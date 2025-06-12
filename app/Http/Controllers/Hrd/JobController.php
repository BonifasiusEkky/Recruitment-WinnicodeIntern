<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        // ambil semua job milik HRD ini
        $jobs = Job::where('hrd_id', Auth::user()->hrdProfile->id)
                   ->orderBy('created_at', 'desc')
                   ->get();

        return view('hrd.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('hrd.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'posisi'              => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'requirements'        => 'required|string',
            'tempat_kerja'        => 'required|string|max:255',
            'tipe_pekerjaan'      => 'required|in:full_time,part_time',
            'gaji'                => 'nullable|numeric|min:0',
            'expired_at'          => 'nullable|date',
        ]);

        Job::create([
            'hrd_id'              => Auth::user()->hrdProfile->id,
            'posisi'              => $validated['posisi'],
            'nama_perusahaan'     => Auth::user()->hrdProfile->company_name,
            'tempat_kerja'        => $validated['tempat_kerja'],
            'tipe_pekerjaan'      => $validated['tipe_pekerjaan'],
            'gaji'                => $validated['gaji'],
            'deskripsi_pekerjaan' => $validated['deskripsi_pekerjaan'],
            'requirements'        => $validated['requirements'],
            'expired_at'          => $validated['expired_at'],
        ]);

        return redirect()
            ->route('hrd.jobs.index')
            ->with('success', 'Job berhasil dibuat.');
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('hrd.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validated = $request->validate([
            'posisi'              => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'requirements'        => 'required|string',
            'tempat_kerja'        => 'required|string|max:255',
            'tipe_pekerjaan'      => 'required|in:full_time,part_time',
            'gaji'                => 'nullable|numeric|min:0',
            'expired_at'          => 'nullable|date',
        ]);

        $job->update($validated);

        return redirect()
            ->route('hrd.jobs.index')
            ->with('success', 'Job berhasil diperbarui.');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();

        return redirect()
            ->route('hrd.jobs.index')
            ->with('success', 'Job berhasil dihapus.');
    }
}
