<?php

use App\Http\Controllers\Api\UserDictionaryCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('user-dictionary-categories', [UserDictionaryCategoryController::class, 'index']);
Route::post('user-dictionary-categories', [UserDictionaryCategoryController::class, 'store']);
Route::put('user-dictionary-categories/{id}', [UserDictionaryCategoryController::class, 'update']);
Route::delete('user-dictionary-categories/{id}', [UserDictionaryCategoryController::class, 'destroy']);
