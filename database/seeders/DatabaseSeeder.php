<?php

namespace Database\Seeders;

use App\Models\User;
use App\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $userData = [
            'kepala rekam medik' => [
                'name' => 'Kepala Rekam Medik',
                'username' => 'kepala',
                'password' => 'password',
                'role' => Role::KepalaRekamMedik
            ],
            'petugas loket' => [
                'name' => 'Petugas Loket',
                'username' => 'loket',
                'password' => 'password',
                'role' => Role::PetugasLoket
            ],
            'dokter' => [
                'name' => 'Dokter',
                'username' => 'dokter',
                'password' => 'password',
                'role' => Role::Dokter
            ],
            'kasir' => [
                'name' => 'Kasir',
                'username' => 'kasir',
                'password' => 'password',
                'role' => Role::Kasir
            ],
            'farmasi' => [
                'name' => 'Farmasi',
                'username' => 'farmasi',
                'password' => 'password',
                'role' => Role::Farmasi
            ],
        ];
        foreach ($userData as $key => $value) {
            User::create([
                'name' => $value['name'],
                'username' => $value['username'],
                'password' => $value['password'],
                'role' => $value['role']
            ]);
        }
    }
}
