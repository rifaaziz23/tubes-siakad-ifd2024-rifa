<?php

namespace Database\Seeders;

use App\Models\Krs;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Seed the KRS data.
     */
    public function run(): void
    {
        $krsData = [
            ['npm' => '2021001001', 'kode_matakuliah' => 'IF101001'],
            ['npm' => '2021001001', 'kode_matakuliah' => 'IF101002'],
            ['npm' => '2021001001', 'kode_matakuliah' => 'IF101003'],
            ['npm' => '2021001002', 'kode_matakuliah' => 'IF101001'],
            ['npm' => '2021001002', 'kode_matakuliah' => 'IF101004'],
            ['npm' => '2021001003', 'kode_matakuliah' => 'IF101005'],
            ['npm' => '2021001003', 'kode_matakuliah' => 'IF101006'],
        ];

        foreach ($krsData as $krs) {
            Krs::create($krs);
        }
    }
}
