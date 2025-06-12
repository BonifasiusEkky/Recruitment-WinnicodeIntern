<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Tampilkan Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $validatedData = $request->validate([
        'role' => 'required|in:user,hrd',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'gender' => 'required|in:Male,Female',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
    ]);

    try {
        DB::beginTransaction(); // Mulai transaksi database

        // Buat user
        $user = User::create([
            'role' => $validatedData['role'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Buat profile dengan user_id yang baru dibuat
        Profile::create([
            'user_id' => $user->id,
            'gender' => $validatedData['gender'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'alamat' => $validatedData['alamat'],
        ]);

        DB::commit(); // Simpan transaksi

        // Auto-login setelah register
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    } catch (\Exception $e) {
        DB::rollBack(); // Batalkan transaksi jika gagal
        return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}




    // Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|boolean'
        ]);

        $user = User::where('email', $request->email)->first();

        // Validasi Login
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        // Login user dengan remember me
        Auth::login($user, $request->boolean('remember'));


        // Redirect berdasarkan role
        if ($user->role === 'hrd') {
            return redirect()->route('dashboard.hrd')->with('success', 'Login berhasil sebagai HRD!');
        }

        return redirect()->route('profile')->with('success', 'Login berhasil!');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session lama
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
