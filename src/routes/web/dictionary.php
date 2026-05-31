<?php

use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\DictionaryCategoryController;
use App\Http\Controllers\SetDictionaryController;
use App\Http\Controllers\WordOfDayController;
use Illuminate\Support\Facades\Route;

Route::resource('/dictionary', DictionaryController::class);
Route::post('/dictionary-category/bulk-delete', [DictionaryCategoryController::class, 'bulkDelete'])->name('dictionary-category.bulk-delete');
Route::resource('/dictionary-category', DictionaryCategoryController::class);
Route::prefix('/dictionary/{dictionaryId}/meaning')->group(function () {
    Route::get('/', [\App\Http\Controllers\DictionaryMeaningController::class, 'index'])->name('dictionary.meaning.index');
    Route::get('/create', [\App\Http\Controllers\DictionaryMeaningController::class, 'create'])->name('dictionary.meaning.create');
    Route::post('/', [\App\Http\Controllers\DictionaryMeaningController::class, 'store'])->name('dictionary.meaning.store');
    Route::get('/{id}/edit', [\App\Http\Controllers\DictionaryMeaningController::class, 'edit'])->name('dictionary.meaning.edit');
    Route::put('/{id}', [\App\Http\Controllers\DictionaryMeaningController::class, 'update'])->name('dictionary.meaning.update');
    Route::delete('/{id}', [\App\Http\Controllers\DictionaryMeaningController::class, 'destroy'])->name('dictionary.meaning.destroy');
});
Route::post('/dictionary/{id}/audio/delete', [DictionaryController::class, 'deleteAudio'])->name('dictionary.audio.delete');



Route::get('/set-dictionary', [SetDictionaryController::class, 'importWords'])->name('set-dictionary');

Route::get('/word-of-day/search', [WordOfDayController::class, 'search'])->name('word-of-day.search');
Route::get('/word-of-day', [WordOfDayController::class, 'index'])->name('word-of-day.index');
Route::post('/word-of-day', [WordOfDayController::class, 'store'])->name('word-of-day.store');
Route::delete('/word-of-day/{id}', [WordOfDayController::class, 'destroy'])->name('word-of-day.destroy');
