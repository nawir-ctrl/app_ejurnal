<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">Manajemen Kelas</h2>
            <a href="{{ route('classrooms.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-lg shadow-blue-500/30">+ Tambah Kelas</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl overflow-hidden shadow-2xl">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-900/50 text-slate-400 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nama Kelas</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse($classrooms as $classroom)
                        <tr class="hover:bg-slate-700/20 transition-colors">
                            <td class="px-6 py-4 font-medium text-white">{{ $classroom->name }}</td>
                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                <a href="{{ route('classrooms.edit', $classroom->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-8 text-center text-slate-500">Belum ada data kelas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-slate-700/50">{{ $classrooms->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>