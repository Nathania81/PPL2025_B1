<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyan-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">Registrasi</h1>
        <p class="text-gray-500 mb-6 text-center">
            Lengkapi informasi di bawah ini untuk membuat akun baru
        </p>
        
        <!-- Tambahkan notifikasi error -->
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Tambahkan notifikasi sukses -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form id="registrationForm" method="POST" action="{{ route('registrasi') }}" class="mt-4">
            @csrf
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Kolom kiri: Data Pribadi -->
                <div class="flex-1 space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="nama" 
                            name="nama" 
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">No. Handphone</label>
                        <input 
                            type="text" 
                            id="no_telepon" 
                            name="no_telepon" 
                            value="{{ old('no_telepon') }}"
                            placeholder="Masukkan nomor handphone" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Masukkan email" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Masukkan ulang password" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    
                    <div class="flex items-center mt-2">
                        <input 
                            type="checkbox" 
                            id="show-password" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="show-password" class="ml-2 text-sm text-gray-700">Tampilkan kata sandi</label>
                    </div>
                </div>
                
                <!-- Kolom kanan: Data Alamat -->
                <div class="flex-1 space-y-4">
                    <div>
                        <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                        <select 
                            id="kota" 
                            name="kota" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Pilih Kota/Kabupaten</option>
                            <option value="Jember" {{ old('kota') == 'Jember' ? 'selected' : '' }}>Jember</option>
                            <option value="Surabaya" {{ old('kota') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                        <select 
                            id="kecamatan" 
                            name="kecamatan" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Pilih Kecamatan</option>
                            <option value="Ambulu" {{ old('kecamatan') == 'Ambulu' ? 'selected' : '' }}>Ambulu</option>
                            <option value="Kedung Banto" {{ old('kecamatan') == 'Kedung Banto' ? 'selected' : '' }}>Kedung Banto</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan</label>
                        <select 
                            id="kelurahan" 
                            name="kelurahan" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">Pilih Desa/Kelurahan</option>
                            <option value="Tegalsari" {{ old('kelurahan') == 'Tegalsari' ? 'selected' : '' }}>Tegalsari</option>
                            <option value="Sumbersari" {{ old('kelurahan') == 'Sumbersari' ? 'selected' : '' }}>Sumbersari</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <input 
                            type="text" 
                            id="alamat" 
                            name="alamat" 
                            value="{{ old('alamat') }}"
                            placeholder="Masukkan alamat lengkap (nama jalan, nomor rumah, dll)" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                </div>
            </div>
            
            <button 
                type="submit" 
                class="w-full mt-6 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Submit Registrasi
            </button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("show-password");

            // Toggle password visibility
            showPasswordCheckbox.addEventListener("change", function() {
                passwordInput.type = this.checked ? "text" : "password";
            });

            // Hapus event listener submit default
            document.getElementById("registrationForm").addEventListener("submit", function(e) {
                // Biarkan form submit secara normal
                // Hapus event.preventDefault() dan validasi JavaScript
            });
        });
    </script>
</body>
</html>