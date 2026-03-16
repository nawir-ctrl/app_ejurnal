<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SubjectTemplateExport implements WithHeadings, WithTitle, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'nama_mata_pelajaran'
        ];
    }

    public function title(): string
    {
        return 'Template Import Mapel';
    }
}