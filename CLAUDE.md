# Milyvents — Event Management PWA

## Project Overview
A Progressive Web App (PWA) for curated event management built with **Laravel 11**, using the MILYVENTS design system (forest green + gold).

## Tech Stack
- **Backend**: PHP 8.4, Laravel 11
- **Frontend**: Blade templates, Alpine.js, Vite
- **Database**: SQLite (default) / MySQL
- **Auth**: Laravel Breeze
- **PDF**: barryvdh/laravel-dompdf
- **PWA**: manifest.json + service worker (public/sw.js)

## Default Credentials (Dev)
- Admin: `admin@milyvents.com` / `password`
- User: `jane@milyvents.com` / `password`

## Common Commands
```bash
# Fresh database with sample data
php artisan migrate:fresh --seed

# Start dev server
php artisan serve

# Build assets
npm run build

# Watch assets (dev)
npm run dev

# Clear all caches
php artisan config:clear && php artisan view:clear && php artisan route:clear
```

## Modules
| Module | Route | Description |
|--------|-------|-------------|
| Landing | `/` | Public homepage with carousel, events, stats |
| Events | `/events` | Browse & search events |
| Dashboard | `/dashboard` | User dashboard with KPIs |
| Bookings | `/bookings` | User booking history |
| Notes | `/notes` | Personal notes linked to events |
| Test Plans | `/tests` | QA test plans with exportable PDF |
| Admin | `/admin` | Event CRUD + carousel management |
| PDF Export | `/pdf/project` | Project documentation PDF |

## Database Tables
- `users` — is_admin flag for admin access
- `events` — full event details
- `bookings` — event reservations
- `notes` — user notes
- `carousel_slides` — homepage hero slides
- `test_plans` — test plan documents
- `test_cases` — individual test cases per plan
- `test_results` — pass/fail results per test case

## Design System
- Primary: `#07332c` (forest green)
- Accent: `#bca879` (gold)
- Typography: Cormorant Garamond (serif) + DM Sans (sans)
- Theme switching: `[data-theme="green|blue"]` on `<html>`

## PWA Notes
- Manifest: `public/manifest.json`
- Service Worker: `public/sw.js`
- Offline page: `public/offline.html`
- Icons: `public/icons/`
