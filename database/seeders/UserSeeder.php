<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'pakar@tht.com'],
            [
                'name'         => 'Dr. Aradita',
                'password'     => Hash::make('password123'),
                'role'         => 'pakar',
                'spesialisasi' => 'THT',
                'status'       => 'aktif',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pasien@tht.com'],
            [
                'name'     => 'Pasien Demo',
                'password' => Hash::make('password123'),
                'role'     => 'pasien',
                'status'   => 'aktif',
            ]
        );
    }
}