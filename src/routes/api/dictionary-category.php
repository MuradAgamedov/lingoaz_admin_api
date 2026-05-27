<?php

use App\Http\Controllers\Api\DictionaryCategoryController;
use App\Http\Controllers\Api\DictionaryImportController;
use Illuminate\Support\Facades\Route;

Route::get('dictionary-categories', [DictionaryCategoryController::class, 'index']);
Route::get('dictionary-categories/{id}/words', [DictionaryCategoryController::class, 'words']);

Route::get('dictionary-categories/{categoryId}/words/{wordId}/group', [DictionaryImportController::class, 'wordGroup']);
Route::delete('dictionary-categories/{categoryId}/import-word/{wordId}', [DictionaryImportController::class, 'removeWord']);
Route::post('dictionary-categories/{categoryId}/import-word/{wordId}', [DictionaryImportController::class, 'importWord']);
Route::post('dictionary-categories/{categoryId}/import-all', [DictionaryImportController::class, 'importAll']);
