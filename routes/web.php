<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\InvitationController;
use App\Controllers\UserController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'register']);
$router->get('/dashboard', [UserController::class, 'dashboard']);
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/undangan/{slug}', [InvitationController::class, 'show']);
