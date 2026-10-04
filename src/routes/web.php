<?php

use App\Http\Controllers\TtsController;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dictionary\Index as DictionaryIndex;
use App\Livewire\Game\Play as GamePlay;
use App\Livewire\Game\Setup as GameSetup;
use App\Livewire\Groups\Index as GroupsIndex;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('dashboard', DashboardIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/lugat', DictionaryIndex::class)->name('dictionary.index');
    Route::get('/qruplar', GroupsIndex::class)->name('groups.index');
    Route::get('/oyun', GameSetup::class)->name('game.setup');
    Route::get('/oyun/oyna', GamePlay::class)->name('game.play');
    Route::get('/tts', TtsController::class)->middleware('throttle:120,1')->name('tts.speak');
});

require __DIR__.'/auth.php';
