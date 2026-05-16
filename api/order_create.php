<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed');}
$name=trim($_POST['buyer_name']??'');$email=trim($_POST['buyer_email']??'');$packageId=(int)($_POST['package_id']??0);
if($name===''||!filter_var($email,FILTER_VALIDATE_EMAIL)||$packageId<1){exit('Input tidak valid');}
$sp=$pdo->prepare('SELECT * FROM packages WHERE id=?');$sp->execute([$packageId]);$pkg=$sp->fetch(PDO::FETCH_ASSOC); if(!$pkg){exit('Paket tidak ditemukan');}
$st=$pdo->prepare('INSERT INTO orders (buyer_name,buyer_email,package_id,amount,status,created_at) VALUES (?,?,?,?,"pending",NOW())');
$st->execute([$name,$email,$packageId,$pkg['price']]);
$id=(int)$pdo->lastInsertId(); header('Location: /buyer?order_id='.$id); exit;
