<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class InvitationController extends Controller
{
    public function show(string $slug): void
    {
        $guest = $_GET['kpd'] ?? 'Tamu Undangan';
        $this->view('invitation/show', [
            'title' => 'Undangan ' . $slug,
            'slug' => $slug,
            'guest' => htmlspecialchars($guest, ENT_QUOTES, 'UTF-8'),
        ], 'layouts/invitation');
    }
}
