<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TeacherTemplateExport implements WithHeadings, WithTitle, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'nip',
            'nama_guru',
            'nomor_hp',
            'status'
        ];
    }

    public function title(): string
    {
        return 'Template Import Guru';
    }
}