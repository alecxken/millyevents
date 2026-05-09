@extends('layouts.app')
@section('title','Events')
@section('content')
<div class="app-pg">
  <div class="section-eyebrow">Discover</div>
  <h1 class="page-title serif">Upcoming Events</h1>
  <p class="page-sub">Find and book your next curated experience</p>

  <!-- Filter Bar -->
  <form method="GET" style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events…" style="padding:9px 14px;border:1.5px solid var(--light);border-radius:3px;font-family:'DM Sans',sans-serif;font-size:13px;outline:none;min-width:220px;background:var(--cream)">
    <select name="category" style="padding:9px 14px;border:1.5px solid var(--light);border-radius:3px;font-family:'DM Sans',sans-serif;font-size:13px;outline:none;background:var(--cream)">
      <option value="">All Categories</option>
      @foreach($categories as $cat)
      <option value="{{ $cat }}" {{ request('category')===$cat?'selected':'' }}>{{ $cat }}</option>
      @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
    @if(request()->hasAny(['search','category']))
    <a href="{{ route('events.index') }}" class="btn btn-outline">Clear</a>
    @endif
  </form>

  <!-- Grid -->
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px">
    @forelse($events as $event)
    <a href="{{ route('events.show',$event) }}" style="text-decoration:none;color:inherit;background:var(--white);border:1px solid var(--border-col);border-radius:4px;overflow:hidden;display:block;transition:.3s" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 40px rgba(7,51,44,.1)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
      <div style="height:180px;background:linear-gradient(135deg,{{ ['#07332c','#485b46','#1a2420','#0a1f44'][($loop->index)%4] }} 0%,{{ ['#485b46','#1a2420','#485b46','#0d3170'][($loop->index)%4] }} 100%);position:relative;display:flex;align-items:center;justify-content:center;font-size:40px;opacity:.6">
        {{ ['🎭','🏢','🎉','☕','🌿','🎵'][($loop->index)%6] }}
        <span style="position:absolute;top:12px;left:12px;font-size:9px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 10px;border-radius:2px;background:var(--gold);color:var(--forest)">{{ $event->category }}</span>
        @if($event->featured)<span style="position:absolute;top:12px;right:12px;font-size:9px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:4px 10px;border-radius:2px;background:rgba(255,255,255,.15);color:var(--white)">Featured</span>@endif
      </div>
      <div style="padding:16px 18px 18px">
        <h3 style="font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:600;color:var(--forest);line-height:1.25;margin-bottom:8px">{{ $event->title }}</h3>
        <div style="font-size:11px;color:var(--text-muted);line-height:1.7;margin-bottom:12px">
          📅 {{ $event->start_date->format('d M Y') }}<br>
          📍 {{ $event->venue }}, {{ $event->location }}<br>
          👥 {{ $event->slots_remaining }} of {{ $event->capacity }} slots available
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:1px solid #f0ede8">
          <div style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--forest)">{{ $event->formatted_price }}</div>
          <span class="btn btn-primary btn-sm">Book Now</span>
        </div>
        <div style="height:4px;background:var(--light);border-radius:2px;margin-top:8px;overflow:hidden"><div style="height:100%;background:var(--gold);border-radius:2px;width:{{ $event->slot_percent }}%"></div></div>
      </div>
    </a>
    @empty
    <div class="empty-state" style="grid-column:1/-1">
      <div class="icon">🎭</div>
      <h3>No Events Found</h3>
      <p>Try adjusting your search filters.</p>
    </div>
    @endforelse
  </div>

  <div style="margin-top:24px">{{ $events->links() }}</div>
</div>
@endsection
