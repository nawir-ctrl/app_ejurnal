<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">
                Manajemen Mata Pelajaran
            </h2>
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('modal-import-subject').classList.remove('hidden')" class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-lg shadow-emerald-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    Import Mapel
                </button>
                <a href="{{ route('subjects.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-lg shadow-blue-500/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Mapel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-medium">Nama Mata Pelajaran</th>
                                <th class="px-6 py-4 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse($subjects as $subject)
                            <tr class="hover:bg-slate-700/20 transition-colors">
                                <td class="px-6 py-4 font-medium text-white">{{ $subject->name }}</td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <a href="{{ route('subjects.edit', $subject->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Hapus mapel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-slate-500">Belum ada data mata pelajaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-slate-700/50">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="modal-import-subject" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('modal-import-subject').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-slate-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-700">
                <div class="bg-slate-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-emerald-500/10 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-white">Import Mata Pelajaran</h3>
                            <p class="text-sm text-slate-400 mt-2">Pastikan kolom heading di Excel bernama: <span class="text-emerald-400 font-mono">nama_mata_pelajaran</span></p>
                        </div>
                    </div>

                    <form action="{{ route('subjects.import') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                        @csrf
                        <input type="file" name="file" required class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-700 file:text-slate-300 hover:file:bg-slate-600 transition-all bg-slate-900 border border-slate-700 rounded-lg">
                        
                        <div class="mt-6 flex flex-col sm:flex-row-reverse gap-3">
                            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-emerald-700 transition-colors">Proses Import</button>
                            <button type="button" onclick="document.getElementById('modal-import-subject').classList.add('hidden')" class="bg-slate-700 text-slate-300 px-4 py-2 rounded-lg font-medium hover:bg-slate-600 transition-colors">Batal</button>
                        </div>
                    </form>
                </div>
                <div class="bg-slate-900/50 px-4 py-4 sm:px-6 flex justify-center border-t border-slate-700">
                    <a href="{{ route('subjects.template') }}" class="text-xs text-blue-400 hover:text-blue-300 flex items-center gap-1 font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh Template Excel Mapel
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>