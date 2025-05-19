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

    public function KlikSimpan(Request $request)
    {
        DB::beginTransaction();

        try {
            $transaksiId = DB::table('transaksis')->insertGetId([
                'metodepengiriman_id' => 3,
                'statustransaksi_id' => 3,
                'tanggal_transaksi' => now(),
                'Kode_Pembayaran' => '1222',
            ]);

            foreach ($request->produk_terpilih as $katalogId) {
                DB::table('detail_transaksis')->insert([
                    'katalog_id' => $katalogId,
                    'transaksi_id' => $transaksiId,
                    'Jumlah_Produk' => $request->jumlah_produk[$katalogId],
                    'Harga' => $request->harga_total[$katalogId],
                ]);
            }

            DB::commit();
            return redirect()->route('FormKasir')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }


    // Membuat Data Transaksi Customer

    public function KlikBeliSekarang(Request $request)
    {
        $request->session()->put('keranjang', $request->input('katalog'));
        return redirect()->route('ShowFormTransaksi');
    }

    public function ShowFormTransaksi(Request $request)
    {
        $keranjang = $request->session()->get('keranjang', []);

        // Jika keranjang kosong, redirect ke katalog dengan pesan error
        if (empty($keranjang)) {
            return redirect()->route('ShowDataKatalog')->with('error', 'Produk masih 0, mohon untuk mengisi produk.');
        }

        $MetodePengiriman = DB::table('metode_pengirimans')->get();
        $katalog = DB::table('katalog')->whereIn('id', $keranjang)->get();

        return view('Customer.Transaksi.FormTransaksi', compact('katalog', 'MetodePengiriman'));
    }


    public function KlikBuatPesanan(Request $request)
    {
        $request->validate([
            'metodepengiriman_id' => 'required|exists:metode_pengirimans,id',
            'katalog_id' => 'required|array',
            'jumlah_produk' => 'required|array',
            'harga_produk' => 'required|array',
        ]);

        $transaksiId = DB::table('transaksis')->insertGetId([
            'metodepengiriman_id' => $request->metodepengiriman_id,
            'statustransaksi_id' => 1,
            'Kode_Pembayaran' => rand(100000, 999999),
            'Tanggal_Transaksi' => now()
        ]);

        foreach ($request->katalog_id as $index => $id) {
            $jumlah = (int) $request->jumlah_produk[$index];
            $hargaSatuan = (int) $request->harga_produk[$index];
            $totalHarga = $jumlah * $hargaSatuan;

            DB::table('detail_transaksis')->insert([
                'transaksi_id' => $transaksiId,
                'katalog_id' => $id,
                'Jumlah_Produk' => $jumlah,
                'Harga' => $totalHarga
            ]);
        }

        $request->session()->forget('keranjang');

        return redirect()->route('ShowDataKatalog')->with('success', 'Transaksi berhasil!');
    }


    // Melihat dan mengubah status Transaksi Admin
    public function ShowDataTransaksi(Request $request)
    {
        $semua_status = DB::table('status_transaksis')->get();
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

        return view('Customer.Transaksi.HalamanTransaksi', compact('transaksis'));
    }

    public function KonfirmasiSelesai($id)
    {
        $transaksi = DB::table('transaksis')->where('id', $id)->first();

        if ($transaksi && $transaksi->statustransaksi_id == 2) { // 3 = Dikirim
            DB::table('transaksis')->where('id', $id)->update([
                'statustransaksi_id' => 3 // 4 = Selesai
            ]);
        }

        return back()->with('success', 'Pesanan telah diselesaikan.');
    }

    // Halaman detail transaksi admin
    public function ShowDetailTransaksi($id)
    {
        $transaksi = DB::table('transaksis')
            ->leftJoin('status_transaksis', 'transaksis.statustransaksi_id', '=', 'status_transaksis.id')
            ->leftJoin('metode_pengirimans', 'transaksis.metodepengiriman_id', '=', 'metode_pengirimans.id')
            ->where('transaksis.id', $id)
            ->select('transaksis.*', 'status_transaksis.status_transaksi', 'metode_pengirimans.metode_pengiriman')
            ->first();

        $detail_transaksi = DB::table('detail_transaksis')
            ->join('katalog', 'detail_transaksis.katalog_id', '=', 'katalog.id')
            ->where('transaksi_id', $id)
            ->select('detail_transaksis.*', 'katalog.nama_produk', 'katalog.harga as harga_satuan')
            ->get();

        return view('AdminPenjualan.Transaksi.HalamanDetailTransaksi', compact('transaksi', 'detail_transaksi'));
    }

    public function ShowDetailTransaksiCust($id)
    {
        $transaksi = DB::table('transaksis')
            ->leftJoin('status_transaksis', 'transaksis.statustransaksi_id', '=', 'status_transaksis.id')
            ->leftJoin('metode_pengirimans', 'transaksis.metodepengiriman_id', '=', 'metode_pengirimans.id')
            ->where('transaksis.id', $id)
            ->select('transaksis.*', 'status_transaksis.status_transaksi', 'metode_pengirimans.metode_pengiriman')
            ->first();

        $detail_transaksi = DB::table('detail_transaksis')
            ->join('katalog', 'detail_transaksis.katalog_id', '=', 'katalog.id')
            ->where('transaksi_id', $id)
            ->select('detail_transaksis.*', 'katalog.nama_produk', 'katalog.harga as harga_satuan')
            ->get();

        return view('AdminPenjualan.Transaksi.HalamanDetailTransaksi', compact('transaksi', 'detail_transaksi'));
    }

}


