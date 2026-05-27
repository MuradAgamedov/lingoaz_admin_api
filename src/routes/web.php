<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    include __DIR__ . '/web/dictionary.php';
});

include __DIR__ . '/web/auth.php';
