<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">Manajemen Data Guru</h2>
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <button type="button" id="btn-bulk-delete" onclick="confirmBulkDelete()" class="hidden touch-button justify-center bg-red-600 hover:bg-red-500 text-white px-4 py-2 text-sm font-medium transition-all shadow-lg shadow-red-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Terpilih (<span id="count-checked">0</span>)
                </button>

                <button onclick="document.getElementById('modal-import').classList.remove('hidden')" class="touch-button justify-center bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 text-sm font-medium transition-colors shadow-lg shadow-emerald-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Import Excel
                </button>
                <a href="{{ route('teachers.create') }}" class="touch-button inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 text-sm font-medium shadow-lg shadow-blue-500/30">+ Tambah Guru</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg">{{ session('error') }}</div>
            @endif

            <form id="form-bulk-delete" action="{{ route('teachers.bulkDelete') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="md:hidden space-y-3 px-4 sm:px-0">
                    @forelse($teachers as $teacher)
                        <article class="panel rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" name="ids[]" value="{{ $teacher->id }}" class="teacher-checkbox mt-1 rounded border-slate-700 bg-slate-900 text-blue-600 focus:ring-blue-500">
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-semibold text-white leading-snug">{{ $teacher->name }}</h3>
                                    <p class="mt-1 text-xs font-mono text-slate-500">{{ $teacher->nip ?? '-' }}</p>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-500/20 text-blue-300">{{ $teacher->employment_status }}</span>
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $teacher->status === 'Aktif' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">{{ $teacher->status }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="touch-button inline-flex items-center justify-center rounded-xl bg-slate-700 text-sm font-medium text-slate-100">Edit</a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Hapus guru ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="touch-button w-full bg-red-600/20 text-sm font-medium text-red-300 border border-red-500/30">Hapus</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="panel rounded-xl px-5 py-10 text-center text-slate-500">Belum ada data guru.</div>
                    @endforelse
                </div>

                <div class="hidden md:block bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4 w-10">
                                        <input type="checkbox" id="check-all" class="rounded border-slate-700 bg-slate-900 text-blue-600 focus:ring-blue-500">
                                    </th>
                                    <th class="px-6 py-4 font-medium">NIP</th>
                                    <th class="px-6 py-4 font-medium">Nama Guru</th>
                                    <th class="px-6 py-4 font-medium">Kepegawaian</th>
                                    <th class="px-6 py-4 font-medium">Status</th>
                                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/50">
                                @forelse($teachers as $teacher)
                                <tr class="hover:bg-slate-700/20 transition-colors">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="ids[]" value="{{ $teacher->id }}" class="teacher-checkbox rounded border-slate-700 bg-slate-900 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 text-xs font-mono">{{ $teacher->nip ?? '-' }}</td>
                                    <td class="px-6 py-4 font-medium text-white">{{ $teacher->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-500/20 text-blue-300">
                                            {{ $teacher->employment_status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $teacher->status === 'Aktif' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                            {{ $teacher->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors">Edit</a>
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Hapus guru ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="px-6 py-8 text-center text-slate-500">Belum ada data guru.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <div class="mt-4">{{ $teachers->links() }}</div>
        </div>
    </div>

    <div id="modal-import" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
        <div class="bg-slate-800 border border-slate-700 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">Import Data Guru</h3>
                <button onclick="document.getElementById('modal-import').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
            </div>
            
            <form action="{{ route('teachers.import') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="mb-6 text-sm text-slate-400">
                    <p class="mb-2">Silakan gunakan template Excel yang telah disediakan agar data terbaca dengan benar oleh sistem.</p>
                    <a href="{{ route('teachers.template') }}" class="text-blue-400 hover:underline flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Template Excel
                    </a>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-300 mb-2">Pilih File (.xlsx / .csv)</label>
                    <input type="file" name="file" required class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-700 file:text-slate-300 hover:file:bg-slate-600 border border-slate-700 rounded-lg bg-slate-900/50">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modal-import').classList.add('hidden')" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition-colors">Batal</button>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-2 rounded-lg text-sm font-medium transition-all shadow-lg shadow-emerald-500/20">Mulai Import</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const checkAll = document.getElementById('check-all');
        const checkboxes = document.querySelectorAll('.teacher-checkbox');
        const btnBulkDelete = document.getElementById('btn-bulk-delete');
        const countChecked = document.getElementById('count-checked');

        function updateBulkButton() {
            const checkedCount = document.querySelectorAll('.teacher-checkbox:checked').length;
            if (checkedCount > 0) {
                btnBulkDelete.classList.remove('hidden');
                countChecked.textContent = checkedCount;
            } else {
                btnBulkDelete.classList.add('hidden');
            }
        }

        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = checkAll.checked);
            updateBulkButton();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateBulkButton);
        });

        function confirmBulkDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus ' + document.querySelectorAll('.teacher-checkbox:checked').length + ' data guru yang dipilih?')) {
                document.getElementById('form-bulk-delete').submit();
            }
        }
    </script>
</x-app-layout>
