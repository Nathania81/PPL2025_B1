@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold text-center mb-10">Edit Produk</h1>

<form action="{{ route('admin.katalog.update', $katalog->id) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-10 rounded-2xl shadow-md">
    @csrf
    @method('PUT')

    {{-- Nama Produk --}}
    <div class="mb-6">
        <label for="nama_produk" class="block mb-2 font-medium text-secondary">Nama Produk</label>
        <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $katalog->nama_produk) }}" required
            class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-accent focus:outline-none">
    </div>

    {{-- Deskripsi --}}
    <div class="mb-6">
        <label for="deskripsi" class="block mb-2 font-medium text-secondary">Deskripsi Produk</label>
        <textarea id="deskripsi" name="deskripsi" rows="3" required
            class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-accent focus:outline-none">{{ old('deskripsi', $katalog->deskripsi) }}</textarea>
    </div>

    {{-- Harga --}}
    <div class="mb-6">
        <label for="harga" class="block mb-2 font-medium text-secondary">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $katalog->harga) }}" required
            class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-accent focus:outline-none">
    </div>

    {{-- Stok --}}
    <div class="mb-6">
        <label for="stok" class="block mb-2 font-medium text-secondary">Stok</label>
        <input type="number" id="stok" name="stok" value="{{ old('stok', $katalog->stok) }}" required
            class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-accent focus:outline-none">
    </div>

    {{-- Foto (Opsional) --}}
    <div class="mb-6">
        <label for="foto" class="block mb-2 font-medium text-secondary">Gambar Produk (kosongkan jika tidak diganti)</label>
        <input type="file" id="foto" name="foto" class="w-full border border-gray-300 p-3 rounded-md bg-white">
        @if ($katalog->foto)
            <img src="{{ asset('storage/' . $katalog->foto) }}" alt="Foto Lama" class="mt-3 w-32 h-32 object-cover rounded-md shadow">
        @endif
    </div>

    <button type="submit" class="bg-secondary text-white px-6 py-3 rounded-lg hover:bg-secondary/90 transition">
        Perbarui
    </button>
</form>
@endsection
