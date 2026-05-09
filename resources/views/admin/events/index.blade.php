@extends('layouts.app')
@section('title','Manage Events')
@section('content')
<div class="app-pg">
  <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
    <div>
      <div class="section-eyebrow">Admin</div>
      <h1 class="page-title serif">Manage Events</h1>
    </div>
    <div style="display:flex;gap:8px">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">← Dashboard</a>
      <a href="{{ route('admin.events.create') }}" class="btn btn-gold">+ New Event</a>
    </div>
  </div>

  <div class="card">
    <table class="tbl">
      <thead><tr><th>Title</th><th>Category</th><th>Date</th><th>Price</th><th>Capacity</th><th>Status</th><th>Published</th><th></th></tr></thead>
      <tbody>
        @forelse($events as $event)
        <tr>
          <td style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:600;color:var(--forest)">{{ $event->title }}</td>
          <td><span class="badge badge-sage">{{ $event->category }}</span></td>
          <td>{{ $event->start_date->format('d M Y') }}</td>
          <td>KES {{ number_format($event->price,0) }}</td>
          <td>{{ $event->slots_taken }}/{{ $event->capacity }}</td>
          <td><span class="badge {{ $event->status==='upcoming'?'badge-green':($event->status==='past'?'badge-muted':'badge-red') }}">{{ ucfirst($event->status) }}</span></td>
          <td><span class="badge {{ $event->published?'badge-green':'badge-muted' }}">{{ $event->published?'Live':'Draft' }}</span></td>
          <td style="display:flex;gap:6px">
            <a href="{{ route('admin.events.edit',$event) }}" class="btn btn-outline btn-sm">Edit</a>
            <form method="POST" action="{{ route('admin.events.destroy',$event) }}" onsubmit="return confirm('Delete this event?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Del</button></form>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:32px;color:var(--text-muted)">No events yet. <a href="{{ route('admin.events.create') }}" style="color:var(--forest)">Create one</a></td></tr>
        @endforelse
      </tbody>
    </table>
    <div style="margin-top:16px">{{ $events->links() }}</div>
  </div>
</div>
@endsection
