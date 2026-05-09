<?php
namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('event')->orderByDesc('created_at')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        abort_unless($booking->user_id === Auth::id(), 403);
        $booking->event->decrement('slots_taken', $booking->quantity);
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled.');
    }
}
