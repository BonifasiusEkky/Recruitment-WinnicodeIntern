<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Request $request, Job $job)
    {
        $user = auth()->user();

        $existingApplication = Application::where('user_id', $user->id)->where('job_id', $job->id)->first();
        if ($existingApplication) {
            return response()->json(['message' => 'You have already applied for this job'], 400);
        }

        $application = Application::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'status' => 'pending'
        ]);

        return response()->json(['message' => 'Application submitted', 'application' => $application]);
    }

    public function listApplications()
    {
        $applications = Application::with('job')->where('user_id', auth()->id())->get();
        return response()->json($applications);
    }

    public function manageApplications()
    {
        $applications = Application::with('user', 'job')->get();
        return response()->json($applications);
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->authorize('update', $application);

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $application->update(['status' => $request->status]);
        return response()->json(['message' => 'Application status updated']);
    }
}
