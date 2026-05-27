<?php

use App\Http\Controllers\Api\NoteGroupController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('note-groups', [NoteGroupController::class, 'index']);
Route::post('note-groups', [NoteGroupController::class, 'store']);
Route::put('note-groups/{id}', [NoteGroupController::class, 'update']);
Route::delete('note-groups/{id}', [NoteGroupController::class, 'destroy']);

Route::get('note-groups/{groupId}/notes', [NoteController::class, 'index']);
Route::post('note-groups/{groupId}/notes', [NoteController::class, 'store']);
Route::put('note-groups/{groupId}/notes/{id}', [NoteController::class, 'update']);
Route::delete('note-groups/{groupId}/notes/{id}', [NoteController::class, 'destroy']);
