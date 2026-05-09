<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Test Plan — {{ $test->name }}</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #1a2420; background: #fff; }
.page { padding: 36px 40px; }

/* Header */
.header { background: #07332c; color: #fff; padding: 24px 32px; margin: -36px -40px 28px; display: flex; justify-content: space-between; align-items: center; }
.header-title { font-size: 22px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
.header-sub { font-size: 10px; color: rgba(255,255,255,.5); margin-top: 4px; letter-spacing: 1px; text-transform: uppercase; }
.header-gold { color: #bca879; }
.gold-line { width: 40px; height: 3px; background: #bca879; margin: 10px 0 16px; }

/* Section */
.section-title { font-size: 14px; font-weight: 700; color: #07332c; border-bottom: 2px solid #bca879; padding-bottom: 6px; margin: 20px 0 12px; text-transform: uppercase; letter-spacing: 1px; }
.section-sub { font-size: 9px; font-weight: 700; color: #6b7c78; text-transform: uppercase; letter-spacing: 1px; margin: 12px 0 6px; }
p, pre { font-size: 11px; line-height: 1.7; color: #333; margin-bottom: 8px; white-space: pre-wrap; }

/* Stats row */
.stat-row { display: flex; gap: 0; margin-bottom: 20px; border: 1px solid #e0ddd7; border-radius: 4px; overflow: hidden; }
.stat-box { flex: 1; padding: 14px; text-align: center; border-right: 1px solid #e0ddd7; }
.stat-box:last-child { border-right: none; }
.stat-num { font-size: 28px; font-weight: 700; color: #07332c; line-height: 1; }
.stat-label { font-size: 9px; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-top: 4px; }
.stat-pass .stat-num { color: #2a7040; }
.stat-fail .stat-num { color: #b83c35; }

/* Table */
table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
th { background: #07332c; color: #bca879; padding: 8px 10px; text-align: left; font-size: 9px; letter-spacing: 1px; text-transform: uppercase; }
td { padding: 8px 10px; border-bottom: 1px solid #f0ede8; font-size: 10px; vertical-align: top; }
tr:nth-child(even) td { background: #faf9f7; }
.tc-num { font-weight: 700; color: #07332c; white-space: nowrap; }
.badge { display: inline-block; padding: 2px 7px; border-radius: 2px; font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; }
.b-pass { background: #e8f4ec; color: #2a7040; }
.b-fail { background: #faeae9; color: #b83c35; }
.b-blocked { background: #fef9ec; color: #8a5a00; }
.b-not { background: #f0ede8; color: #888; }
.b-critical { background: #faeae9; color: #b83c35; }
.b-high { background: #e8dfc8; color: #8a7550; }
.b-medium { background: #ecf0eb; color: #485b46; }
.b-low { background: #f0ede8; color: #888; }

/* Footer */
.footer { margin-top: 32px; padding-top: 16px; border-top: 1px solid #e0ddd7; display: flex; justify-content: space-between; font-size: 9px; color: #aaa; }
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.info-item { background: #f9f8f6; border-radius: 3px; padding: 10px 12px; }
.info-label { font-size: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #bca879; margin-bottom: 4px; }
.info-val { font-size: 11px; line-height: 1.6; white-space: pre-line; }
</style>
</head>
<body>
<div class="page">

  <!-- Header -->
  <div class="header">
    <div>
      <div class="header-title">Mily<span class="header-gold">vents</span></div>
      <div class="header-sub">Test Plan Documentation</div>
    </div>
    <div style="text-align:right">
      <div style="font-size:11px;color:rgba(255,255,255,.7)">Generated: {{ now()->format('d M Y H:i') }}</div>
      <div style="font-size:10px;color:rgba(255,255,255,.4);margin-top:2px">By: {{ $test->user->name }}</div>
    </div>
  </div>

  <div class="gold-line"></div>
  <div style="font-size:18px;font-weight:700;color:#07332c;margin-bottom:4px">{{ $test->name }}</div>
  @if($test->description)<p style="color:#6b7c78">{{ $test->description }}</p>@endif

  <!-- Stats -->
  @php
  $allResults = $test->testCases->flatMap->results;
  $pass    = $allResults->where('status','pass')->count();
  $fail    = $allResults->where('status','fail')->count();
  $blocked = $allResults->where('status','blocked')->count();
  $ntested = $allResults->where('status','not_tested')->count();
  $total   = $test->testCases->count();
  @endphp
  <div class="section-title">5.6 Testing Results Summary</div>
  <div class="stat-row">
    <div class="stat-box"><div class="stat-num">{{ $total }}</div><div class="stat-label">Total Cases</div></div>
    <div class="stat-box stat-pass"><div class="stat-num">{{ $pass }}</div><div class="stat-label">Passed</div></div>
    <div class="stat-box stat-fail"><div class="stat-num">{{ $fail }}</div><div class="stat-label">Failed</div></div>
    <div class="stat-box"><div class="stat-num">{{ $blocked }}</div><div class="stat-label">Blocked</div></div>
    <div class="stat-box"><div class="stat-num">{{ $ntested }}</div><div class="stat-label">Not Tested</div></div>
  </div>

  <!-- Plan Details Grid -->
  <div class="info-grid" style="margin-bottom:16px">
    @if($test->features_to_test)<div class="info-item"><div class="info-label">5.1 Features to Test</div><div class="info-val">{{ $test->features_to_test }}</div></div>@endif
    @if($test->features_not_to_test)<div class="info-item"><div class="info-label">5.1 Features NOT to Test</div><div class="info-val">{{ $test->features_not_to_test }}</div></div>@endif
    @if($test->pass_criteria)<div class="info-item"><div class="info-label">5.2 Pass Criteria</div><div class="info-val">{{ $test->pass_criteria }}</div></div>@endif
    @if($test->fail_criteria)<div class="info-item"><div class="info-label">5.2 Fail Criteria</div><div class="info-val">{{ $test->fail_criteria }}</div></div>@endif
    @if($test->approach)<div class="info-item"><div class="info-label">5.3 Approach</div><div class="info-val">{{ $test->approach }}</div></div>@endif
    @if($test->testing_materials)<div class="info-item"><div class="info-label">5.4 Testing Materials</div><div class="info-val">{{ $test->testing_materials }}</div></div>@endif
  </div>

  <!-- Test Cases Table -->
  <div class="section-title">5.5 Test Cases & Results</div>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Test Case</th>
        <th>Priority</th>
        <th>Steps</th>
        <th>Expected Result</th>
        <th>Actual Result</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($test->testCases as $i => $case)
      <tr>
        <td class="tc-num">TC{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</td>
        <td style="font-weight:600">{{ $case->name }}@if($case->description)<br><span style="font-weight:400;color:#888">{{ $case->description }}</span>@endif</td>
        <td><span class="badge b-{{ $case->priority }}">{{ $case->priority }}</span></td>
        <td>{{ $case->steps }}</td>
        <td>{{ $case->expected_result }}</td>
        <td>{{ $case->latestResult?->actual_result ?? '—' }}</td>
        <td>
          @php $r = $case->latestResult; @endphp
          @if($r)
          <span class="badge b-{{ $r->status }}">{{ str_replace('_',' ',$r->status) }}</span>
          @else
          <span class="badge b-not">not tested</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Conclusion -->
  @if($test->conclusion || $test->recommendation)
  <div class="info-grid">
    @if($test->conclusion)<div class="info-item"><div class="info-label">5.7 Conclusion</div><div class="info-val">{{ $test->conclusion }}</div></div>@endif
    @if($test->recommendation)<div class="info-item"><div class="info-label">5.8 Recommendation</div><div class="info-val">{{ $test->recommendation }}</div></div>@endif
  </div>
  @endif

  <div class="footer">
    <div>Milyvents PWA — {{ $test->name }}</div>
    <div>Exported {{ now()->format('d M Y H:i') }} · Status: {{ ucfirst($test->status) }}</div>
  </div>
</div>
</body>
</html>
