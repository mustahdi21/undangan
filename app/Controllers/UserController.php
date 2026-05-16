<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class UserController extends Controller
{
    public function dashboard(): void { $this->view('user/dashboard', ['title' => 'Dashboard User']); }
}
