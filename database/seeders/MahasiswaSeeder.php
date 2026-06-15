<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Seed the mahasiswa data.
     */
    public function run(): void
    {
        $mahasiswaData = [
            ['npm' => '2021001001', 'nidn' => '0101017001', 'nama' => 'Muhammad Rifa Maulana Aziz',     'email' => 'rifa@unsur.ac.id'],
            ['npm' => '2021001002', 'nidn' => '0101017001', 'nama' => 'Bela Safitri',     'email' => 'bela@unsur.ac.id'],
            ['npm' => '2021001003', 'nidn' => '0202028001', 'nama' => 'Candra Wijaya',    'email' => 'candra@unsur.ac.id'],
            ['npm' => '2021001004', 'nidn' => '0202028001', 'nama' => 'Dewi Kusuma',      'email' => 'dewi@unsur.ac.id'],
            ['npm' => '2021001005', 'nidn' => '0303039001', 'nama' => 'Eko Prasetyo',     'email' => 'eko@unsur.ac.id'],
        ];

        foreach ($mahasiswaData as $mhs) {
            $user = User::create([
                'name'     => $mhs['nama'],
                'email'    => $mhs['email'],
                'password' => Hash::make('123'),
                'role'     => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'npm'     => $mhs['npm'],
                'nidn'    => $mhs['nidn'],
                'nama'    => $mhs['nama'],
                'user_id' => $user->id,
            ]);
        }
    }
}
