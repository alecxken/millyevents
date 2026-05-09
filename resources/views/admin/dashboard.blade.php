@extends('layouts.app')
@section('title','Admin Dashboard')
@section('content')
<div class="app-pg">
  <div class="section-eyebrow">Administration</div>
  <h1 class="page-title serif">Admin Dashboard</h1>
  <p class="page-sub">Manage events, users, bookings and carousel slides</p>

  <div class="kpi-row">
    <div class="kc c-forest"><div class="kc-label">Total Events</div><div class="kc-value serif">{{ $stats['events'] }}</div></div>
    <div class="kc c-gold"><div class="kc-label">Registered Users</div><div class="kc-value serif">{{ $stats['users'] }}</div></div>
    <div class="kc c-olive"><div class="kc-label">Total Bookings</div><div class="kc-value serif">{{ $stats['bookings'] }}</div></div>
    <div class="kc c-sage"><div class="kc-label">Revenue</div><div class="kc-value serif" style="font-size:22px">KES {{ number_format($stats['revenue'],0) }}</div></div>
  </div>

  <div style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap">
    <a href="{{ route('admin.events.create') }}" class="btn btn-gold">+ New Event</a>
    <a href="{{ route('admin.events.index') }}" class="btn btn-primary">Manage Events</a>
    <a href="{{ route('admin.carousel.index') }}" class="btn btn-outline">Carousel Slides</a>
    <a href="{{ route('pdf.project') }}" class="btn btn-outline">📄 Project PDF</a>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">Recent Events</div>
      <table class="tbl">
        <thead><tr><th>Title</th><th>Date</th><th>Status</th></tr></thead>
        <tbody>
          @foreach($recentEvents as $ev)
          <tr>
            <td style="font-weight:500">{{ Str::limit($ev->title,30) }}</td>
            <td>{{ $ev->start_date->format('d M Y') }}</td>
            <td><span class="badge {{ $ev->published?'badge-green':'badge-muted' }}">{{ $ev->published?'Live':'Draft' }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">Recent Bookings</div>
      <table class="tbl">
        <thead><tr><th>User</th><th>Event</th><th>Ref</th><th>Status</th></tr></thead>
        <tbody>
          @foreach($recentBookings as $b)
          <tr>
            <td>{{ Str::limit($b->user->name,15) }}</td>
            <td>{{ Str::limit($b->event->title,20) }}</td>
            <td style="font-family:monospace;font-size:10px">{{ $b->reference }}</td>
            <td><span class="badge {{ $b->status==='confirmed'?'badge-green':'badge-red' }}">{{ $b->status }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
