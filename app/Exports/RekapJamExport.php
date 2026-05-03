<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class RekapJamExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $startDate = $this->request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $this->request->input('end_date', now()->endOfMonth()->toDateString());
        $employmentStatus = $this->request->input('employment_status');

        $teachers = Teacher::with(['journals' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])
        ->when($employmentStatus, fn($query, $status) => $query->where('employment_status', $status))
        ->get();

        return $teachers->map(function ($teacher) {
            $totalHours = $teacher->journals->sum(function ($journal) {
                return $this->calculateHours($journal->time_slot);
            });
            
            return (object)[
                'teacher' => $teacher,
                'total_journals' => $teacher->journals->count(),
                'total_hours' => $totalHours
            ];
        })->filter(function($item) {
            return $item->total_hours > 0; // Hanya tampilkan yang ada jam mengajarnya
        })->sortByDesc('total_hours')->values();
    }

    public function headings(): array
    {
        return ['No', 'Nama Guru', 'NIP', 'Status Kepegawaian', 'Total Mengisi Jurnal', 'Total Jam', 'Honor Per Jam', 'Total Honor'];
    }

    public function map($row): array
    {
        static $number = 0;
        $number++;
        $honorPerJam = $this->request->input('honor_per_jam', 50000); // Default 50rb

        return [
            $number,
            $row->teacher->name,
            $row->teacher->nip ?? '-',
            $row->teacher->employment_status,
            $row->total_journals . ' Kali',
            $row->total_hours . ' Jam',
            $honorPerJam,
            $row->total_hours * $honorPerJam
        ];
    }

    private function calculateHours($timeSlot) {
        $timeSlot = strtolower(trim($timeSlot));
        $timeSlot = str_replace([' s/d ', ' sampai ', ' s.d '], '-', $timeSlot);
        if (preg_match('/(\d+)\s*-\s*(\d+)/', $timeSlot, $matches)) {
            return max(0, $matches[2] - $matches[1] + 1);
        }
        if (str_contains($timeSlot, ',')) {
            return count(array_filter(explode(',', $timeSlot), 'trim'));
        }
        return is_numeric($timeSlot) ? 1 : 1;
    }
}
