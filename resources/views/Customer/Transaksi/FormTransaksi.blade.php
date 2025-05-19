@extends('layouts.Customer')

@section('content')
<form action="{{ route('KlikBuatPesanan') }}" method="POST">
    @csrf

    <div class="p-4 bg-white rounded shadow-md max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Form Transaksi</h1>

        {{-- Alamat Pengiriman --}}
        <div class="mb-4">
            <p class="font-semibold">Alamat Pengiriman:</p>
            <p class="text-gray-600">MASIH BELUM (nanti ambil dari profil user)</p>
        </div>

        {{-- Produk --}}
        <div class="mb-4">
            <p class="font-semibold mb-2">Produk yang Dibeli:</p>
            @foreach($katalog as $index => $item)
                <div class="flex justify-between items-center border p-3 mb-2 rounded">
                    <div>
                        <p>{{ $item->nama_produk }}</p>
                        <p class="text-sm text-gray-600">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center">
                        <button type="button" onclick="decreaseQty({{ $index }})" class="px-2 bg-gray-300 rounded">-</button>
                        <input type="number" name="jumlah_produk[]" id="qty-{{ $index }}" value="1" min="1" class="mx-2 w-12 text-center border rounded">
                        <button type="button" onclick="increaseQty({{ $index }})" class="px-2 bg-gray-300 rounded">+</button>
                    </div>
                    <input type="hidden" name="katalog_id[]" value="{{ $item->id }}">
                    <input type="hidden" name="harga_produk[]" value="{{ $item->harga }}">
                </div>
            @endforeach
        </div>

        {{-- Total Harga --}}
        <div class="mb-4">
            <p class="font-semibold">Total Harga: Rp<span id="totalHarga">0</span></p>
        </div>

        {{-- Metode Pengiriman --}}
        <div class="mb-4">
            <p class="font-semibold">Metode Pengiriman:</p>
            <select name="metodepengiriman_id" class="border px-3 py-2 rounded w-full" required>
                @foreach ($MetodePengiriman as $metode)
                    <option value="{{ $metode->id }}">{{ $metode->metode_pengiriman }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="statustransaksi_id" value="2">

        {{-- Submit --}}
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
            Buat Pesanan
        </button>
    </div>
</form>

<script>
    function updateTotal() {
        let hargaInputs = document.getElementsByName('harga_produk[]');
        let jumlahInputs = document.getElementsByName('jumlah_produk[]');
        let total = 0;

        for (let i = 0; i < hargaInputs.length; i++) {
            let harga = parseInt(hargaInputs[i].value);
            let jumlah = parseInt(jumlahInputs[i].value);
            total += harga * jumlah;
        }

        document.getElementById('totalHarga').innerText = total.toLocaleString('id-ID');
    }

    function increaseQty(index) {
        let qtyInput = document.getElementById('qty-' + index);
        qtyInput.value = parseInt(qtyInput.value) + 1;
        updateTotal();
    }

    function decreaseQty(index) {
        let qtyInput = document.getElementById('qty-' + index);
        if (qtyInput.value > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            updateTotal();
        }
    }

    document.addEventListener('DOMContentLoaded', updateTotal);
</script>
@endsection
