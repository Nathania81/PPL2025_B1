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
            'user' => $user,
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
            'user' => $user,
            'profil' => $profil,
            'hideNavbar' => true
        ]);
    }

    public function update(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:13',
        'kota' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kelurahan' => 'required|string|max:255',
        'alamat' => 'required|string|max:500',
    ]);

    $user = Auth::user();
    $user->update(['name' => $request->name]);
    $user->update([
            'nama' => $request->nama,
            'kota' => $request->kota,
            'alamat' => $request->alamat
        ]);

    $profilData = [
            'no_telepon' => $request->no_telepon,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat
        ];

        if ($user->profil) {
            $user->profil()->update($profilData);
        } else {
            $user->profil()->create($profilData);
        }

        return redirect()->route('profil.show')->with('success', 'Data profil berhasil diperbarui!');
    }
}
