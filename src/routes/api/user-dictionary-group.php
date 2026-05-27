<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserDictionaryGroupController;

Route::apiResource('user-dictionary-groups', UserDictionaryGroupController::class);
