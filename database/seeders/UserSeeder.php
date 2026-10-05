<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'     => 'maulida',
            'nama_lengkap' => 'Maulida Nur',
            'password'     => 'admin123',  // otomatis dihash oleh cast 'hashed'
        ]);

        User::create([
            'username'     => 'ryul',
            'nama_lengkap' => 'Kim Ryul',
            'password'     => 'admin123',
        ]);
    }
}
