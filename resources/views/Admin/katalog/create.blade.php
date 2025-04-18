@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-secondary mb-6">Tambah Produk Baru</h1>
        
        <form action="{{ route('katalog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="nama_produk" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required></textarea>
            </div>

            <!-- Harga & Stok -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="harga" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stok" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
                </div>
            </div>

            <!-- Foto Produk -->
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Foto Produk</label>
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-accent" required>
                <p class="text-sm text-gray-500 mt-1">Format: JPEG/PNG (Max 2MB)</p>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" class="bg-secondary hover:bg-secondary/90 text-white px-6 py-2 rounded-lg transition duration-300">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection