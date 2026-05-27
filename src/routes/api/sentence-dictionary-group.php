<?php

use App\Http\Controllers\Api\SentenceDictionaryGroupController;
use App\Http\Controllers\Api\SentenceDictionaryGroupCategoryController;
use App\Http\Controllers\Api\SentenceDictionaryController;
use Illuminate\Support\Facades\Route;

Route::get('sentence-dictionary-groups', [SentenceDictionaryGroupController::class, 'index']);
Route::post('sentence-dictionary-groups', [SentenceDictionaryGroupController::class, 'store']);
Route::get('sentence-dictionary-groups/{id}', [SentenceDictionaryGroupController::class, 'show']);
Route::put('sentence-dictionary-groups/{id}', [SentenceDictionaryGroupController::class, 'update']);
Route::delete('sentence-dictionary-groups/{id}', [SentenceDictionaryGroupController::class, 'destroy']);

// Categories belonging to a group
Route::get('sentence-dictionary-groups/{groupId}/categories', [SentenceDictionaryGroupCategoryController::class, 'index']);
Route::post('sentence-dictionary-groups/{groupId}/categories', [SentenceDictionaryGroupCategoryController::class, 'store']);
Route::put('sentence-dictionary-groups/{groupId}/categories/{id}', [SentenceDictionaryGroupCategoryController::class, 'update']);
Route::delete('sentence-dictionary-groups/{groupId}/categories/{id}', [SentenceDictionaryGroupCategoryController::class, 'destroy']);

// Entries (SentenceDictionary) belonging to a group
Route::get('sentence-dictionary-groups/{groupId}/entries', [SentenceDictionaryController::class, 'index']);
Route::post('sentence-dictionary-groups/{groupId}/entries', [SentenceDictionaryController::class, 'store']);
Route::put('sentence-dictionary-groups/{groupId}/entries/{id}', [SentenceDictionaryController::class, 'update']);
Route::delete('sentence-dictionary-groups/{groupId}/entries/{id}', [SentenceDictionaryController::class, 'destroy']);
Route::post('sentence-dictionary-groups/{groupId}/entries/{id}/audio', [SentenceDictionaryController::class, 'addAudio']);
Route::delete('sentence-dictionary-groups/{groupId}/entries/{id}/audio/{index}', [SentenceDictionaryController::class, 'removeAudio']);
