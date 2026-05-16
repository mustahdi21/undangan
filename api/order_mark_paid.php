<?php
require __DIR__ . '/../config/database.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed');}
$orderId=(int)($_POST['order_id']??0); if($orderId<1) exit('Order invalid');
$st=$pdo->prepare('SELECT o.id,p.duration_days FROM orders o JOIN packages p ON p.id=o.package_id WHERE o.id=?');$st->execute([$orderId]);$o=$st->fetch(PDO::FETCH_ASSOC); if(!$o) exit('Order not found');
$activeUntil=date('Y-m-d H:i:s', strtotime('+'.(int)$o['duration_days'].' days'));
$u=$pdo->prepare('UPDATE orders SET status="paid", paid_at=NOW(), active_until=? WHERE id=?');$u->execute([$activeUntil,$orderId]);
header('Location: /buyer?order_id='.$orderId); exit;
