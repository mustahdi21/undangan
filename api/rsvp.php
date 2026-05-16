<?php
require __DIR__ . '/../config/helpers.php';
require __DIR__ . '/../config/database.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['message'=>'Method not allowed']); exit; }
if (!verify_csrf($_POST['csrf_token'] ?? null)) { http_response_code(419); echo json_encode(['message'=>'CSRF tidak valid']); exit; }
if (!rate_limit('rsvp_'.($_SERVER['REMOTE_ADDR']??'guest'), 5, 60)) { http_response_code(429); echo json_encode(['message'=>'Terlalu sering, coba lagi nanti']); exit; }
$name = trim($_POST['guest_name'] ?? ''); $attendance = trim($_POST['attendance'] ?? 'Hadir'); $count=(int)($_POST['guest_count']??1); $msg=trim($_POST['message'] ?? '');
if ($name === '' || $msg === '') { http_response_code(422); echo json_encode(['message'=>'Nama dan ucapan wajib diisi']); exit; }
$stmt = $pdo->prepare('INSERT INTO rsvp (guest_name,attendance,guest_count,message,created_at) VALUES (?,?,?,?,NOW())');
$stmt->execute([$name,$attendance,max(0,min(10,$count)),$msg]);
$pdo->prepare('INSERT INTO wishes (guest_name,message,created_at) VALUES (?,?,NOW())')->execute([$name,$msg]);
echo json_encode(['message'=>'RSVP berhasil disimpan']);
