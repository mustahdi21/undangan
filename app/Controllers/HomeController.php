<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('landing/index', [
            'title' => 'LuxInvite - Undangan Digital Premium',
        ]);
    }
}
