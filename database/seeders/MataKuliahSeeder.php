<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Seed the mata kuliah data.
     */
    public function run(): void
    {
        $mataKuliah = [
            ['kode_matakuliah' => 'IF101001', 'nama_matakuliah' => 'Algoritma dan Pemrograman',     'sks' => 3],
            ['kode_matakuliah' => 'IF101002', 'nama_matakuliah' => 'Basis Data',                    'sks' => 3],
            ['kode_matakuliah' => 'IF101003', 'nama_matakuliah' => 'Pemrograman Web',               'sks' => 3],
            ['kode_matakuliah' => 'IF101004', 'nama_matakuliah' => 'Jaringan Komputer',             'sks' => 3],
            ['kode_matakuliah' => 'IF101005', 'nama_matakuliah' => 'Sistem Operasi',                'sks' => 2],
            ['kode_matakuliah' => 'IF101006', 'nama_matakuliah' => 'Kalkulus',                     'sks' => 3],
            ['kode_matakuliah' => 'IF101007', 'nama_matakuliah' => 'Struktur Data',                'sks' => 3],
            ['kode_matakuliah' => 'IF101008', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak',     'sks' => 3],
        ];

        foreach ($mataKuliah as $mk) {
            MataKuliah::create($mk);
        }
    }
}
