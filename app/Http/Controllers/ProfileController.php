<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::with('profile')->find(Auth::id());
        return view('profile.index', compact('user'));
    }

    public function history()
    {
        $user = User::with('profile')->find(Auth::id());
        $applications = Application::with('job')
            ->where('user_id', Auth::id())
            ->get();

        Log::info('Applications retrieved for history:', [
            'user_id' => Auth::id(),
            'count' => $applications->count()
        ]);

        return view('profile.historyJob', compact('user', 'applications'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function create($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->profile) {
            return redirect()->route('profile.index')->with('info', 'Profil sudah ada!');
        }
        return view('profile.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'gender' => 'required|in:Male,Female,Other',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'profile_picture' => 'nullable|image|m MimeType:jpeg,png,jpg|max:2048',
        ]);

        try {
            if (Profile::where('user_id', $validatedData['user_id'])->exists()) {
                return back()->withErrors(['error' => 'Profil sudah ada untuk user ini.']);
            }

            if ($request->hasFile('profile_picture')) {
                Log::info('Storing new profile picture in store method', ['file' => $request->file('profile_picture')->getClientOriginalName()]);
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $validatedData['profile_picture'] = $path;
            }

            Profile::create($validatedData);
            return redirect()->route('profile.index')->with('success', 'Profil berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Error creating profile:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'gender' => 'required|in:Male,Female,Other',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                Log::info('Profile picture uploaded in update method:', [
                    'file' => $request->file('profile_picture')->getClientOriginalName(),
                    'size' => $request->file('profile_picture')->getSize(),
                    'mime' => $request->file('profile_picture')->getMimeType(),
                ]);

                // Hapus gambar lama jika ada
                if ($user->profile && $user->profile->profile_picture) {
                    Log::info('Deleting old profile picture:', ['path' => $user->profile->profile_picture]);
                    Storage::disk('public')->delete($user->profile->profile_picture);
                }

                // Simpan gambar baru
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                Log::info('New profile picture stored:', ['path' => $path]);
                $validatedData['profile_picture'] = $path;
            } else {
                Log::info('No profile picture uploaded in update method');
            }

            if (!$user->profile) {
                Log::info('Creating new profile for user:', ['user_id' => $user->id]);
                $validatedData['user_id'] = $user->id;
                Profile::create($validatedData);
                return redirect()->route('profile.index')->with('success', 'Profil berhasil dibuat!');
            }

            Log::info('Updating profile with data:', $validatedData);
            $user->profile->update($validatedData);
            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating profile:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Kata sandi berhasil diperbarui.');
    }
}