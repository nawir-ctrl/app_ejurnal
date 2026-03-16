<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Tips Melodi: Menangani berbagai kemungkinan penulisan header Excel
        $nip = $row['nip'] ?? $row['nomor_induk'] ?? null;
        $name = $row['nama'] ?? $row['nama_guru'] ?? $row['nama_lengkap'] ?? null;
        $phone = $row['telp'] ?? $row['no_hp'] ?? $row['whatsapp'] ?? null;
        $status = $row['status'] ?? 'Aktif';

        if (!$name) return null; // Abaikan baris jika nama kosong

        return new Teacher([
            'nip'    => $nip,
            'name'   => $name,
            'phone'  => $phone,
            'status' => $status,
        ]);
    }
}