<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Role::factory()->create([
            'nama_role' => 'admin',
        ]);
        Role::factory()->create([
            'nama_role' => 'superadmin',
        ]);

        Role::factory()->create([
            'nama_role' => 'customer',
        ]);

        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'kota'=> 'Jakarta',
            'alamat'=> 'Jl. Test No. 1',
            'password' => '12345678',
            'role_id' => 1,
        ]);

    }
}
