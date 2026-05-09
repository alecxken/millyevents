<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Milyvents — Project Documentation</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #1a2420; background: #fff; }
.page { padding: 40px; }

/* Cover */
.cover { background: #07332c; color: #fff; padding: 60px 50px; margin: -40px -40px 36px; text-align: center; position: relative; }
.cover-logo { font-size: 42px; font-weight: 900; letter-spacing: 4px; text-transform: uppercase; color: #bca879; margin-bottom: 8px; }
.cover-sub { font-size: 13px; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,.5); margin-bottom: 32px; }
.cover-line { width: 60px; height: 3px; background: #bca879; margin: 0 auto 32px; }
.cover-title { font-size: 26px; font-weight: 700; color: #fff; margin-bottom: 12px; }
.cover-desc { font-size: 12px; color: rgba(255,255,255,.6); max-width: 380px; margin: 0 auto 32px; line-height: 1.7; }
.cover-meta { font-size: 10px; color: rgba(255,255,255,.35); letter-spacing: 1px; }

/* Headings */
h1 { font-size: 20px; font-weight: 700; color: #07332c; border-bottom: 2px solid #bca879; padding-bottom: 8px; margin: 28px 0 14px; text-transform: uppercase; letter-spacing: 1px; }
h2 { font-size: 14px; font-weight: 700; color: #485b46; margin: 18px 0 8px; }
h3 { font-size: 12px; font-weight: 700; color: #07332c; margin: 12px 0 6px; }
p  { font-size: 11px; line-height: 1.8; color: #333; margin-bottom: 10px; }
ul, ol { padding-left: 18px; margin-bottom: 10px; }
li { font-size: 11px; line-height: 1.8; color: #444; margin-bottom: 2px; }

/* Boxes */
.box { background: #f9f8f6; border-left: 4px solid #bca879; border-radius: 0 3px 3px 0; padding: 12px 16px; margin-bottom: 12px; }
.box-green { border-left-color: #2a7040; background: #eef6f0; }
.box-blue { border-left-color: #085580; background: #edf4f9; }
.box-title { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #8a7550; margin-bottom: 6px; }

/* Module cards */
.module-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
.module-card { background: #f9f8f6; border: 1px solid #e0ddd7; border-radius: 3px; padding: 12px; }
.module-icon { font-size: 18px; margin-bottom: 6px; }
.module-name { font-size: 12px; font-weight: 700; color: #07332c; margin-bottom: 4px; }
.module-desc { font-size: 10px; color: #6b7c78; line-height: 1.6; }

/* Tech stack */
.tech-row { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px; }
.tech-badge { display: inline-block; padding: 5px 12px; background: #07332c; color: #bca879; border-radius: 2px; font-size: 10px; font-weight: 700; letter-spacing: .5px; }

/* Footer */
.footer { margin-top: 40px; padding-top: 16px; border-top: 1px solid #e0ddd7; display: flex; justify-content: space-between; font-size: 9px; color: #bbb; }
</style>
</head>
<body>
<div class="page">

  <!-- COVER -->
  <div class="cover">
    <div class="cover-logo">Milyvents</div>
    <div class="cover-sub">Event Management Platform</div>
    <div class="cover-line"></div>
    <div class="cover-title">Project Documentation</div>
    <div class="cover-desc">A comprehensive Progressive Web App (PWA) for curated event management, built with Laravel 11, featuring booking, notes, test plans and admin tools.</div>
    <div class="cover-meta">Masters Group Project · Generated {{ now()->format('F Y') }}</div>
  </div>

  <!-- 1. WHAT IS THIS PROJECT -->
  <h1>1. What Is This Project?</h1>
  <p>Milyvents is an <strong>Event Management Progressive Web App</strong> — a website that works like a mobile app. Think of it like a smart ticketing and event organiser that you can install on your phone, even without an internet connection.</p>
  <p>The system allows:</p>
  <ul>
    <li><strong>The public</strong> to browse events and learn more</li>
    <li><strong>Registered users</strong> to book tickets, take notes and manage test plans</li>
    <li><strong>Administrators</strong> to create events, manage the homepage carousel, and monitor activity</li>
  </ul>
  <div class="box box-green">
    <div class="box-title">In Simple Terms</div>
    Milyvents is like a combination of Eventbrite (event bookings), Google Keep (notes), and a Quality Assurance checklist tool — all wrapped in a beautiful website that also works as a phone app.
  </div>

  <!-- 2. WHY LARAVEL -->
  <h1>2. Why Laravel?</h1>
  <p>Laravel is a <strong>PHP framework</strong> — a toolbox of ready-made code that helps developers build websites faster and more securely. Here is why we chose it:</p>
  <ul>
    <li><strong>Ready-made security</strong> — Laravel automatically protects against hacking techniques like SQL injection, cross-site scripting (XSS), and cross-site request forgery (CSRF).</li>
    <li><strong>Database made easy</strong> — Instead of writing complex database commands, Laravel uses "Eloquent ORM" which lets us write simple English-like code.</li>
    <li><strong>Built-in user accounts</strong> — Laravel Breeze gave us a complete login/registration system in minutes, not weeks.</li>
    <li><strong>Routing</strong> — Laravel handles website addresses (URLs) cleanly and organised.</li>
    <li><strong>Blade Templates</strong> — Laravel's template engine makes HTML pages reusable and maintainable.</li>
    <li><strong>Popular in industry</strong> — Millions of websites use Laravel globally, meaning there is excellent community support.</li>
  </ul>
  <div class="box">
    <div class="box-title">Analogy</div>
    If building a website from scratch is like constructing a building from raw materials, Laravel is like using pre-fabricated panels — the walls, doors and plumbing are already made, so you focus on designing your unique building.
  </div>

  <!-- 3. TECH STACK -->
  <h1>3. Technology Stack</h1>
  <div class="tech-row">
    <span class="tech-badge">PHP 8.4</span>
    <span class="tech-badge">Laravel 11</span>
    <span class="tech-badge">SQLite / MySQL</span>
    <span class="tech-badge">Blade Templates</span>
    <span class="tech-badge">Alpine.js</span>
    <span class="tech-badge">Vite</span>
    <span class="tech-badge">DomPDF</span>
    <span class="tech-badge">PWA</span>
    <span class="tech-badge">Service Worker</span>
    <span class="tech-badge">Laravel Breeze</span>
  </div>

  <h2>Why SQLite (and optionally MySQL)?</h2>
  <p>SQLite is a <strong>file-based database</strong> — perfect for development and testing because it needs no server setup. The database is a single file. MySQL is a full server-based database used in production environments. Our system supports both with a simple configuration change.</p>

  <!-- 4. PROJECT MODULES -->
  <h1>4. Project Modules</h1>
  <p>The system is divided into six main modules:</p>
  <div class="module-grid">
    <div class="module-card">
      <div class="module-icon">🎟</div>
      <div class="module-name">Events Module</div>
      <div class="module-desc">Browse, search and book events. Administrators can create, edit and delete events with full detail management.</div>
    </div>
    <div class="module-card">
      <div class="module-icon">📝</div>
      <div class="module-name">Notes Module</div>
      <div class="module-desc">Personal notes attached to specific events or standalone. Supports pinning, colour coding and event linking.</div>
    </div>
    <div class="module-card">
      <div class="module-icon">🧪</div>
      <div class="module-name">Test Plans Module</div>
      <div class="module-desc">Full structured test plan creation following the standard 5.1–5.8 documentation template. Results recorded per test case.</div>
    </div>
    <div class="module-card">
      <div class="module-icon">📄</div>
      <div class="module-name">PDF Export</div>
      <div class="module-desc">Export test plans as professional PDF documents. Download this project documentation as PDF too.</div>
    </div>
    <div class="module-card">
      <div class="module-icon">⚙</div>
      <div class="module-name">Admin Panel</div>
      <div class="module-desc">Full CRUD for events. Manage homepage carousel slides, view booking stats, and monitor system activity.</div>
    </div>
    <div class="module-card">
      <div class="module-icon">📱</div>
      <div class="module-name">PWA (Progressive Web App)</div>
      <div class="module-desc">Install on Android or iOS. Works offline. Loads instantly. Feels like a native app — no app store needed.</div>
    </div>
  </div>

  <!-- 5. WHAT IS A PWA -->
  <h1>5. What Is a Progressive Web App (PWA)?</h1>
  <p>A PWA is a website that has been enhanced to behave like a mobile phone application. Here is what makes Milyvents a PWA:</p>
  <ul>
    <li><strong>Installable</strong> — Users see an "Add to Home Screen" prompt on Android/iOS. Once installed, it has its own icon, no browser address bar, and looks exactly like a native app.</li>
    <li><strong>Offline support</strong> — A "Service Worker" (a background script) caches pages so the app still loads even without Wi-Fi.</li>
    <li><strong>Fast loading</strong> — Cached assets load from the device storage, making the app feel instant.</li>
    <li><strong>Theme colour</strong> — The browser/status bar matches the Milyvents green brand colour.</li>
    <li><strong>No app store required</strong> — Zero cost to distribute. No Apple/Google approval needed.</li>
  </ul>

  <!-- 6. HOW DATA IS STRUCTURED -->
  <h1>6. How Data Is Structured (Database)</h1>
  <p>The system uses 8 database tables:</p>
  <ul>
    <li><strong>users</strong> — Stores registered users (name, email, password, is_admin flag)</li>
    <li><strong>events</strong> — All event details (title, venue, date, price, capacity, category)</li>
    <li><strong>bookings</strong> — Records which user booked which event, quantity and payment</li>
    <li><strong>notes</strong> — User notes optionally linked to events</li>
    <li><strong>carousel_slides</strong> — The hero carousel content on the homepage, editable by admin</li>
    <li><strong>test_plans</strong> — Test plan documents with scope, approach, criteria</li>
    <li><strong>test_cases</strong> — Individual test steps and expected outcomes within a plan</li>
    <li><strong>test_results</strong> — Pass/Fail outcomes recorded against each test case</li>
  </ul>

  <!-- 7. USER ROLES -->
  <h1>7. User Roles</h1>
  <h2>Public Visitor</h2>
  <p>Can browse the landing page, view events, read event details. Cannot book or access dashboard without an account.</p>
  <h2>Registered User</h2>
  <p>Can book events, manage personal notes, create and manage test plans, export test results as PDF, view booking history.</p>
  <h2>Administrator</h2>
  <p>Has all user permissions plus: Create/Edit/Delete events, manage carousel slides, view all bookings and revenue stats.</p>
  <div class="box box-blue">
    <div class="box-title">Default Admin Credentials (For Demo)</div>
    Email: admin@milyvents.com · Password: password
  </div>

  <!-- 8. HOW TO RUN THE PROJECT -->
  <h1>8. How to Run the Project</h1>
  <ol>
    <li>Ensure PHP 8.2+, Composer, and Node.js are installed</li>
    <li>Clone the repository: <strong>git clone [repo-url]</strong></li>
    <li>Copy environment file: <strong>cp .env.example .env</strong></li>
    <li>Install dependencies: <strong>composer install &amp;&amp; npm install</strong></li>
    <li>Generate application key: <strong>php artisan key:generate</strong></li>
    <li>Run migrations with sample data: <strong>php artisan migrate:fresh --seed</strong></li>
    <li>Build frontend assets: <strong>npm run build</strong></li>
    <li>Start development server: <strong>php artisan serve</strong></li>
    <li>Open browser at: <strong>http://localhost:8000</strong></li>
  </ol>
  <p style="margin-top:8px">To use MySQL instead of SQLite, update the <strong>DB_CONNECTION</strong> and related settings in the <strong>.env</strong> file.</p>

  <!-- 9. DESIGN -->
  <h1>9. Design Language</h1>
  <p>The design uses a premium forest green (#07332c) and gold (#bca879) palette inspired by luxury African event aesthetics. Typography combines <em>Cormorant Garamond</em> (an elegant serif for headings) with <em>DM Sans</em> (a clean sans-serif for body text). The design supports theme switching (Green / Blue) without a page reload.</p>

  <div class="footer">
    <div>Milyvents — Masters Group Project Documentation</div>
    <div>Generated {{ now()->format('d M Y') }}</div>
  </div>
</div>
</body>
</html>
