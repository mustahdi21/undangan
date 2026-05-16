# LuxInvite - Premium Digital Invitation SaaS (Native PHP)

## Fitur Utama
- Landing page premium (hero, statistik, kategori, tema, pricing, testimoni/FAQ-ready).
- User dashboard + admin dashboard modular.
- Dynamic invitation URL: `/undangan/{slug}?kpd=Nama+Tamu`.
- Paywall subscription: user wajib berlangganan sebelum publish/builder penuh.
- SEO basics: meta OG, robots, sitemap.
- Struktur scalable (Core, Controllers, Views, config, routes, database).

## Menjalankan
1. Import `database/schema.sql`.
2. Jalankan server: `php -S localhost:8000 -t public`.
3. Buka `http://localhost:8000`.

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
