<section class="min-h-screen p-6 md:p-10 bg-gradient-to-br from-fuchsia-950 via-slate-950 to-indigo-950">
  <div class="max-w-6xl mx-auto">
    <nav class="flex justify-between items-center mb-10"><h1 class="text-2xl font-bold">LuxInvite</h1><a href="/register" class="px-4 py-2 rounded-xl glass">Coba Gratis</a></nav>
    <div class="glass rounded-3xl p-8 md:p-16">
      <h2 class="text-4xl md:text-6xl font-black leading-tight">Undangan Digital <span class="text-fuchsia-300">Premium</span> untuk Momen Spesial</h2>
      <p class="mt-4 text-slate-200">Mobile-first, cepat, SEO friendly, dan buyer flow SaaS lengkap dengan paywall subscription.</p>
      <div class="mt-6 flex flex-wrap gap-3"><a href="/register" class="btn">Buat Undangan</a><a href="#tema" class="btn-outline">Preview Tema</a><a href="/dashboard" class="btn-outline">Coba Gratis</a></div>
    </div>
    <div class="grid md:grid-cols-4 gap-4 mt-8" id="stats"></div>
    <section id="tema" class="mt-12"><h3 class="text-3xl font-bold mb-4">Preview Tema</h3><div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4"><?php for($i=1;$i<=6;$i++): ?><article class="glass p-4 rounded-2xl"><div class="h-32 rounded-xl bg-gradient-to-r from-indigo-700 to-fuchsia-700"></div><h4 class="mt-3 font-semibold">Tema Premium <?= $i ?></h4><div class="mt-3 flex gap-2"><button class="btn-sm">Preview</button><button class="btn-sm-dark">Gunakan</button></div></article><?php endfor; ?></div></section>
    <section class="mt-12"><h3 class="text-3xl font-bold mb-4">Paket Berlangganan</h3><div class="grid md:grid-cols-4 gap-4"><?php foreach(['Free','Basic','Premium','Ultimate'] as $plan): ?><div class="glass p-5 rounded-2xl"><h4 class="text-xl font-bold"><?= $plan ?></h4><p class="text-slate-200"><?= $plan==='Free'?'Preview only':'Mulai Rp 49.000' ?></p><p class="text-sm text-slate-300 mt-2">Paywall aktif: wajib bayar sebelum publish & builder penuh.</p></div><?php endforeach; ?></div></section>
  </div>
</section>
