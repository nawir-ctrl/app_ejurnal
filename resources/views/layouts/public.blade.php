<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'e-Jurnal Guru') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-900 text-slate-100 selection:bg-blue-500 selection:text-white relative overflow-x-hidden min-h-screen">
    <nav class="w-full bg-slate-900/50 backdrop-blur-md border-b border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between min-h-16 py-3 items-center gap-3">
                <div class="flex min-w-0 items-center gap-2 text-lg sm:text-xl font-bold text-white">
                    <svg class="w-7 h-7 shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span class="truncate">
                    e-Jurnal Guru
                    </span>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('login') }}" class="inline-flex min-h-[40px] items-center rounded-xl border border-slate-700 bg-slate-800 px-3 text-sm text-slate-200 hover:bg-slate-700 transition-colors">Login Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6 sm:py-10">
        @yield('content')
    </main>

</body>
</html>
