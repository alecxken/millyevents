@extends('layouts.app')
@section('title',$test->name)
@section('content')
<div class="app-pg">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px">
    <div><a href="{{ route('tests.index') }}" style="font-size:11px;color:var(--text-muted);text-decoration:none">← Test Plans</a></div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
      <a href="{{ route('tests.edit',$test) }}" class="btn btn-outline btn-sm">Edit Plan</a>
      @if($test->testCases->count())
      <button class="btn btn-primary btn-sm" onclick="document.getElementById('run-all-modal').style.display='flex'">▶ Run All Tests</button>
      @endif
      <a href="{{ route('pdf.test-plan',$test) }}" class="btn btn-gold btn-sm">📄 Export PDF</a>
    </div>
  </div>

  <!-- Plan Header -->
  <div class="card">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px">
      <div>
        <div class="section-eyebrow">Test Plan</div>
        <h1 class="page-title serif">{{ $test->name }}</h1>
        @if($test->description)<p style="font-size:14px;color:var(--text-muted);margin-top:8px">{{ $test->description }}</p>@endif
      </div>
      <span class="badge {{ $test->status==='active'?'badge-green':($test->status==='completed'?'badge-gold':'badge-muted') }}" style="font-size:11px;padding:6px 14px">{{ ucfirst($test->status) }}</span>
    </div>

    @php
    $allResults = $test->testCases->flatMap->results;
    $pass = $allResults->where('status','pass')->count();
    $fail = $allResults->where('status','fail')->count();
    $blocked = $allResults->where('status','blocked')->count();
    $total = $test->testCases->count();
    @endphp

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:20px;padding-top:20px;border-top:1px solid var(--light)">
      <div class="kc c-forest" style="margin:0"><div class="kc-label">Total Cases</div><div class="kc-value serif">{{ $total }}</div></div>
      <div class="kc c-gold" style="margin:0"><div class="kc-label">Passed</div><div class="kc-value serif" style="color:#2a7040">{{ $pass }}</div></div>
      <div class="kc" style="margin:0;border-top:3px solid #b83c35"><div class="kc-label">Failed</div><div class="kc-value serif" style="color:#b83c35">{{ $fail }}</div></div>
      <div class="kc c-sage" style="margin:0"><div class="kc-label">Blocked</div><div class="kc-value serif">{{ $blocked }}</div></div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;align-items:start">

    <!-- Test Cases -->
    <div>
      <div class="card">
        <div class="card-header">
          <div class="card-title serif">5.5 Test Cases</div>
          <button class="btn btn-primary btn-sm" onclick="document.getElementById('add-case-modal').classList.add('show')">+ Add Test Case</button>
        </div>

        @forelse($test->testCases as $i => $case)
        <div style="border:1px solid var(--border-col);border-radius:3px;margin-bottom:12px;overflow:hidden">
          <div style="background:#f9f8f6;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">
            <div style="display:flex;align-items:center;gap:10px">
              <span style="font-size:10px;font-weight:700;letter-spacing:.1em;color:var(--text-muted)">TC {{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
              <span style="font-weight:600;color:var(--forest)">{{ $case->name }}</span>
              <span class="badge {{ $case->priority==='critical'?'badge-red':($case->priority==='high'?'badge-gold':($case->priority==='medium'?'badge-sage':'badge-muted')) }}">{{ $case->priority }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:8px">
              @if($case->latestResult)
              <span class="badge result-{{ $case->latestResult->status }}">{{ str_replace('_',' ',$case->latestResult->status) }}</span>
              @else
              <span class="badge badge-muted">Not Tested</span>
              @endif
              <button class="btn btn-outline btn-sm" onclick="openResult({{ $case->id }})">Record Result</button>
              <form method="POST" action="{{ route('tests.cases.destroy',$case) }}" onsubmit="return confirm('Delete this test case?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Del</button></form>
            </div>
          </div>
          <div style="padding:14px 16px">
            @if($case->description)<p style="font-size:12px;color:var(--text-muted);margin-bottom:8px">{{ $case->description }}</p>@endif
            @if($case->preconditions)<div style="font-size:11px;margin-bottom:8px"><strong style="color:var(--forest)">Pre:</strong> {{ $case->preconditions }}</div>@endif
            <div style="font-size:11px;margin-bottom:6px;white-space:pre-line"><strong style="color:var(--forest)">Steps:</strong><br>{{ $case->steps }}</div>
            <div style="font-size:11px;padding:8px 10px;background:var(--gold-lt);border-radius:2px;border-left:3px solid var(--gold)"><strong>Expected:</strong> {{ $case->expected_result }}</div>
            @if($case->latestResult)
            <div style="margin-top:8px;font-size:11px;padding:8px 10px;background:#f9f8f6;border-radius:2px">
              <strong>Actual:</strong> {{ $case->latestResult->actual_result ?? 'No notes' }}
              @if($case->latestResult->notes)<br><strong>Notes:</strong> {{ $case->latestResult->notes }}@endif
              <span style="float:right;color:var(--text-muted)">by {{ $case->latestResult->user->name }} · {{ $case->latestResult->tested_at->format('d M Y H:i') }}</span>
            </div>
            @endif
          </div>
        </div>
        @empty
        <div class="empty-state" style="padding:32px"><div class="icon">🧪</div><p>No test cases yet. Add your first test case.</p></div>
        @endforelse
      </div>
    </div>

    <!-- Plan Details -->
    <div>
      @foreach([
        ['5.1 Features to Test', $test->features_to_test],
        ['5.1 Not to Test', $test->features_not_to_test],
        ['5.2 Pass Criteria', $test->pass_criteria],
        ['5.2 Fail Criteria', $test->fail_criteria],
        ['5.3 Approach', $test->approach],
        ['5.4 Materials', $test->testing_materials],
        ['5.7 Conclusion', $test->conclusion],
        ['5.8 Recommendation', $test->recommendation],
      ] as [$label, $value])
      @if($value)
      <div class="card" style="margin-bottom:12px">
        <div style="font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--gold-dk);margin-bottom:8px">{{ $label }}</div>
        <div style="font-size:12px;color:var(--text-muted);line-height:1.7;white-space:pre-line">{{ $value }}</div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>

<!-- Add Test Case Modal -->
<div id="add-case-modal" style="display:none;position:fixed;inset:0;background:rgba(7,51,44,.6);z-index:2000;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(8px);overflow-y:auto">
  <div style="background:var(--white);border-radius:6px;width:100%;max-width:560px;margin:auto">
    <div style="background:var(--forest);padding:20px 24px;display:flex;align-items:center;justify-content:space-between">
      <div style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--white)">Add Test Case</div>
      <button onclick="document.getElementById('add-case-modal').classList.remove('show')" style="background:rgba(255,255,255,.08);border:none;border-radius:50%;width:28px;height:28px;color:rgba(255,255,255,.6);cursor:pointer;font-size:16px">×</button>
    </div>
    <form method="POST" action="{{ route('tests.cases.store',$test) }}" style="padding:20px 24px">
      @csrf
      <div class="fld"><label>Test Case Name *</label><input name="name" required placeholder="e.g. User Registration"></div>
      <div class="fld"><label>Description</label><textarea name="description" rows="2" placeholder="What does this test cover?"></textarea></div>
      <div class="fld"><label>Pre-conditions</label><input name="preconditions" placeholder="e.g. User must be logged in"></div>
      <div class="fld"><label>Test Steps *</label><textarea name="steps" rows="4" required placeholder="1. Navigate to…&#10;2. Fill in…&#10;3. Click…"></textarea></div>
      <div class="fld"><label>Expected Result *</label><textarea name="expected_result" rows="2" required placeholder="What should happen?"></textarea></div>
      <div class="fld"><label>Priority</label><select name="priority"><option value="low">Low</option><option value="medium" selected>Medium</option><option value="high">High</option><option value="critical">Critical</option></select></div>
      <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center">Add Test Case</button>
    </form>
  </div>
</div>

<!-- Record Result Modal -->
<div id="result-modal" style="display:none;position:fixed;inset:0;background:rgba(7,51,44,.6);z-index:2000;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(8px)">
  <div style="background:var(--white);border-radius:6px;width:100%;max-width:440px">
    <div style="background:var(--forest);padding:20px 24px;display:flex;align-items:center;justify-content:space-between">
      <div style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--white)">Record Test Result</div>
      <button onclick="document.getElementById('result-modal').style.display='none'" style="background:rgba(255,255,255,.08);border:none;border-radius:50%;width:28px;height:28px;color:rgba(255,255,255,.6);cursor:pointer;font-size:16px">×</button>
    </div>
    <form id="result-form" method="POST" style="padding:20px 24px">
      @csrf
      <div class="fld">
        <label>Result Status *</label>
        <select name="status">
          <option value="pass">✅ Pass</option>
          <option value="fail">❌ Fail</option>
          <option value="blocked">🚧 Blocked</option>
          <option value="not_tested">⬜ Not Tested</option>
        </select>
      </div>
      <div class="fld"><label>Actual Result</label><textarea name="actual_result" rows="2" placeholder="What actually happened?"></textarea></div>
      <div class="fld"><label>Notes</label><textarea name="notes" rows="2" placeholder="Additional notes…"></textarea></div>
      <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center">Save Result</button>
    </form>
  </div>
</div>

<!-- Run All Tests Modal -->
<div id="run-all-modal" style="display:none;position:fixed;inset:0;background:rgba(13,31,74,.65);z-index:2000;align-items:flex-start;justify-content:center;padding:24px;backdrop-filter:blur(8px);overflow-y:auto">
  <div style="background:var(--white);border-radius:6px;width:100%;max-width:680px;margin:auto">
    <div style="background:var(--forest);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;border-radius:6px 6px 0 0">
      <div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--white)">Run All Tests</div>
        <div style="font-size:11px;color:rgba(255,255,255,.55);margin-top:2px">Set a result for each test case and submit all at once</div>
      </div>
      <button onclick="document.getElementById('run-all-modal').style.display='none'" style="background:rgba(255,255,255,.08);border:none;border-radius:50%;width:28px;height:28px;color:rgba(255,255,255,.6);cursor:pointer;font-size:18px">×</button>
    </div>
    <form method="POST" action="{{ route('tests.run-all',$test) }}" style="padding:20px 24px">
      @csrf
      <div style="margin-bottom:16px;display:flex;gap:8px;flex-wrap:wrap;align-items:center">
        <span style="font-size:11px;color:var(--text-muted);font-weight:600;letter-spacing:.1em;text-transform:uppercase">Quick set all:</span>
        <button type="button" onclick="setAllStatus('pass')" class="btn btn-sm" style="background:#e8f4ec;color:#2a7040;border:none">All Pass</button>
        <button type="button" onclick="setAllStatus('fail')" class="btn btn-sm" style="background:#faeae9;color:#b83c35;border:none">All Fail</button>
        <button type="button" onclick="setAllStatus('blocked')" class="btn btn-sm" style="background:#fef9ec;color:#8a5a00;border:none">All Blocked</button>
        <button type="button" onclick="setAllStatus('not_tested')" class="btn btn-sm" style="background:var(--light);color:#888;border:none">All Not Tested</button>
      </div>
      <div style="border:1px solid var(--border-col);border-radius:4px;overflow:hidden">
        @foreach($test->testCases as $i => $case)
        <div style="display:grid;grid-template-columns:1fr auto;gap:12px;align-items:center;padding:12px 16px;{{ !$loop->last ? 'border-bottom:1px solid var(--border-col);' : '' }}background:{{ $loop->even ? 'var(--cream)' : 'var(--white)' }}">
          <div>
            <div style="font-size:12px;font-weight:600;color:var(--forest)">
              <span style="color:var(--text-muted);font-weight:400;margin-right:6px">TC{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>{{ $case->name }}
              <span class="badge {{ $case->priority==='critical'?'badge-red':($case->priority==='high'?'badge-gold':'badge-muted') }}" style="margin-left:6px">{{ $case->priority }}</span>
            </div>
            @if($case->latestResult)
            <div style="font-size:10px;color:var(--text-muted);margin-top:3px">Last: <span class="badge result-{{ $case->latestResult->status }}" style="font-size:9px">{{ str_replace('_',' ',$case->latestResult->status) }}</span></div>
            @endif
          </div>
          <select name="results[{{ $case->id }}]" class="run-status-select" style="padding:7px 10px;border:1.5px solid var(--light);border-radius:3px;font-family:'DM Sans',sans-serif;font-size:12px;color:var(--text);background:var(--white);cursor:pointer" onchange="styleSelect(this)">
            <option value="pass" {{ $case->latestResult?->status === 'pass' ? 'selected' : '' }}>Pass</option>
            <option value="fail" {{ $case->latestResult?->status === 'fail' ? 'selected' : '' }}>Fail</option>
            <option value="blocked" {{ $case->latestResult?->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
            <option value="not_tested" {{ (!$case->latestResult || $case->latestResult?->status === 'not_tested') ? 'selected' : '' }}>Not Tested</option>
          </select>
        </div>
        @endforeach
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:20px;padding:12px">Submit All Results</button>
    </form>
  </div>
</div>

<style>#add-case-modal.show{display:flex}</style>
<script>
function openResult(caseId) {
  document.getElementById('result-form').action = `/test-cases/${caseId}/results`;
  document.getElementById('result-modal').style.display = 'flex';
}
function setAllStatus(status) {
  document.querySelectorAll('.run-status-select').forEach(function(sel) {
    sel.value = status;
    styleSelect(sel);
  });
}
function styleSelect(sel) {
  const colors = {pass:'#2a7040',fail:'#b83c35',blocked:'#8a5a00',not_tested:'#888'};
  sel.style.color = colors[sel.value] || 'var(--text)';
}
document.querySelectorAll('.run-status-select').forEach(styleSelect);
</script>
@endsection
