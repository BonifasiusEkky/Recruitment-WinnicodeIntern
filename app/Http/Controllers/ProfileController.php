<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Mengharuskan login sebelum mengakses profile
    }

    // Menampilkan profil user yang sedang login
    public function index()
    {
        $user = User::with('profile')->find(Auth::id()); // Mengambil user beserta profilnya
        return view('profile.index', compact('user'));
    }

    // Menampilkan form edit profile
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // Menampilkan form create profile (jika user belum punya profile)
    public function create($user_id)
    {
        $user = User::findOrFail($user_id);
        
        // Cek apakah user sudah punya profile
        if ($user->profile) {
            return redirect()->route('profile.index')->with('info', 'Profil sudah ada!');
        }

        return view('profile.create', compact('user'));
    }

    // Menyimpan data profile
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'gender' => 'required|in:Male,Female,Other', // Validasi gender
            'date_of_birth' => 'required|date', // Menggunakan date_of_birth sesuai database
            'address' => 'required|string|max:500', // Menggunakan address sesuai database
        ]);

        try {
            // Cek apakah profile sudah ada sebelumnya
            if (Profile::where('user_id', $validatedData['user_id'])->exists()) {
                return back()->withErrors(['error' => 'Profil sudah ada untuk user ini.']);
            }

            // Simpan profil baru
            Profile::create([
                'user_id' => $validatedData['user_id'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'address' => $validatedData['address'],
            ]);

            return redirect()->route('profile.index')->with('success', 'Profil berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Menyimpan perubahan profil
    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:500',
        ]);

        try {
            // Cek jika user sudah memiliki profil
            if (!$user->profile) {
                return redirect()->route('profile.create', ['user_id' => $user->id])
                    ->with('info', 'Silakan buat profil terlebih dahulu.');
            }

            // Update profil
            $user->profile->update([
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'address' => $validatedData['address'],
            ]);

            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
