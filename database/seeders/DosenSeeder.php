<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Seed the dosen data.
     */
    public function run(): void
    {
        $dosenUsers = [
            ['name' => 'Lalan Jaelani, S.T, M.Kom',      'email' => 'lalan@unsur.ac.id'],
            ['name' => 'Tarmin Abdul Ghani, S.T, M.T',   'email' => 'tag@unsur.ac.id'],
            ['name' => 'Finsa Nurpandi, S.T, M.T',                 'email' => 'finsa@unsur.ac.id'],
        ];

        $dosenNIDN = ['0101017001', '0202028001', '0303039001'];

        foreach ($dosenUsers as $i => $du) {
            $user = User::create([
                'name'     => $du['name'],
                'email'    => $du['email'],
                'password' => Hash::make('123'),
                'role'     => 'admin',
            ]);

            Dosen::create([
                'nidn'    => $dosenNIDN[$i],
                'nama'    => $du['name'],
                'user_id' => $user->id,
            ]);
        }
    }
}
