<nav x-data="{ open: false }" class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between min-h-16">
            <div class="flex min-w-0">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Admin
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-300">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('journals.index')" :active="request()->routeIs('journals.index')" class="text-slate-300">
                        Data Jurnal
                    </x-nav-link>
                    <x-nav-link :href="route('journals.rekap-jam')" :active="request()->routeIs('journals.rekap-jam')" class="text-slate-300">
                        Rekap Jam
                    </x-nav-link>
                    
                    <x-nav-link :href="route('teachers.index')" :active="request()->routeIs('teachers.*')" class="text-slate-300">
                        Guru
                    </x-nav-link>
                    <x-nav-link :href="route('subjects.index')" :active="request()->routeIs('subjects.*')" class="text-slate-300">
                        Mapel
                    </x-nav-link>
                    <x-nav-link :href="route('classrooms.index')" :active="request()->routeIs('classrooms.*')" class="text-slate-300">
                        Kelas
                    </x-nav-link>

                    <x-nav-link :href="route('school-profile.edit')" :active="request()->routeIs('school-profile.*')" class="text-blue-400 font-bold">
                        Profil Sekolah
                    </x-nav-link>

                    <x-nav-link :href="route('home')" target="_blank" class="text-purple-400 hover:text-purple-300 transition-colors">
                        Form Publik ↗
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-700 text-sm leading-4 font-medium rounded-lg text-slate-300 bg-slate-800 hover:text-white hover:bg-slate-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-slate-800 border border-slate-700 rounded-md">
                            <x-dropdown-link :href="route('profile.edit')" class="text-slate-300 hover:bg-slate-700 hover:text-white">
                                Profil Akun
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-red-400 hover:bg-slate-700 hover:text-red-300">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900 border-b border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-300">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('journals.index')" :active="request()->routeIs('journals.index')" class="text-slate-300">Data Jurnal</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('journals.rekap-jam')" :active="request()->routeIs('journals.rekap-jam')" class="text-slate-300">Rekap Jam</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('teachers.index')" :active="request()->routeIs('teachers.*')" class="text-slate-300">Guru</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('subjects.index')" :active="request()->routeIs('subjects.*')" class="text-slate-300">Mapel</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('classrooms.index')" :active="request()->routeIs('classrooms.*')" class="text-slate-300">Kelas</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('school-profile.edit')" :active="request()->routeIs('school-profile.*')" class="text-blue-400">Profil Sekolah</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" target="_blank" class="text-purple-400">Form Publik ↗</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-800">
            <div class="px-4">
                <div class="font-medium text-base text-slate-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-400">
                        Logout
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
