@extends('layouts.customer', ['hideNavbar' => true])

@section('content')
<div class="flex items-center justify-center min-h-screen bg-lightbg">
    <div class="w-[600px] bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Ubah Profil</h2>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" 
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                @error('nama')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">No. Telepon</label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon ?? '') }}" 
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                @error('no_telepon')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Wilayah Selector -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kota/Kabupaten</label>
                <select id="kota" name="kota" required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Pilih Kota/Kabupaten</option>
                    @if($profil->kota)
                        <option value="{{ $profil->kota }}" selected data-is-old="true">{{ $profil->kota }}</option>
                    @endif
                </select>
                @error('kota')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Pilih Kecamatan</option>
                    @if($profil->kecamatan)
                        <option value="{{ $profil->kecamatan }}" selected data-is-old="true">{{ $profil->kecamatan }}</option>
                    @endif
                </select>
                @error('kecamatan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Kelurahan/Desa</label>
                <select id="kelurahan" name="kelurahan" required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">Pilih Kelurahan/Desa</option>
                    @if($profil->kelurahan)
                        <option value="{{ $profil->kelurahan }}" selected data-is-old="true">{{ $profil->kelurahan }}</option>
                    @endif
                </select>
                @error('kelurahan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                <textarea name="alamat" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary"
                        rows="3">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                @error('alamat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('profil.show') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", async function () {
        const kotaSelect = document.getElementById("kota");
        const kecamatanSelect = document.getElementById("kecamatan");
        const kelurahanSelect = document.getElementById("kelurahan");

        // Data yang sudah ada
        const existingData = {
            kota: "{{ $profil->kota ?? '' }}",
            kecamatan: "{{ $profil->kecamatan ?? '' }}",
            kelurahan: "{{ $profil->kelurahan ?? '' }}"
        };

        // Cache untuk data wilayah
        const wilayahCache = {
            kota: [],
            kecamatan: [],
            kelurahan: []
        };

        // Fungsi untuk memeriksa apakah opsi sudah ada
        function optionExists(selectElement, value) {
            return Array.from(selectElement.options).some(opt => opt.value === value);
        }

        async function loadKota() {
            try {
                const response = await fetch("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/35.json");
                const data = await response.json();
                wilayahCache.kota = data;
                
                data.forEach(kota => {
                    if (!optionExists(kotaSelect, kota.name)) {
                        const option = new Option(kota.name, kota.name);
                        option.dataset.id = kota.id;
                        kotaSelect.add(option);
                    }
                });
                
                // Set nilai yang sudah ada jika ada
                if (existingData.kota) {
                    kotaSelect.value = existingData.kota;
                    await loadKecamatan(existingData.kota);
                }
            } catch (error) {
                console.error("Gagal memuat data kota:", error);
                // Jika error, setidaknya opsi lama tetap ada
                if (existingData.kota) {
                    kotaSelect.value = existingData.kota;
                }
            }
        }

        // Fungsi untuk memuat kecamatan
        async function loadKecamatan(kotaName) {
            try {
                const kota = wilayahCache.kota.find(k => k.name === kotaName);
                if (!kota) return;

                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kota.id}.json`);
                const data = await response.json();
                wilayahCache.kecamatan = data;
                
                // Simpan opsi lama terlebih dahulu
                const oldKecamatan = kecamatanSelect.querySelector('[data-is-old]');
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                
                if (oldKecamatan) {
                    kecamatanSelect.add(oldKecamatan);
                }
                
                // Tambahkan opsi baru
                data.forEach(kec => {
                    if (!optionExists(kecamatanSelect, kec.name)) {
                        const option = new Option(kec.name, kec.name);
                        option.dataset.id = kec.id;
                        kecamatanSelect.add(option);
                    }
                });
                
                // Set nilai yang sudah ada jika ada
                if (existingData.kecamatan) {
                    kecamatanSelect.value = existingData.kecamatan;
                    await loadKelurahan(existingData.kecamatan);
                }
            } catch (error) {
                console.error("Gagal memuat data kecamatan:", error);
                // Jika error, setidaknya opsi lama tetap ada
                if (existingData.kecamatan) {
                    kecamatanSelect.value = existingData.kecamatan;
                }
            }
        }

        // Fungsi untuk memuat kelurahan
        async function loadKelurahan(kecamatanName) {
            try {
                const kecamatan = wilayahCache.kecamatan.find(k => k.name === kecamatanName);
                if (!kecamatan) return;

                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatan.id}.json`);
                const data = await response.json();
                wilayahCache.kelurahan = data;
                
                // Simpan opsi lama terlebih dahulu
                const oldKelurahan = kelurahanSelect.querySelector('[data-is-old]');
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                
                if (oldKelurahan) {
                    kelurahanSelect.add(oldKelurahan);
                }
                
                // Tambahkan opsi baru
                data.forEach(kel => {
                    if (!optionExists(kelurahanSelect, kel.name)) {
                        const option = new Option(kel.name, kel.name);
                        kelurahanSelect.add(option);
                    }
                });
                
                // Set nilai yang sudah ada jika ada
                if (existingData.kelurahan) {
                    kelurahanSelect.value = existingData.kelurahan;
                }
            } catch (error) {
                console.error("Gagal memuat data kelurahan:", error);
                // Jika error, setidaknya opsi lama tetap ada
                if (existingData.kelurahan) {
                    kelurahanSelect.value = existingData.kelurahan;
                }
            }
        }

        // Event listeners
        kotaSelect.addEventListener("change", async () => {
            await loadKecamatan(kotaSelect.value);
        });

        kecamatanSelect.addEventListener("change", async () => {
            await loadKelurahan(kecamatanSelect.value);
        });

        // Inisialisasi
        await loadKota();
    });
</script>
@endsection