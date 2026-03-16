<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        /**
         * Tips Melodi: 
         * Pastikan nama di dalam kurung [ ] sama persis dengan header di Excel.
         * Jika di Excel tulisannya "Nama Mata Pelajaran", maka di sini harus "nama_mata_pelajaran".
         * Laravel Excel otomatis mengubah spasi menjadi underscore dan huruf kecil.
         */
        return new Subject([
            'code'   => $row['kode_mapel'] ?? $row['kode'] ?? null,
            'name'   => $row['nama_mata_pelajaran'] ?? $row['nama_mapel'] ?? $row['nama'] ?? null,
            'status' => $row['status'] ?? 'Aktif',
        ]);
    }
}