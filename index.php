<?php
$app = require __DIR__ . '/config/config.php';
require __DIR__ . '/config/helpers.php';
require __DIR__ . '/config/database.php';

date_default_timezone_set($app['timezone']);
$guestName = guest_name_from_url();
$themes = $pdo->query('SELECT id,name,slug,primary_color,secondary_color FROM themes ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
$wishes = $pdo->query('SELECT guest_name,message,created_at FROM wishes ORDER BY id DESC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html lang="id" class="scroll-smooth"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($app['seo']['title']) ?></title>
<meta name="description" content="<?= e($app['seo']['description']) ?>">
<meta name="keywords" content="<?= e($app['seo']['keywords']) ?>">
<meta property="og:title" content="<?= e($app['seo']['title']) ?>"><meta property="og:description" content="<?= e($app['seo']['description']) ?>">
<meta property="og:image" content="<?= e($app['base_url'].'/'.$app['seo']['og_image']) ?>">
<link rel="manifest" href="/pwa/manifest.json"><link rel="stylesheet" href="assets/css/style.css">
<script src="https://cdn.tailwindcss.com"></script><script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head><body class="bg-zinc-950 text-white">
<div id="loader" class="fixed inset-0 z-50 grid place-items-center bg-black">Loading...</div>
<header class="relative h-screen overflow-hidden">
<video autoplay muted loop playsinline class="absolute inset-0 h-full w-full object-cover opacity-40"><source src="uploads/hero.mp4" type="video/mp4"></video>
<div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/90"></div>
<div class="relative z-10 flex h-full flex-col items-center justify-center text-center px-4" data-aos="zoom-in">
<p class="tracking-[0.3em] text-xs">THE WEDDING OF</p><h1 class="text-5xl md:text-7xl font-semibold mt-3">Andi & Salsa</h1>
<p class="mt-4">Kepada Yth. <span class="font-bold text-amber-300"><?= e($guestName) ?></span></p>
<div id="countdown" class="mt-8 grid grid-cols-4 gap-3"></div>
<a href="#undangan" class="mt-8 rounded-full bg-amber-400 px-8 py-3 text-black font-semibold">Buka Undangan</a>
<button id="musicToggle" class="mt-4 text-sm underline">Pause Music</button></div>
</header>
<main id="undangan" class="max-w-6xl mx-auto p-4 space-y-14">
<section data-aos="fade-up"><h2 class="text-3xl font-semibold">Pilihan Tema</h2><div class="grid md:grid-cols-3 gap-4 mt-4"><?php foreach($themes as $t): ?><article class="glass p-4 rounded-2xl"><h3><?= e($t['name']) ?></h3><p class="text-xs text-zinc-300"><?= e($t['slug']) ?></p></article><?php endforeach; ?></div></section>
<section data-aos="fade-up"><h2 class="text-3xl font-semibold">Acara</h2><div class="grid md:grid-cols-3 gap-4 mt-4"><div class="card">Akad Nikah<br>20 Des 2026 08:00</div><div class="card">Resepsi<br>20 Des 2026 11:00</div><div class="card">Ngunduh Mantu<br>27 Des 2026 10:00</div></div></section>
<section data-aos="fade-up"><h2 class="text-3xl font-semibold">RSVP</h2><form id="rsvpForm" class="grid gap-3 mt-4"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input name="guest_name" class="input" placeholder="Nama"><select name="attendance" class="input"><option>Hadir</option><option>Tidak Hadir</option></select><input name="guest_count" type="number" class="input" min="1" max="10" value="1"><textarea name="message" class="input" placeholder="Ucapan & doa"></textarea><button class="rounded-xl bg-emerald-400 px-5 py-3 text-black font-semibold">Kirim RSVP</button></form><div id="rsvpResult"></div></section>
<section data-aos="fade-up"><h2 class="text-3xl font-semibold">Ucapan Tamu</h2><div id="wishes" class="space-y-3 mt-4"><?php foreach($wishes as $w): ?><div class="glass p-3 rounded-xl"><b><?= e($w['guest_name']) ?></b><p><?= e($w['message']) ?></p></div><?php endforeach; ?></div></section>
<section data-aos="fade-up"><h2 class="text-3xl font-semibold">Amplop Digital</h2><div class="grid md:grid-cols-2 gap-4 mt-4"><div class="card">BCA 1234567890 <button data-copy="1234567890" class="copy-btn">Copy</button></div><div class="card">QRIS <a href="uploads/qris.png" download>Download</a></div></div></section>
</main>
<audio id="bgMusic" autoplay loop><source src="uploads/music.mp3" type="audio/mp3"></audio>
<script>window.APP={eventDate:'<?= e($app['event_date']) ?>',baseUrl:'<?= e($app['base_url']) ?>'};</script>
<script src="assets/js/main.js"></script>
<script type="application/ld+json">{"@context":"https://schema.org","@type":"WeddingEvent","name":"Andi & Salsa Wedding","startDate":"2026-12-20T08:00:00+07:00","location":{"@type":"Place","name":"Gedung Bahagia"}}</script>
</body></html>
