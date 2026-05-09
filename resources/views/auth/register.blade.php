<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Register — Milyvents</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
:root{--forest:#07332c;--gold:#bca879;--gold-lt:#e8dfc8;--gold-dk:#8a7550;--light:#ededed;--cream:#f7f4ef;--white:#ffffff;--sage:#afb7ac;--text:#1a2420;--text-muted:#6b7c78;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:var(--cream);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.auth-wrap{width:100%;max-width:440px}
.auth-box{background:var(--white);border-radius:6px;overflow:hidden;box-shadow:0 20px 60px rgba(7,51,44,.15)}
.auth-top{background:var(--forest);padding:28px 36px 24px;position:relative;overflow:hidden}
.auth-top::before{content:'';position:absolute;right:-30px;top:-30px;width:120px;height:120px;border-radius:50%;background:rgba(188,168,121,.1)}
.auth-logo{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:var(--white);letter-spacing:.12em;text-transform:uppercase}
.auth-logo span{color:var(--gold)}
.auth-sub{font-size:11px;color:rgba(255,255,255,.4);letter-spacing:.1em;text-transform:uppercase;margin-top:4px}
.auth-gold-line{width:32px;height:2px;background:var(--gold);margin:12px 0 0;border-radius:1px}
.auth-body{padding:28px 36px}
.fld{margin-bottom:14px}
.fld label{display:block;font-size:10px;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:5px}
.fld input{width:100%;padding:11px 14px;border:1.5px solid var(--light);border-radius:3px;font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text);outline:none;transition:.2s;background:var(--cream)}
.fld input:focus{border-color:var(--gold);background:var(--white);box-shadow:0 0 0 3px rgba(188,168,121,.12)}
.fld-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.btn-auth{width:100%;padding:13px;background:var(--forest);color:var(--white);border:none;font-family:'DM Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;border-radius:3px;transition:.25s;margin-top:4px}
.btn-auth:hover{background:var(--gold-dk)}
.auth-switch{margin-top:18px;text-align:center;font-size:12px;color:var(--text-muted)}
.auth-switch a{color:var(--forest);font-weight:600;text-decoration:none}
</style>
</head>
<body>
<div class="auth-wrap">
  <div class="auth-box">
    <div class="auth-top">
      <div class="auth-logo">Mily<span>vents</span></div>
      <div class="auth-sub">Create your account</div>
      <div class="auth-gold-line"></div>
    </div>
    <div class="auth-body">
      @if($errors->any())
      <div style="background:#faeae9;color:#b83c35;border-left:3px solid #b83c35;padding:10px 14px;border-radius:3px;font-size:12px;margin-bottom:14px">{{ implode('. ', $errors->all()) }}</div>
      @endif
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="fld"><label>Full Name</label><input type="text" name="name" required autofocus value="{{ old('name') }}" placeholder="Jane Wanjiku"></div>
        <div class="fld"><label>Email Address</label><input type="email" name="email" required value="{{ old('email') }}" placeholder="jane@example.com"></div>
        <div class="fld-row">
          <div class="fld"><label>Password</label><input type="password" name="password" required placeholder="Min 8 chars"></div>
          <div class="fld"><label>Confirm Password</label><input type="password" name="password_confirmation" required placeholder="Repeat"></div>
        </div>
        <button type="submit" class="btn-auth">Create Account</button>
      </form>
      <div class="auth-switch">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
    </div>
  </div>
  <div style="text-align:center;margin-top:16px;font-size:11px;color:var(--text-muted)"><a href="{{ route('home') }}" style="color:var(--forest);text-decoration:none">← Back to Milyvents</a></div>
</div>
</body>
</html>
