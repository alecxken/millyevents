@extends('layouts.app')
@section('title','Test Plans')
@section('content')
<div class="app-pg">
  <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px">
    <div>
      <div class="section-eyebrow">Quality Assurance</div>
      <h1 class="page-title serif">Test Plans</h1>
      <p class="page-sub">Create, manage and export test plans for your projects</p>
    </div>
    <a href="{{ route('tests.create') }}" class="btn btn-gold">+ New Test Plan</a>
  </div>

  @forelse($plans as $plan)
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title serif">{{ $plan->name }}</div>
        <div class="card-sub">{{ Str::limit($plan->description,120) }}</div>
      </div>
      <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
        <span class="badge {{ $plan->status==='active'?'badge-green':($plan->status==='completed'?'badge-gold':'badge-muted') }}">{{ ucfirst($plan->status) }}</span>
        <a href="{{ route('tests.show',$plan) }}" class="btn btn-primary btn-sm">View</a>
        <a href="{{ route('tests.edit',$plan) }}" class="btn btn-outline btn-sm">Edit</a>
        <a href="{{ route('pdf.test-plan',$plan) }}" class="btn btn-gold btn-sm">📄 PDF</a>
        <form method="POST" action="{{ route('tests.destroy',$plan) }}" onsubmit="return confirm('Delete this test plan?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Del</button></form>
      </div>
    </div>
    <div style="display:flex;gap:24px;flex-wrap:wrap">
      <div style="text-align:center"><div style="font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:var(--forest)">{{ $plan->testCases->count() }}</div><div style="font-size:10px;text-transform:uppercase;letter-spacing:.1em;color:var(--text-muted)">Test Cases</div></div>
      @php $latest = $plan->testCases->flatMap->results; @endphp
      <div style="text-align:center"><div style="font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:#2a7040">{{ $latest->where('status','pass')->count() }}</div><div style="font-size:10px;text-transform:uppercase;letter-spacing:.1em;color:var(--text-muted)">Passed</div></div>
      <div style="text-align:center"><div style="font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:#b83c35">{{ $latest->where('status','fail')->count() }}</div><div style="font-size:10px;text-transform:uppercase;letter-spacing:.1em;color:var(--text-muted)">Failed</div></div>
      <div style="text-align:center"><div style="font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:var(--text-muted)">{{ $latest->where('status','not_tested')->count() }}</div><div style="font-size:10px;text-transform:uppercase;letter-spacing:.1em;color:var(--text-muted)">Not Tested</div></div>
      <div style="text-align:center"><div style="font-size:11px;color:var(--text-muted)">Created<br>{{ $plan->created_at->format('d M Y') }}</div></div>
    </div>
  </div>
  @empty
  <div class="empty-state card">
    <div class="icon">🧪</div>
    <h3>No Test Plans Yet</h3>
    <p>Create your first test plan to track quality assurance for your project.</p>
    <a href="{{ route('tests.create') }}" class="btn btn-primary" style="margin-top:16px">Create Test Plan</a>
  </div>
  @endforelse
</div>
@endsection
