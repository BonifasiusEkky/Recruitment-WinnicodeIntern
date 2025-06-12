<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pastikan pengguna adalah HRD
        if ($user->role !== 'hrd') {
            return redirect()->route('login')->with('error', 'Akses ditolak. Hanya HRD yang bisa mengakses dashboard ini.');
        }

        // Ambil profil HRD
        $hrd = $user->hrdProfile;

        // Jika profil HRD tidak ada, arahkan pengguna untuk membuat profil
        if (is_null($hrd)) {
            return redirect()->route('hrd.profile.create')->with('error', 'Silakan lengkapi profil HRD Anda terlebih dahulu.');
        }

        // Ambil data jobs dan applications
        $jobs = Job::where('hrd_id', $hrd->id)->get();
        $applications = Application::whereIn('job_id', $jobs->pluck('id'))->get();
        $companyName = $hrd->company_name; // Tambahkan semicolon yang hilang

        return view('hrd.dashboard', compact('jobs', 'applications', 'companyName'));
    }
}