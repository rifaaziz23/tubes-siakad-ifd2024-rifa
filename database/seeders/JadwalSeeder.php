<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Seed the jadwal data.
     */
    public function run(): void
    {
        $jadwalData = [
            ['kode_matakuliah' => 'IF101001', 'nidn' => '0101017001', 'kelas' => 'A', 'hari' => 'Senin',   'jam' => '2024-01-01 07:30:00'],
            ['kode_matakuliah' => 'IF101002', 'nidn' => '0101017001', 'kelas' => 'A', 'hari' => 'Selasa',  'jam' => '2024-01-01 09:00:00'],
            ['kode_matakuliah' => 'IF101003', 'nidn' => '0202028001', 'kelas' => 'A', 'hari' => 'Rabu',    'jam' => '2024-01-01 10:30:00'],
            ['kode_matakuliah' => 'IF101004', 'nidn' => '0202028001', 'kelas' => 'B', 'hari' => 'Kamis',   'jam' => '2024-01-01 13:00:00'],
            ['kode_matakuliah' => 'IF101005', 'nidn' => '0303039001', 'kelas' => 'A', 'hari' => 'Jumat',   'jam' => '2024-01-01 07:30:00'],
            ['kode_matakuliah' => 'IF101006', 'nidn' => '0303039001', 'kelas' => 'B', 'hari' => 'Senin',   'jam' => '2024-01-01 13:00:00'],
            ['kode_matakuliah' => 'IF101007', 'nidn' => '0101017001', 'kelas' => 'B', 'hari' => 'Rabu',    'jam' => '2024-01-01 07:30:00'],
            ['kode_matakuliah' => 'IF101008', 'nidn' => '0202028001', 'kelas' => 'A', 'hari' => 'Selasa',  'jam' => '2024-01-01 13:00:00'],
        ];

        foreach ($jadwalData as $j) {
            Jadwal::create($j);
        }
    }
}
