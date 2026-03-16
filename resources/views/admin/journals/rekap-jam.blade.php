<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            Perhitungan Jam Mengajar & Honor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 mb-6 shadow-lg">
                <form action="{{ route('journals.rekap-jam') }}" method="GET" class="mb-0">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Dari Tanggal</label>
                            <input type="date" name="start_date" value="{{ $startDate }}" required class="bg-slate-900 border border-slate-700 text-white rounded-lg text-sm block w-full p-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ $endDate }}" required class="bg-slate-900 border border-slate-700 text-white rounded-lg text-sm block w-full p-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Nominal Honor / Jam (Rp)</label>
                            <input type="number" name="honor_per_jam" value="{{ $honorPerJam }}" required min="0" step="1000" class="bg-slate-900 border border-slate-700 text-white rounded-lg text-sm block w-full p-2 focus:ring-green-500">
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white rounded-lg p-2 text-sm font-medium transition-colors shadow-lg shadow-blue-500/30">
                                Hitung Kalkulasi
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-slate-700/50">
                        <button type="submit" formaction="{{ route('journals.rekap.pdf') }}" formtarget="_blank" class="bg-red-500 hover:bg-red-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-lg shadow-red-500/30 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export PDF
                        </button>
                        <button type="submit" formaction="{{ route('journals.rekap.excel') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-lg shadow-emerald-500/30 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export Excel
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-medium w-16 text-center">No</th>
                                <th class="px-6 py-4 font-medium">Nama Guru</th>
                                <th class="px-6 py-4 font-medium text-center">Jurnal</th>
                                <th class="px-6 py-4 font-medium text-center text-blue-400">Total Jam</th>
                                <th class="px-6 py-4 font-medium text-right text-green-400">Estimasi Honor (Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @php $grandTotalJam = 0; $grandTotalHonor = 0; @endphp
                            @forelse($rekapData as $index => $data)
                                @if($data->total_hours > 0)
                                    @php 
                                        $honor = $data->total_hours * $honorPerJam; 
                                        $grandTotalJam += $data->total_hours;
                                        $grandTotalHonor += $honor;
                                    @endphp
                                    <tr class="hover:bg-slate-700/20 transition-colors">
                                        <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-white">
                                            {{ $data->teacher->name }}<br><span class="text-xs text-slate-500">{{ $data->teacher->nip ?? '-' }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center"><span class="bg-slate-700 text-white px-2 py-1 rounded text-xs">{{ $data->total_journals }} Kali</span></td>
                                        <td class="px-6 py-4 text-center"><span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full font-bold text-sm">{{ $data->total_hours }} Jam</span></td>
                                        <td class="px-6 py-4 text-right font-bold text-green-400">Rp {{ number_format($honor, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                            @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data mengajar di rentang tanggal ini.</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-slate-900/80 font-bold text-white">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right">TOTAL KESELURUHAN :</td>
                                <td class="px-6 py-4 text-center text-blue-400">{{ $grandTotalJam }} Jam</td>
                                <td class="px-6 py-4 text-right text-green-400">Rp {{ number_format($grandTotalHonor, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>