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
            ['kode_matakuliah' => 'IF101001', 'nidn' => '0101017001', 'kelas' => 'A', 'hari' => 'Senin',   'jam_mulai' => '07:30', 'jam_selesai' => '09:10'],
            ['kode_matakuliah' => 'IF101002', 'nidn' => '0101017001', 'kelas' => 'A', 'hari' => 'Selasa',  'jam_mulai' => '09:00', 'jam_selesai' => '10:40'],
            ['kode_matakuliah' => 'IF101003', 'nidn' => '0202028001', 'kelas' => 'A', 'hari' => 'Rabu',    'jam_mulai' => '10:30', 'jam_selesai' => '12:10'],
            ['kode_matakuliah' => 'IF101004', 'nidn' => '0202028001', 'kelas' => 'B', 'hari' => 'Kamis',   'jam_mulai' => '13:00', 'jam_selesai' => '14:40'],
            ['kode_matakuliah' => 'IF101005', 'nidn' => '0303039001', 'kelas' => 'A', 'hari' => 'Jumat',   'jam_mulai' => '07:30', 'jam_selesai' => '09:10'],
            ['kode_matakuliah' => 'IF101006', 'nidn' => '0303039001', 'kelas' => 'B', 'hari' => 'Senin',   'jam_mulai' => '13:00', 'jam_selesai' => '14:40'],
            ['kode_matakuliah' => 'IF101007', 'nidn' => '0101017001', 'kelas' => 'B', 'hari' => 'Rabu',    'jam_mulai' => '07:30', 'jam_selesai' => '09:10'],
            ['kode_matakuliah' => 'IF101008', 'nidn' => '0202028001', 'kelas' => 'A', 'hari' => 'Selasa',  'jam_mulai' => '13:00', 'jam_selesai' => '14:40'],
        ];

        foreach ($jadwalData as $j) {
            Jadwal::create($j);
        }
    }
}
