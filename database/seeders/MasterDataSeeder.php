<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Classroom;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Insert Data Kelas
        $classrooms = [
            'VII MTs A',
            'VIII MTs A',
            'IX MTs A',
            'X TKJ 1',
            'XI TKJ 1',
            'XII TKJ 1',
        ];

        foreach ($classrooms as $class) {
            Classroom::create(['name' => $class]);
        }

        // 2. Insert Data Mata Pelajaran
        $subjects = [
            'Administrasi Sistem Jaringan',
            'Administrasi Infrastruktur Jaringan',
            'Teknologi Layanan Jaringan',
            'Pendidikan Agama Islam',
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
        ];

        foreach ($subjects as $subject) {
            Subject::create(['name' => $subject]);
        }

        // 3. Insert Data Guru
        $teachers = [
            [
                'nip' => '198001012005011001',
                'name' => 'Ahmad Fauzi, S.Kom.',
                'phone' => '081234567890',
                'employment_status' => 'PNS',
                'status' => 'Aktif'
            ],
            [
                'nip' => '198502022010012002',
                'name' => 'Siti Aminah, S.Pd.',
                'phone' => '081298765432',
                'employment_status' => 'GTY',
                'status' => 'Aktif'
            ],
            [
                'nip' => null,
                'name' => 'Budi Santoso, S.T.',
                'phone' => '085612345678',
                'employment_status' => 'GTT',
                'status' => 'Aktif'
            ],
            [
                'nip' => '199004042015022004',
                'name' => 'Ratna Sari, S.Pd.I.',
                'phone' => '087766554433',
                'employment_status' => 'GTY',
                'status' => 'Cuti'
            ],
            [
                'nip' => '196005051985031005',
                'name' => 'Drs. H. Abdullah',
                'phone' => null,
                'employment_status' => 'PNS',
                'status' => 'Pensiun'
            ]
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
