@extends('layouts.Admin')

@section('content')
<div class="p-6 max-w-6xl mx-auto bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Data Transaksi</h1>

    <form method="GET" action="{{ route('ShowDataTransaksi') }}" class="mb-6 flex items-center gap-4 bg-gray-50 p-4 rounded-lg">
        <label for="status" class="text-sm font-medium text-gray-700">Filter Status:</label>
        <select name="status" id="status" onchange="this.form.submit()"
                class="border border-gray-300 rounded-md px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            <option value="">-- Semua --</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Diproses</option>
            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Dikirim</option>
            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Selesai</option>
        </select>
    </form>

    <div class="overflow-x-auto rounded-lg border border-gray-900 shadow-sm">
        <table class="min-w-full divide-y divide-gray-900">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Kode Pembayaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Metode Pengiriman</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Status Transaksi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Ubah Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($transaksis as $index => $trx)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:underline">
                        <a href="{{ route('ShowDetailTransaksi', ['id' => $trx->id]) }}">
                            {{ $index + 1 }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trx->Kode_Pembayaran }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trx->Tanggal_Transaksi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trx->metode_pengiriman }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($trx->statustransaksi_id == 1) bg-yellow-100 text-yellow-800
                            @elseif($trx->statustransaksi_id == 2) bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ $trx->status_transaksi }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <form action="{{ route('UbahStatusTransaksi', $trx->id) }}" method="POST">
                            @csrf
                            <select name="statustransaksi_id" onchange="this.form.submit()"
                                    class="border border-gray-900 rounded-md px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                @foreach($semua_status as $st)
                                    <option value="{{ $st->id }}" {{ ($trx->statustransaksi_id == $st->id) ? 'selected' : '' }}>
                                        {{ $st->status_transaksi }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
