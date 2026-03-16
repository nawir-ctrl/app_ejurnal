<x-guest-layout>
    <div class="min-h-screen bg-slate-950 flex flex-col justify-center items-center px-4 py-12">
        
        <div class="mb-10 text-center">
            <div class="inline-flex p-4 bg-blue-600/10 rounded-3xl border border-blue-500/20 mb-4 shadow-2xl shadow-blue-500/20">
                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">E-Jurnal MTs</h1>
            <p class="text-slate-400 mt-2">Masuk untuk mengelola data mengajar</p>
        </div>

        <div class="w-full max-w-md bg-slate-900/50 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 shadow-2xl">
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Alamat Email</label>
                    <div class="relative">
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                            class="w-full bg-slate-950 border-slate-700 text-slate-200 rounded-2xl py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="nama@sekolah.sch.id">
                        <div class="absolute left-4 top-3.5 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label for="password" class="block text-sm font-medium text-slate-300">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full bg-slate-950 border-slate-700 text-slate-200 rounded-2xl py-3 pl-11 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="••••••••">
                        <div class="absolute left-4 top-3.5 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-950 text-blue-600 focus:ring-blue-500 shadow-sm" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-slate-400">Ingat saya di perangkat ini</label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold py-3.5 rounded-2xl transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-800 text-center">
                <p class="text-sm text-slate-500">Bukan Admin atau Guru?</p>
                <a href="{{ route('journals.public') }}" class="mt-2 inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Lihat Rekap Jurnal Publik
                </a>
            </div>
        </div>

        <p class="mt-10 text-slate-600 text-xs tracking-widest uppercase">
            &copy; 2026 MTs Pesantren Kilat
        </p>
    </div>
</x-guest-layout>