@extends('layouts.app')
@section('title','Edit Test Plan')
@section('content')
<div class="app-pg" style="max-width:800px">
  <div style="margin-bottom:16px"><a href="{{ route('tests.show',$test) }}" style="font-size:11px;color:var(--text-muted);text-decoration:none">← Back to Plan</a></div>
  <div class="section-eyebrow">Edit</div>
  <h1 class="page-title serif">Edit Test Plan</h1>

  <form method="POST" action="{{ route('tests.update',$test) }}">
    @csrf @method('PUT')
    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">Plan Overview</div>
      <div class="fld"><label>Plan Name *</label><input name="name" required value="{{ $test->name }}"></div>
      <div class="fld"><label>Description</label><textarea name="description" rows="3">{{ $test->description }}</textarea></div>
      <div class="fld"><label>Status</label><select name="status"><option value="draft" {{ $test->status==='draft'?'selected':'' }}>Draft</option><option value="active" {{ $test->status==='active'?'selected':'' }}>Active</option><option value="completed" {{ $test->status==='completed'?'selected':'' }}>Completed</option></select></div>
    </div>
    <div class="card">
      <div class="card-title serif" style="margin-bottom:16px">Scope & Approach</div>
      <div class="fld"><label>Features to Test</label><textarea name="features_to_test" rows="5">{{ $test->features_to_test }}</textarea></div>
      <div class="fld"><label>Features NOT to Test</label><textarea name="features_not_to_test" rows="3">{{ $test->features_not_to_test }}</textarea></div>
      <div class="fld-row">
        <div class="fld"><label>Pass Criteria</label><textarea name="pass_criteria" rows="3">{{ $test->pass_criteria }}</textarea></div>
        <div class="fld"><label>Fail Criteria</label><textarea name="fail_criteria" rows="3">{{ $test->fail_criteria }}</textarea></div>
      </div>
      <div class="fld"><label>Test Approach</label><textarea name="approach" rows="3">{{ $test->approach }}</textarea></div>
      <div class="fld"><label>Testing Materials</label><textarea name="testing_materials" rows="3">{{ $test->testing_materials }}</textarea></div>
    </div>
    <div class="card">
      <div class="fld"><label>Conclusion</label><textarea name="conclusion" rows="3">{{ $test->conclusion }}</textarea></div>
      <div class="fld"><label>Recommendation</label><textarea name="recommendation" rows="3">{{ $test->recommendation }}</textarea></div>
    </div>
    <div style="display:flex;gap:12px">
      <button type="submit" class="btn btn-gold">Update Plan</button>
      <a href="{{ route('tests.show',$test) }}" class="btn btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
