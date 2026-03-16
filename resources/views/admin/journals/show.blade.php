<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">
                Detail Jurnal Mengajar
            </h2>
            <a href="{{ route('journals.index') }}" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 md:p-8 shadow-2xl">
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="flex items-start justify-between pb-6 border-b border-slate-700/50">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-1">{{ $journal->teacher->name }}</h3>
                                <p class="text-slate-400 text-sm">NIP: {{ $journal->teacher->nip ?? '-' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block bg-purple-500/20 text-purple-400 px-3 py-1 rounded-full text-sm font-medium border border-purple-500/30">
                                    {{ \Carbon\Carbon::parse($journal->date)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-slate-700/50">
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/30">
                                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Mata Pelajaran</span>
                                <span class="text-lg font-semibold text-slate-200">{{ $journal->subject->name }}</span>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/30">
                                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Kelas</span>
                                <span class="text-lg font-semibold text-slate-200">{{ $journal->classroom->name }}</span>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/30">
                                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Jam Pelajaran</span>
                                <span class="text-lg font-semibold text-slate-200">{{ $journal->time_slot }}</span>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/30">
                                <span class="block text-xs font-medium text-slate-400 uppercase tracking-wider mb-1">Metode Pembelajaran</span>
                                <span class="text-lg font-semibold text-slate-200">{{ $journal->method }}</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-slate-400 mb-2">Materi yang Diajarkan</h4>
                                <div class="bg-slate-900/30 p-4 rounded-xl text-slate-300 leading-relaxed border border-slate-700/30">
                                    {{ $journal->material }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-slate-400 mb-2">Kehadiran Siswa</h4>
                                    <div class="bg-slate-900/30 p-4 rounded-xl text-slate-300 border border-slate-700/30">
                                        {{ $journal->attendance ?? 'Nihil / Semua Hadir' }}
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-400 mb-2">Catatan Pembelajaran</h4>
                                    <div class="bg-slate-900/30 p-4 rounded-xl text-slate-300 border border-slate-700/30">
                                        {{ $journal->notes ?? 'Tidak ada catatan.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 border-t lg:border-t-0 lg:border-l border-slate-700/50 pt-6 lg:pt-0 lg:pl-8">
                        <h4 class="text-sm font-medium text-slate-400 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Foto Dokumentasi Mengajar
                        </h4>
                        
                        @if($journal->photo_path)
                            <div class="group relative rounded-xl overflow-hidden border border-slate-700/50 bg-slate-900">
                                <img src="{{ asset('storage/' . $journal->photo_path) }}" alt="Dokumentasi Jurnal" class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <a href="{{ asset('storage/' . $journal->photo_path) }}" target="_blank" class="text-xs text-white bg-blue-600/80 hover:bg-blue-500 px-3 py-1.5 rounded-lg backdrop-blur-sm transition-colors w-full text-center">
                                        Buka Gambar Penuh
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-slate-700 rounded-xl bg-slate-900/30 text-slate-500">
                                <svg class="w-12 h-12 mb-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-sm font-medium">Tidak ada foto dilampirkan</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>