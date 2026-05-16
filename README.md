# Undangan Digital Premium (PHP Native)

Website undangan digital premium modern berbasis **HTML + TailwindCSS + JavaScript + PHP Native** tanpa framework.

## Fitur Utama
- Landing page premium (hero fullscreen, countdown, musik autoplay, AOS, particle, confetti, typing).
- Multi tema (9 preset + custom theme builder).
- Data mempelai + love story timeline.
- Detail acara (akad, resepsi, ngunduh mantu, maps, add to calendar).
- RSVP tersimpan ke MySQL + ucapan realtime polling.
- Galeri (Swiper slider, masonry, lightbox, video prewedding).
- Amplop digital (QRIS, e-wallet, bank transfer + copy rekening).
- Admin panel (login, dashboard statistik, CRUD dasar).
- Generator link tamu `?to=NamaTamu` + share WhatsApp.
- SEO, OpenGraph, Schema.org WeddingEvent, sitemap.
- PWA installable + service worker cache.
- Integrasi notifikasi WA/Telegram/Email (hook API).
- Security: CSRF, rate-limit, sanitasi input.

## Struktur Folder
- `assets/` CSS/JS/gambar statis
- `uploads/` upload foto/video
- `admin/` panel admin
- `api/` endpoint AJAX/JSON
- `config/` konfigurasi app + DB + helper
- `templates/` komponen halaman
- `themes/` kumpulan tema
- `database/` SQL schema + dummy data
- `pwa/` manifest + icon

## Instalasi (Hosting/cPanel/aapanel)
1. Upload semua source ke `public_html` (atau document root).
2. Buat database MySQL baru.
3. Import `database/schema.sql` lalu `database/dummy_data.sql`.
4. Edit `config/config.php` dan `config/database.php`.
5. Pastikan folder `uploads/` writable (`755/775`).
6. Akses domain, login admin di `/admin/login.php`.

### Default Admin (dummy)
- Email: `admin@demo.com`
- Password: `password123`

## Catatan
- Untuk realtime ucapan, frontend melakukan polling tiap 8 detik ke endpoint wishes.
- Untuk anti-spam RSVP, rate-limit berbasis session+IP diterapkan pada endpoint API.
