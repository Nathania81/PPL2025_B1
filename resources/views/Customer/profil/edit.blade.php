@extends('layouts.customer', ['hideNavbar' => true])

@section('content')
<div class="flex items-center justify-center min-h-screen bg-lightbg">
    <div class="w-[600px] bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Ubah Profil</h2>
        @if(session('success'))
            <div class="text-green-600 mb-2">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block font-semibold">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-3">
                <label class="block font-semibold">No. Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-3">
                <label class="block font-semibold">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $profil->alamat) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-3">
                <label class="block font-semibold">Kabupaten</label>
                <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil->kabupaten) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-3">
                <label class="block font-semibold">Kecamatan</label>
                <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil->kecamatan) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-3">
                <label class="block font-semibold">Desa</label>
                <input type="text" name="desa" value="{{ old('desa', $profil->desa) }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Foto Profil</label>
                <input type="file" name="foto_profil" class="w-full border rounded">
                @if($profil->foto_profil)
                    <img src="{{ asset('storage/' . $profil->foto_profil) }}" alt="Foto Profil" class="w-20 h-20 rounded-full mt-2">
                @endif
            </div>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">Simpan</button>
        </form>
    </div>
</div>
@endsection
