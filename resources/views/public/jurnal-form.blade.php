@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto mobile-shell">
    
    <div class="text-center mb-6 sm:mb-10">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight mb-2 text-white leading-tight">Formulir Jurnal Mengajar</h1>
        <p class="text-slate-400 text-sm sm:text-base">MTs Peskil Poasia</p>
    </div>

    <div class="mb-6 sm:mb-8 bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 sm:p-5 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 shadow-lg shadow-emerald-500/5">
        <div class="flex items-start sm:items-center gap-3 sm:gap-4">
            <div class="bg-emerald-500/20 p-2.5 sm:p-3 rounded-xl text-emerald-400 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-white font-bold text-sm md:text-base">Lihat Rekapitulasi Jurnal</h4>
                <p class="text-slate-400 text-xs">Pantau data jurnal yang sudah masuk melalui halaman publik.</p>
            </div>
        </div>
        <a href="{{ route('journals.public') }}" class="w-full sm:w-auto touch-button text-center bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-2.5 text-sm font-bold transition-all shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-2">
            Buka Rekap ↗
        </a>
    </div>

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition.duration.500ms class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl relative flex items-center justify-between" role="alert">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-green-400 hover:text-green-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif

    <div class="panel rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8">
        <form action="{{ route('jurnal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
            @csrf
            
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-slate-300">Tanggal Mengajar *</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors cursor-pointer">
                <p class="mt-1 text-xs text-slate-500">Ubah tanggal jika Anda mengisi jurnal untuk hari sebelumnya.</p>
                @error('date') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-300">Nama Guru *</label>
                    <select name="teacher_id" required class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors">
                        <option value="">-- Pilih Nama Guru --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    @error('teacher_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-300">Mata Pelajaran *</label>
                    <select name="subject_id" required class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors">
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-300">Kelas *</label>
                    <select name="classroom_id" required class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                    @error('classroom_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-300">Jam Pelajaran Ke- *</label>
                    <input type="text" name="time_slot" value="{{ old('time_slot') }}" required placeholder="Contoh: 1 - 2" class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors">
                    @error('time_slot') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-300">Materi yang Diajarkan *</label>
                <textarea name="material" rows="3" required class="rounded-xl bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors" placeholder="Tuliskan garis besar materi yang diajarkan...">{{ old('material') }}</textarea>
                @error('material') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-300">Metode Pembelajaran *</label>
                    <input type="text" name="method" value="{{ old('method') }}" required placeholder="Ceramah, Diskusi, Praktikum, dll" class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors">
                    @error('method') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-300">Kehadiran Siswa</label>
                    <input type="text" name="attendance" value="{{ old('attendance') }}" placeholder="Nihil, atau sebutkan nama yang absen" class="touch-field bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors">
                    @error('attendance') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-300">Catatan Pembelajaran (Opsional)</label>
                <textarea name="notes" rows="2" class="rounded-xl bg-slate-900 border border-slate-700 text-white focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-colors" placeholder="Hambatan, catatan khusus siswa, dll...">{{ old('notes') }}</textarea>
                @error('notes') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-300">Upload Foto Kegiatan (Opsional)</label>
                <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-400 file:mr-3 file:py-3 file:px-3 sm:file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-700 file:text-slate-300 hover:file:bg-slate-600 transition-all cursor-pointer bg-slate-900 border border-slate-700 rounded-xl">
                <p class="mt-1 text-xs text-slate-500">PNG, JPG or JPEG (Maks. 2MB).</p>
                @error('photo') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full touch-button text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-800 font-bold text-base sm:text-lg px-5 py-4 text-center transition-all duration-300 shadow-lg shadow-blue-500/20">
                    Kirim Jurnal Mengajar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
