<?php
namespace App\Http\Controllers;
use App\Models\Note;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes  = Note::where('user_id', Auth::id())->with('event')->orderByDesc('pinned')->orderByDesc('created_at')->get();
        $events = Event::where('published', true)->orderBy('title')->get();
        return view('notes.index', compact('notes', 'events'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'color'    => 'nullable|string|max:20',
            'event_id' => 'nullable|exists:events,id',
            'pinned'   => 'nullable|boolean',
        ]);
        Note::create(array_merge($data, ['user_id' => Auth::id(), 'pinned' => $request->boolean('pinned')]));
        return back()->with('success', 'Note saved.');
    }

    public function update(Request $request, Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'color'    => 'nullable|string|max:20',
            'event_id' => 'nullable|exists:events,id',
            'pinned'   => 'nullable|boolean',
        ]);
        $note->update(array_merge($data, ['pinned' => $request->boolean('pinned')]));
        return back()->with('success', 'Note updated.');
    }

    public function destroy(Note $note)
    {
        abort_unless($note->user_id === Auth::id(), 403);
        $note->delete();
        return back()->with('success', 'Note deleted.');
    }
}
