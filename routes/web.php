<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\JobController;
// Controller untuk public apply
use App\Http\Controllers\ApplicationController;
// Alias untuk HRD ApplicationController
use App\Http\Controllers\Hrd\ApplicationController as HrdApplicationController;
use App\Http\Controllers\Hrd\DashboardController;
use App\Http\Controllers\Hrd\ProfileController as HrdProfileController;
use App\Http\Controllers\Hrd\JobController as HrdJob;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // User Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Document filling
    Route::get('/profile/fill-doc', [DocumentController::class, 'fillDoc'])->name('profile.fill-doc');
    Route::post('/profile/fill-doc', [DocumentController::class, 'storeDoc'])->name('profile.fill-doc.store');

    // History Job
    Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history');    
    // Apply to job
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
});

/*
|--------------------------------------------------------------------------
| HRD DASHBOARD & MANAGEMENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'hrd'])
    ->prefix('hrd')
    ->name('hrd.')
    ->group(function () {
        // HRD Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Job management (uses HrdJob)
        Route::resource('jobs', HrdJob::class)
            ->only(['index', 'create', 'store', 'edit','show', 'update', 'destroy'])
            ->names([
                'index'   => 'jobs.index',
                'create'  => 'jobs.create',
                'store'   => 'jobs.store',
                'show'    => 'jobs.show',
                'edit'    => 'jobs.edit',
                'update'  => 'jobs.update',
                'destroy' => 'jobs.destroy',
            ]);

        // Application review (pakai alias HrdApplicationController)
        Route::get('/applications', [HrdApplicationController::class, 'index'])
             ->name('applications.index');
        Route::get('/applications/{application}', [HrdApplicationController::class, 'show'])
             ->name('applications.show');
        Route::post('/applications/{application}/update-status', [HrdApplicationController::class, 'updateStatus'])
             ->name('applications.updateStatus');

        // HRD Profile management
        Route::get('/profile/create', [HrdProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [HrdProfileController::class, 'store'])->name('profile.store');
    });
