# Eleven Five Roots (115-roots)

> Website resmi komunitas suporter **Suicide Squad 11.5** — *Unite To Empower*.

CMS dan landing page untuk komunitas suporter PSS Sleman. Mengelola konten publik (blog, galeri, events, shop) dan panel admin dalam satu aplikasi Laravel.

---

## Tentang Proyek

**Eleven Five Roots** adalah platform web komunitas suporter yang dibangun dari template travel/booking menjadi CMS modern. Situs ini menjadi pusat informasi untuk:

- Berita dan artikel komunitas
- Jadwal dan dokumentasi event (nobar, away day, gathering)
- Katalog merchandise / shop
- Galeri foto kegiatan
- Halaman statis (About, FAQs, Contact)

---

## Fitur

### Halaman Publik

| Halaman | URL | Keterangan |
|---------|-----|------------|
| Homepage | `/` | Hero, about, shop carousel, events, blog, galeri slider, YouTube |
| Shop | `/shop` | Katalog produk merchandise |
| Blog | `/blogs` | Artikel dengan search, kategori, dan pagination |
| Events | `/events` | Event upcoming & past |
| Gallery | `/gallery` | Foto kegiatan, filter per event/album |
| About | `/about-us` | Konten dari CMS |
| FAQs | `/faqs` | Pertanyaan umum |
| Contact | `/contact` | Form kontak + info sosial media |
| RSS Feed | `/feed` | Feed artikel blog |
| Sitemap | `/sitemap.xml` | Sitemap SEO |

### Panel Admin (`/admin`)

| Modul | Fungsi |
|-------|--------|
| Dashboard | Statistik & ringkasan pesan terbaru |
| Blog & Category | CRUD artikel (draft/published) + kategori |
| Events | CRUD event dengan tanggal, lokasi, galeri album |
| Shop Products | CRUD produk dengan harga & link eksternal |
| Gallery | Upload foto, hubungkan ke event |
| Pages | Edit konten CMS (About, FAQs, Contact, Site Settings) |
| Messages | Inbox pesan kontak + balas via email |
| Users | Kelola akun admin |

**Site Settings** (via Admin → Pages → Site Settings):

- Hero title & subtitle
- Hero background images
- Partner logos
- Announcement banner
- YouTube embed & channel URL
- Footer & social links

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 10, PHP 8.1+ |
| Frontend | Blade, custom CSS, Swiper, ScrollReveal |
| Admin UI | AdminLTE |
| Database | MySQL / MariaDB / SQLite |
| Editor | CKEditor 5 |
| Auth | Laravel UI (login, tanpa register publik) |

---

## Persyaratan

- PHP **8.1+** (extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- [Composer](https://getcomposer.org/)
- MySQL / MariaDB / SQLite
- Node.js *(opsional, untuk build asset Vite)*

---

## Instalasi

### 1. Clone & install dependencies

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

Edit `.env` — minimal atur koneksi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_suicide
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database & storage

```bash
php artisan migrate --seed
php artisan storage:link
```

### 4. Jalankan server

```bash
php artisan serve
```

Buka **http://127.0.0.1:8000**

---

## Akun Admin

Setelah seed, login di **http://127.0.0.1:8000/login**

| | Default |
|---|---------|
| Email | `admin@suicide.com` |
| Password | `suicide115` |

Kustomisasi via `.env` **sebelum** menjalankan seed:

```env
ADMIN_NAME="Admin"
ADMIN_EMAIL=admin@suicide.com
ADMIN_PASSWORD=password_anda_yang_kuat
```

> **Production:** gunakan password kuat dan jangan commit `.env` ke repository.

---

## Environment Variables

| Variabel | Deskripsi |
|----------|-----------|
| `APP_URL` | URL situs (sitemap, OG tags, RSS) |
| `ADMIN_NAME` | Nama admin saat seed |
| `ADMIN_EMAIL` | Email admin saat seed |
| `ADMIN_PASSWORD` | Password admin saat seed |
| `MAIL_MAILER` | Driver email (`smtp`, `log`, dll.) |
| `MAIL_HOST` | Host SMTP |
| `MAIL_PORT` | Port SMTP |
| `MAIL_USERNAME` | Username SMTP |
| `MAIL_PASSWORD` | Password SMTP |
| `MAIL_FROM_ADDRESS` | Alamat pengirim email |
| `MAIL_FROM_NAME` | Nama pengirim email |

Form kontak dan balasan admin membutuhkan konfigurasi `MAIL_*` yang valid.

---

## Seeders

| Seeder | Isi |
|--------|-----|
| `AdminSeeder` | Akun admin |
| `PageSeeder` | About, FAQs, Contact, Site Settings |
| `CategorySeeder` | Kategori blog |
| `BlogSeeder` | Artikel contoh |
| `EventSeeder` | Event contoh |
| `ProductSeeder` | Produk shop contoh |

```bash
# Seed semua
php artisan db:seed

# Seed spesifik
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=EventSeeder
```

Reset penuh database + seed:

```bash
php artisan migrate:fresh --seed
```

---

## Struktur Proyek

```
115-roots/
├── app/
│   ├── Http/Controllers/       # Controller publik & admin
│   ├── Http/Requests/          # Form validation
│   ├── Models/                 # Eloquent models
│   └── Support/                # Helpers (SlugGenerator, dll.)
├── database/
│   ├── migrations/
│   └── seeders/
├── public/frontend/            # Asset frontend (CSS, JS, gambar)
├── resources/views/
│   ├── admin/                  # View panel admin
│   ├── blogs/, events/, shop/  # View halaman publik
│   └── layouts/                # Layout frontend & admin
└── routes/web.php              # Route aplikasi
```

---

## Testing

```bash
php artisan test
```

> Disarankan menggunakan database terpisah untuk testing. Uncomment baris SQLite di `phpunit.xml` agar test tidak menimpa data development.

---

## Deploy ke Production

1. Set environment production:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domain-anda.com
   ```
2. Install dependencies:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. Migrasi & storage:
   ```bash
   php artisan migrate --force
   php artisan storage:link
   ```
4. Seed admin *(hanya first deploy)* — pastikan `ADMIN_PASSWORD` sudah kuat
5. Konfigurasi `MAIL_*` untuk form kontak
6. Cache optimasi:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
7. Pastikan `storage/` dan `bootstrap/cache/` writable oleh web server
8. Verifikasi endpoint: `/`, `/shop`, `/events`, `/sitemap.xml`, `/feed`

---

## Route Penting

| Akses | URL |
|-------|-----|
| Homepage | `/` |
| Admin Dashboard | `/admin/dashboard` |
| Login | `/login` |

Registrasi publik **dinonaktifkan** — hanya admin yang dapat membuat user baru.

---

## Lisensi

Proyek ini menggunakan [MIT License](https://opensource.org/licenses/MIT) (Laravel framework).

---

## Kredit

Dikembangkan untuk komunitas **Suicide Squad 11.5** — suporter PSS Sleman.

Built with love by [GEGA CREATIVE](https://www.gegacreative.com/)
