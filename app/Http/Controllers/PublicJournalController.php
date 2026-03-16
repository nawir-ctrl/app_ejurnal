<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Journal;
use Illuminate\Support\Facades\Storage;

class PublicJournalController extends Controller
{
    public function create()
    {
        // Hanya mengambil guru yang statusnya Aktif
        $teachers = Teacher::where('status', 'Aktif')->get();
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        
        return view('public.jurnal-form', compact('teachers', 'subjects', 'classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date', // Field baru untuk tanggal manual
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'time_slot' => 'required|string|max:50',
            'material' => 'required|string',
            'method' => 'required|string|max:100',
            'attendance' => 'nullable|string',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('jurnal_photos', 'public');
        }

        // HAPUS BARIS INI KARENA KITA PAKAI INPUT DARI FORM
        // $validated['date'] = now()->toDateString(); 

        unset($validated['photo']);

        Journal::create($validated);

        return back()->with('success', 'Jurnal mengajar berhasil disimpan! Terima kasih.');
    }
}