<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubjectTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        // Contoh data untuk template
        return [
            ['MTK', 'Matematika', 'Hadir'],
            ['PAI', 'Pendidikan Agama Islam', 'Hadir'],
        ];
    }

   public function headings(): array
{
    return [
        'kode_mapel',          // Ini akan menjadi $row['kode_mapel']
        'nama_mata_pelajaran', // Ini akan menjadi $row['nama_mata_pelajaran']
        'status'
    ];
}
}