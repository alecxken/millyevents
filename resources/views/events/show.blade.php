@extends('layouts.app')
@section('title',$event->title)
@section('content')
<div class="app-pg">
  <div style="margin-bottom:16px"><a href="{{ route('events.index') }}" style="font-size:11px;color:var(--text-muted);text-decoration:none">← All Events</a></div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start">
    <div>
      <!-- Hero -->
      <div style="height:320px;background:linear-gradient(135deg,var(--forest),var(--olive));border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:72px;opacity:.5;margin-bottom:24px;position:relative">
        🎭
        <span style="position:absolute;top:20px;left:20px;font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;padding:6px 14px;border-radius:2px;background:var(--gold);color:var(--forest)">{{ $event->category }}</span>
        <span style="position:absolute;top:20px;right:20px" class="badge {{ $event->status==='upcoming'?'badge-green':($event->status==='past'?'badge-muted':'badge-red') }}">{{ ucfirst($event->status) }}</span>
      </div>

      <div class="card">
        <div class="section-eyebrow">About This Event</div>
        <h1 class="page-title serif" style="margin-bottom:16px">{{ $event->title }}</h1>
        <p style="font-size:14px;line-height:1.8;color:var(--text-muted)">{{ $event->description }}</p>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:24px;padding-top:24px;border-top:1px solid var(--light)">
          <div><div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:4px">Date</div><div style="font-weight:600">{{ $event->start_date->format('d M Y') }}</div></div>
          <div><div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:4px">Venue</div><div style="font-weight:600">{{ $event->venue }}</div></div>
          <div><div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:4px">Location</div><div style="font-weight:600">{{ $event->location }}</div></div>
          <div><div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:4px">Time</div><div style="font-weight:600">{{ $event->start_date->format('H:i') }}{{ $event->end_date?' – '.$event->end_date->format('H:i'):'' }}</div></div>
          <div><div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:4px">Capacity</div><div style="font-weight:600">{{ $event->capacity }} seats</div></div>
          <div><div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:4px">Available</div><div style="font-weight:600">{{ $event->slots_remaining }} left</div></div>
        </div>
      </div>
    </div>

    <!-- Booking Card -->
    <div class="card" style="position:sticky;top:80px">
      <div style="font-family:'Cormorant Garamond',serif;font-size:36px;font-weight:600;color:var(--forest);margin-bottom:4px">{{ $event->formatted_price }}</div>
      <div style="font-size:11px;color:var(--text-muted);margin-bottom:16px">per person</div>

      <div style="height:6px;background:var(--light);border-radius:3px;margin-bottom:8px;overflow:hidden"><div style="height:100%;background:var(--gold);border-radius:3px;width:{{ $event->slot_percent }}%"></div></div>
      <div style="font-size:11px;color:var(--text-muted);margin-bottom:20px">{{ $event->slots_remaining }} of {{ $event->capacity }} seats available ({{ 100-$event->slot_percent }}%)</div>

      @auth
        @if($event->slots_remaining > 0 && $event->status === 'upcoming')
        <form method="POST" action="{{ route('events.book',$event) }}">
          @csrf
          <div class="fld">
            <label>Number of Tickets</label>
            <select name="quantity">
              @for($i=1;$i<=min(10,$event->slots_remaining);$i++)<option value="{{ $i }}">{{ $i }} ticket{{ $i>1?'s':'' }}</option>@endfor
            </select>
          </div>
          <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;padding:14px">Reserve Now</button>
        </form>
        @elseif($event->slots_remaining === 0)
        <div class="alert alert-error">This event is fully booked.</div>
        @else
        <div class="alert" style="background:var(--light);color:var(--text-muted)">Bookings are not available for this event.</div>
        @endif
      @else
      <div style="text-align:center;padding:16px 0">
        <p style="font-size:12px;color:var(--text-muted);margin-bottom:12px">Sign in to book this event</p>
        <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;justify-content:center">Sign In to Book</a>
        <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:8px">Create Account</a>
      </div>
      @endauth

      <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--light)">
        <div style="font-size:10px;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:8px">Organised By</div>
        <div style="font-size:12px;color:var(--text)">{{ $event->creator?->name ?? 'Milyvents Team' }}</div>
      </div>
    </div>
  </div>
</div>
@endsection
