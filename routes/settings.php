<?php

use App\Livewire\Admin\Jobs\CreateJob;
use App\Livewire\Admin\Jobs\JobListing;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::middleware(['auth', 'superadmin', 'verified'])->group(function () {
    Route::view('admin/dashboard', 'dashboard')->name('admin.dashboard');
});

Route::middleware(['auth', 'superadmin'])->prefix('admin/dashboard')->name('admin.')->group(function() {

    Route::redirect('settings', 'settings/profile');

    Route::livewire('settings/profile', 'pages::settings.profile')->name('profile.edit');

    Route::middleware(['verified'])->group(function () {
        Route::livewire('settings/password', 'pages::settings.password')->name('user-password.edit');
        Route::livewire('settings/appearance', 'pages::settings.appearance')->name('appearance.edit');

        Route::livewire('settings/two-factor', 'pages::settings.two-factor')
            ->middleware(
                when(
                    Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                    ['password.confirm'],
                    [],
                ),
            )
            ->name('two-factor.show');
    });

    // Other routes
    Route::prefix('jobs')->group(function() {
        Route::get('/', JobListing::class)->name('jobs.index');
        Route::get('/create/{id?}', CreateJob::class)->name('jobs.create');
    });
});
