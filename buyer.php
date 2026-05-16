<?php
require __DIR__ . '/config/helpers.php';
require __DIR__ . '/config/database.php';
$packages=$pdo->query('SELECT * FROM packages ORDER BY price')->fetchAll(PDO::FETCH_ASSOC);
$order=null;$themes=[];$canChoose=false;
if(!empty($_GET['order_id'])){
  $st=$pdo->prepare('SELECT o.*,p.duration_days,p.name as package_name FROM orders o JOIN packages p ON p.id=o.package_id WHERE o.id=?');
  $st->execute([(int)$_GET['order_id']]);$order=$st->fetch(PDO::FETCH_ASSOC);
  if($order){
    $themes=$pdo->query('SELECT id,name,slug FROM themes ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
    $canChoose=$order['status']==='paid' && strtotime((string)$order['active_until'])>time();
  }
}
?><!doctype html><html><head><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1'><script src='https://cdn.tailwindcss.com'></script></head>
<body class='bg-zinc-950 text-white p-6'><div class='max-w-5xl mx-auto space-y-8'>
<h1 class='text-3xl font-bold'>Buyer Area - Pilih Tema (setelah bayar)</h1>
<section class='bg-zinc-900 rounded-2xl p-5'><h2 class='text-xl font-semibold mb-3'>1) Pilih Paket & Checkout</h2>
<form method='post' action='/api/order-create' class='grid md:grid-cols-2 gap-3'>
<input name='buyer_name' required placeholder='Nama buyer' class='p-3 rounded bg-zinc-800'>
<input name='buyer_email' type='email' required placeholder='Email buyer' class='p-3 rounded bg-zinc-800'>
<select name='package_id' class='p-3 rounded bg-zinc-800'><?php foreach($packages as $p): ?><option value='<?= (int)$p['id']?>'><?= e($p['name'])?> - Rp<?= number_format((int)$p['price'],0,',','.')?></option><?php endforeach;?></select>
<button class='bg-amber-400 text-black rounded px-4 py-3 font-semibold'>Buat Order</button>
</form></section>
<section class='bg-zinc-900 rounded-2xl p-5'><h2 class='text-xl font-semibold mb-3'>2) Verifikasi Pembayaran & Masa Aktif</h2>
<form method='get' class='flex gap-2'><input name='order_id' placeholder='Masukkan Order ID' class='p-3 rounded bg-zinc-800'><button class='bg-emerald-400 text-black rounded px-4'>Cek</button></form>
<?php if($order): ?><div class='mt-4 text-sm space-y-1'><p>Order: #<?= (int)$order['id'] ?> | Paket: <?= e($order['package_name'])?></p><p>Status: <b><?= e($order['status'])?></b></p><p>Masa aktif sampai: <b><?= e((string)$order['active_until'])?></b></p></div>
<?php if(!$canChoose): ?><form method='post' action='/api/order-mark-paid' class='mt-3'><input type='hidden' name='order_id' value='<?= (int)$order['id']?>'><button class='bg-blue-400 text-black rounded px-4 py-2'>Simulasi: Sudah Bayar</button></form><?php endif; ?>
<?php endif; ?></section>
<?php if($order): ?><section class='bg-zinc-900 rounded-2xl p-5'><h2 class='text-xl font-semibold mb-3'>3) Pilih Tema Undangan</h2>
<?php if($canChoose): ?><form method='post' action='/api/select-theme' class='grid gap-3'><input type='hidden' name='order_id' value='<?= (int)$order['id']?>'><select name='theme_id' class='p-3 rounded bg-zinc-800'><?php foreach($themes as $t):?><option value='<?= (int)$t['id']?>'><?= e($t['name'])?></option><?php endforeach;?></select><input name='title' placeholder='Judul undangan' class='p-3 rounded bg-zinc-800'><input name='slug' placeholder='slug-undangan-kamu' class='p-3 rounded bg-zinc-800'><button class='bg-fuchsia-400 text-black rounded px-4 py-3 font-semibold'>Simpan Tema</button></form>
<?php else: ?><p class='text-amber-300'>Tema hanya bisa dipilih setelah pembayaran tervalidasi dan masa aktif masih berlaku.</p><?php endif; ?></section><?php endif; ?>
</div></body></html>
