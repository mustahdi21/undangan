<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class AuthController extends Controller
{
    public function login(): void { $this->view('auth/login', ['title' => 'Login']); }
    public function register(): void { $this->view('auth/register', ['title' => 'Register']); }
}
