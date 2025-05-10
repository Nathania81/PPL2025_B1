<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metode_pengirimans')->insert([
            'metode_pengiriman' => 'JNE'
        ]);

        DB::table('metode_pengirimans')->insert([
            'metode_pengiriman' => 'JNT'
        ]);

        DB::table('metode_pengirimans')->insert([
            'metode_pengiriman' => 'COD'
        ]);
    }
}
