<?php

namespace App\Exports;

use App\Models\Journal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JournalsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        // Menggunakan filter yang sama dengan halaman index
        return Journal::with(['teacher', 'subject', 'classroom'])
            ->when($this->request->date, fn($q, $d) => $q->whereDate('date', $d))
            ->when($this->request->teacher_id, fn($q, $t) => $q->where('teacher_id', $t))
            ->when($this->request->subject_id, fn($q, $s) => $q->where('subject_id', $s))
            ->when($this->request->classroom_id, fn($q, $c) => $q->where('classroom_id', $c))
            ->latest('date')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Tanggal', 'Nama Guru', 'Mata Pelajaran', 'Kelas', 'Jam Ke', 'Materi', 'Metode', 'Kehadiran', 'Catatan'
        ];
    }

    public function map($journal): array
    {
        static $rowNumber = 0;
        $rowNumber++;

        return [
            $rowNumber,
            Carbon::parse($journal->date)->format('d/m/Y'),
            $journal->teacher->name,
            $journal->subject->name,
            $journal->classroom->name,
            $journal->time_slot,
            $journal->material,
            $journal->method,
            $journal->attendance,
            $journal->notes,
        ];
    }
}