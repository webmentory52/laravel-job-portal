<?php

use App\Livewire\Company\Jobs\JobCreate as CompanyJobCreate;
use App\Livewire\Site\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::prefix('company')->name('company.')->group(function() {
    Route::get('/jobs/create/{id?}', CompanyJobCreate::class)->name('jobs.create');
});

require __DIR__.'/settings.php';
