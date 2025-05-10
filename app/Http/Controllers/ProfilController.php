<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $profil = $user->profil;

        return view('Customer.profil.show', [
            'title' => 'Profil Saya',
            'profil' => $profil,
            'hideNavbar' => true
        ]);
    }

    public function edit()
    {
        $user = auth()->user();
        $profil = $user->profil;

        return view('Customer.profil.edit', [
            'title' => 'Edit Profil',
            'profil' => $profil,
            'hideNavbar' => true
        ]);
    }

    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'no_telepon' => 'required|max:13',
        'alamat' => 'required|string',
        'kabupaten' => 'required|string',
        'kecamatan' => 'required|string',
        'desa' => 'required|string',
        'foto_profil' => 'nullable|image|max:2048'
    ]);

    $user = Auth::user();
    // $user->update(['name' => $request->name]);

    $profil = $user->profil;
    $profil->no_telepon = $request->no_telepon;
    $profil->kota = $request->kota;
    $profil->kecamatan = $request->kecamatan;
    $profil->kelurahan = $request->kelurahan;
    $profil->alamat = $request->alamat;

    $profil->save();

    return redirect()->route('profil.show')->with('success', 'Data profil berhasil diubah!');
}
}
