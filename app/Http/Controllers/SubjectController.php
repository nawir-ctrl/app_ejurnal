<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Imports\SubjectsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TeacherTemplateExport;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
        ]);

        Subject::create($validated);
        return redirect()->route('subjects.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
        ]);

        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }

    public function import(Request $request) {
    $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
    Excel::import(new SubjectsImport, $request->file('file'));
    return back()->with('success', 'Data Mata Pelajaran berhasil diimport!');
}

public function downloadTemplate()
{
    return Excel::download(new SubjectTemplateExport, 'template_mapel.xlsx');
}
}