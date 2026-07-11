<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 text-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Administrasi') - Kelurahan Ledok Kulon</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS & JS Assets (Tailwind + Vite) -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="h-full flex flex-col md:flex-row overflow-hidden">

    <!-- Mobile Header -->
    <div class="md:hidden flex items-center justify-between bg-slate-900 text-white px-4 py-3 shadow-md">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center font-bold text-white shadow-md">L</div>
            <span class="font-bold tracking-wide text-sm">Ledok Kulon</span>
        </div>
        <button id="mobile-menu-toggle" class="p-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-950 text-slate-300 flex-col justify-between shadow-2xl transition-transform -translate-x-full md:translate-x-0 md:static md:flex md:h-full">
        <!-- Logo / Brand -->
        <div class="p-6 border-b border-slate-800">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-indigo-600 flex items-center justify-center font-extrabold text-white shadow-lg text-lg">L</div>
                <div>
                    <h1 class="font-bold text-white tracking-wide leading-none text-base">Ledok Kulon</h1>
                    <span class="text-xs text-slate-500">Persuratan & WA Gateway</span>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">Master Data</div>
            <a href="{{ route('ketua-rt.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('ketua-rt.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('ketua-rt.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Ketua RT
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">Persuratan</div>
            <a href="{{ route('surat-rt.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('surat-rt.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('surat-rt.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5"></path></svg>
                Pengantar RT
            </a>
            
            <a href="{{ route('surat-kelurahan.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('surat-kelurahan.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('surat-kelurahan.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Pengantar Kelurahan
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-600 uppercase tracking-wider">Uji Coba / Simulator</div>
            <a href="{{ route('simulator.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 group {{ request()->routeIs('simulator.*') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('simulator.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Fonnte Webhook Simulator
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-900">
            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-900">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-lg bg-indigo-500/20 flex items-center justify-center font-semibold text-indigo-400 text-sm">AD</div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold text-white leading-none truncate">Admin Desa</p>
                        <span class="text-[10px] text-slate-500 truncate">admin@desa.com</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-1.5 text-slate-500 hover:text-red-400 hover:bg-slate-800 rounded-lg transition-colors focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-slate-50">
        <!-- Inner Header -->
        <header class="hidden md:flex items-center justify-between px-8 py-4 bg-white border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-800">@yield('page_title', 'Dashboard')</h2>
            <div class="text-xs font-semibold text-slate-400">Ledok Kulon - Bojonegoro</div>
        </header>

        <!-- Scrollable Inner Content -->
        <div class="flex-1 overflow-y-auto px-4 py-6 md:p-8">
            <!-- Toast Flash Messages -->
            @if (session('success'))
                <div class="mb-6 flex items-center p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-center p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Content Container -->
            @yield('content')
        </div>
    </main>

    <!-- Sidebar backdrop (Mobile) -->
    <div id="sidebar-backdrop" class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm hidden md:hidden"></div>

    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        function toggleMobileMenu() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
        backdrop.addEventListener('click', toggleMobileMenu);
    </script>
</body>
</html>
