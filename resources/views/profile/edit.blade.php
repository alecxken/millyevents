@extends('layouts.app')
@section('title','Profile')
@section('content')
<div class="app-pg" style="max-width:700px">
  <div class="section-eyebrow">Account</div>
  <h1 class="page-title serif">My Profile</h1>
  <p class="page-sub">Manage your account settings</p>

  <div class="card">
    <div class="card-title serif" style="margin-bottom:16px">Profile Information</div>
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf @method('patch')
      <div class="fld"><label>Name</label><input name="name" value="{{ old('name', $user->name) }}" required></div>
      <div class="fld"><label>Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
      @if($errors->has('name') || $errors->has('email'))
      <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif
      @if(session('status') === 'profile-updated')
      <div class="alert alert-success">Profile updated.</div>
      @endif
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
  </div>

  <div class="card">
    <div class="card-title serif" style="margin-bottom:16px">Update Password</div>
    <form method="POST" action="{{ route('password.update') }}">
      @csrf @method('put')
      <div class="fld"><label>Current Password</label><input type="password" name="current_password" autocomplete="current-password"></div>
      <div class="fld"><label>New Password</label><input type="password" name="password" autocomplete="new-password"></div>
      <div class="fld"><label>Confirm Password</label><input type="password" name="password_confirmation" autocomplete="new-password"></div>
      @if($errors->updatePassword->any())
      <div class="alert alert-error">{{ $errors->updatePassword->first() }}</div>
      @endif
      @if(session('status') === 'password-updated')
      <div class="alert alert-success">Password updated.</div>
      @endif
      <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
  </div>

  <div class="card">
    <div class="card-title serif" style="margin-bottom:8px;color:#b83c35">Danger Zone</div>
    <p style="font-size:12px;color:var(--text-muted);margin-bottom:16px">Once deleted, your account and all data cannot be recovered.</p>
    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you absolutely sure? This cannot be undone.')">
      @csrf @method('delete')
      <div class="fld"><label>Confirm Password</label><input type="password" name="password" placeholder="Your current password"></div>
      <button type="submit" class="btn btn-danger">Delete Account</button>
    </form>
  </div>
</div>
@endsection
