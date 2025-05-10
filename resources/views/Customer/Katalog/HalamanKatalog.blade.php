@extends('layouts.Customer')

@section('content')
    <h1 class="text-xl font-bold mb-4">Katalog Produk</h1>

    <form action="{{ route('KlikBeliSekarang') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            @foreach($katalogs as $katalog)
                <div class="border rounded p-4">
                    <h2 class="font-semibold">{{ $katalog->nama_produk }}</h2>
                    <p>Rp{{ number_format($katalog->harga, 0, ',', '.') }}</p>
                    <label class="inline-flex items-center mt-2">
                        <input type="checkbox" name="katalog[]" value="{{ $katalog->id }}">
                        <span class="ml-2">Pilih Produk Ini</span>
                    </label>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Beli Sekarang
            </button>
        </div>
    </form>
@endsection
