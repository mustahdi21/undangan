<?php
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? ''); $email = trim($_POST['email'] ?? ''); $password = $_POST['password'] ?? '';
  if ($name && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($password)>=8) {
    $st = $pdo->prepare('INSERT INTO buyers(name,email,password,created_at) VALUES (?,?,?,NOW())');
    try { $st->execute([$name,$email,password_hash($password,PASSWORD_BCRYPT)]); header('Location: /buyer/login'); exit; } catch (Throwable $e) { $err='Email sudah digunakan'; }
  } else $err='Input tidak valid (password min 8 karakter)';
}
?><!doctype html><html><head><script src="https://cdn.tailwindcss.com"></script></head><body class="min-h-screen grid place-items-center bg-zinc-950 text-white"><form method="post" class="bg-zinc-900 p-6 rounded-xl w-80 grid gap-3"><h1 class="text-xl font-bold">Daftar Buyer</h1><?php if(!empty($err)) echo '<p class="text-red-400">'.$err.'</p>';?><input class="p-2 rounded text-black" name="name" placeholder="Nama"><input class="p-2 rounded text-black" name="email" placeholder="Email"><input class="p-2 rounded text-black" type="password" name="password" placeholder="Password"><button class="bg-emerald-400 text-black p-2 rounded">Daftar</button></form></body></html>
