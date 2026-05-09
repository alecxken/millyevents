@extends('layouts.app')
@section('title','Carousel Slides')
@section('content')
<div class="app-pg">
  <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
    <div>
      <div class="section-eyebrow">Admin · Homepage</div>
      <h1 class="page-title serif">Carousel Slides</h1>
      <p class="page-sub">Manage the hero carousel displayed on the landing page</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">← Dashboard</a>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:start">

    <!-- Current Slides -->
    <div>
      <div class="card-title serif" style="margin-bottom:12px;font-size:18px">Current Slides</div>
      @forelse($slides as $slide)
      <div class="card" style="border-left:4px solid {{ $slide->bg_color }};margin-bottom:12px">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:12px">
          <div>
            <span class="badge badge-gold" style="margin-right:6px">Order {{ $slide->sort_order }}</span>
            <span class="badge {{ $slide->active?'badge-green':'badge-muted' }}">{{ $slide->active?'Active':'Hidden' }}</span>
          </div>
          <form method="POST" action="{{ route('admin.carousel.destroy',$slide) }}" onsubmit="return confirm('Delete this slide?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Delete</button></form>
        </div>
        <div style="font-weight:600;color:var(--forest);margin-bottom:4px">{{ $slide->tag }}</div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:600;color:var(--forest);white-space:pre-line;margin-bottom:6px">{{ $slide->headline }}</div>
        <div style="font-size:11px;color:var(--text-muted)">{{ Str::limit($slide->sub_text,80) }}</div>
        @if($slide->event)
        <div style="font-size:11px;color:var(--gold-dk);margin-top:6px">🔗 {{ $slide->event->title }}</div>
        @endif
        <div style="display:flex;gap:8px;margin-top:10px;font-size:11px;color:var(--text-muted)">
          @if($slide->date_display)<span>📅 {{ $slide->date_display }}</span>@endif
          @if($slide->venue_display)<span>📍 {{ $slide->venue_display }}</span>@endif
          @if($slide->price_display)<span>💰 {{ $slide->price_display }}</span>@endif
        </div>

        <!-- Quick Edit -->
        <form method="POST" action="{{ route('admin.carousel.update',$slide) }}" style="margin-top:12px;padding-top:12px;border-top:1px solid var(--light)">
          @csrf @method('PUT')
          <input type="hidden" name="tag" value="{{ $slide->tag }}">
          <input type="hidden" name="headline" value="{{ $slide->headline }}">
          <div style="display:flex;gap:8px;align-items:center">
            <select name="active" style="padding:5px 8px;border:1.5px solid var(--light);border-radius:2px;font-size:11px;background:var(--cream)">
              <option value="1" {{ $slide->active?'selected':'' }}>Active</option>
              <option value="0" {{ !$slide->active?'selected':'' }}>Hidden</option>
            </select>
            <input type="number" name="sort_order" value="{{ $slide->sort_order }}" style="width:60px;padding:5px 8px;border:1.5px solid var(--light);border-radius:2px;font-size:11px;background:var(--cream)" placeholder="Order">
            <button type="submit" class="btn btn-outline btn-sm">Update</button>
          </div>
        </form>
      </div>
      @empty
      <div class="empty-state card"><div class="icon">🖼</div><p>No slides yet. Add one using the form.</p></div>
      @endforelse
    </div>

    <!-- Add New Slide -->
    <div class="card" style="position:sticky;top:80px">
      <div class="card-title serif" style="margin-bottom:16px">Add New Slide</div>
      <form method="POST" action="{{ route('admin.carousel.store') }}">
        @csrf
        <div class="fld"><label>Tag / Category Label *</label><input name="tag" required placeholder="Featured Event"></div>
        <div class="fld"><label>Headline * (use line breaks for multiple lines)</label><textarea name="headline" rows="3" required placeholder="The Grand&#10;Annual&#10;Gala Night"></textarea></div>
        <div class="fld"><label>Sub Text</label><textarea name="sub_text" rows="2" placeholder="Short description of the event…"></textarea></div>
        <div class="fld-row">
          <div class="fld"><label>Primary Button</label><input name="btn_primary_label" value="Reserve a Seat"></div>
          <div class="fld"><label>Secondary Button</label><input name="btn_secondary_label" value="Learn More"></div>
        </div>
        <div class="fld-row">
          <div class="fld"><label>Date Display</label><input name="date_display" placeholder="14 September 2025"></div>
          <div class="fld"><label>Venue Display</label><input name="venue_display" placeholder="Nairobi Serena Hotel"></div>
        </div>
        <div class="fld-row">
          <div class="fld"><label>Price Display</label><input name="price_display" placeholder="KES 12,000"></div>
          <div class="fld"><label>Background Color</label><input name="bg_color" type="color" value="#07332c" style="height:38px;padding:4px"></div>
        </div>
        <div class="fld-row">
          <div class="fld"><label>Sort Order</label><input type="number" name="sort_order" value="{{ ($slides->max('sort_order') ?? 0) + 1 }}"></div>
          <div class="fld"><label>Link to Event</label>
            <select name="event_id">
              <option value="">None</option>
              @foreach($events as $ev)<option value="{{ $ev->id }}">{{ Str::limit($ev->title,35) }}</option>@endforeach
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center">Add Slide</button>
      </form>
    </div>
  </div>
</div>
@endsection
