<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. admeen
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
            'nim'      => null,
            'prodi'    => null,
            'semester' => null,
            'angkatan' => null,
        ]);

        // 2. mahasigma
        User::create([
            'name'     => 'Sulis Rahayu',
            'email'    => 'sulis@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'mahasiswa',
            'nim'      => '220102034',
            'prodi'    => 'Teknik Informatika',
            'semester' => 4,
            'angkatan' => '2022',
        ]);

        // 3. dammy mahasiswa
        $prodiList = ['Teknik Informatika', 'Teknik Mesin', 'Teknik Listrik'];
        
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name'     => 'Mahasiswa Dummy ' . $i,
                'email'    => 'student' . $i . '@example.com',
                'password' => Hash::make('password123'),
                'role'     => 'mahasiswa',
                'nim'      => '22010' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'prodi'    => $prodiList[array_rand($prodiList)],
                'semester' => rand(1, 8),
                'angkatan' => (string) rand(2020, 2023),
            ]);
        }
    }
}