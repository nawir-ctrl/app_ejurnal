<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            Edit Data Guru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-8 shadow-2xl">
                <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">NIP (Opsional)</label>
                        <input type="text" name="nip" value="{{ old('nip', $teacher->nip) }}" class="bg-slate-900 border border-slate-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('nip') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required class="bg-slate-900 border border-slate-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Nomor HP</label>
                        <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}" class="bg-slate-900 border border-slate-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Status Kepegawaian</label>
                        <select name="employment_status" class="bg-slate-900 border border-slate-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="GTY" {{ old('employment_status', $teacher->employment_status) == 'GTY' ? 'selected' : '' }}>GTY</option>
                            <option value="GTT" {{ old('employment_status', $teacher->employment_status) == 'GTT' ? 'selected' : '' }}>GTT</option>
                            <option value="PNS" {{ old('employment_status', $teacher->employment_status) == 'PNS' ? 'selected' : '' }}>PNS</option>
                        </select>
                        @error('employment_status') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Status</label>
                        <select name="status" class="bg-slate-900 border border-slate-700 text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Aktif" {{ $teacher->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Cuti" {{ $teacher->status == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="Pensiun" {{ $teacher->status == 'Pensiun' ? 'selected' : '' }}>Pensiun</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-700/50">
                        <a href="{{ route('teachers.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-300 bg-slate-700 hover:bg-slate-600 rounded-lg transition-colors">Batal</a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 rounded-lg shadow-lg shadow-blue-500/30 transition-colors">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
