<?php
require __DIR__ . '/../config/database.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed');}
$orderId=(int)($_POST['order_id']??0);$themeId=(int)($_POST['theme_id']??0);$title=trim($_POST['title']??'');$slug=preg_replace('/[^a-z0-9\-]/','-',strtolower(trim($_POST['slug']??'')));
if($orderId<1||$themeId<1||$title===''||$slug===''){exit('Input tidak valid');}
$so=$pdo->prepare('SELECT * FROM orders WHERE id=?');$so->execute([$orderId]);$o=$so->fetch(PDO::FETCH_ASSOC);
if(!$o) exit('Order tidak ditemukan');
if($o['status']!=='paid' || strtotime((string)$o['active_until'])<=time()) exit('Belum bisa pilih tema. Pembayaran/masa aktif tidak valid.');
$ck=$pdo->prepare('SELECT id FROM buyer_invitations WHERE order_id=?');$ck->execute([$orderId]);$exist=$ck->fetchColumn();
if($exist){$up=$pdo->prepare('UPDATE buyer_invitations SET theme_id=?,title=?,slug=? WHERE order_id=?');$up->execute([$themeId,$title,$slug,$orderId]);}
else{$in=$pdo->prepare('INSERT INTO buyer_invitations (order_id,theme_id,title,slug,is_published,created_at) VALUES (?,?,?,?,0,NOW())');$in->execute([$orderId,$themeId,$title,$slug]);}
header('Location: /buyer?order_id='.$orderId); exit;
