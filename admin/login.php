<?php
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/../config/database.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $email=$_POST['email']??''; $password=$_POST['password']??'';
    $st=$pdo->prepare('SELECT * FROM users WHERE email=? LIMIT 1'); $st->execute([$email]); $u=$st->fetch(PDO::FETCH_ASSOC);
    if($u && password_verify($password,$u['password'])){$_SESSION['admin_id']=$u['id']; header('Location: /admin/dashboard'); exit;}
    $err='Login gagal';
}
?><!doctype html><html><head><script src="https://cdn.tailwindcss.com"></script></head><body class="grid place-items-center min-h-screen bg-zinc-900 text-white"><form method="post" class="bg-zinc-800 p-6 rounded-xl grid gap-3 w-80"><h1 class="text-xl">Admin Login</h1><?php if(!empty($err)) echo '<p class="text-red-400">'.$err.'</p>';?><input class="p-2 rounded text-black" name="email" placeholder="Email"><input class="p-2 rounded text-black" name="password" type="password" placeholder="Password"><button class="bg-amber-400 text-black rounded p-2">Login</button></form></body></html>
