<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JournalsExport;
use App\Exports\RekapJamExport;

class AdminJournalController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $classrooms = Classroom::orderBy('name')->get();

        $journals = Journal::with(['teacher', 'subject', 'classroom'])
            // Filter Range Tanggal
            ->when($request->start_date, fn($query) => $query->whereDate('date', '>=', $request->start_date))
            ->when($request->end_date, fn($query) => $query->whereDate('date', '<=', $request->end_date))
            // Filter Master Data
            ->when($request->teacher_id, fn($query, $teacher) => $query->where('teacher_id', $teacher))
            ->when($request->subject_id, fn($query, $subject) => $query->where('subject_id', $subject))
            ->when($request->classroom_id, fn($query, $classroom) => $query->where('classroom_id', $classroom))
            ->latest('date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.journals.index', compact('journals', 'teachers', 'subjects', 'classrooms'));
    }

    public function show(Journal $journal)
    {
        return view('admin.journals.show', compact('journal'));
    }

    public function destroy(Journal $journal)
    {
        if ($journal->photo_path && Storage::disk('public')->exists($journal->photo_path)) {
            Storage::disk('public')->delete($journal->photo_path);
        }
        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Data jurnal berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $profile = SchoolProfile::first();
        $journals = Journal::with(['teacher', 'subject', 'classroom'])
            ->when($request->start_date, fn($q) => $q->whereDate('date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('date', '<=', $request->end_date))
            ->when($request->teacher_id, fn($q, $t) => $q->where('teacher_id', $t))
            ->when($request->subject_id, fn($q, $s) => $q->where('subject_id', $s))
            ->when($request->classroom_id, fn($q, $c) => $q->where('classroom_id', $c))
            ->orderBy('date', 'asc')
            ->get();

        $pdf = Pdf::loadView('admin.journals.pdf', compact('journals', 'profile'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan-Jurnal-'.now()->format('YmdHi').'.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new JournalsExport($request), 'Laporan-Jurnal-'.now()->format('YmdHi').'.xlsx');
    }

    // --- FITUR REKAP JAM & HONOR ---

    private function getRekapData($startDate, $endDate)
    {
        $teachers = Teacher::with(['journals' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->get();

        return $teachers->map(function ($teacher) {
            $totalHours = $teacher->journals->sum(function ($journal) {
                return $this->calculateHours($journal->time_slot);
            });
            return (object)[
                'teacher' => $teacher,
                'total_journals' => $teacher->journals->count(),
                'total_hours' => $totalHours
            ];
        })->sortByDesc('total_hours')->values();
    }

    public function rekapJam(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $honorPerJam = $request->input('honor_per_jam', 50000); 

        $rekapData = $this->getRekapData($startDate, $endDate);

        return view('admin.journals.rekap-jam', compact('rekapData', 'startDate', 'endDate', 'honorPerJam'));
    }

    public function exportRekapPdf(Request $request)
    {
        $profile = SchoolProfile::first();
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $honorPerJam = $request->input('honor_per_jam', 50000);

        $rekapData = $this->getRekapData($startDate, $endDate)->filter(fn($item) => $item->total_hours > 0);

        $pdf = Pdf::loadView('admin.journals.rekap-pdf', compact('rekapData', 'startDate', 'endDate', 'honorPerJam', 'profile'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('Rekap-Honor-'.now()->format('YmdHi').'.pdf');
    }

    public function exportRekapExcel(Request $request)
    {
        return Excel::download(new RekapJamExport($request), 'Rekap-Honor-'.now()->format('YmdHi').'.xlsx');
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