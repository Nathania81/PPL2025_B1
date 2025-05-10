<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Transaksi = Transaksi::first();

        DB::table('Notifikasi')->insert([
            'transaksi_id' => $Transaksi->id,
            'pesan_notifikasi' => 'udah yaaa'
        ]);
    }
}
