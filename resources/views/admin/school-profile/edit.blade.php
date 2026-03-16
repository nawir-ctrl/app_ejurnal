<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">Pengaturan Profil Sekolah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-2xl p-8 shadow-2xl">
                <form action="{{ route('school-profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center gap-6 pb-6 border-b border-slate-700/50">
                        <div class="w-24 h-24 rounded-xl bg-slate-900 border border-slate-700 flex items-center justify-center overflow-hidden shadow-inner">
                            @if($profile->logo_path)
                                <img src="{{ asset('storage/'.$profile->logo_path) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-12 h-12 text-slate-700" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.827a1 1 0 00-.788 0L2.606 6A1 1 0 001 6.918v5.164a1 1 0 00.606.918L9.606 16a1 1 0 00.788 0l7-3.082a1 1 0 00.606-.918V6.918a1 1 0 00-.606-.918l-7-3.091z"></path></svg>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Logo Sekolah</label>
                            <input type="file" name="logo" class="text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-700 file:text-slate-300 hover:file:bg-slate-600 cursor-pointer">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Nama Sekolah</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="bg-slate-900 border-slate-700 text-white rounded-lg w-full p-2.5">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">NPSN</label>
                            <input type="text" name="npsn" value="{{ old('npsn', $profile->npsn) }}" class="bg-slate-900 border-slate-700 text-white rounded-lg w-full p-2.5">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Tahun Ajaran</label>
                            <input type="text" name="academic_year" value="{{ old('academic_year', $profile->academic_year) }}" class="bg-slate-900 border-slate-700 text-white rounded-lg w-full p-2.5">
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-300 mb-2">Alamat Lengkap</label>
                                <textarea name="address" rows="2" class="bg-slate-900 border-slate-700 text-white rounded-lg w-full p-2.5">{{ old('address', $profile->address) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Kota / Kabupaten</label>
                                <input type="text" name="city" value="{{ old('city', $profile->city) }}" placeholder="Contoh: Kendari" class="bg-slate-900 border-slate-700 text-white rounded-lg w-full p-2.5">
                            </div>
                        </div>

                        <div class="p-5 bg-slate-900/40 rounded-xl border border-slate-700/50 space-y-4">
                            <h4 class="text-xs font-bold text-blue-400 uppercase tracking-widest">Kepala Sekolah</h4>
                            <input type="text" name="principal_name" value="{{ old('principal_name', $profile->principal_name) }}" placeholder="Nama & Gelar" class="bg-slate-800 border-slate-700 text-white rounded-lg w-full p-2.5 text-sm">
                            <input type="text" name="principal_nip" value="{{ old('principal_nip', $profile->principal_nip) }}" placeholder="NIP / NIY" class="bg-slate-800 border-slate-700 text-white rounded-lg w-full p-2.5 text-sm">
                        </div>

                        <div class="p-5 bg-slate-900/40 rounded-xl border border-slate-700/50 space-y-4">
                            <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Bendahara</h4>
                            <input type="text" name="treasurer_name" value="{{ old('treasurer_name', $profile->treasurer_name) }}" placeholder="Nama & Gelar" class="bg-slate-800 border-slate-700 text-white rounded-lg w-full p-2.5 text-sm">
                            <input type="text" name="treasurer_nip" value="{{ old('treasurer_nip', $profile->treasurer_nip) }}" placeholder="NIP / NIY" class="bg-slate-800 border-slate-700 text-white rounded-lg w-full p-2.5 text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-slate-700/50">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-500/20 transition-all">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>