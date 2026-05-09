<!DOCTYPE html>
<html lang="en" data-theme="{{ session('theme','green') }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#07332c">
<title>@yield('title','Milyvents') — Curated Experiences</title>
<link rel="manifest" href="/manifest.json">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
:root,[data-theme="green"]{
  --forest:#07332c;--olive:#485b46;--sage:#afb7ac;--gold:#bca879;
  --light:#ededed;--cream:#f7f4ef;--white:#ffffff;--dark:#0e1a18;
  --gold-lt:#e8dfc8;--gold-dk:#8a7550;--olive-lt:#cdd4cb;
  --text:#1a2420;--text-muted:#6b7c78;
  --primary:var(--forest);--accent:var(--gold);--accent-lt:var(--gold-lt);
  --border-col:rgba(175,183,172,.3);
}
[data-theme="blue"]{
  --forest:#0a1f44;--olive:#0d3170;--sage:#5b8fa8;--gold:#0e6fa3;
  --light:#d4e4ee;--cream:#edf4f9;--white:#ffffff;--dark:#071428;
  --gold-lt:#d6eaf4;--gold-dk:#085580;--olive-lt:#c2d9e8;
  --text:#0c1e35;--text-muted:#4a6b80;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--text);font-size:14px;overflow-x:hidden}
.serif{font-family:'Cormorant Garamond',serif}
::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:var(--light)}::-webkit-scrollbar-thumb{background:var(--sage);border-radius:3px}

/* NAV */
.app-nav{background:var(--forest);height:64px;display:flex;align-items:center;border-bottom:2px solid var(--gold);position:sticky;top:0;z-index:500}
.app-nav-inner{max-width:1280px;margin:0 auto;padding:0 36px;display:flex;align-items:center;gap:16px;width:100%}
.app-brand{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--white);letter-spacing:.12em;text-transform:uppercase;cursor:pointer;text-decoration:none}
.app-brand span{color:var(--gold)}
.app-sep{width:1px;height:28px;background:rgba(255,255,255,.1)}
.app-tabs{display:flex;gap:2px;margin-left:8px;flex-wrap:wrap}
.app-tab{padding:7px 16px;font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.5);cursor:pointer;border-radius:2px;transition:.15s;text-decoration:none;display:inline-block}
.app-tab:hover,.app-tab.on{background:rgba(255,255,255,.1);color:var(--white)}
.app-tab.on{color:var(--gold)}
.app-user{display:flex;align-items:center;gap:10px;margin-left:auto}
.app-av{width:32px;height:32px;border-radius:50%;background:var(--gold);display:grid;place-items:center;font-size:10px;font-weight:800;color:var(--forest);flex-shrink:0}
.app-uname{font-size:12px;color:rgba(255,255,255,.75);font-weight:500}
.btn-app-logout{padding:7px 16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.5);font-family:'DM Sans',sans-serif;font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:.15s;text-decoration:none}
.btn-app-logout:hover{background:rgba(255,255,255,.12);color:var(--white)}

/* PAGE */
.app-body{background:var(--cream);min-height:calc(100vh - 64px)}
.app-pg{max-width:1280px;margin:0 auto;padding:32px 36px}
.page-title{font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:600;color:var(--forest);margin-bottom:4px}
.page-sub{font-size:13px;color:var(--text-muted);margin-bottom:28px}

/* KPI */
.kpi-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.kc{background:var(--white);border:1px solid var(--border-col);border-radius:4px;padding:20px 22px;position:relative;overflow:hidden}
.kc::before{content:'';position:absolute;top:0;left:0;right:0;height:3px}
.kc.c-forest::before{background:var(--forest)}.kc.c-gold::before{background:var(--gold)}.kc.c-olive::before{background:var(--olive)}.kc.c-sage::before{background:var(--sage)}
.kc-label{font-size:9px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--text-muted);margin-bottom:8px}
.kc-value{font-family:'Cormorant Garamond',serif;font-size:36px;font-weight:600;color:var(--forest);line-height:1;margin-bottom:4px}
.kc-note{font-size:10px;color:var(--text-muted)}

/* CARDS */
.card{background:var(--white);border:1px solid var(--border-col);border-radius:4px;padding:22px 24px;margin-bottom:16px}
.card-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:10px}
.card-title{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--forest)}
.card-sub{font-size:11px;color:var(--text-muted);margin-top:2px}

/* TABLE */
table.tbl{width:100%;border-collapse:collapse;font-size:12px}
table.tbl th{padding:10px 14px;text-align:left;font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);background:#f9f8f6;border-bottom:2px solid var(--light)}
table.tbl td{padding:12px 14px;border-bottom:1px solid #f3f1ec;vertical-align:middle}
table.tbl tbody tr:hover{background:#faf9f7}

/* BADGES */
.badge{display:inline-block;padding:3px 10px;border-radius:2px;font-size:9px;font-weight:700;letter-spacing:.1em;text-transform:uppercase}
.badge-green{background:#e8f4ec;color:#2a7040}.badge-gold{background:var(--gold-lt);color:var(--gold-dk)}
.badge-sage{background:#ecf0eb;color:var(--olive)}.badge-red{background:#faeae9;color:#b83c35}
.badge-blue{background:#d6eaf4;color:#085580}.badge-muted{background:var(--light);color:#888}

/* BUTTONS */
.btn{padding:9px 18px;font-family:'DM Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:.2s;display:inline-flex;align-items:center;gap:6px;text-decoration:none;border:none}
.btn-primary{background:var(--forest);color:var(--white)}.btn-primary:hover{background:var(--olive)}
.btn-gold{background:var(--gold);color:var(--forest)}.btn-gold:hover{background:var(--gold-dk);color:var(--white)}
.btn-outline{background:transparent;border:1px solid var(--sage);color:var(--text-muted)}.btn-outline:hover{border-color:var(--forest);color:var(--forest)}
.btn-danger{background:#faeae9;color:#b83c35}.btn-danger:hover{background:#b83c35;color:var(--white)}
.btn-sm{padding:6px 12px;font-size:9px}

/* FORMS */
.fld{margin-bottom:14px}
.fld label{display:block;font-size:10px;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:5px}
.fld input,.fld select,.fld textarea{width:100%;padding:10px 13px;border:1.5px solid var(--light);border-radius:3px;font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text);outline:none;transition:.2s;background:var(--cream)}
.fld input:focus,.fld select:focus,.fld textarea:focus{border-color:var(--gold);background:var(--white);box-shadow:0 0 0 3px rgba(188,168,121,.1)}
.fld input::placeholder{color:var(--sage)}
.fld-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}

/* ALERT */
.alert{padding:12px 16px;border-radius:3px;font-size:12px;font-weight:500;margin-bottom:16px;display:flex;align-items:center;gap:8px}
.alert-success{background:#eef6f0;color:#2a7040;border-left:3px solid #2a7040}
.alert-error{background:#faeae9;color:#b83c35;border-left:3px solid #b83c35}

/* MISC */
.section-eyebrow{font-size:10px;font-weight:600;letter-spacing:.22em;text-transform:uppercase;color:var(--gold);margin-bottom:14px;display:flex;align-items:center;gap:10px}
.section-eyebrow::before{content:'';display:block;width:24px;height:1px;background:var(--gold)}
.empty-state{text-align:center;padding:64px 20px;color:var(--text-muted)}
.empty-state .icon{font-size:40px;margin-bottom:12px}
.empty-state h3{font-family:'Cormorant Garamond',serif;font-size:22px;color:var(--forest);margin-bottom:6px}
.empty-state p{font-size:12px}

/* PRIORITY COLORS */
.priority-critical{color:#b83c35;font-weight:700}
.priority-high{color:var(--gold-dk);font-weight:600}
.priority-medium{color:var(--olive);font-weight:500}
.priority-low{color:var(--sage)}

/* RESULT STATUS */
.result-pass{background:#e8f4ec;color:#2a7040}
.result-fail{background:#faeae9;color:#b83c35}
.result-blocked{background:#fef9ec;color:#8a5a00}
.result-not_tested{background:var(--light);color:#888}

@media(max-width:960px){
  .app-nav-inner,.app-pg{padding-left:16px;padding-right:16px}
  .kpi-row,.fld-row{grid-template-columns:1fr 1fr}
  .app-tabs{display:none}
}
@media(max-width:600px){
  .kpi-row,.fld-row{grid-template-columns:1fr}
  .app-uname{display:none}
}
</style>
</head>
<body>
<nav class="app-nav">
  <div class="app-nav-inner">
    <a class="app-brand" href="{{ route('home') }}">Mily<span>vents</span></a>
    <div class="app-sep"></div>
    <div class="app-tabs">
      <a class="app-tab {{ request()->routeIs('dashboard') ? 'on' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
      <a class="app-tab {{ request()->routeIs('events.*') ? 'on' : '' }}" href="{{ route('events.index') }}">Events</a>
      <a class="app-tab {{ request()->routeIs('bookings.*') ? 'on' : '' }}" href="{{ route('bookings.index') }}">My Bookings</a>
      <a class="app-tab {{ request()->routeIs('notes.*') ? 'on' : '' }}" href="{{ route('notes.index') }}">Notes</a>
      <a class="app-tab {{ request()->routeIs('tests.*') ? 'on' : '' }}" href="{{ route('tests.index') }}">Test Plans</a>
      @if(auth()->user()?->is_admin)
      <a class="app-tab {{ request()->routeIs('admin.*') ? 'on' : '' }}" href="{{ route('admin.dashboard') }}">Admin</a>
      @endif
    </div>
    <div class="app-user">
      @auth
      <div class="app-av">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
      <span class="app-uname">{{ auth()->user()->name }}</span>
      <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit" class="btn-app-logout">Sign Out</button>
      </form>
      @else
      <a href="{{ route('login') }}" class="btn-app-logout">Sign In</a>
      @endauth
    </div>
  </div>
</nav>
<div class="app-body">
  @if(session('success'))
  <div style="max-width:1280px;margin:16px auto;padding:0 36px">
    <div class="alert alert-success">✓ {{ session('success') }}</div>
  </div>
  @endif
  @if(session('error'))
  <div style="max-width:1280px;margin:16px auto;padding:0 36px">
    <div class="alert alert-error">⚠ {{ session('error') }}</div>
  </div>
  @endif
  @yield('content')
</div>
<script>
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/sw.js').catch(()=>{});
}
</script>
</body>
</html>
