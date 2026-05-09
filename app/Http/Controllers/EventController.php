<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('published', true);
        if ($request->filled('category')) $query->where('category', $request->category);
        if ($request->filled('search'))   $query->where('title', 'like', '%'.$request->search.'%');
        $events = $query->orderBy('start_date')->paginate(9);
        $categories = Event::where('published', true)->distinct()->pluck('category');
        return view('events.index', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        abort_unless($event->published, 404);
        return view('events.show', compact('event'));
    }

    public function book(Request $request, Event $event)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:10']);
        if ($event->slots_remaining < $request->quantity) {
            return back()->with('error', 'Not enough slots available.');
        }
        $booking = Booking::create([
            'user_id'        => Auth::id(),
            'event_id'       => $event->id,
            'quantity'       => $request->quantity,
            'total_amount'   => $event->price * $request->quantity,
            'status'         => 'confirmed',
            'payment_method' => 'card',
        ]);
        $event->increment('slots_taken', $request->quantity);
        return redirect()->route('dashboard')->with('success', "Booking confirmed! Ref: {$booking->reference}");
    }
}
