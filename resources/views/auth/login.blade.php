<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Sign In — Milyvents</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
:root{--forest:#07332c;--gold:#bca879;--gold-lt:#e8dfc8;--gold-dk:#8a7550;--light:#ededed;--cream:#f7f4ef;--white:#ffffff;--sage:#afb7ac;--text:#1a2420;--text-muted:#6b7c78;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:var(--cream);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.auth-wrap{width:100%;max-width:420px}
.auth-box{background:var(--white);border-radius:6px;overflow:hidden;box-shadow:0 20px 60px rgba(7,51,44,.15)}
.auth-top{background:var(--forest);padding:32px 36px 28px;position:relative;overflow:hidden}
.auth-top::before{content:'';position:absolute;right:-30px;top:-30px;width:120px;height:120px;border-radius:50%;background:rgba(188,168,121,.1)}
.auth-logo{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:var(--white);letter-spacing:.12em;text-transform:uppercase}
.auth-logo span{color:var(--gold)}
.auth-sub{font-size:11px;color:rgba(255,255,255,.4);letter-spacing:.1em;text-transform:uppercase;margin-top:4px}
.auth-gold-line{width:32px;height:2px;background:var(--gold);margin:14px 0 0;border-radius:1px}
.auth-body{padding:32px 36px}
.fld{margin-bottom:16px}
.fld label{display:block;font-size:10px;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:6px}
.fld input{width:100%;padding:11px 14px;border:1.5px solid var(--light);border-radius:3px;font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text);outline:none;transition:.2s;background:var(--cream)}
.fld input:focus{border-color:var(--gold);background:var(--white);box-shadow:0 0 0 3px rgba(188,168,121,.12)}
.btn-auth{width:100%;padding:13px;background:var(--forest);color:var(--white);border:none;font-family:'DM Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;border-radius:3px;transition:.25s;margin-top:4px}
.btn-auth:hover{background:var(--gold-dk)}
.auth-switch{margin-top:20px;text-align:center;font-size:12px;color:var(--text-muted)}
.auth-switch a{color:var(--forest);font-weight:600;text-decoration:none}
.auth-switch a:hover{color:var(--gold)}
.err{color:#b83c35;font-size:11px;margin-top:4px}
.remember{display:flex;align-items:center;gap:8px;font-size:12px;cursor:pointer;margin-bottom:16px}
</style>
</head>
<body>
<div class="auth-wrap">
  <div class="auth-box">
    <div class="auth-top">
      <div class="auth-logo">Mily<span>vents</span></div>
      <div class="auth-sub">Sign in to your account</div>
      <div class="auth-gold-line"></div>
    </div>
    <div class="auth-body">
      @if($errors->any())
      <div style="background:#faeae9;color:#b83c35;border-left:3px solid #b83c35;padding:10px 14px;border-radius:3px;font-size:12px;margin-bottom:16px">{{ $errors->first() }}</div>
      @endif
      @if(session('status'))
      <div style="background:#eef6f0;color:#2a7040;border-left:3px solid #2a7040;padding:10px 14px;border-radius:3px;font-size:12px;margin-bottom:16px">{{ session('status') }}</div>
      @endif
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="fld"><label>Email Address</label><input type="email" name="email" required autofocus value="{{ old('email') }}" placeholder="you@example.com"></div>
        <div class="fld"><label>Password</label><input type="password" name="password" required placeholder="••••••••"></div>
        <label class="remember"><input type="checkbox" name="remember"> Remember me</label>
        <button type="submit" class="btn-auth">Sign In</button>
      </form>
      <div class="auth-switch">
        Don't have an account? <a href="{{ route('register') }}">Register here</a>
        @if(Route::has('password.request'))&nbsp;·&nbsp;<a href="{{ route('password.request') }}">Forgot password?</a>@endif
      </div>
    </div>
  </div>
  <div style="text-align:center;margin-top:16px;font-size:11px;color:var(--text-muted)"><a href="{{ route('home') }}" style="color:var(--forest);text-decoration:none">← Back to Milyvents</a></div>
</div>
</body>
</html>
