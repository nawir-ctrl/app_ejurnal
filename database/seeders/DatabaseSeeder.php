<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SchoolProfile;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data Admin Bawaan
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password'),
        ]);

        // Data Profil Sekolah Bawaan
        SchoolProfile::create([
            'name' => 'MTs / SMK Modern',
            'npsn' => '12345678',
            'academic_year' => '2025/2026'
        ]);

        // Panggil MasterDataSeeder yang baru dibuat
        $this->call([
            MasterDataSeeder::class,
        ]);
    }
}