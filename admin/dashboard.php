<?php
require __DIR__ . '/../config/helpers.php'; require __DIR__ . '/../config/database.php';
if(empty($_SESSION['admin_id'])){header('Location: /admin/login'); exit;}
$stats=[
'visitors'=>(int)$pdo->query('SELECT COUNT(*) FROM visitor_logs')->fetchColumn(),
'rsvp'=>(int)$pdo->query('SELECT COUNT(*) FROM rsvp')->fetchColumn(),
'wishes'=>(int)$pdo->query('SELECT COUNT(*) FROM wishes')->fetchColumn(),
'buyers'=>(int)$pdo->query('SELECT COUNT(*) FROM buyers')->fetchColumn(),
'orders'=>(int)$pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn(),
'paid_orders'=>(int)$pdo->query("SELECT COUNT(*) FROM orders WHERE status='paid'")->fetchColumn()
];
$recentOrders=$pdo->query('SELECT id,buyer_name,buyer_email,amount,status,active_until FROM orders ORDER BY id DESC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html><html><head><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-zinc-950 text-white p-6"><h1 class="text-3xl">Dashboard Admin</h1><div class="grid md:grid-cols-4 gap-4 mt-4"><?php foreach($stats as $k=>$v)echo "<div class='bg-zinc-800 p-4 rounded-xl'><p>$k</p><b class='text-3xl'>$v</b></div>";?></div><section class="mt-6 bg-zinc-900 p-4 rounded-xl"><h2 class="text-xl font-semibold mb-3">Kontrol Buyer & Order</h2><div class="overflow-auto"><table class="w-full text-sm"><thead><tr class="text-left"><th>ID</th><th>Buyer</th><th>Email</th><th>Amount</th><th>Status</th><th>Active Until</th></tr></thead><tbody><?php foreach($recentOrders as $o): ?><tr class="border-t border-zinc-700"><td><?= (int)$o['id'] ?></td><td><?= e($o['buyer_name']) ?></td><td><?= e($o['buyer_email']) ?></td><td>Rp<?= number_format((int)$o['amount'],0,',','.') ?></td><td><?= e($o['status']) ?></td><td><?= e((string)$o['active_until']) ?></td></tr><?php endforeach; ?></tbody></table></div></section></body></html>
