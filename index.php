<?php
$app = require __DIR__ . '/config/config.php';
require __DIR__ . '/config/helpers.php';
require __DIR__ . '/config/database.php';
$themes = $pdo->query('SELECT id,name,slug FROM themes ORDER BY id LIMIT 8')->fetchAll(PDO::FETCH_ASSOC);
$packages = $pdo->query('SELECT id,name,price,duration_days FROM packages ORDER BY price')->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>UndanganPro - Platform Undangan Digital Premium</title>
<meta name="description" content="Bangun undangan digital premium dengan alur buyer lengkap: register, payment, pilih tema, kelola data mempelai, dan panel admin global.">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="text-white">
<header class="sticky top-0 z-50 backdrop-blur-xl bg-slate-950/55 border-b border-white/10">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <div class="font-bold tracking-wide text-lg">Undangan<span class="text-amber-300">Pro</span></div>
    <nav class="hidden md:flex gap-6 text-sm text-slate-300">
      <a href="#fitur">Fitur</a><a href="#preview">Preview</a><a href="#tema">Tema</a><a href="#harga">Harga</a><a href="#faq">FAQ</a>
    </nav>
    <div class="flex gap-2"><a href="/buyer/login" class="px-4 py-2 rounded-lg border border-white/20 text-sm">Login</a><a href="/buyer/register" class="px-4 py-2 rounded-lg bg-amber-400 text-black text-sm font-semibold">Mulai</a></div>
  </div>
</header>
<section class="hero-grid max-w-7xl mx-auto px-4 py-20 grid lg:grid-cols-2 gap-10 items-center">
  <div>
    <span class="badge">#1 Premium Invitation Platform</span>
    <p class="kicker mt-5">Wedding Website Builder</p>
    <h1 class="text-4xl md:text-6xl font-bold leading-tight mt-2">Bangun Undangan Digital <span class="gradient-text">Semewah Desain Agency</span></h1>
    <p class="text-slate-300 mt-5">Dari registrasi buyer, payment masa aktif, pilih tema, hingga kelola detail acara—semua dalam dashboard profesional.</p>
    <div class="mt-7 flex flex-wrap gap-3"><a href="/buyer/register" class="px-6 py-3 rounded-xl bg-amber-400 text-black font-semibold">Daftar Gratis</a><a href="#preview" class="px-6 py-3 rounded-xl border border-white/20">Lihat Demo</a><a href="/admin/login" class="px-6 py-3 rounded-xl border border-fuchsia-300/40 text-fuchsia-200">Admin Control</a></div>
    <div class="mt-6 text-sm text-slate-400">✨ Cepat • Mobile First • URL personal tamu • SEO friendly</div>
  </div>
  <div class="glass rounded-3xl p-6">
    <h3 class="text-xl font-semibold">Funnel Buyer yang Jelas</h3>
    <ol class="mt-4 space-y-2 text-slate-200 text-sm list-decimal list-inside"><li>Daftar/Login buyer</li><li>Pilih paket durasi aktif</li><li>Payment tervalidasi</li><li>Pilih tema premium</li><li>Isi data mempelai, acara, story</li><li>Publish dan bagikan link tamu</li></ol>
  </div>
</section>
<section id="fitur" class="max-w-7xl mx-auto px-4 py-10">
  <h2 class="text-3xl font-bold">Fitur Tahap 2 (UI Product-Grade)</h2>
  <div class="grid md:grid-cols-3 gap-4 mt-6">
    <div class="card">Landing konversi + CTA buyer/admin</div><div class="card">Buyer panel: pembayaran, tema, data mempelai</div><div class="card">Admin monitor order & buyer global</div><div class="card">Tema premium multi-style</div><div class="card">RSVP dan wishes realtime</div><div class="card">Siap dikembangkan ke payment gateway</div>
  </div>
</section>
<section id="preview" class="max-w-7xl mx-auto px-4 py-10 grid lg:grid-cols-3 gap-4">
  <div class="glass rounded-2xl p-5 lg:col-span-2"><h3 class="text-xl font-semibold">Preview Experience</h3><p class="text-slate-300 mt-2">Tampilan modern dark-luxury dengan aksen gold, card glassmorphism, dan struktur informasi yang mudah dipahami buyer.</p><div class="mt-4 grid md:grid-cols-3 gap-3 text-sm"><div class="card">Hero + value proposition</div><div class="card">Pricing & package duration</div><div class="card">Flow dan FAQ</div></div></div>
  <div class="card"><h4 class="font-semibold">Statistik Platform</h4><p class="text-slate-300 text-sm mt-2">Realtime mengikuti data paket dan tema dari database, sehingga landing selalu sinkron dengan sistem buyer panel.</p></div>
</section>
<section id="tema" class="max-w-7xl mx-auto px-4 py-10">
  <h2 class="text-3xl font-bold">Pilihan Tema Premium</h2>
  <div class="grid md:grid-cols-4 gap-4 mt-6"><?php foreach($themes as $t): ?><div class="glass p-4 rounded-2xl"><p class="font-semibold"><?= e($t['name']) ?></p><p class="text-xs text-slate-300 mt-1"><?= e($t['slug']) ?></p></div><?php endforeach; ?></div>
</section>
<section id="harga" class="max-w-7xl mx-auto px-4 py-10">
  <h2 class="text-3xl font-bold">Paket & Masa Aktif</h2>
  <div class="grid md:grid-cols-3 gap-4 mt-6"><?php foreach($packages as $p): ?><div class="glass p-6 rounded-2xl"><p class="font-semibold"><?= e($p['name']) ?></p><p class="text-3xl font-bold mt-2">Rp<?= number_format((int)$p['price'],0,',','.') ?></p><p class="text-sm text-slate-300 mt-1">Aktif <?= (int)$p['duration_days'] ?> hari</p><a href="/buyer/register" class="inline-block mt-4 px-4 py-2 bg-amber-400 text-black rounded-lg font-semibold">Pilih Paket</a></div><?php endforeach; ?></div>
</section>
<section id="faq" class="max-w-7xl mx-auto px-4 py-10 mb-10">
  <h2 class="text-3xl font-bold">FAQ</h2>
  <div class="grid md:grid-cols-2 gap-4 mt-6 text-sm"><div class="card"><b>Apakah harus bayar dulu sebelum pilih tema?</b><p class="text-slate-300 mt-2">Ya. Sistem mengunci pemilihan tema sampai order berstatus paid dan masa aktif masih berlaku.</p></div><div class="card"><b>Apakah buyer bisa edit data mempelai sendiri?</b><p class="text-slate-300 mt-2">Bisa, melalui Buyer Dashboard tanpa harus akses admin.</p></div></div>
</section>
<footer class="border-t border-white/10 py-8 text-center text-slate-400 text-sm">© <?= date('Y') ?> UndanganPro — Crafted for premium invitation businesses.</footer>
</body></html>
