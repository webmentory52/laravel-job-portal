<?php

use App\Livewire\Company\{
    Jobs\JobCreate as CompanyJobCreate,
    Jobs\JobListing as CompanyJobListing,
    JoinRequests,
    Dashboard as CompanyDashboard
};
use App\Livewire\Site\{
    Categories\Categories,
    Categories\CategoryDetail,
    Companies\Companies as CompaniesSite,
    Companies\CompanyDetail as CompanyDetailSite,
    Home,
    JobDetail,
    JobSearch,
    UserOnboarding
};
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/job/{id}/{slug?}', JobDetail::class)->name('job-detail');
Route::get('/job-search', JobSearch::class)->name('jobs.search');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/c/{id}/{slug?}', CategoryDetail::class)->name('categories.detail');
Route::get('/companies', CompaniesSite::class)->name('companies');
Route::get('/companies/{id}/{slug?}', CompanyDetailSite::class)->name('company.detail');

Route::middleware(['auth'])->group(function () {

    Route::get('/onboarding', UserOnboarding::class)->name('onboarding.show');

    Route::middleware(['verified'])->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    Route::middleware(['check.onboarding'])->group(function () {

        Route::middleware(['company'])->prefix('company')->name('company.')->group(function() {
            Route::get('/dashboard', CompanyDashboard::class)->name('dashboard');
            Route::get('/jobs/create/{id?}', CompanyJobCreate::class)->name('jobs.create');
            Route::get('/jobs', CompanyJobListing::class)->name('jobs.index');

            Route::get('/join-requests', JoinRequests::class)->name('join-requests');
        });
    });


    // Admin routes
    Route::view('welcome', 'welcome')->name('admin.jobs.list');
});

require __DIR__.'/settings.php';
