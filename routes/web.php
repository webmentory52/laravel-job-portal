<?php

use App\Livewire\Company\Jobs\JobCreate as CompanyJobCreate;
use App\Livewire\Site\Home;
use App\Livewire\Site\JobDetail;
use App\Livewire\Site\UserOnboarding;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/job/{id}/{slug?}', JobDetail::class)->name('job-detail');

Route::middleware(['auth'])->group(function () {

    Route::get('/onboarding', UserOnboarding::class)->name('onboarding.show');

    Route::middleware(['verified', 'superadmin'])->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    Route::middleware(['company'])->prefix('company')->name('company.')->group(function() {
        Route::get('/jobs/create/{id?}', CompanyJobCreate::class)->name('jobs.create');
    });
});

require __DIR__.'/settings.php';
