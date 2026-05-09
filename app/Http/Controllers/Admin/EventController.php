<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('creator')->orderByDesc('created_at')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create() { return view('admin.events.form', ['event' => null]); }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Event::create(array_merge($data, ['created_by' => Auth::id()]));
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function edit(Event $event) { return view('admin.events.form', compact('event')); }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validated($request));
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string|max:100',
            'venue'       => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after:start_date',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
            'status'      => 'required|in:upcoming,ongoing,past,cancelled',
            'image_url'   => 'nullable|url',
            'featured'    => 'boolean',
            'published'   => 'boolean',
        ]);
    }
}
