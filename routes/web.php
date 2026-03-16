<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicJournalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AdminJournalController;
use App\Http\Controllers\SchoolProfileController;
use Illuminate\Support\Facades\Route;

// Rute Publik (Akses HP/Tamu)
Route::get('/', [PublicJournalController::class, 'create'])->name('home');
Route::post('/jurnal', [PublicJournalController::class, 'store'])->name('jurnal.store');

// Rute Admin (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // --- Profil Sekolah ---
    Route::get('/school-profile', [SchoolProfileController::class, 'edit'])->name('school-profile.edit');
    Route::put('/school-profile', [SchoolProfileController::class, 'update'])->name('school-profile.update');

    // --- Manajemen Guru (Urutan Sangat Penting) ---
    Route::get('/teachers/template', [TeacherController::class, 'downloadTemplate'])->name('teachers.template');
    Route::post('/teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
    Route::delete('/teachers/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('teachers.bulkDelete');
    Route::resource('teachers', TeacherController::class)->except(['show']);

    // --- Manajemen Mata Pelajaran ---
    Route::get('/subjects/template', [SubjectController::class, 'downloadTemplate'])->name('subjects.template');
    Route::post('/subjects/import', [SubjectController::class, 'import'])->name('subjects.import');
    Route::resource('subjects', SubjectController::class)->except(['show']);

    // --- Manajemen Kelas ---
    Route::resource('classrooms', ClassroomController::class)->except(['show']);
    
    // --- Rekap Jam Mengajar & Honor ---
    Route::get('/journals/rekap-jam', [AdminJournalController::class, 'rekapJam'])->name('journals.rekap-jam');
    Route::get('/journals/rekap-jam/export-pdf', [AdminJournalController::class, 'exportRekapPdf'])->name('journals.rekap.pdf');
    Route::get('/journals/rekap-jam/export-excel', [AdminJournalController::class, 'exportRekapExcel'])->name('journals.rekap.excel');
    
    // --- Laporan Jurnal & Export ---
    Route::get('/journals/export-pdf', [AdminJournalController::class, 'exportPdf'])->name('journals.export.pdf');
    Route::get('/journals/export-excel', [AdminJournalController::class, 'exportExcel'])->name('journals.export.excel');
    Route::resource('journals', AdminJournalController::class);

});

// Rute Profil Admin (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';