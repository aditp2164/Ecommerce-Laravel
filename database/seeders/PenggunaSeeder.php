<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        Pengguna::create([
            'nama' => 'Admin',
            'username' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        Pengguna::create([
            'nama' => 'User1',
            'username' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);
    }
}

