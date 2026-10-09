<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTokoSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user'      => 'USR000000000001',
            'nama_lengkap' => 'Maulida Nur',
            'email'        => 'maulida@gmail.com',
            'username'     => 'maulida',
            'password'     => 'admin123',
            'no_hp'        => '081234567898',
            'alamat'       => 'Jl. Melati 1, Bandung',
        ]);

        User::create([
            'id_user'      => 'USR000000000002',
            'nama_lengkap' => 'Martin Edward',
            'email'        => 'martin@gmail.com',
            'username'     => 'martin',
            'password'     => 'martin123',
            'no_hp'        => '089876543210',
            'alamat'       => 'Jl. Sudirman No. 5, Jakarta',
        ]);
    }
}