@extends('layouts.Customer')

@section('content')
    <form action="{{ route('KlikBuatPesanan') }}" method="POST">
        @csrf

        <div>
            <h1 class="text-xl font-bold mb-4">Form Transaksi</h1>

            {{-- Alamat Pengiriman (bisa dikembangkan pakai profil user) --}}
            <div class="mb-4">
                <p class="font-semibold">Alamat Pengiriman:</p>
                <p>MASIH BELUM (nanti ambil dari profil user)</p>
            </div>

            {{-- Produk yang dibeli --}}
            <div class="mb-4">
                <p class="font-semibold">Produk yang Dibeli:</p>
                @if($katalog && $katalog->count())
                    @foreach($katalog as $item)
                        <div class="mb-2 border rounded px-3 py-2">
                            <span>{{ $item->nama_produk }} - Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                            <input type="hidden" name="katalog_id[]" value="{{ $item->id }}">
                        </div>
                    @endforeach
                @else
                    <p>Tidak ada produk dipilih.</p>
                @endif
            </div>

            {{-- Metode Pengiriman --}}
            <div class="mb-4">
                <p class="font-semibold">Metode Pengiriman:</p>
                <select name="metodepengiriman_id" class="border px-2 py-1 rounded" required>
                    @foreach ($MetodePengiriman as $metode)
                        <option value="{{ $metode->id }}">{{ $metode->metode_pengiriman }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status Transaksi default "Selesai" --}}
            <input type="hidden" name="statustransaksi_id" value="2">

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Buat Pesanan
            </button>
        </div>
    </form>
@endsection
