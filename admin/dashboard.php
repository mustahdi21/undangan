<?php
require __DIR__ . '/../config/helpers.php'; require __DIR__ . '/../config/database.php';
if(empty($_SESSION['admin_id'])){header('Location: /admin/login.php'); exit;}
$stats=[
'visitors'=>(int)$pdo->query('SELECT COUNT(*) FROM visitor_logs')->fetchColumn(),
'rsvp'=>(int)$pdo->query('SELECT COUNT(*) FROM rsvp')->fetchColumn(),
'wishes'=>(int)$pdo->query('SELECT COUNT(*) FROM wishes')->fetchColumn()
];
?><!doctype html><html><head><script src="https://cdn.tailwindcss.com"></script></head><body class="bg-zinc-950 text-white p-6"><h1 class="text-3xl">Dashboard Admin</h1><div class="grid md:grid-cols-3 gap-4 mt-4"><?php foreach($stats as $k=>$v)echo "<div class='bg-zinc-800 p-4 rounded-xl'><p>$k</p><b class='text-3xl'>$v</b></div>";?></div><p class="mt-6 text-zinc-400">CRUD undangan/tema/tamu dapat diperluas dari fondasi ini.</p></body></html>
