@extends('layouts.customer', ['hideNavbar' => true])

@section('content')
<div class="flex justify-center items-center min-h-screen bg-[#f0f4f8]">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-[#2c3e50] mb-6 text-center">Ubah Password</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('akun.update-password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block text-gray-700 font-medium mb-1">Password Lama</label>
                    <input type="password" name="current_password" id="current_password" 
                        class="w-full p-2 border rounded" required>
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="new_password" class="block text-gray-700 font-medium mb-1">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" 
                        class="w-full p-2 border rounded" required>
                    @error('new_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="new_password_confirmation" class="block text-gray-700 font-medium mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                        class="w-full p-2 border rounded" required>
                </div>
                
                <div class="flex justify-between pt-4">
                    <a href="{{ route('akun.show') }}" 
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition">
                        Kembali
                    </a>
                    <button type="submit" 
                        class="bg-[#2c3e50] text-white py-2 px-4 rounded hover:bg-[#34495e] transition">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection