<?php

use App\Livewire\Admin\Categories\ListCategories;
use App\Livewire\Admin\Companies\ListCompanies;
use App\Livewire\Admin\Jobs\CreateJob;
use App\Livewire\Admin\Jobs\JobListing;
use App\Livewire\Admin\JobTypes\ListJobTypes;
use App\Livewire\Admin\Workplaces\ListWorkplaces;
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

    // Categories
    Route::get('/categories', ListCategories::class)->name('categories.index');

    // Workplaces
    Route::get('/workplaces', ListWorkplaces::class)->name('workplaces.index');

    // Job Types
    Route::get('/job-types', ListJobTypes::class)->name('job-types.index');

    // Companies
    Route::get('/companies', ListCompanies::class)->name('companies.index');
});
