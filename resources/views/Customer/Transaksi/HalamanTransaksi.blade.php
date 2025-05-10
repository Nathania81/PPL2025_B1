@extends('layouts.Customer')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Daftar Transaksi</h1>

        {{-- Filter Status --}}
        <form method="GET" class="mb-4">
            <label for="status">Filter Status:</label>
            <select name="status" id="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
                <option value="">-- Semua --</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Diproses</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Dikirim</option>
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Selesai</option>
            </select>
        </form>

        <table class="w-full table-auto border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Metode Pengiriman</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $transaksi)
                    <tr>
                        <td class="border p-2">{{ $transaksi->id }}</td>
                        <td class="border p-2">{{ $transaksi->Tanggal_Transaksi }}</td>
                        <td class="border p-2">{{ $transaksi->metode_pengiriman }}</td>
                        <td class="border p-2">{{ $transaksi->status_transaksi }}</td>
                        <td class="border p-2 text-center">
                            @if($transaksi->statustransaksi_id == 2)
                                {{-- Hanya jika status Dikirim --}}
                                <form action="{{ route('KonfirmasiSelesai', $transaksi->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                        Pesanan Diterima
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border p-2 text-center text-gray-500">Tidak ada transaksi ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
