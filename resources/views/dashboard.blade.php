@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="app-pg">
  <div class="section-eyebrow">Welcome Back</div>
  <h1 class="page-title serif">{{ auth()->user()->name }}</h1>
  <p class="page-sub">Your event management dashboard</p>

  <!-- KPIs -->
  <div class="kpi-row">
    <div class="kc c-forest"><div class="kc-label">My Bookings</div><div class="kc-value serif">{{ $stats['bookings'] }}</div><div class="kc-note">Confirmed reservations</div></div>
    <div class="kc c-gold"><div class="kc-label">My Notes</div><div class="kc-value serif">{{ $stats['notes'] }}</div><div class="kc-note">Saved notes</div></div>
    <div class="kc c-olive"><div class="kc-label">Test Plans</div><div class="kc-value serif">{{ $stats['plans'] }}</div><div class="kc-note">Created plans</div></div>
    <div class="kc c-sage"><div class="kc-label">Live Events</div><div class="kc-value serif">{{ $stats['events'] }}</div><div class="kc-note">Available to book</div></div>
  </div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px">

    <!-- Recent Bookings -->
    <div class="card">
      <div class="card-header">
        <div><div class="card-title serif">Recent Bookings</div><div class="card-sub">Your latest event reservations</div></div>
        <a href="{{ route('bookings.index') }}" class="btn btn-outline btn-sm">View All</a>
      </div>
      @forelse($bookings as $booking)
      <div style="display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid #f3f1ec">
        <div style="width:40px;height:40px;background:var(--gold-lt);border-radius:50%;display:grid;place-items:center;font-size:18px;flex-shrink:0">🎫</div>
        <div style="flex:1">
          <div style="font-weight:600;font-size:13px;color:var(--forest)">{{ $booking->event->title }}</div>
          <div style="font-size:11px;color:var(--text-muted)">{{ $booking->event->start_date->format('d M Y') }} · {{ $booking->reference }}</div>
        </div>
        <span class="badge {{ $booking->status==='confirmed'?'badge-green':($booking->status==='cancelled'?'badge-red':'badge-muted') }}">{{ $booking->status }}</span>
      </div>
      @empty
      <div class="empty-state" style="padding:32px"><div class="icon">🎫</div><p>No bookings yet. <a href="{{ route('events.index') }}" style="color:var(--forest)">Browse events</a></p></div>
      @endforelse
    </div>

    <!-- Quick Actions -->
    <div>
      <div class="card" style="margin-bottom:16px">
        <div class="card-title serif" style="margin-bottom:16px">Quick Actions</div>
        <div style="display:flex;flex-direction:column;gap:8px">
          <a href="{{ route('events.index') }}" class="btn btn-primary" style="justify-content:center">🎟 Browse Events</a>
          <a href="{{ route('notes.index') }}" class="btn btn-outline" style="justify-content:center">📝 My Notes</a>
          <a href="{{ route('tests.index') }}" class="btn btn-outline" style="justify-content:center">🧪 Test Plans</a>
          <a href="{{ route('pdf.project') }}" class="btn btn-gold" style="justify-content:center">📄 Project PDF</a>
        </div>
      </div>

      <!-- Pinned Notes -->
      <div class="card">
        <div class="card-title serif" style="margin-bottom:12px">Pinned Notes</div>
        @forelse($notes->where('pinned',true) as $note)
        <div style="padding:10px 12px;background:{{ $note->color }};border-radius:3px;margin-bottom:8px;border-left:3px solid var(--gold)">
          <div style="font-size:12px;font-weight:600;color:var(--forest)">{{ $note->title }}</div>
          <div style="font-size:11px;color:var(--text-muted);margin-top:3px">{{ Str::limit($note->body,80) }}</div>
        </div>
        @empty
        <div style="font-size:12px;color:var(--text-muted);text-align:center;padding:16px">No pinned notes</div>
        @endforelse
        <a href="{{ route('notes.index') }}" class="btn btn-outline btn-sm" style="width:100%;justify-content:center;margin-top:8px">All Notes</a>
      </div>
    </div>

  </div>

  <!-- Test Plans Preview -->
  @if($plans->count())
  <div class="card" style="margin-top:16px">
    <div class="card-header">
      <div><div class="card-title serif">Test Plans</div><div class="card-sub">Quality assurance for your projects</div></div>
      <a href="{{ route('tests.index') }}" class="btn btn-outline btn-sm">View All</a>
    </div>
    <table class="tbl">
      <thead><tr><th>Plan Name</th><th>Test Cases</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @foreach($plans as $plan)
        <tr>
          <td style="font-weight:600;color:var(--forest)">{{ $plan->name }}</td>
          <td>{{ $plan->testCases()->count() }}</td>
          <td><span class="badge {{ $plan->status==='active'?'badge-green':($plan->status==='completed'?'badge-gold':'badge-muted') }}">{{ $plan->status }}</span></td>
          <td><a href="{{ route('tests.show',$plan) }}" class="btn btn-outline btn-sm">View</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>
@endsection
