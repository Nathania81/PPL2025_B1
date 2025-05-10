<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Katalog;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Transaksi = Transaksi::first();
        $Katalog = Katalog::first();

        DB::table('Detail_Transaksis')->insert([
            'katalog_id' => $Katalog->id,
            'transaksi_id' => $Transaksi->id,
            'Jumlah_Produk' => 100,
            'Harga' => $Katalog->harga

        ]);

    }
}
