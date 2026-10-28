<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Penting: Import Hash untuk mengenkripsi password

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@starnas.com'],
            [
                'nama_lengkap' => 'Administrator Utama',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Peserta Uji Coba (dengan data lengkap)
        User::updateOrCreate(
            ['email' => 'peserta@starnas.com'],
            [
                'nama_lengkap' => 'Budi Peserta',
                'password' => Hash::make('password'),
                'pekerjaan' => 'Mahasiswa',
                'jenis_kelamin' => 'Laki-laki',
                'nomor_handphone' => '081234567890',
                'provinsi' => 'DKI Jakarta',
                'institusi' => 'Universitas Uji Coba',
                'role' => 'peserta',
            ]
        );

    }
}