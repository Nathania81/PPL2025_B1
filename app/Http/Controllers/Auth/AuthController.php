<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('FormLogin');
    }
    // Login
    public function FormLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    // Registrasi

    public function showFormRegistrasi()
    {
        return view('FormRegistrasi');
    }

    public function FormRegistrasi(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'no_telepon' => 'required|string|max:13',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        // dd($validated);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role_id' => 3 
        ]);
        
        Profil::create([
            'user_id' => $user->id,
            'no_telepon' => $validated['no_telepon'],
            'alamat' => "{$validated['alamat']}, {$validated['kelurahan']}, Kec. {$validated['kecamatan']}"
        ]);

        DB::commit();

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Redirect berdasarkan role
    protected function redirectPath()
    {
        $user = Auth::user();
        
        return match($user->role_id) {
            1 => '/adminsapi/dashboard',    // Admin Sapi
            2 => '/adminpenjualan/dashboard',  // Admin Penjualan
            default => '/HalamanUtama',        // Customer
        };
    }
}