<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('katalog')->insert([
            [
                'nama_produk' => 'Susu Sapi Murni',
                'deskripsi' => 'Susu sapi segar langsung dari peternakan Rembangan, tanpa pengawet',
                'stok' => 150,
                'harga' => 12000.00,
                'foto' => 'susu-murni.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_produk' => 'Susu Coklat',
                'deskripsi' => 'Susu sapi dengan varian rasa coklat yang lezat',
                'stok' => 80,
                'harga' => 15000.00,
                'foto' => 'susu-coklat.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
