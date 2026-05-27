<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


include __DIR__ . '/api/auth.php';


Route::get('/word-of-day', [\App\Http\Controllers\Api\WordOfDayController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    include __DIR__ . '/api/dictionary-category.php';
    include __DIR__ . '/api/sentence-dictionary-group.php';
    include __DIR__ . '/api/note-group.php';
    include __DIR__ . '/api/user-dictionary-group.php';
    include __DIR__ . '/api/user-dictionary.php';
    include __DIR__ . '/api/user-dictionary-meaning.php';
    include __DIR__ . '/api/user-dictionary-definition.php';
    include __DIR__ . '/api/user-dictionary-category.php';
});
