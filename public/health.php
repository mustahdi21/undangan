<?php

declare(strict_types=1);

http_response_code(200);
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'status' => 'ok',
    'service' => 'luxinvite',
    'php_version' => PHP_VERSION,
    'time_utc' => gmdate('c'),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
