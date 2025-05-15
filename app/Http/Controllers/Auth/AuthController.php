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
        //dd($request);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kota' => $request->kota_nama,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role_id' => 3 
        ]);

        $profile = Profil::create([
            'user_id' => $user->id,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota_nama,
            'kecamatan' => $request->kecamatan_nama,
            'kelurahan' => $request->kelurahan_nama
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
            1 => '/Superadmin/dashboard',    // Superadmin
            2 => '/adminpenjualan/dashboard',  // Admin Penjualan
            default => '/HalamanUtama',        // Customer
        };
    }
}