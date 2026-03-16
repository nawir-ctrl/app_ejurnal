<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Teacher([
            'nip'    => $row['nip'],
            'name'   => $row['nama_guru'],
            'phone'  => $row['nomor_hp'],
            'status' => $row['status'] ?? 'Aktif',
        ]);
    }
}