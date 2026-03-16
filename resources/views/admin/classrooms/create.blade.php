<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-slate-200">Tambah Kelas</h2></x-slot>
    <div class="py-12"><div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-8 shadow-2xl">
            <form action="{{ route('classrooms.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Kelas *</label>
                    <input type="text" name="name" required placeholder="Contoh: X TKJ 1" class="bg-slate-900 border border-slate-700 text-white rounded-lg focus:ring-blue-500 block w-full p-2.5">
                    @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-700/50">
                    <a href="{{ route('classrooms.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-300 bg-slate-700 rounded-lg">Batal</a>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-lg shadow-blue-500/30">Simpan</button>
                </div>
            </form>
        </div>
    </div></div>
</x-app-layout>