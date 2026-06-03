# Eleven Five Roots — 115-roots

Website komunitas suporter PSS Sleman (Suicide Squad 11.5). Dibangun dengan Laravel 10, Blade, dan AdminLTE.

## Fitur

- **Publik:** Homepage, shop, blog, galeri, about, FAQs, contact, events, RSS feed, sitemap
- **Admin:** Dashboard, produk shop, blog & kategori, galeri, halaman CMS, events, pesan kontak, users

## Persyaratan

- PHP 8.1+
- Composer
- MySQL / MariaDB / SQLite
- Node.js (opsional, untuk asset build)

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Atur database di `.env`, lalu:

```bash
php artisan migrate --seed
php artisan storage:link
```

### Variabel environment penting

| Variabel | Deskripsi |
|----------|-----------|
| `ADMIN_NAME` | Nama admin saat seed (default: `Admin`) |
| `ADMIN_EMAIL` | Email admin saat seed (default: `admin@suicide.com`) |
| `ADMIN_PASSWORD` | Password admin saat seed (default: `suicide115`) |
| `MAIL_*` | Konfigurasi email untuk form kontak & balasan admin |
| `APP_URL` | URL situs (untuk sitemap & OG tags) |

### Akun admin default

- Email: nilai `ADMIN_EMAIL` di `.env`, atau `admin@suicide.com` jika tidak diset
- Password: nilai `ADMIN_PASSWORD` di `.env`, atau `suicide115` jika tidak diset

## Menjalankan

```bash
php artisan serve
```

Admin panel: `/admin/dashboard`  
Login: `/login`

## Storage

Upload gambar blog, galeri, dan produk disimpan di `storage/app/public`. Pastikan symlink sudah dibuat:

```bash
php artisan storage:link
```

## Deploy checklist

1. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` ke domain production
2. Jalankan `composer install --no-dev --optimize-autoloader`
3. Jalankan `php artisan migrate --force`
4. Jalankan `php artisan storage:link`
5. Set `ADMIN_PASSWORD` yang kuat sebelum `php artisan db:seed` (hanya first deploy)
6. Konfigurasi `MAIL_*` untuk form kontak & reply admin
7. Cache config & routes:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
8. Pastikan folder `storage/` dan `bootstrap/cache/` writable oleh web server
9. Verifikasi `/sitemap.xml`, `/feed`, `/shop`, `/faqs` dapat diakses

## Testing

```bash
php artisan test
```
