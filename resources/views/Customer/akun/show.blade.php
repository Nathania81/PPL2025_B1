@extends('layouts.customer', ['hideNavbar' => true])

@section('content')
<div class="flex justify-center items-center min-h-screen bg-[#f0f4f8]">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-[#2c3e50] mb-6 text-center">Informasi Akun</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" value="{{ $user->nama }}" 
                    class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>
            
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="text" value="{{ $user->email }}" 
                    class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>
            
            <div class="pt-4">
                <a href="{{ route('akun.edit-password') }}" 
                    class="block w-full bg-[#2c3e50] text-white text-center py-2 px-4 rounded hover:bg-[#34495e] transition">
                    Ubah Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection