<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Dashboard Administrator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 shadow-lg hover:shadow-blue-500/10 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">Jurnal Hari Ini</p>
                            <h3 class="text-3xl font-bold text-white">{{ $todayJournalsCount }}</h3>
                        </div>
                        <div class="p-3 bg-blue-500/20 rounded-xl">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 shadow-lg hover:shadow-purple-500/10 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">Total Guru</p>
                            <h3 class="text-3xl font-bold text-white">{{ $totalTeachers }}</h3>
                        </div>
                        <div class="p-3 bg-purple-500/20 rounded-xl">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 shadow-lg hover:shadow-pink-500/10 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-400 mb-1">Total Kelas</p>
                            <h3 class="text-3xl font-bold text-white">{{ $totalClassrooms }}</h3>
                        </div>
                        <div class="p-3 bg-pink-500/20 rounded-xl">
                            <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 shadow-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-slate-200">Aktivitas Mengajar Hari Ini</h3>
                        <span class="text-xs bg-blue-500/20 text-blue-400 px-2 py-1 rounded">{{ date('d M Y') }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="text-xs text-slate-500 uppercase border-b border-slate-700/50">
                                <tr>
                                    <th class="pb-3 font-medium">Guru</th>
                                    <th class="pb-3 font-medium">Mapel / Kelas</th>
                                    <th class="pb-3 font-medium text-center">Jam</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/50">
                                @forelse($todayActivities as $activity)
                                <tr class="group hover:bg-slate-700/20 transition-colors">
                                    <td class="py-4 font-medium text-white">{{ $activity->teacher->name }}</td>
                                    <td class="py-4">
                                        <div class="text-slate-200">{{ $activity->subject->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $activity->classroom->name }}</div>
                                    </td>
                                    <td class="py-4 text-center">
                                        <span class="bg-slate-900 border border-slate-700 px-2 py-1 rounded text-xs">Ke-{{ $activity->time_slot }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="py-10 text-center text-slate-500">Belum ada aktivitas mengajar hari ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-6 shadow-2xl">
                    <h3 class="text-lg font-semibold text-slate-200 mb-6">Tren 7 Hari</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('activityChart').getContext('2d');
            const chartData = @json($chartData);
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(139, 92, 246, 0.4)');
            gradient.addColorStop(1, 'rgba(139, 92, 246, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        borderColor: '#8b5cf6',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { display: false, beginAtZero: true },
                        x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 10 } } }
                    }
                }
            });
        });
    </script>
</x-app-layout>