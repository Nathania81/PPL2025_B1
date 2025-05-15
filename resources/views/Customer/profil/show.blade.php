@extends('layouts.customer', ['hideNavbar' => true])

@section('content')
<div class="flex items-center justify-center min-h-screen bg-lightbg">
    <div class="w-[600px] mt-[-100px]">
        <div class="bg-white rounded-lg shadow-md flex p-5">
            <div class="w-[200px] flex flex-col items-center">
                <div class="flex flex-col w-full p-4">
                    <a href="{{ route('profil.edit') }}">
                        <button class="p-2 bg-primary rounded text-white cursor-pointer w-full my-1">
                            Ubah Profil
                        </button>
                    </a>
                    <a href="{{ route('akun.show') }}">
                        <button class="p-2 bg-primary rounded text-white cursor-pointer w-full my-1">Akun</button>
                    </a>
                </div>
            </div>
            <div class="flex-1 mr-5">
                
                <div class="mb-3">
                    <label class="block font-semibold">Nama Lengkap</label>
                    <p class="p-2 bg-gray-100 rounded">{{ $user->nama }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="block font-semibold">No. Telepon</label>
                    <p class="p-2 bg-gray-100 rounded">{{ $profil->no_telepon ?? '-' }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="block font-semibold">Kabupaten/Kota</label>
                    <p class="p-2 bg-gray-100 rounded">{{ $profil->kota ?? '-' }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="block font-semibold">Kecamatan</label>
                    <p class="p-2 bg-gray-100 rounded">{{ $profil->kecamatan ?? '-' }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="block font-semibold">Kelurahan/Desa</label>
                    <p class="p-2 bg-gray-100 rounded">{{ $profil->kelurahan ?? '-' }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="block font-semibold">Alamat Lengkap</label>
                    <p class="p-2 bg-gray-100 rounded">{{ $profil->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection