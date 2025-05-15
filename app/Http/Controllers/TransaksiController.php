<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Form Kasir
    public function ShowFormKasir()
    {
        $katalogs = DB::table('katalog')->get();
        return view('AdminPenjualan.Transaksi.FormKasir', compact('katalogs'));
    }

    public function KlikSimpan(Request $request){
        $transaksiId = DB::table('transaksis')->insertGetId([
            'metodepengiriman_id' => 3,
            'statustransaksi_id' => 3,
            'tanggal_transaksi' => now(),
            'Kode_Pembayaran' => '1222',
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);

        foreach ($request->produk_terpilih as $KatalogId) {
        DB::table('detail_transaksis')->insert([
            'katalog_id' => $KatalogId,
            'transaksi_id' => $transaksiId,
            'Jumlah_Produk' => 10,
            'Harga' => 1000
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);
    }

        DB::commit();
        return redirect()->route('FormKasir')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Membuat Data Transaksi Customer

    public function KlikBeliSekarang(Request $request)
    {
        $request->session()->put('keranjang', $request->input('katalog'));
        return redirect()->route('ShowFormTransaksi');
    }

    public function ShowFormTransaksi(Request $request)
    {
        $MetodePengiriman = DB::table('metode_pengirimans')->get();
        $keranjang = $request->session()->get('keranjang', []);
        $katalog = DB::table('katalog')->whereIn('id', $keranjang)->get();

        return view('Customer.Transaksi.FormTransaksi', compact('katalog', 'MetodePengiriman'));
    }

    public function KlikBuatPesanan(Request $request)
    {
        $request->validate([
            'metodepengiriman_id' => 'required|exists:metode_pengirimans,id',
        ]);

        $transaksiId = DB::table('transaksis')->insertGetId([
            'metodepengiriman_id' => $request->metodepengiriman_id,
            'statustransaksi_id' => 2,
            'Kode_Pembayaran' => 7,
            'Tanggal_Transaksi' => now()
        ]);

        foreach ($request->katalog_id as $index => $id) {
            DB::table('detail_transaksis')->insert([
                'transaksi_id' => $transaksiId,
                'katalog_id' => $id,
                'Jumlah_Produk' => 2,
                'Harga' => 22
            ]);
        }

        $request->session()->forget('keranjang');

        return redirect()->route('ShowDataKatalog')->with('success', 'Transaksi berhasil!');
    }

    // Melihat dan mengubah status Transaksi Admin
    public function ShowDataTransaksi(Request $request)
    {
        $status = $request->input('status');
        $query = DB::table('transaksis')
            ->join('metode_pengirimans', 'transaksis.metodepengiriman_id', '=', 'metode_pengirimans.id')
            ->join('status_transaksis', 'transaksis.statustransaksi_id', '=', 'status_transaksis.id')
            ->select(
                'transaksis.*',
                'metode_pengirimans.metode_pengiriman as metode_pengiriman',
                'status_transaksis.status_transaksi as status_transaksi'
            );

        if ($status) {
            $query->where('transaksis.statustransaksi_id', $status);
        }

        $transaksis = $query->get();

        $semua_status = DB::table('status_transaksis')->get();
        dd($semua_status);

        return view('AdminPenjualan.Transaksi.HalamanTransaksi', compact('transaksis', 'semua_status', 'status'));
    }

    public function UbahStatusTransaksi(Request $request, $id)
    {
        DB::table('transaksis')->where('id', $id)->update([
            'statustransaksi_id' => $request->input('statustransaksi_id')
        ]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    // Melihat dan mengubah status transaksi customer
    public function TransaksiCustomer(Request $request)
    {
        $query = DB::table('transaksis')
            ->join('metode_pengirimans', 'transaksis.metodepengiriman_id', '=', 'metode_pengirimans.id')
            ->join('status_transaksis', 'transaksis.statustransaksi_id', '=', 'status_transaksis.id')
            ->select(
                'transaksis.*',
                'metode_pengirimans.metode_pengiriman as metode_pengiriman',
                'status_transaksis.status_transaksi as status_transaksi'
            );

        if ($request->has('status') && $request->status != '') {
            $query->where('transaksis.statustransaksi_id', $request->status);
        }

        $transaksis = $query->get();
        $semua_status = DB::table('status_transaksis')->get();
        dd($semua_status);

        return view('Customer.Transaksi.HalamanTransaksi', compact('transaksis', 'semua_status'));
    }

    public function KonfirmasiSelesai($id)
    {
        $transaksis = DB::table('transaksis')->where('id', $id)->first();

        if ($transaksis && $transaksis->statustransaksi_id == 3) { // 3 = Dikirim
            DB::table('transaksis')->where('id', $id)->update([
                'statustransaksi_id' => 4 // 4 = Selesai
            ]);
        }

        return back()->with('success', 'Pesanan telah diselesaikan.');
    }


}


