<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('home');
    include __DIR__ . '/web/dictionary.php';
});

include __DIR__ . '/web/auth.php';
