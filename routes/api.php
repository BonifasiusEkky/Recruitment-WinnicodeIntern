<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // 🔹 Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // 🔹 User Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

    // 🔹 Upload Dokumen (CV, Portofolio, dll.)
    Route::post('/upload-documents', [DocumentController::class, 'upload']);

    // 🔹 Lowongan Pekerjaan (CRUD untuk HRD)
    Route::get('/jobs', [JobController::class, 'index']);
    Route::post('/jobs', [JobController::class, 'store'])->middleware('is_hrd');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->middleware('is_hrd');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('is_hrd');

    // 🔹 User Melamar Pekerjaan
    Route::post('/apply/{job}', [ApplicationController::class, 'apply']);

    // 🔹 HRD Mengelola Lamaran
    Route::get('/applications', [ApplicationController::class, 'manageApplications'])->middleware('is_hrd');
    Route::patch('/applications/{application}', [ApplicationController::class, 'updateStatus'])->middleware('is_hrd');

    // 🔹 User Melihat History Lamaran
    Route::get('/my-applications', [ApplicationController::class, 'listApplications']);

});
