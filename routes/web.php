<?php

use App\Livewire\Site\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
