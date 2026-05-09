@extends('layouts.app')
@section('title','New Test Plan')
@section('content')
<div class="app-pg" style="max-width:800px">
  <div style="margin-bottom:16px"><a href="{{ route('tests.index') }}" style="font-size:11px;color:var(--text-muted);text-decoration:none">← Test Plans</a></div>
  <div class="section-eyebrow">Create</div>
  <h1 class="page-title serif">New Test Plan</h1>
  <p class="page-sub">Document your testing approach following the standard test plan structure</p>

  <form method="POST" action="{{ route('tests.store') }}">
    @csrf
    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">5.1 Plan Overview</div>
      <div class="fld"><label>Plan Name *</label><input name="name" required placeholder="e.g. Milyvents PWA — System Test Plan" value="{{ old('name') }}"></div>
      <div class="fld"><label>Description</label><textarea name="description" rows="3" placeholder="Brief overview of this test plan…">{{ old('description') }}</textarea></div>
      <div class="fld"><label>Status</label><select name="status"><option value="draft">Draft</option><option value="active">Active</option><option value="completed">Completed</option></select></div>
    </div>

    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">5.2–5.3 Scope & Approach</div>
      <div class="fld"><label>5.1 Features to Test</label><textarea name="features_to_test" rows="5" placeholder="List features included in testing…">{{ old('features_to_test') }}</textarea></div>
      <div class="fld"><label>5.1 Features NOT to Test</label><textarea name="features_not_to_test" rows="3" placeholder="List features excluded from testing…">{{ old('features_not_to_test') }}</textarea></div>
      <div class="fld-row">
        <div class="fld"><label>5.2 Pass Criteria</label><textarea name="pass_criteria" rows="3" placeholder="What defines a successful test?">{{ old('pass_criteria') }}</textarea></div>
        <div class="fld"><label>5.2 Fail Criteria</label><textarea name="fail_criteria" rows="3" placeholder="What defines a test failure?">{{ old('fail_criteria') }}</textarea></div>
      </div>
      <div class="fld"><label>5.3 Test Approach</label><textarea name="approach" rows="3" placeholder="How will testing be conducted?">{{ old('approach') }}</textarea></div>
      <div class="fld"><label>5.4 Testing Materials (Hardware/Software)</label><textarea name="testing_materials" rows="3" placeholder="Browsers, devices, tools…">{{ old('testing_materials') }}</textarea></div>
    </div>

    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">5.7–5.8 Conclusion & Recommendation</div>
      <div class="fld"><label>5.7 Conclusion</label><textarea name="conclusion" rows="3" placeholder="Summary of testing outcomes…">{{ old('conclusion') }}</textarea></div>
      <div class="fld"><label>5.8 Recommendation</label><textarea name="recommendation" rows="3" placeholder="Recommendations based on testing…">{{ old('recommendation') }}</textarea></div>
    </div>

    <div style="display:flex;gap:12px">
      <button type="submit" class="btn btn-gold">Create Test Plan</button>
      <a href="{{ route('tests.index') }}" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
