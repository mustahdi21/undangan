<?php
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/../config/database.php';
if (empty($_SESSION['buyer_id'])) { http_response_code(401); exit('Unauthorized'); }
if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Method not allowed');}
$buyerId=(int)$_SESSION['buyer_id'];
$title=trim($_POST['invitation_title']??''); $groom=trim($_POST['groom_name']??''); $bride=trim($_POST['bride_name']??'');
$eventDate=trim($_POST['event_date']??''); $loc=trim($_POST['event_location']??''); $story=trim($_POST['story']??'');
$ck=$pdo->prepare('SELECT id FROM buyer_profiles WHERE buyer_id=?'); $ck->execute([$buyerId]);
if($ck->fetchColumn()){
  $st=$pdo->prepare('UPDATE buyer_profiles SET invitation_title=?,groom_name=?,bride_name=?,event_date=?,event_location=?,story=? WHERE buyer_id=?');
  $st->execute([$title,$groom,$bride,$eventDate?:null,$loc,$story,$buyerId]);
}else{
  $st=$pdo->prepare('INSERT INTO buyer_profiles (buyer_id,invitation_title,groom_name,bride_name,event_date,event_location,story) VALUES (?,?,?,?,?,?,?)');
  $st->execute([$buyerId,$title,$groom,$bride,$eventDate?:null,$loc,$story]);
}
header('Location: /buyer/dashboard');
