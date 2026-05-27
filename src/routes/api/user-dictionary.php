<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserDictionaryController;

Route::delete('user-dictionaries/bulk', [UserDictionaryController::class, 'destroyMultiple']);
Route::apiResource('user-dictionaries', UserDictionaryController::class);
Route::post('user-dictionaries/{id}/audio', [UserDictionaryController::class, 'addAudio']);
Route::delete('user-dictionaries/{id}/audio/{index}', [UserDictionaryController::class, 'removeAudio']);
