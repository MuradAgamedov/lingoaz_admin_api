<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserDictionaryMeaningController;

Route::get('user-dictionary-meanings', [UserDictionaryMeaningController::class, 'index']);
Route::post('user-dictionary-meanings', [UserDictionaryMeaningController::class, 'store']);
Route::put('user-dictionary-meanings/{id}', [UserDictionaryMeaningController::class, 'update']);
Route::delete('user-dictionary-meanings/{id}', [UserDictionaryMeaningController::class, 'destroy']);
