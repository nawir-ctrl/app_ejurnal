<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">Manajemen Data Guru</h2>
            <div class="flex items-center gap-3">
                <button type="button" id="btn-bulk-delete" onclick="confirmBulkDelete()" class="hidden bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-lg shadow-red-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Terpilih (<span id="count-checked">0</span>)
                </button>

                <button onclick="document.getElementById('modal-import').classList.remove('hidden')" class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-lg shadow-emerald-500/30">
                    Import Excel
                </button>
                <a href="{{ route('teachers.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-lg shadow-blue-500/30">+ Tambah Guru</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif

            <form id="form-bulk-delete" action="{{ route('teachers.bulkDelete') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden shadow-2xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4 w-10">
                                        <input type="checkbox" id="check-all" class="rounded border-slate-700 bg-slate-900 text-blue-600 focus:ring-blue-500">
                                    </th>
                                    <th class="px-6 py-4 font-medium">NIP</th>
                                    <th class="px-6 py-4 font-medium">Nama Guru</th>
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
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $teacher->status === 'Aktif' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                            {{ $teacher->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="text-blue-400 hover:underline mr-3">Edit</a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data guru.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            <div class="mt-4">{{ $teachers->links() }}</div>
        </div>
    </div>

    <div id="modal-import" class="hidden fixed inset-0 z-50 overflow-y-auto">
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
            if (confirm('Apakah Anda yakin ingin menghapus semua guru yang dipilih? Tindakan ini tidak bisa dibatalkan.')) {
                document.getElementById('form-bulk-delete').submit();
            }
        }
    </script>
</x-app-layout>