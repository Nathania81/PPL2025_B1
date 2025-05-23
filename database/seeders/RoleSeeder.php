<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nama_role' => 'Superadmin'],
            ['id' => 2, 'nama_role' => 'Admin Penjualan'],
            ['id' => 3, 'nama_role' => 'Customer'],
        ]);
    }
}
