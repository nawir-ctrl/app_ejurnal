<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            ['198501012010011001', 'Budi Santoso, S.Pd', '08123456789', 'Aktif'],
            ['', 'Siti Aminah, M.Pd', '', 'Aktif'],
        ];
    }

    public function headings(): array
    {
        return ['nip', 'nama_guru', 'no_hp', 'status'];
    }
}