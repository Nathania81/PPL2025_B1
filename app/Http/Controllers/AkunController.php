<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        
        return view('Customer.akun.show', [
            'title' => 'Informasi Akun',
            'user' => $user,
            'hideNavbar' => true
        ]);
    }

    public function editPassword()
    {
        return view('Customer.akun.edit-password', [
            'title' => 'Ubah Password',
            'hideNavbar' => true
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password lama tidak sesuai');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('akun.show')
            ->with('success', 'Password berhasil diperbarui!');
    }
}