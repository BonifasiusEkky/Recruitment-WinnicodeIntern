<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use App\Models\HrdProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        return view('hrd.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
            'company_name' => 'required|string|max:255',
        ]);

        HrdProfile::create([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'company_name' => $request->company_name,
        ]);

        return redirect()->route('hrd.dashboard')->with('success', 'Profil HRD berhasil dibuat!');
    }
}