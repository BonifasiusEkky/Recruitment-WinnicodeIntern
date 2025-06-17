<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        Log::info('Filter type applied:', ['type' => $type]);
        $query = Job::query();
        if ($type && in_array($type, ['full_time', 'part_time'])) {
            $query->where('tipe_pekerjaan', $type);
        }
        $jobs = $query->get();
        Log::info('Jobs retrieved:', ['jobs' => $jobs->toArray()]);
        return view('jobs.index', compact('jobs', 'type'));
    }

    public function show(Job $job)
    {
        Log::info('Job retrieved for show:', ['job' => $job->toArray()]);
        return view('jobs.show', compact('job'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Job::class);

        $data = $request->validate([
            'posisi'             => 'required|string|max:255',
            'nama_perusahaan'    => 'required|string|max:255',
            'tempat_kerja'       => 'required|string|max:255',
            'tipe_pekerjaan'     => 'required|in:full_time,part_time',
            'gaji'               => 'nullable|numeric',
            'deskripsi_pekerjaan'=> 'required|string',
            'requirements'       => 'required|string',
            'expired_at'         => 'nullable|date',
        ]);

        $data['hrd_id'] = auth()->id();
        $job = Job::create($data);

        return redirect()->route('jobs.index')
                         ->with('success', 'Job created successfully.');
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $data = $request->validate([
            'posisi'             => 'required|string|max:255',
            'nama_perusahaan'    => 'required|string|max:255',
            'tempat_kerja'       => 'required|string|max:255',
            'tipe_pekerjaan'     => 'required|in:full_time,part_time',
            'gaji'               => 'nullable|numeric',
            'deskripsi_pekerjaan'=> 'required|string',
            'requirements'       => 'required|string',
            'expired_at'         => 'nullable|date',
            'status'             => 'nullable|boolean',
        ]);

        $job->update($data);

        return redirect()->route('jobs.index')
                         ->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return redirect()->route('jobs.index')
                         ->with('success', 'Job deleted successfully.');
    }
    
}