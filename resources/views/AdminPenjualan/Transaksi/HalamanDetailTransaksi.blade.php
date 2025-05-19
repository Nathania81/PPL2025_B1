@extends('layouts.Admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Detail Transaksi</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 text-sm text-gray-700">
        <div class="flex justify-between">
            <span class="font-semibold">Tanggal Transaksi:</span>
            <span>{{ $transaksi->Tanggal_Transaksi }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Status:</span>
            <span>{{ $transaksi->statustransaksi_id }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Metode Pengiriman:</span>
            <span>{{ $transaksi->metodepengiriman_id }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Kode Pembayaran:</span>
            <span>{{ $transaksi->Kode_Pembayaran }}</span>
        </div>
    </div>

    <h3 class="text-xl font-bold mb-3 text-gray-800">Produk dalam Transaksi</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border-b text-left">Produk</th>
                    <th class="py-2 px-4 border-b text-center">Jumlah</th>
                    <th class="py-2 px-4 border-b text-right">Harga Satuan</th>
                    <th class="py-2 px-4 border-b text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_transaksi as $item)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $item->nama_produk }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $item->Jumlah_Produk }}</td>
                    <td class="py-2 px-4 border-b text-right">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border-b text-right">
                        Rp{{ number_format($item->Jumlah_Produk * $item->harga_satuan, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
