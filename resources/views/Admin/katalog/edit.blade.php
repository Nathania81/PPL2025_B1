@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-secondary mb-6">Edit Produk</h1>
        
        <form action="{{ route('katalog.update', $katalog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Preview Foto -->
            <div class="mb-4 text-center">
                <img src="{{ asset('storage/' . $katalog->foto) }}" alt="Foto Produk" class="w-40 h-40 object-cover mx-auto rounded-lg">
            </div>

            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $katalog->nama_produk) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>{{ old('deskripsi', $katalog->deskripsi) }}</textarea>
            </div>

            <!-- Harga & Stok -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" min="0" value="{{ old('harga', $katalog->harga) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stok" min="0" value="{{ old('stok', $katalog->stok) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
                </div>
            </div>

            <!-- Foto Produk (Optional) -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Ganti Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <a href="{{ route('katalog.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-300">
                    Kembali
                </a>
                <button type="submit" class="bg-secondary hover:bg-secondary/90 text-white px-6 py-2 rounded-lg transition duration-300">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection