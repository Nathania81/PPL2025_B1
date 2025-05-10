<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_transaksis')->insert([
            'status_transaksi' => 'Diproses'
        ]);

        DB::table('status_transaksis')->insert([
            'status_transaksi' => 'Dikirim'
        ]);

        DB::table('status_transaksis')->insert([
            'status_transaksi' => 'Selesai'
        ]);
    }
}
