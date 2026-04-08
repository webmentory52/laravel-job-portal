<?php

use App\Livewire\Company\Jobs\JobCreate as CompanyJobCreate;
use App\Livewire\Company\JoinRequests;
use App\Livewire\Site\{Categories\Categories,
    Categories\CategoryDetail,
    Companies\Companies as CompaniesSite,
    Companies\CompanyDetail as CompanyDetailSite,
    Home,
    JobDetail,
    JobSearch,
    UserOnboarding};
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/job/{id}/{slug?}', JobDetail::class)->name('job-detail');
Route::get('/job-search', JobSearch::class)->name('jobs.search');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/c/{id}/{slug?}', CategoryDetail::class)->name('categories.detail');
Route::get('/companies', CompaniesSite::class)->name('companies');
Route::get('/company/{id}/{slug?}', CompanyDetailSite::class)->name('company.detail');

Route::middleware(['auth'])->group(function () {

    Route::get('/onboarding', UserOnboarding::class)->name('onboarding.show');

    Route::middleware(['verified', 'superadmin'])->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    Route::middleware(['check.onboarding'])->group(function () {

        Route::middleware(['company'])->prefix('company')->name('company.')->group(function() {
            Route::get('/jobs/create/{id?}', CompanyJobCreate::class)->name('jobs.create');

            Route::get('/join-requests', JoinRequests::class)->name('join-requests');
        });
    });

});

require __DIR__.'/settings.php';
