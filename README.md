# LuxInvite - Premium Digital Invitation SaaS (Native PHP)

## Fitur Utama
- Landing page premium (hero, statistik, kategori, tema, pricing, testimoni/FAQ-ready).
- User dashboard + admin dashboard modular.
- Dynamic invitation URL: `/undangan/{slug}?kpd=Nama+Tamu`.
- Paywall subscription: user wajib berlangganan sebelum publish/builder penuh.
- SEO basics: meta OG, robots, sitemap.
- Struktur scalable (Core, Controllers, Views, config, routes, database).

## Menjalankan Lokal
1. Import `database/schema.sql`.
2. Jalankan server: `php -S localhost:8000 -t public`.
3. Buka `http://localhost:8000`.

---

## Deploy ke aaPanel (Nginx + PHP Native)
Panduan ini untuk VPS dengan aaPanel dan stack Nginx + MySQL + PHP.

### 1) Persiapan di aaPanel
1. Install package: **Nginx**, **MySQL**, **PHP (minimal 8.1)**, **phpMyAdmin**, **Redis (opsional)**.
2. Buat website baru di menu **Website > Add Site**:
   - Domain: `domainkamu.com`
   - Root dir: `/www/wwwroot/domainkamu.com`
   - PHP version: pilih yang aktif (mis. PHP 8.2)

### 2) Upload source code
1. Upload source project ke folder root domain:
   - `/www/wwwroot/domainkamu.com`
2. Pastikan struktur ini tersedia:
   - `app/`
   - `config/`
   - `database/`
   - `public/`
   - `routes/`

> Karena entry point ada di `public/index.php`, document root harus diarahkan ke folder `public`.

### 3) Atur Document Root ke `public`
Di aaPanel:
1. Masuk ke **Website > domainkamu.com > Config**.
2. Ubah root menjadi:
   - `/www/wwwroot/domainkamu.com/public`
3. Simpan lalu reload Nginx.

### 4) Konfigurasi Rewrite Nginx
Tambahkan konfigurasi di site conf (aaPanel > Config):

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    include fastcgi_params;
    fastcgi_pass unix:/tmp/php-cgi-82.sock; # sesuaikan versi php
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
}
```

> Jika socket berbeda, cek di aaPanel PHP-FPM settings.

### 5) Konfigurasi Database
1. Buat database baru di menu **Database** (contoh: `undangan`).
2. Import file SQL:
   - `database/schema.sql`
3. Sesuaikan kredensial di `config/app.php`:
   - host, port, database, username, password.

### 6) Permission folder
Set permission aman (umum Linux):
- Folder: `755`
- File: `644`
- Folder upload/log (jika dipakai runtime): writeable oleh user webserver.

Contoh command:
```bash
find /www/wwwroot/domainkamu.com -type d -exec chmod 755 {} \;
find /www/wwwroot/domainkamu.com -type f -exec chmod 644 {} \;
chmod -R 775 /www/wwwroot/domainkamu.com/storage
```

### 7) SSL & domain
1. Aktifkan SSL di aaPanel (Let's Encrypt).
2. Force HTTPS.
3. Arahkan DNS A record domain ke IP VPS.

### 8) Optimasi production
- Aktifkan OPcache di PHP.
- Gzip/Brotli di Nginx.
- Cache static assets (css/js/img).
- Nonaktifkan `display_errors` di production.
- Tambahkan log rotation untuk `storage/logs`.

### 9) Validasi setelah deploy
- Buka `/` (landing page harus tampil).
- Buka `/login`, `/register`, `/dashboard`, `/admin`.
- Tes URL dinamis:
  - `/undangan/andi-dan-sinta?kpd=Budi+Santoso`

---

## Buyer/User Flow (Ringkas)
1. Landing -> Preview tema -> CTA buat undangan.
2. Register/Login -> trial mode (fitur dikunci).
3. Upgrade paket -> checkout/payment callback.
4. Onboarding wizard -> publish undangan.
5. Share WhatsApp + tracking RSVP + analytics.

## Catatan Keamanan
- Escape output dasar untuk parameter tamu.
- Pisahkan role admin & user route.
- Fondasi siap ditingkatkan dengan CSRF token, rate limit, signature webhook, dan audit log.
