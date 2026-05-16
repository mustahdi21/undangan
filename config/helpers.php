<?php
session_start();

function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function verify_csrf(?string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string) $token);
}
function rate_limit(string $key, int $limit = 5, int $seconds = 60): bool {
    $now = time();
    $_SESSION['rl'][$key] = $_SESSION['rl'][$key] ?? [];
    $_SESSION['rl'][$key] = array_filter($_SESSION['rl'][$key], fn($ts) => $ts > $now - $seconds);
    if (count($_SESSION['rl'][$key]) >= $limit) return false;
    $_SESSION['rl'][$key][] = $now;
    return true;
}
function guest_name_from_url(): string {
    $to = $_GET['to'] ?? 'Tamu Undangan';
    $to = preg_replace('/[^\p{L}\p{N}\s\-\.]/u', '', urldecode($to));
    return trim($to) ?: 'Tamu Undangan';
}
