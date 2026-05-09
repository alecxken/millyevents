@extends('layouts.app')
@section('title','Notes')
@section('content')
<div class="app-pg">
  <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
    <div>
      <div class="section-eyebrow">My Notes</div>
      <h1 class="page-title serif">Notes</h1>
      <p class="page-sub">Personal notes attached to events or general thoughts</p>
    </div>
    <button class="btn btn-gold" onclick="document.getElementById('new-note-modal').classList.add('show')">+ New Note</button>
  </div>

  <!-- Notes Grid -->
  @if($notes->isEmpty())
  <div class="empty-state card">
    <div class="icon">📝</div>
    <h3>No Notes Yet</h3>
    <p>Start capturing your thoughts and event insights.</p>
    <button class="btn btn-primary" style="margin-top:16px" onclick="document.getElementById('new-note-modal').classList.add('show')">Create First Note</button>
  </div>
  @else
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px">
    @foreach($notes as $note)
    <div style="background:{{ $note->color }};border:1px solid rgba(0,0,0,.06);border-radius:4px;padding:18px;position:relative;transition:.2s" onmouseover="this.style.boxShadow='0 6px 24px rgba(0,0,0,.1)'" onmouseout="this.style.boxShadow=''">
      @if($note->pinned)<div style="position:absolute;top:10px;right:10px;font-size:14px">📌</div>@endif
      <div style="font-family:'Cormorant Garamond',serif;font-size:17px;font-weight:600;color:var(--forest);margin-bottom:6px;padding-right:20px">{{ $note->title }}</div>
      @if($note->event)<div style="font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--gold-dk);margin-bottom:8px">📅 {{ $note->event->title }}</div>@endif
      <p style="font-size:12px;color:var(--text-muted);line-height:1.7">{{ Str::limit($note->body,150) }}</p>
      <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;padding-top:10px;border-top:1px solid rgba(0,0,0,.06)">
        <span style="font-size:10px;color:var(--text-muted)">{{ $note->created_at->diffForHumans() }}</span>
        <div style="display:flex;gap:6px">
          <button class="btn btn-outline btn-sm" onclick="openEdit({{ $note->id }}, '{{ addslashes($note->title) }}', {{ json_encode($note->body) }}, '{{ $note->color }}', {{ $note->event_id ?? 'null' }}, {{ $note->pinned?'true':'false' }})">Edit</button>
          <form method="POST" action="{{ route('notes.destroy',$note) }}" onsubmit="return confirm('Delete this note?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Del</button></form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>

<!-- New Note Modal -->
<div id="new-note-modal" style="display:none;position:fixed;inset:0;background:rgba(7,51,44,.6);z-index:2000;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(8px)" onclick="if(event.target===this)this.classList.remove('show')">
  <div style="background:var(--white);border-radius:6px;width:100%;max-width:500px;overflow:hidden">
    <div style="background:var(--forest);padding:24px 28px;display:flex;align-items:center;justify-content:space-between">
      <div style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--white)">New Note</div>
      <button onclick="document.getElementById('new-note-modal').classList.remove('show')" style="background:rgba(255,255,255,.08);border:none;border-radius:50%;width:28px;height:28px;color:rgba(255,255,255,.6);cursor:pointer;font-size:16px">×</button>
    </div>
    <form method="POST" action="{{ route('notes.store') }}" style="padding:24px 28px">
      @csrf
      <div class="fld"><label>Title</label><input name="title" required placeholder="Note title…"></div>
      <div class="fld"><label>Body</label><textarea name="body" rows="4" required placeholder="Your note…" style="resize:vertical"></textarea></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div class="fld">
          <label>Link to Event</label>
          <select name="event_id">
            <option value="">No event</option>
            @foreach($events as $ev)<option value="{{ $ev->id }}">{{ Str::limit($ev->title,30) }}</option>@endforeach
          </select>
        </div>
        <div class="fld">
          <label>Note Color</label>
          <select name="color">
            <option value="#f7f4ef">Cream</option>
            <option value="#edf4f9">Blue</option>
            <option value="#eef6f0">Green</option>
            <option value="#fef9ec">Yellow</option>
            <option value="#faeae9">Red</option>
          </select>
        </div>
      </div>
      <label style="display:flex;align-items:center;gap:8px;font-size:12px;cursor:pointer;margin-bottom:16px">
        <input type="checkbox" name="pinned" value="1"> Pin this note
      </label>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Save Note</button>
    </form>
  </div>
</div>

<!-- Edit Note Modal -->
<div id="edit-note-modal" style="display:none;position:fixed;inset:0;background:rgba(7,51,44,.6);z-index:2000;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(8px)">
  <div style="background:var(--white);border-radius:6px;width:100%;max-width:500px;overflow:hidden">
    <div style="background:var(--forest);padding:24px 28px;display:flex;align-items:center;justify-content:space-between">
      <div style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--white)">Edit Note</div>
      <button onclick="document.getElementById('edit-note-modal').style.display='none'" style="background:rgba(255,255,255,.08);border:none;border-radius:50%;width:28px;height:28px;color:rgba(255,255,255,.6);cursor:pointer;font-size:16px">×</button>
    </div>
    <form id="edit-note-form" method="POST" style="padding:24px 28px">
      @csrf @method('PUT')
      <div class="fld"><label>Title</label><input id="en-title" name="title" required></div>
      <div class="fld"><label>Body</label><textarea id="en-body" name="body" rows="4" style="resize:vertical"></textarea></div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div class="fld"><label>Event</label><select id="en-event" name="event_id"><option value="">No event</option>@foreach($events as $ev)<option value="{{ $ev->id }}">{{ Str::limit($ev->title,30) }}</option>@endforeach</select></div>
        <div class="fld"><label>Color</label><select id="en-color" name="color"><option value="#f7f4ef">Cream</option><option value="#edf4f9">Blue</option><option value="#eef6f0">Green</option><option value="#fef9ec">Yellow</option><option value="#faeae9">Red</option></select></div>
      </div>
      <label style="display:flex;align-items:center;gap:8px;font-size:12px;cursor:pointer;margin-bottom:16px"><input type="checkbox" id="en-pinned" name="pinned" value="1"> Pin this note</label>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Update Note</button>
    </form>
  </div>
</div>

<style>
  #new-note-modal.show{display:flex}
</style>
<script>
function openEdit(id, title, body, color, eventId, pinned) {
  document.getElementById('edit-note-form').action = `/notes/${id}`;
  document.getElementById('en-title').value = title;
  document.getElementById('en-body').value = body;
  document.getElementById('en-color').value = color;
  if (eventId) document.getElementById('en-event').value = eventId;
  document.getElementById('en-pinned').checked = pinned;
  document.getElementById('edit-note-modal').style.display = 'flex';
}
</script>
@endsection
