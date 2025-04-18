@extends('layouts.customer', ['hideNavbar' => true])

@section('content')
<div class="flex items-center justify-center h-screen bg-lightbg">
    <div class="w-[600px] mt-[-100px]">
        <div class="bg-white rounded-lg shadow-md flex p-5">
            <div class="w-[200px] flex flex-col items-center">
                <div class="flex flex-col w-full p-4">
                    <a href="{{ route('profil.edit') }}">
                        <button class="p-2 bg-primary rounded text-white cursor-pointer w-full  my-1">Ubah Profile</button>
                    </a>
                    <a href="/HalamanAkun">
                        <button class="p-2 bg-primary rounded text-white cursor-pointer w-full my-1">Akun</button>
                    </a>
                </div>
            </div>
            <div class="flex-1 mr-5">
                <p class="text-xl text-gray-900 pb-2">Nama Lengkap</p>
                <input type="text" value="{{ $profil->nama }}" class="block w-full p-2.5 mb-4 border border-gray-300 rounded">
                <p class="text-xl text-gray-900 pb-2">No telp</p>
                <input type="text" value="{{ $profil->no_telepon }}" class="block w-full p-2.5 mb-4 border border-gray-300 rounded">
                <p class="text-xl text-gray-900 pb-2">Kabupaten</p>
                <input type="text" value="{{ $profil->kabupaten }}" class="block w-full p-2.5 mb-4 border border-gray-300 rounded">
                <p class="text-xl text-gray-900 pb-2">Kecamatan</p>
                <input type="text" value="{{ $profil->kecamatan }}" class="block w-full p-2.5 mb-4 border border-gray-300 rounded">
                <p class="text-xl text-gray-900 pb-2">Kelurahan</p>
                <input type="text" value="{{ $profil->desa }}" class="block w-full p-2.5 mb-4 border border-gray-300 rounded">
                <p class="text-xl text-gray-900 pb-2">Alamat</p>
                <input type="text" value="{{ $profil->alamat }}" class="block w-full p-2.5 mb-4 border border-gray-300 rounded">
            </div>
        </div>
    </div>
</div>
@endsection
