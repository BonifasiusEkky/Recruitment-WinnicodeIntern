<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        // Log untuk debugging
        Log::info('User attempting to apply for job:', [
            'user_id' => auth()->id(),
            'job_id' => $job->id
        ]);

        // Pastikan pengguna sudah login (sudah ditangani oleh middleware 'auth')
        if (!auth()->check()) {
            Log::warning('User not authenticated when trying to apply for job:', ['job_id' => $job->id]);
            return redirect()->route('login')->with('error', 'Please login to apply for this job.');
        }

        // Pastikan pengguna belum melamar pekerjaan ini
        $existingApplication = Application::where('user_id', auth()->id())
            ->where('job_id', $job->id)
            ->first();

        if ($existingApplication) {
            Log::info('User has already applied for this job:', [
                'user_id' => auth()->id(),
                'job_id' => $job->id
            ]);
            return redirect()->route('jobs.show', $job->id)
                ->with('error', 'You have already applied for this job.');
        }

        // Pastikan pengguna sudah melengkapi profil dan dokumen
        $user = auth()->user();
        if (!$user->profile || !$user->document) {
            Log::warning('User profile or document incomplete:', ['user_id' => auth()->id()]);
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your profile and upload documents before applying.');
        }

        // Buat aplikasi baru dengan status 'pending'
        $application = Application::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'status' => 'pending', // Default status sesuai tabel
        ]);

        Log::info('Application submitted successfully:', [
            'application_id' => $application->id,
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'status' => $application->status
        ]);

        return redirect()->route('jobs.show', $job->id)
            ->with('success', 'Application submitted successfully!');
    }
}