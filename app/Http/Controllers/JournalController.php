<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    /**
     * Tampilan untuk Publik (Tanpa Login)
     * Fitur Terbatas: Hanya Lihat & Pagination
     */
    public function publicIndex(Request $request)
{
    // Ambil nilai per_page dari request, default-nya 10
    $perPage = $request->get('per_page', 10);
    
    $query = Journal::with(['teacher', 'subject', 'classroom'])->latest();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->whereHas('teacher', function($t) use ($search) {
                $t->where('name', 'like', "%{$search}%");
            })->orWhereHas('classroom', function($c) use ($search) {
                $c->where('name', 'like', "%{$search}%");
            })->orWhere('material', 'like', "%{$search}%");
        });
    }

    // Jika pilih 'semua', ambil semua data tanpa pagination (atau limit sangat besar)
    $journals = ($perPage == 'all') ? $query->paginate($query->count())->withQueryString() : $query->paginate($perPage)->withQueryString();

    return view('journals.public', compact('journals'));
}
    /**
     * Tampilan Dashboard Utama (Perlu Login)
     */
    public function index()
    {
        // Jika user adalah guru, mungkin hanya ingin melihat jurnal miliknya sendiri
        // Jika admin, bisa melihat semua. Di sini Melodi buat agar admin bisa melihat semua.
        $journals = Journal::with(['teacher', 'subject'])->latest()->paginate(10);
        
        return view('journals.index', compact('journals'));
    }

    /**
     * Form Tambah Jurnal
     */
    public function create()
    {
        $teachers = Teacher::where('status', 'Aktif')->get();
        $subjects = Subject::where('status', 'Aktif')->get();
        
        return view('journals.create', compact('teachers', 'subjects'));
    }

    /**
     * Simpan Jurnal Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'date'       => 'required|date',
            'material'   => 'required|string',
            'summary'    => 'nullable|string',
        ]);

        Journal::create($request->all());

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil ditambahkan!');
    }

    /**
     * Form Edit Jurnal
     */
    public function edit(Journal $journal)
    {
        $teachers = Teacher::where('status', 'Aktif')->get();
        $subjects = Subject::where('status', 'Aktif')->get();
        
        return view('journals.edit', compact('journal', 'teachers', 'subjects'));
    }

    /**
     * Update Jurnal
     */
    public function update(Request $request, Journal $journal)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'date'       => 'required|date',
            'material'   => 'required|string',
        ]);

        $journal->update($request->all());

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diperbarui!');
    }

    /**
     * Hapus Jurnal
     */
    public function destroy(Journal $journal)
    {
        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus!');
    }

    /**
     * Fitur Bulk Delete untuk Admin
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            Journal::whereIn('id', $ids)->delete();
            return redirect()->route('journals.index')->with('success', count($ids) . ' data jurnal berhasil dihapus.');
        }

        return redirect()->route('journals.index')->with('error', 'Tidak ada data yang dipilih.');
    }
}