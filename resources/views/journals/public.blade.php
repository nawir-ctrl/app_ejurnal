@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto mobile-shell py-4 sm:py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4 sm:gap-6 mb-6 sm:mb-10">
        <div class="text-center md:text-left">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-white leading-tight">E-Jurnal Guru MTs</h1>
            <p class="text-slate-400 mt-2 text-sm sm:text-lg">Rekapitulasi kegiatan belajar mengajar harian.</p>
        </div>
        
        <a href="{{ url('/') }}" class="touch-button inline-flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-5 py-3 rounded-xl text-sm font-bold transition-all border border-slate-700 shadow-xl group">
            <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Form Jurnal
        </a>
    </div>

    <div class="panel p-4 sm:p-6 rounded-xl sm:rounded-2xl mb-6 sm:mb-8">
    <form action="{{ route('journals.public') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="relative flex-1 w-full">
            <label class="block text-slate-400 text-xs mb-2 ml-1">Pencarian</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama guru, kelas, atau materi..." 
                class="w-full touch-field bg-slate-900 border-slate-700 text-slate-200 py-3.5 pl-12 focus:ring-2 focus:ring-blue-500 transition-all outline-none">
            <div class="absolute left-4 top-10 text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="w-full md:w-32">
            <label class="block text-slate-400 text-xs mb-2 ml-1">Tampilkan</label>
            <select name="per_page" onchange="this.form.submit()" class="w-full touch-field bg-slate-900 border-slate-700 text-slate-200 py-3.5 px-4 focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 baris</option>
                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 baris</option>
                <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 baris</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>
            </select>
        </div>

        <button type="submit" class="w-full md:w-auto touch-button bg-blue-600 hover:bg-blue-500 text-white px-10 py-3.5 font-bold transition-all shadow-lg shadow-blue-600/20">
            Filter
        </button>
    </form>
</div>

    <div class="md:hidden space-y-3">
        @forelse($journals as $journal)
            <article class="panel rounded-xl p-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="text-xs font-mono text-blue-400">{{ \Carbon\Carbon::parse($journal->date)->format('d/m/Y') }} · Jam {{ $journal->time_slot }}</div>
                        <h2 class="mt-1 text-base font-bold text-white leading-snug">{{ $journal->teacher->name }}</h2>
                    </div>
                    <span class="shrink-0 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-1 text-[10px] font-bold text-emerald-400">Terekam</span>
                </div>
                <div class="mt-3 flex flex-wrap gap-2 text-xs">
                    <span class="rounded-lg bg-slate-900 px-2.5 py-1 text-slate-300">{{ $journal->classroom->name }}</span>
                    <span class="rounded-lg bg-slate-900 px-2.5 py-1 text-slate-300">{{ $journal->subject->name }}</span>
                </div>
                <p class="mt-3 text-sm leading-relaxed text-slate-300">{{ Str::limit($journal->material, 120) }}</p>
                <p class="mt-2 text-xs italic text-slate-500">Kehadiran: {{ $journal->attendance ?? 'Nihil' }}</p>
            </article>
        @empty
            <div class="panel rounded-xl px-5 py-12 text-center text-slate-500">Data jurnal belum tersedia.</div>
        @endforelse
    </div>

    <div class="hidden md:block bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/80 text-slate-400 uppercase text-[10px] font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-5">Waktu & Kelas</th>
                        <th class="px-6 py-5">Nama Guru</th>
                        <th class="px-6 py-5">Mata Pelajaran</th>
                        <th class="px-6 py-5">Materi</th>
                        <th class="px-6 py-5">Kehadiran Siswa</th>
                        <th class="px-6 py-5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($journals as $journal)
                    <tr class="hover:bg-slate-700/30 transition-colors">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-blue-400 font-mono text-xs">{{ \Carbon\Carbon::parse($journal->date)->format('d/m/Y') }}</div>
                            <div class="text-white font-bold mt-1">{{ $journal->classroom->name }}</div>
                            <div class="text-slate-500 text-[11px]">Jam: {{ $journal->time_slot }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="text-white font-bold text-base">{{ $journal->teacher->name }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-700 text-slate-300 text-xs">
                                {{ $journal->subject->name }}
                            </span>
                        </td>
                        <td class="px-6 py-5 leading-relaxed max-w-xs text-xs">
                            {{ Str::limit($journal->material, 80) }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="text-slate-400 italic text-xs">
                                {{ $journal->attendance ?? 'Nihil' }}
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                                Terekam
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="text-slate-500 text-xl font-medium">Data jurnal belum tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $journals->links() }}
    </div>
</div>
@endsection
