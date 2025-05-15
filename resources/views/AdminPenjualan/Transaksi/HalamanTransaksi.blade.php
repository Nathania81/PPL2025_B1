@extends('layouts.Admin')

@section('content')
    <h1>Data Transaksi</h1>

    <form method="GET" action="{{ route('ShowDataTransaksi') }}">
        <label>Filter Status:</label>
        <select name="status" onchange="this.form.submit()">
            <option value="">-- Semua --</option>
            @foreach($semua_status as $st)
                <option value="{{ $st->id }}" {{ $status == $st->id ? 'selected' : '' }}>
                    {{ $st->status_transaksi }}
                </option>
            @endforeach
        </select>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pembayaran</th>
                <th>Tanggal</th>
                <th>Metode Pengiriman</th>
                <th>Status Transaksi</th>
                <th>Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $trx->Kode_Pembayaran }}</td>
                    <td>{{ $trx->Tanggal_Transaksi }}</td>
                    <td>{{ $trx->metode_pengiriman }}</td>
                    <td>{{ $trx->status_transaksi }}</td>
                    <td>
                        <form action="{{ route('UbahStatusTransaksi', $trx->id) }}" method="POST">
                            @csrf
                            <select name="statustransaksi_id" onchange="this.form.submit()">
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
@endsection
