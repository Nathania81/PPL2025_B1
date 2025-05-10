<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MetodePengirimans;
use App\Models\StatusTransaksi;
use App\Models\Profil;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Profil = Profil::first();
        $Metode_Pengiriman = MetodePengirimans::first();

        $Status_Transaksi = StatusTransaksi::first();

        DB::table('transaksis')->insert([
            // 'profil_id' => $Profil,
            'metodepengiriman_id' => $Metode_Pengiriman->id,
            'statustransaksi_id' => $Status_Transaksi->id,
            'Kode_Pembayaran' => '1122',
            'Tanggal_Transaksi' => now()
        ]);
    }
}
