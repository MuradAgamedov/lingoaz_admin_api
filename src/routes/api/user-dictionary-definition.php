<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserDictionaryDefinitionController;

Route::post('user-dictionary-definitions', [UserDictionaryDefinitionController::class, 'store']);
Route::put('user-dictionary-definitions/{id}', [UserDictionaryDefinitionController::class, 'update']);
Route::delete('user-dictionary-definitions/{id}', [UserDictionaryDefinitionController::class, 'destroy']);
