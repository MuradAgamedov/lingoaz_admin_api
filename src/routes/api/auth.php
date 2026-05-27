<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify_otp', [AuthController::class, 'verify_otp']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/resend_otp', [AuthController::class, 'resend_otp']);
Route::post('/forgot_password', [AuthController::class, 'forgotPassword']);
Route::post('/reset_password', [AuthController::class, 'resetPassword']);
Route::post('/logout', [AuthController::class, 'logout']);
