@extends('layouts.app')
@section('title', $event ? 'Edit Event' : 'New Event')
@section('content')
<div class="app-pg" style="max-width:900px">
  <div style="margin-bottom:16px"><a href="{{ route('admin.events.index') }}" style="font-size:11px;color:var(--text-muted);text-decoration:none">← Events</a></div>
  <div class="section-eyebrow">Admin</div>
  <h1 class="page-title serif">{{ $event ? 'Edit Event' : 'Create New Event' }}</h1>

  <form method="POST" action="{{ $event ? route('admin.events.update',$event) : route('admin.events.store') }}">
    @csrf
    @if($event) @method('PUT') @endif

    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">Event Details</div>
      <div class="fld"><label>Event Title *</label><input name="title" required value="{{ old('title',$event?->title) }}" placeholder="The Grand Annual Gala Night"></div>
      <div class="fld"><label>Description *</label><textarea name="description" rows="4" required>{{ old('description',$event?->description) }}</textarea></div>
      <div class="fld-row">
        <div class="fld"><label>Category *</label><input name="category" required value="{{ old('category',$event?->category) }}" placeholder="Gala, Business Summit, Festival…"></div>
        <div class="fld"><label>Status *</label>
          <select name="status">
            @foreach(['upcoming','ongoing','past','cancelled'] as $s)
            <option value="{{ $s }}" {{ old('status',$event?->status)===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="fld-row">
        <div class="fld"><label>Venue *</label><input name="venue" required value="{{ old('venue',$event?->venue) }}" placeholder="Nairobi Serena Hotel"></div>
        <div class="fld"><label>Location *</label><input name="location" required value="{{ old('location',$event?->location) }}" placeholder="Nairobi, Kenya"></div>
      </div>
    </div>

    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">Date, Price & Capacity</div>
      <div class="fld-row">
        <div class="fld"><label>Start Date & Time *</label><input type="datetime-local" name="start_date" required value="{{ old('start_date',$event?->start_date?->format('Y-m-d\TH:i')) }}"></div>
        <div class="fld"><label>End Date & Time</label><input type="datetime-local" name="end_date" value="{{ old('end_date',$event?->end_date?->format('Y-m-d\TH:i')) }}"></div>
      </div>
      <div class="fld-row">
        <div class="fld"><label>Price (KES) *</label><input type="number" name="price" required min="0" step="100" value="{{ old('price',$event?->price ?? 0) }}"></div>
        <div class="fld"><label>Total Capacity *</label><input type="number" name="capacity" required min="1" value="{{ old('capacity',$event?->capacity ?? 100) }}"></div>
      </div>
      <div class="fld"><label>Image URL (optional)</label><input name="image_url" type="url" value="{{ old('image_url',$event?->image_url) }}" placeholder="https://…"></div>
    </div>

    <div class="card">
      <div class="card-title serif" style="margin-bottom:12px">Visibility</div>
      <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;margin-bottom:10px">
        <input type="checkbox" name="published" value="1" {{ old('published',$event?->published ?? true)?'checked':'' }}> Published (visible to public)
      </label>
      <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer">
        <input type="checkbox" name="featured" value="1" {{ old('featured',$event?->featured)?'checked':'' }}> Featured on homepage
      </label>
    </div>

    @if($errors->any())
    <div class="alert alert-error">{{ implode(', ', $errors->all()) }}</div>
    @endif

    <div style="display:flex;gap:12px">
      <button type="submit" class="btn btn-gold">{{ $event ? 'Update Event' : 'Create Event' }}</button>
      <a href="{{ route('admin.events.index') }}" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
