<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">Data Jurnal Mengajar</h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel rounded-xl sm:rounded-2xl p-4 sm:p-6 mb-6 mx-4 sm:mx-0">
                <form action="{{ route('journals.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Mulai Tanggal</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="touch-field bg-slate-900 border-slate-700 text-white w-full p-2">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="touch-field bg-slate-900 border-slate-700 text-white w-full p-2">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Guru</label>
                            <select name="teacher_id" class="touch-field bg-slate-900 border-slate-700 text-white w-full p-2">
                                <option value="">Semua Guru</option>
                                @foreach($teachers as $t)
                                    <option value="{{ $t->id }}" {{ request('teacher_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="submit" class="touch-button w-full bg-blue-600 text-white p-2 text-sm font-medium">Filter</button>
                            <a href="{{ route('journals.index') }}" class="touch-button w-full inline-flex items-center justify-center bg-slate-700 text-center text-white p-2 text-sm font-medium">Reset</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:flex sm:justify-end gap-3 mt-4 pt-4 border-t border-slate-700/50">
                        <button type="submit" formaction="{{ route('journals.export.pdf') }}" formtarget="_blank" class="touch-button bg-red-500/20 text-red-400 border border-red-500/30 px-4 py-2 text-sm">PDF</button>
                        <button type="submit" formaction="{{ route('journals.export.excel') }}" class="touch-button bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-4 py-2 text-sm">Excel</button>
                    </div>
                </form>
            </div>

            <div class="md:hidden space-y-3 px-4 sm:px-0">
                @forelse($journals as $j)
                    <article class="panel rounded-xl p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs font-mono text-blue-400">{{ \Carbon\Carbon::parse($j->date)->format('d/m/Y') }}</p>
                                <h3 class="mt-1 font-semibold text-white leading-snug">{{ $j->teacher->name }}</h3>
                            </div>
                            <span class="shrink-0 rounded-lg bg-slate-900 px-2 py-1 text-xs text-slate-300">Jam {{ $j->time_slot }}</span>
                        </div>
                        <p class="mt-3 text-sm text-slate-300">{{ $j->subject->name }} ({{ $j->classroom->name }})</p>
                        <div class="mt-4 grid grid-cols-2 gap-2">
                            <a href="{{ route('journals.show', $j->id) }}" class="touch-button inline-flex items-center justify-center bg-slate-700 text-sm font-medium text-slate-100">Detail</a>
                            <form action="{{ route('journals.destroy', $j->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="touch-button w-full bg-red-600/20 text-sm font-medium text-red-300 border border-red-500/30">Hapus</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="panel rounded-xl px-5 py-10 text-center text-slate-500">Belum ada data jurnal.</div>
                @endforelse
            </div>

            <div class="hidden md:block bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-900/50 text-slate-400 text-xs">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Guru</th>
                            <th class="px-6 py-4">Mapel / Kelas</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @foreach($journals as $j)
                        <tr>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($j->date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-white font-medium">{{ $j->teacher->name }}</td>
                            <td class="px-6 py-4 text-xs">{{ $j->subject->name }} ({{ $j->classroom->name }})</td>
                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                <a href="{{ route('journals.show', $j->id) }}" class="text-blue-400">Detail</a>
                                <form action="{{ route('journals.destroy', $j->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4 border-t border-slate-700/50">{{ $journals->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
