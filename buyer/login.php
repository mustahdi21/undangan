<?php
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/../config/database.php';
if (!empty($_SESSION['buyer_id'])) { header('Location: /buyer/dashboard'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $st = $pdo->prepare('SELECT * FROM buyers WHERE email=? LIMIT 1');
  $st->execute([$email]);
  $u = $st->fetch(PDO::FETCH_ASSOC);
  if ($u && password_verify($password, $u['password'])) { $_SESSION['buyer_id'] = $u['id']; header('Location: /buyer/dashboard'); exit; }
  $err = 'Login buyer gagal';
}
?><!doctype html><html><head><script src="https://cdn.tailwindcss.com"></script></head><body class="min-h-screen grid place-items-center bg-zinc-950 text-white"><form method="post" class="bg-zinc-900 p-6 rounded-xl w-80 grid gap-3"><h1 class="text-xl font-bold">Login Buyer</h1><?php if(!empty($err)) echo '<p class="text-red-400">'.$err.'</p>';?><input class="p-2 rounded text-black" name="email" placeholder="Email"><input class="p-2 rounded text-black" type="password" name="password" placeholder="Password"><button class="bg-amber-400 text-black p-2 rounded">Login</button><a href="/buyer/register" class="text-sm underline">Belum punya akun? Daftar</a></form></body></html>
