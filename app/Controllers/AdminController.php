<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class AdminController extends Controller
{
    public function dashboard(): void { $this->view('admin/dashboard', ['title' => 'Dashboard Admin']); }
}
