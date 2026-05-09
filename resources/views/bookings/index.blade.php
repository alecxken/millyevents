@extends('layouts.app')
@section('title','My Bookings')
@section('content')
<div class="app-pg">
  <div class="section-eyebrow">My Reservations</div>
  <h1 class="page-title serif">My Bookings</h1>
  <p class="page-sub">All your event reservations in one place</p>

  <div class="card">
    @forelse($bookings as $booking)
    <div style="display:flex;align-items:center;gap:16px;padding:16px 0;border-bottom:1px solid var(--light)">
      <div style="width:48px;height:48px;background:var(--gold-lt);border-radius:50%;display:grid;place-items:center;font-size:22px;flex-shrink:0">🎫</div>
      <div style="flex:1">
        <div style="font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:600;color:var(--forest)">{{ $booking->event->title }}</div>
        <div style="font-size:11px;color:var(--text-muted);margin-top:2px">
          📅 {{ $booking->event->start_date->format('d M Y') }} &nbsp;·&nbsp;
          📍 {{ $booking->event->venue }} &nbsp;·&nbsp;
          🎟 {{ $booking->quantity }} ticket{{ $booking->quantity>1?'s':'' }} &nbsp;·&nbsp;
          Ref: <strong>{{ $booking->reference }}</strong>
        </div>
      </div>
      <div style="text-align:right;flex-shrink:0">
        <div style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--forest)">KES {{ number_format($booking->total_amount,0) }}</div>
        <span class="badge {{ $booking->status==='confirmed'?'badge-green':($booking->status==='cancelled'?'badge-red':'badge-sage') }}">{{ ucfirst($booking->status) }}</span>
      </div>
      @if($booking->status === 'confirmed')
      <form method="POST" action="{{ route('bookings.cancel',$booking) }}" onsubmit="return confirm('Cancel this booking?')">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
      </form>
      @endif
    </div>
    @empty
    <div class="empty-state">
      <div class="icon">🎫</div>
      <h3>No Bookings Yet</h3>
      <p>Browse our events and make your first reservation.</p>
      <a href="{{ route('events.index') }}" class="btn btn-primary" style="margin-top:16px">Browse Events</a>
    </div>
    @endforelse
  </div>
</div>
@endsection
