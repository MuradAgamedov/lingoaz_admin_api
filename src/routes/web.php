<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('home');

    // User management routes
    Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users/{id}/toggle-admin', [\App\Http\Controllers\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // Newsletter subscribers
    Route::get('/admin/subscribers', [\App\Http\Controllers\NewsletterController::class, 'index'])->name('subscribers.index');
    Route::delete('/admin/subscribers/{id}', [\App\Http\Controllers\NewsletterController::class, 'destroy'])->name('subscribers.destroy');

    // APK releases
    Route::get('/admin/apk',             [\App\Http\Controllers\ApkReleaseController::class, 'index'])->name('apk.index');
    Route::post('/admin/apk',            [\App\Http\Controllers\ApkReleaseController::class, 'store'])->name('apk.store');
    Route::post('/admin/apk/{id}/activate', [\App\Http\Controllers\ApkReleaseController::class, 'activate'])->name('apk.activate');
    Route::delete('/admin/apk/{id}',     [\App\Http\Controllers\ApkReleaseController::class, 'destroy'])->name('apk.destroy');

    include __DIR__ . '/web/dictionary.php';
});


Route::get("/test-job", function(){
    App\Jobs\SendMessage::dispatch("test");
    return "Job göndərildi!";
});
include __DIR__ . '/web/auth.php';
