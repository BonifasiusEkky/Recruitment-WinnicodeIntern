<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    // Menampilkan semua lamaran pekerjaan untuk HRD yang sedang login
    public function index()
    {
        $user = auth()->user(); // Ambil HRD yang sedang login

        // Validasi apakah user sudah login dan memiliki role HRD
        if (!$user || $user->role !== 'hrd') {
            abort(403, 'Unauthorized action.');
        }

        // Ambil semua job_id yang dimiliki HRD
        $jobs = $user->jobs()->pluck('id');

        // Log untuk debugging
        Log::info('HRD User: ', ['user_id' => $user->id, 'jobs' => $jobs]);

        // Cek apakah HRD memiliki lowongan
        if ($jobs->isEmpty()) {
            return view('hrd.applications.index', ['applications' => collect([])])
                ->with('info', 'Anda belum memiliki lowongan yang aktif.');
        }

        // Ambil semua lamaran untuk job milik HRD dengan relasi user dan job
        $applications = Application::with(['user', 'job'])
            ->whereIn('job_id', $jobs)
            ->whereNotNull('user_id') // Pastikan user_id tidak null
            ->whereNotNull('job_id')  // Pastikan job_id tidak null
            ->whereHas('user')        // Pastikan relasi user ada
            ->whereHas('job')         // Pastikan relasi job ada
            ->get();

        // Log data applications untuk debugging
        Log::info('Applications retrieved: ', ['count' => $applications->count(), 'applications' => $applications]);

        return view('hrd.applications.index', compact('applications'));
    }

    // Menampilkan detail satu lamaran
    public function show(Application $application)
    {
        // Cek apakah lamaran ada
        if (!$application->exists) {
            Log::warning('Application not found', ['application_id' => $application->id]);
            abort(404, 'Lamaran tidak ditemukan.');
        }

        // Load relasi user dan job
        $application->load(['user', 'job']);

        // Cek apakah relasi user ada
        if (!$application->user) {
            Log::warning('User not found for application', ['application_id' => $application->id, 'user_id' => $application->user_id]);
            abort(404, 'Data pengguna untuk lamaran ini tidak ditemukan.');
        }

        // Cek apakah relasi job ada
        if (!$application->job) {
            Log::warning('Job not found for application', ['application_id' => $application->id, 'job_id' => $application->job_id]);
            abort(404, 'Data lowongan untuk lamaran ini tidak ditemukan.');
        }

        // Log untuk debugging
        Log::info('Application loaded: ', [
            'application_id' => $application->id,
            'user_id' => $application->user_id,
            'job_id' => $application->job_id,
            'user' => $application->user->toArray(),
            'job' => $application->job->toArray()
        ]);

        // Ambil dokumen milik pelamar
        $documents = Document::where('user_id', $application->user_id)->get();

        // Log dokumen untuk debugging
        Log::info('Documents retrieved: ', ['user_id' => $application->user_id, 'count' => $documents->count()]);

        return view('hrd.applications.show', compact('application', 'documents'));
    }

    // Mengupdate status lamaran (pending, accepted, rejected)
    public function updateStatus(Request $request, Application $application)
    {
        // Cek apakah lamaran ada
        if (!$application->exists) {
            Log::warning('Application not found for status update', ['application_id' => $application->id]);
            abort(404, 'Lamaran tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        // Update status
        $application->update([
            'status' => $request->status,
        ]);

        // Log update status
        Log::info('Application status updated', [
            'application_id' => $application->id,
            'new_status' => $request->status
        ]);

        return redirect()
            ->route('hrd.applications.show', $application->id)
            ->with('success', 'Status lamaran diperbarui.');
    }
}