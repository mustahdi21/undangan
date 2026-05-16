<?php
require __DIR__ . '/../config/database.php';
header('Content-Type: application/json');
$data = $pdo->query('SELECT guest_name,message,DATE_FORMAT(created_at, "%d-%m-%Y %H:%i") as created_at FROM wishes ORDER BY id DESC LIMIT 20')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
