<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AboutController;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// About Us Page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/create/{user_id}', [ProfileController::class, 'create'])
        ->name('profile.create')
        ->where('user_id', '[0-9]+');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/fill-doc', [DocumentController::class, 'fillDoc'])->name('profile.fill-doc.form');
    Route::post('/profile/fill-doc', [DocumentController::class, 'storeDoc'])->name('profile.fill-doc.store');
    
    Route::get('/profile/fill-doc', function () {
        return view('profile.fill-doc');
    })->name('profile.fill-doc');
    

    // Logout Route (Hanya Bisa Diakses Jika Sudah Login)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Guest Routes (Hanya Bisa Diakses Jika Belum Login)
Route::middleware('guest')->group(function () {
    // Register Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login Routes
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::get('/about', [AboutController::class, 'index'])->name('about');