<!DOCTYPE html>
<html lang="en" data-theme="green">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#07332c">
<title>Milyvents — Curated Experiences</title>
<link rel="manifest" href="/manifest.json">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
:root{--forest:#07332c;--olive:#485b46;--sage:#afb7ac;--gold:#bca879;--light:#ededed;--cream:#f7f4ef;--white:#ffffff;--dark:#0e1a18;--gold-lt:#e8dfc8;--gold-dk:#8a7550;--olive-lt:#cdd4cb;--text:#1a2420;--text-muted:#6b7c78;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--text);overflow-x:hidden}
.serif{font-family:'Cormorant Garamond',serif}
::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:var(--light)}::-webkit-scrollbar-thumb{background:var(--sage);border-radius:3px}

/* NAV */
#nav{position:fixed;top:0;left:0;right:0;z-index:900;transition:background .4s,box-shadow .3s;padding:0 48px;height:68px;display:flex;align-items:center;justify-content:space-between}
#nav.scrolled{background:rgba(7,51,44,.96);backdrop-filter:blur(12px);box-shadow:0 2px 30px rgba(0,0,0,.2)}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.nav-logo-mark{width:36px;height:36px;background:var(--gold);border-radius:50%;display:grid;place-items:center}
.nav-brand{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--white);letter-spacing:.12em;text-transform:uppercase}
.nav-links{display:flex;align-items:center;gap:32px}
.nav-link{font-size:11px;font-weight:500;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.7);cursor:pointer;transition:.2s;text-decoration:none}
.nav-link:hover{color:var(--gold)}
.nav-actions{display:flex;align-items:center;gap:12px}
.btn-nav{padding:9px 22px;font-family:'DM Sans',sans-serif;font-size:11px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:.2s;text-decoration:none;display:inline-block;border:none}
.btn-nav-outline{background:transparent;border:1px solid rgba(255,255,255,.35);color:rgba(255,255,255,.8)}
.btn-nav-outline:hover{border-color:var(--gold);color:var(--gold)}
.btn-nav-fill{background:var(--gold);border:1px solid var(--gold);color:var(--forest)}
.btn-nav-fill:hover{background:var(--gold-dk);color:var(--white)}

/* HERO */
.hero{position:relative;width:100%;height:100vh;overflow:hidden}
.slides-wrap{display:flex;height:100%;transition:transform .9s cubic-bezier(.77,0,.175,1)}
.slide{width:100%;height:100%;position:relative;flex-shrink:0}
.slide-bg{position:absolute;inset:0;display:flex;align-items:center;justify-content:center}
.slide-overlay{position:absolute;inset:0}
.slide-content{position:absolute;bottom:14%;left:10%;max-width:560px;z-index:2}
.slide-tag{font-size:10px;font-weight:600;letter-spacing:.22em;text-transform:uppercase;color:var(--gold);margin-bottom:16px;display:flex;align-items:center;gap:8px}
.slide-tag::before{content:'';display:block;width:28px;height:1px;background:var(--gold)}
.slide-headline{font-family:'Cormorant Garamond',serif;font-size:clamp(38px,5vw,68px);font-weight:600;color:var(--white);line-height:1.05;margin-bottom:20px;white-space:pre-line}
.slide-sub{font-size:14px;color:rgba(255,255,255,.7);line-height:1.7;margin-bottom:32px;max-width:400px}
.slide-meta{display:flex;gap:24px;margin-bottom:32px;flex-wrap:wrap}
.slide-meta-item{display:flex;flex-direction:column;gap:2px}
.slide-meta-label{font-size:9px;font-weight:600;letter-spacing:.16em;text-transform:uppercase;color:rgba(255,255,255,.4)}
.slide-meta-val{font-size:13px;font-weight:600;color:rgba(255,255,255,.9)}
.hero-btns{display:flex;gap:12px;flex-wrap:wrap}
.btn-hero-primary{padding:14px 32px;background:var(--gold);color:var(--forest);border:none;font-family:'DM Sans',sans-serif;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:.25s;text-decoration:none}
.btn-hero-primary:hover{background:var(--gold-dk);color:var(--white)}
.btn-hero-outline{padding:14px 32px;background:transparent;color:var(--white);border:1px solid rgba(255,255,255,.4);font-family:'DM Sans',sans-serif;font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:.25s;text-decoration:none}
.btn-hero-outline:hover{border-color:var(--gold);color:var(--gold)}
.carousel-dots{position:absolute;bottom:40px;left:10%;display:flex;gap:8px;z-index:10}
.cdot{width:24px;height:3px;background:rgba(255,255,255,.3);border-radius:2px;cursor:pointer;transition:.3s}
.cdot.on{background:var(--gold);width:40px}
.carr-wrap{position:absolute;right:5%;top:50%;transform:translateY(-50%);display:flex;flex-direction:column;gap:10px;z-index:10}
.carr{width:44px;height:44px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.2);border-radius:2px;cursor:pointer;display:grid;place-items:center;color:rgba(255,255,255,.7);font-size:16px;transition:.2s;backdrop-filter:blur(6px)}
.carr:hover{background:rgba(188,168,121,.3);border-color:var(--gold);color:var(--gold)}

/* SECTIONS */
.section{padding:96px 0}
.section-inner{max-width:1200px;margin:0 auto;padding:0 48px}
.section-eyebrow{font-size:10px;font-weight:600;letter-spacing:.22em;text-transform:uppercase;color:var(--gold);margin-bottom:14px;display:flex;align-items:center;gap:10px}
.section-eyebrow::before{content:'';display:block;width:24px;height:1px;background:var(--gold)}
.section-title{font-family:'Cormorant Garamond',serif;font-size:clamp(32px,4vw,52px);font-weight:600;color:var(--forest);line-height:1.1;margin-bottom:16px}
.section-sub{font-size:14px;color:var(--text-muted);line-height:1.75;max-width:480px}

/* EVENTS */
.events-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:48px;flex-wrap:wrap;gap:16px}
.ev-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.ev-card{background:var(--white);border:1px solid rgba(175,183,172,.3);border-radius:4px;overflow:hidden;cursor:pointer;transition:.3s;text-decoration:none;color:inherit;display:block}
.ev-card:hover{transform:translateY(-4px);box-shadow:0 20px 60px rgba(7,51,44,.12);border-color:var(--gold)}
.ev-card-img{height:220px;background:var(--forest);position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden}
.ev-card-img-inner{width:100%;height:100%;background:linear-gradient(135deg,var(--forest) 0%,var(--olive) 100%);display:flex;align-items:center;justify-content:center;font-size:48px;opacity:.3}
.ev-card-cat{position:absolute;top:14px;left:14px;font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;padding:5px 12px;border-radius:2px;background:var(--gold);color:var(--forest)}
.ev-card-body{padding:20px 22px 22px}
.ev-card-title{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:600;color:var(--forest);line-height:1.25;margin-bottom:10px}
.ev-card-meta{display:flex;flex-direction:column;gap:5px;margin-bottom:16px}
.ev-meta-row{display:flex;align-items:center;gap:7px;font-size:11px;color:var(--text-muted)}
.ev-card-footer{display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid var(--light)}
.ev-price{font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:var(--forest)}
.ev-price small{font-family:'DM Sans',sans-serif;font-size:10px;font-weight:500;color:var(--text-muted);display:block;line-height:1}
.btn-ev{padding:9px 20px;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;border-radius:2px;cursor:pointer;transition:.2s;font-family:'DM Sans',sans-serif;border:none;text-decoration:none}
.btn-ev-primary{background:var(--forest);color:var(--white)}.btn-ev-primary:hover{background:var(--olive)}

/* MARQUEE */
.marquee-strip{background:var(--forest);padding:16px 0;overflow:hidden}
.marquee-track{display:flex;white-space:nowrap;animation:marquee 24s linear infinite}
@keyframes marquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.marquee-item{display:inline-flex;align-items:center;gap:14px;padding:0 32px;font-size:11px;font-weight:500;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.5)}
.marquee-dot{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block}

/* WHY */
.why-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;margin-top:64px}
.why-visual{background:var(--forest);position:relative;overflow:hidden;min-height:480px;border-radius:4px 0 0 4px;display:flex;align-items:center;justify-content:center}
.why-visual-text{font-family:'Cormorant Garamond',serif;font-size:72px;font-weight:600;color:rgba(188,168,121,.15);line-height:1;text-align:center;padding:24px}
.why-features{background:var(--white);padding:56px 48px;border-radius:0 4px 4px 0;border:1px solid rgba(175,183,172,.3);border-left:none}
.why-item{display:flex;gap:18px;padding:20px 0;border-bottom:1px solid var(--light)}
.why-item:last-child{border:none}
.why-icon{width:42px;height:42px;border-radius:50%;background:var(--gold-lt);display:grid;place-items:center;flex-shrink:0;font-size:18px}
.why-item-title{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:600;color:var(--forest);margin-bottom:5px}
.why-item-text{font-size:12px;color:var(--text-muted);line-height:1.7}

/* STATS */
.stats-section{background:var(--forest);padding:72px 0}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:0}
.stat-item{text-align:center;padding:32px;border-right:1px solid rgba(255,255,255,.08)}
.stat-item:last-child{border:none}
.stat-num{font-family:'Cormorant Garamond',serif;font-size:56px;font-weight:600;color:var(--gold);line-height:1;margin-bottom:6px}
.stat-label{font-size:11px;font-weight:500;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.45)}

/* NEWSLETTER */
.newsletter{background:var(--gold-lt);padding:80px 0;text-align:center}
.nl-form{display:flex;max-width:440px;margin:32px auto 0;border:1px solid rgba(7,51,44,.15);border-radius:3px;overflow:hidden;background:var(--white)}
.nl-form input{flex:1;padding:14px 18px;border:none;font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text);outline:none;background:transparent}
.nl-form button{padding:14px 24px;background:var(--forest);color:var(--white);border:none;font-family:'DM Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;transition:.2s;white-space:nowrap}
.nl-form button:hover{background:var(--olive)}

/* FOOTER */
footer{background:var(--dark);padding:64px 0 32px}
.footer-inner{max-width:1200px;margin:0 auto;padding:0 48px}
.footer-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:48px;margin-bottom:48px}
.footer-brand{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:600;color:var(--white);letter-spacing:.1em;text-transform:uppercase;margin-bottom:14px}
.footer-desc{font-size:12px;color:rgba(255,255,255,.35);line-height:1.8;max-width:260px}
.footer-col-title{font-size:10px;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--gold);margin-bottom:18px}
.footer-link{display:block;font-size:12px;color:rgba(255,255,255,.4);margin-bottom:10px;cursor:pointer;transition:.2s;text-decoration:none}
.footer-link:hover{color:var(--gold)}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;padding-top:24px;border-top:1px solid rgba(255,255,255,.06)}
.footer-copy{font-size:11px;color:rgba(255,255,255,.25)}

.slots-bar{height:4px;background:rgba(255,255,255,.2);border-radius:2px;overflow:hidden;margin-top:4px}
.slots-fill{height:100%;border-radius:2px;background:var(--gold)}

/* PWA Install Banner */
#pwa-banner{display:none;position:fixed;bottom:20px;left:50%;transform:translateX(-50%);background:var(--forest);color:var(--white);padding:14px 24px;border-radius:4px;font-size:12px;font-weight:500;gap:12px;align-items:center;z-index:999;border:1px solid var(--gold);box-shadow:0 8px 32px rgba(7,51,44,.4)}
#pwa-banner.show{display:flex}
#pwa-banner button{padding:7px 16px;background:var(--gold);color:var(--forest);border:none;border-radius:2px;font-family:'DM Sans',sans-serif;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;cursor:pointer}

@media(max-width:960px){
  #nav{padding:0 20px}.nav-links{display:none}
  .ev-grid{grid-template-columns:1fr}.why-grid{grid-template-columns:1fr}
  .stats-grid{grid-template-columns:repeat(2,1fr)}.footer-top{grid-template-columns:1fr 1fr}
  .section-inner{padding:0 20px}
}
</style>
</head>
<body>

<nav id="nav">
  <a href="/" class="nav-logo">
    <div class="nav-logo-mark">
      <svg viewBox="0 0 20 20" fill="none" width="20" height="20">
        <path d="M10 2L3 8v10h5v-6h4v6h5V8z" fill="#07332c"/>
      </svg>
    </div>
    <span class="nav-brand">Milyvents</span>
  </a>
  <div class="nav-links">
    <a class="nav-link" href="#sec-events">Events</a>
    <a class="nav-link" href="#sec-about">About</a>
    <a class="nav-link" href="#sec-stats">Gallery</a>
    <a class="nav-link" href="{{ route('pdf.project') }}">Project Doc</a>
  </div>
  <div class="nav-actions">
    @auth
    <a class="btn-nav btn-nav-outline" href="{{ route('dashboard') }}">Dashboard</a>
    @else
    <a class="btn-nav btn-nav-outline" href="{{ route('login') }}">Sign In</a>
    <a class="btn-nav btn-nav-fill" href="{{ route('register') }}">Get Started</a>
    @endauth
  </div>
</nav>

<!-- HERO CAROUSEL -->
<div class="hero">
  <div class="slides-wrap" id="slides-wrap" style="width:{{ count($slides) * 100 }}%">
    @forelse($slides as $slide)
    <div class="slide" style="width:{{ 100 / max(count($slides),1) }}%">
      <div class="slide-bg" style="background:{{ $slide->bg_color }}">
        <svg width="100%" height="100%" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice">
          <rect width="1440" height="900" fill="{{ $slide->bg_color }}"/>
          <polygon points="900,100 1100,300 900,500 700,300" fill="none" stroke="#bca879" stroke-width=".8" opacity=".25"/>
          <circle cx="1100" cy="200" r="180" fill="none" stroke="#bca879" stroke-width=".5" opacity=".12"/>
          <circle cx="1100" cy="200" r="80" fill="#bca879" opacity=".06"/>
          <rect x="100" y="720" width="200" height="2" fill="#bca879" opacity=".7"/>
          <circle cx="400" cy="150" r="3" fill="#bca879" opacity=".3"/>
          <circle cx="550" cy="80" r="2" fill="#bca879" opacity=".2"/>
        </svg>
      </div>
      <div class="slide-overlay" style="background:linear-gradient(120deg,rgba(7,51,44,.88) 0%,rgba(7,51,44,.5) 50%,transparent 100%)"></div>
      <div class="slide-content">
        <div class="slide-tag">{{ $slide->tag }}</div>
        <h1 class="slide-headline serif">{{ $slide->headline }}</h1>
        @if($slide->sub_text)<p class="slide-sub">{{ $slide->sub_text }}</p>@endif
        <div class="slide-meta">
          @if($slide->date_display)<div class="slide-meta-item"><span class="slide-meta-label">Date</span><span class="slide-meta-val">{{ $slide->date_display }}</span></div>@endif
          @if($slide->venue_display)<div class="slide-meta-item"><span class="slide-meta-label">Venue</span><span class="slide-meta-val">{{ $slide->venue_display }}</span></div>@endif
          @if($slide->price_display)<div class="slide-meta-item"><span class="slide-meta-label">From</span><span class="slide-meta-val">{{ $slide->price_display }}</span></div>@endif
        </div>
        <div class="hero-btns">
          <a href="{{ route('register') }}" class="btn-hero-primary">{{ $slide->btn_primary_label }}</a>
          <a href="{{ $slide->event ? route('events.show',$slide->event) : route('events.index') }}" class="btn-hero-outline">{{ $slide->btn_secondary_label }}</a>
        </div>
      </div>
    </div>
    @empty
    <div class="slide" style="width:100%">
      <div class="slide-bg" style="background:#07332c"></div>
      <div class="slide-overlay" style="background:rgba(7,51,44,.7)"></div>
      <div class="slide-content">
        <div class="slide-tag">Welcome</div>
        <h1 class="slide-headline serif">Curated Events<br>For Those Who<br>Demand Excellence</h1>
        <div class="hero-btns">
          <a href="{{ route('events.index') }}" class="btn-hero-primary">Explore Events</a>
          <a href="{{ route('register') }}" class="btn-hero-outline">Get Started</a>
        </div>
      </div>
    </div>
    @endforelse
  </div>

  <div class="carousel-dots" id="carousel-dots">
    @foreach($slides as $i => $slide)
    <div class="cdot {{ $i===0?'on':'' }}" onclick="goSlide({{ $i }})"></div>
    @endforeach
  </div>

  <div class="carr-wrap">
    <button class="carr" onclick="prevSlide()">▲</button>
    <button class="carr" onclick="nextSlide()">▼</button>
  </div>
</div>

<!-- MARQUEE -->
<div class="marquee-strip">
  <div class="marquee-track">
    @foreach(['Gala Nights','Business Summits','Corporate Retreats','Networking Events','Cultural Festivals','Leadership Forums','Award Ceremonies','Product Launches','Gala Nights','Business Summits','Corporate Retreats','Networking Events','Cultural Festivals','Leadership Forums','Award Ceremonies','Product Launches'] as $item)
    <span class="marquee-item"><span class="marquee-dot"></span>{{ $item }}</span>
    @endforeach
  </div>
</div>

<!-- FEATURED EVENTS -->
<section class="section" id="sec-events">
  <div class="section-inner">
    <div class="events-header">
      <div>
        <div class="section-eyebrow">Featured Events</div>
        <h2 class="section-title serif">Upcoming Experiences</h2>
        <p class="section-sub">Carefully curated events designed for Africa's most distinguished professionals and organisations.</p>
      </div>
      <a href="{{ route('events.index') }}" class="btn-ev btn-ev-primary">View All Events →</a>
    </div>
    <div class="ev-grid">
      @foreach($events->take(3) as $event)
      <a href="{{ route('events.show', $event) }}" class="ev-card">
        <div class="ev-card-img">
          @if($event->image_url)
          <img src="{{ $event->image_url }}" style="width:100%;height:100%;object-fit:cover" alt="{{ $event->title }}">
          @else
          <div class="ev-card-img-inner">🎭</div>
          @endif
          <div class="ev-card-cat">{{ $event->category }}</div>
        </div>
        <div class="ev-card-body">
          <h3 class="ev-card-title serif">{{ $event->title }}</h3>
          <div class="ev-card-meta">
            <div class="ev-meta-row">📅 {{ $event->start_date->format('d M Y') }}</div>
            <div class="ev-meta-row">📍 {{ $event->venue }}, {{ $event->location }}</div>
            <div class="ev-meta-row">👥 {{ $event->slots_remaining }} slots left</div>
          </div>
          <div class="ev-card-footer">
            <div class="ev-price">{{ $event->formatted_price }}<small>per person</small></div>
            <span class="btn-ev btn-ev-primary">Book Now</span>
          </div>
          <div class="slots-bar" style="margin-top:10px"><div class="slots-fill" style="width:{{ $event->slot_percent }}%"></div></div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>

<!-- WHY MILYVENTS -->
<section class="section" id="sec-about" style="background:var(--white);padding:96px 0">
  <div class="section-inner">
    <div class="section-eyebrow">Why Milyvents</div>
    <h2 class="section-title serif">Built for Excellence</h2>
    <div class="why-grid">
      <div class="why-visual">
        <div class="why-visual-text">Mily<br>vents</div>
      </div>
      <div class="why-features">
        @foreach([['🎯','Curated Experiences','Every event is hand-picked and quality-verified to meet the highest professional standards.'],['🔒','Secure Booking','Our booking system ensures safe, instant confirmation with full payment protection.'],['📱','PWA Mobile App','Install Milyvents on your phone — works offline, loads instantly, feels native.'],['📊','Test & Document','Built-in test plans and PDF export for project documentation and quality assurance.'],['📝','Smart Notes','Attach personal notes to events — never forget an insight or action item.'],['🌍','Pan-African Reach','Events across Nairobi, Kigali, Lagos and more cities across the continent.']] as [$icon,$title,$desc])
        <div class="why-item">
          <div class="why-icon">{{ $icon }}</div>
          <div>
            <div class="why-item-title serif">{{ $title }}</div>
            <div class="why-item-text">{{ $desc }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats-section" id="sec-stats">
  <div class="section-inner">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num serif">{{ $stats['events'] }}+</div><div class="stat-label">Events Hosted</div></div>
      <div class="stat-item"><div class="stat-num serif">{{ $stats['bookings'] }}+</div><div class="stat-label">Bookings Made</div></div>
      <div class="stat-item"><div class="stat-num serif">{{ $stats['venues'] }}+</div><div class="stat-label">Cities & Venues</div></div>
      <div class="stat-item"><div class="stat-num serif">{{ $stats['years'] }}+</div><div class="stat-label">Years Experience</div></div>
    </div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="newsletter">
  <div class="section-inner">
    <div class="section-eyebrow" style="justify-content:center">Stay Updated</div>
    <h2 class="section-title serif" style="text-align:center;color:var(--forest)">Never Miss an Event</h2>
    <p class="section-sub" style="margin:0 auto;text-align:center">Get early access to exclusive events and curated experiences straight to your inbox.</p>
    <div class="nl-form">
      <input type="email" placeholder="Your email address">
      <button type="button">Subscribe</button>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-top">
      <div>
        <div class="footer-brand">Milyvents</div>
        <p class="footer-desc">Africa's premier event management platform. Curated experiences for distinguished professionals.</p>
      </div>
      <div>
        <div class="footer-col-title">Events</div>
        <a href="{{ route('events.index') }}" class="footer-link">Browse Events</a>
        <a href="{{ route('register') }}" class="footer-link">Get Started</a>
        <a href="{{ route('login') }}" class="footer-link">Sign In</a>
      </div>
      <div>
        <div class="footer-col-title">Platform</div>
        <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
        <a href="{{ route('notes.index') }}" class="footer-link">Notes</a>
        <a href="{{ route('tests.index') }}" class="footer-link">Test Plans</a>
      </div>
      <div>
        <div class="footer-col-title">Documentation</div>
        <a href="{{ route('pdf.project') }}" class="footer-link">Project PDF</a>
        <a href="#" class="footer-link">API Docs</a>
        <a href="#" class="footer-link">Support</a>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-copy">© {{ date('Y') }} Milyvents. All rights reserved.</div>
      <div style="font-size:11px;color:rgba(255,255,255,.25)">Built with Laravel · PWA Enabled</div>
    </div>
  </div>
</footer>

<!-- PWA INSTALL BANNER -->
<div id="pwa-banner">
  📱 Install Milyvents on your device for a native experience
  <button id="pwa-install-btn">Install App</button>
  <button onclick="document.getElementById('pwa-banner').classList.remove('show')" style="background:transparent;border:none;color:rgba(255,255,255,.5);cursor:pointer;font-size:16px">×</button>
</div>

<script>
// NAV SCROLL
window.addEventListener('scroll',()=>{
  document.getElementById('nav').classList.toggle('scrolled',window.scrollY>50);
});

// CAROUSEL
let cur = 0;
const total = {{ max(count($slides),1) }};
function goSlide(n){
  cur = n;
  const pct = (100 / total) * cur;
  document.getElementById('slides-wrap').style.transform = `translateX(-${pct}%)`;
  document.querySelectorAll('.cdot').forEach((d,i)=>d.classList.toggle('on',i===cur));
}
function nextSlide(){ goSlide((cur+1)%total); }
function prevSlide(){ goSlide((cur-1+total)%total); }
const autoplay = setInterval(nextSlide, 5000);
document.querySelector('.hero').addEventListener('mouseenter',()=>clearInterval(autoplay));

// PWA
let deferredPrompt;
window.addEventListener('beforeinstallprompt',e=>{
  e.preventDefault(); deferredPrompt=e;
  document.getElementById('pwa-banner').classList.add('show');
});
document.getElementById('pwa-install-btn')?.addEventListener('click',()=>{
  if(deferredPrompt){ deferredPrompt.prompt(); deferredPrompt=null; document.getElementById('pwa-banner').classList.remove('show'); }
});

if('serviceWorker' in navigator){ navigator.serviceWorker.register('/sw.js').catch(()=>{}); }
</script>
</body>
</html>
