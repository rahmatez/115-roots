# Eleven Five Roots (115-roots)

> Official website for **Suicide Squad 11.5** supporter community — *Unite To Empower*.

A Laravel CMS and landing page for the PSS Sleman supporter community. Manage public content (blog, gallery, events, shop) and a modern admin panel in one application.

---

## About

**Eleven Five Roots** is a supporter community platform refactored from a travel/booking template into a modern CMS. The site serves as a hub for:

- Community news and articles
- Event schedules and documentation (watch parties, away days, gatherings)
- Merchandise catalog and order intake
- Instagram-powered photo gallery
- Static pages (About, FAQs, Contact)

---

## Features

### Public Pages

| Page | URL | Description |
|------|-----|-------------|
| Homepage | `/` | Hero, about, shop carousel, events, blog, gallery slider, YouTube |
| Shop | `/shop` | Product catalog with on-site order form |
| Blog | `/blogs` | Articles with search, categories, and pagination |
| Events | `/events` | Upcoming and past events |
| Gallery | `/gallery` | Photos synced from Instagram feed |
| About | `/about-us` | CMS-driven content |
| FAQs | `/faqs` | Frequently asked questions |
| Contact | `/contact` | Contact form + social links |
| RSS Feed | `/feed` | Blog article feed |
| Sitemap | `/sitemap.xml` | SEO sitemap |

### Admin Panel (`/admin`)

| Module | Description |
|--------|-------------|
| Dashboard | Stats, recent orders, blog posts, and messages |
| Blog & Categories | CRUD articles (draft/published) + categories |
| Events | CRUD events with date, location, and event photo albums |
| Shop Products | CRUD products with pricing |
| Orders | View and delete customer shop orders with payment proof |
| Event Photos | Upload photos linked to specific events |
| Pages | Edit CMS content (About, FAQs, Contact, Site Settings) |
| Messages | Contact inbox + email replies |
| Users | Manage admin accounts |

**Site Settings** (Admin → Pages → Site Settings):

- Hero title, subtitle, and background images
- Partner logos
- Announcement banner
- YouTube embed and channel URL
- Instagram gallery API credentials
- Footer and social links

**Shop orders:** Customers submit orders from `/shop/{product}` with name, address, phone, and payment proof upload. Orders appear automatically in Admin → Orders.

**Gallery:** The public gallery and homepage slider pull photos from your Instagram account via the Instagram Graph API (no manual uploads for the main gallery).

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 10, PHP 8.1+ |
| Frontend | Blade, custom CSS, Swiper, ScrollReveal |
| Admin UI | Custom modern dashboard |
| Database | MySQL / MariaDB / SQLite |
| Editor | CKEditor 5 |
| Auth | Laravel UI (login only, public registration disabled) |
| Gallery | Instagram Graph API |

---

## Requirements

- PHP **8.1+** (extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- [Composer](https://getcomposer.org/)
- MySQL / MariaDB / SQLite
- Node.js *(optional, for Vite asset builds)*

---

## Installation

### 1. Clone and install dependencies

```bash
git clone https://github.com/<username>/115-roots.git
cd 115-roots
composer install
```

### 2. Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` — at minimum configure the database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_suicide
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database and storage

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4. Run the server

```bash
php artisan serve
```

Open **http://127.0.0.1:8000**

---

## Default Admin Account

After seeding, log in at **http://127.0.0.1:8000/login**

| | Default |
|---|---------|
| Email | `admin@suicide.com` |
| Password | `suicide115` |

Customize via `.env` **before** running seed:

```env
ADMIN_NAME="Admin"
ADMIN_EMAIL=admin@suicide.com
ADMIN_PASSWORD=your_strong_password
```

> **Production:** Use a strong password and never commit `.env` to the repository.

---

## Environment Variables

| Variable | Description |
|----------|-------------|
| `APP_URL` | Site URL (sitemap, OG tags, RSS) |
| `ADMIN_NAME` | Admin display name when seeding |
| `ADMIN_EMAIL` | Admin email when seeding |
| `ADMIN_PASSWORD` | Admin password when seeding |
| `MAIL_MAILER` | Email driver (`smtp`, `log`, etc.) |
| `MAIL_HOST` | SMTP host |
| `MAIL_PORT` | SMTP port |
| `MAIL_USERNAME` | SMTP username |
| `MAIL_PASSWORD` | SMTP password |
| `MAIL_FROM_ADDRESS` | Sender email address |
| `MAIL_FROM_NAME` | Sender display name |
| `INSTAGRAM_USERNAME` | Instagram handle (e.g. `suicidesquad11.5`) |
| `INSTAGRAM_USER_ID` | Instagram Business account numeric ID |
| `INSTAGRAM_ACCESS_TOKEN` | Long-lived Instagram Graph API token |
| `INSTAGRAM_FEED_LIMIT` | Max posts to fetch (default: 25) |
| `INSTAGRAM_CACHE_TTL` | Feed cache duration in seconds (default: 3600) |

Contact forms and admin reply emails require valid `MAIL_*` configuration.

Instagram gallery requires a **Business** or **Creator** Instagram account connected to a Meta Developer app. Credentials can also be set in Admin → Pages → Site Settings.

---

## Seeders

| Seeder | Contents |
|--------|----------|
| `AdminSeeder` | Admin user account |
| `PageSeeder` | About, FAQs, Contact, Site Settings |
| `CategorySeeder` | Blog categories |
| `BlogSeeder` | Sample articles |
| `EventSeeder` | Sample events |
| `ProductSeeder` | Sample shop products |

```bash
# Seed all
php artisan db:seed

# Seed specific seeder
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=EventSeeder
```

Full database reset + seed:

```bash
php artisan migrate:fresh --seed
```

---

## Project Structure

```
115-roots/
├── app/
│   ├── Http/Controllers/       # Public and admin controllers
│   ├── Http/Requests/            # Form validation
│   ├── Models/                   # Eloquent models
│   ├── Services/                 # InstagramFeedService, etc.
│   └── Support/                  # Helpers (SlugGenerator, etc.)
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── admin/                    # Admin CSS/JS
│   └── frontend/                 # Frontend assets (CSS, JS, images)
├── resources/views/
│   ├── admin/                    # Admin panel views
│   ├── blogs/, events/, shop/    # Public page views
│   └── layouts/                  # Frontend and admin layouts
└── routes/web.php                # Application routes
```

---

## Testing

```bash
php artisan test
```

> Use a separate database for testing. Uncomment the SQLite lines in `phpunit.xml` so tests do not overwrite your development data.

---

## Production Deployment

1. Set production environment:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-domain.com
   ```
2. Install dependencies:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. Migrate and link storage:
   ```bash
   php artisan migrate --force
   php artisan storage:link
   ```
4. Seed admin *(first deploy only)* — ensure `ADMIN_PASSWORD` is strong
5. Configure `MAIL_*` for contact forms
6. Configure Instagram API credentials for the gallery
7. Optimize caches:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
8. Ensure `storage/` and `bootstrap/cache/` are writable by the web server
9. Verify endpoints: `/`, `/shop`, `/events`, `/gallery`, `/sitemap.xml`, `/feed`

---

## Key Routes

| Access | URL |
|--------|-----|
| Homepage | `/` |
| Admin Dashboard | `/admin/dashboard` |
| Login | `/login` |

Public registration is **disabled** — only existing admins can create new users.

---

## License

This project uses the [MIT License](https://opensource.org/licenses/MIT) (Laravel framework).

---

## Credits

Built for **Suicide Squad 11.5** — PSS Sleman supporter community.

Built with love by [rahmatez](https://www.github/rahmatez.com/)
