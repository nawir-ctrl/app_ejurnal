<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Exports\TeacherTemplateExport;
use App\Imports\TeachersImport;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('name')->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'nullable|string|max:20|unique:teachers,nip',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'employment_status' => 'required|in:GTY,GTT,PNS',
            'status' => 'required|in:Aktif,Cuti,Pensiun',
        ]);

        Teacher::create($validated);
        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'nip' => 'nullable|string|max:20|unique:teachers,nip,' . $teacher->id,
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'employment_status' => 'required|in:GTY,GTT,PNS',
            'status' => 'required|in:Aktif,Cuti,Pensiun',
        ]);

        $teacher->update($validated);
        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil dihapus.');
    }

    // Fitur Import Excel
    public function import(Request $request) 
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:2048'
    ]);

    try {
        Excel::import(new TeachersImport, $request->file('file'));
        return back()->with('success', 'Data Guru berhasil diimport!');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal: Periksa kembali format file Anda.');
    }
}

    // Fitur Download Template Excel (XLSX)
    public function downloadTemplate()
    {
        return Excel::download(new TeacherTemplateExport, 'template_guru.xlsx');
    }

    // FITUR BARU: Bulk Delete (Hapus Massal)
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            Teacher::whereIn('id', $ids)->delete();
            return back()->with('success', count($ids) . ' data guru berhasil dihapus secara massal.');
        }
        return back()->with('error', 'Silakan pilih data yang ingin dihapus terlebih dahulu.');
    }
}
