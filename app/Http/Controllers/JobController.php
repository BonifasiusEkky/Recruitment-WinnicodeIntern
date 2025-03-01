<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Job::class);

        $request->validate([
            'posisi' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'tempat_kerja' => 'required|string',
            'tipe_pekerjaan' => 'required|in:full-time,part-time',
            'gaji' => 'required|integer',
            'deskripsi_pekerjaan' => 'required|string',
            'requirements' => 'required|string'
        ]);

        $job = Job::create([
            'hrd_id' => auth()->id(),
            'posisi' => $request->posisi,
            'nama_perusahaan' => $request->nama_perusahaan,
            'tempat_kerja' => $request->tempat_kerja,
            'tipe_pekerjaan' => $request->tipe_pekerjaan,
            'gaji' => $request->gaji,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'requirements' => $request->requirements
        ]);

        return response()->json($job);
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $job->update($request->all());
        return response()->json(['message' => 'Job updated successfully']);
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return response()->json(['message' => 'Job deleted successfully']);
    }
}
