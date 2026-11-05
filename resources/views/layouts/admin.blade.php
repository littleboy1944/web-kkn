<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Panel Admin CMS Direktori RW & UMKM</title>
    
    <!-- One variable font family; system fonts remain the fallback. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="min-h-screen flex bg-slate-50 text-slate-800">

    <!-- Sidebar Navigation (SIG Corporate Admin Style) -->
    <aside class="w-64 bg-slate-950 text-white flex flex-col shrink-0 min-h-screen border-r border-slate-900 shadow-xl z-20">
        
        <!-- Sidebar Brand Header -->
        <div class="h-20 flex items-center px-6 border-b border-slate-900 bg-slate-950/95">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-xl bg-forest-900 text-white border border-forest-800 flex items-center justify-center font-bold text-xl group-hover:bg-terracotta group-hover:text-white transition duration-300 shadow-xs">
                    RW
                </div>
                <div>
                    <span class="block font-corporate text-lg font-extrabold text-white tracking-tight leading-tight">Panel CMS</span>
                    <span class="block text-[10px] font-mono text-emerald-300/80 uppercase tracking-wider font-bold">Direktori RW & UMKM</span>
                </div>
            </a>
        </div>

        <!-- Navigation Links Group -->
        <nav class="flex-grow p-4 space-y-1.5 text-xs font-semibold overflow-y-auto">
            
            <!-- Dashboard Item -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-terracotta text-white font-bold shadow-xs' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} transition duration-200">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="flex-grow">Dashboard Ringkasan</span>
                @if(request()->routeIs('admin.dashboard'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- Section Label -->
            <div class="pt-5 pb-1 px-3">
                <p class="text-[10px] font-mono uppercase tracking-wider text-emerald-400/80 font-bold">Pengelolaan Konten</p>
            </div>

            <!-- 1. Kelola RW -->
            <a href="{{ route('admin.rw.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.rw.*') ? 'bg-terracotta text-white font-bold shadow-xs' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} transition duration-200">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.rw.*') ? 'text-white' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="flex-grow">1. Kelola RW</span>
                @if(request()->routeIs('admin.rw.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- 2. Kelola UMKM -->
            <a href="{{ route('admin.umkm.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.umkm.*') ? 'bg-terracotta text-white font-bold shadow-xs' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} transition duration-200">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.umkm.*') ? 'text-white' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <span class="flex-grow">2. Kelola UMKM</span>
                @if(request()->routeIs('admin.umkm.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- 3. Kelola Produk -->
            <a href="{{ route('admin.produk.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.produk.*') ? 'bg-terracotta text-white font-bold shadow-xs' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} transition duration-200">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.produk.*') ? 'text-white' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="flex-grow">3. Kelola Produk</span>
                @if(request()->routeIs('admin.produk.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- 4. Kelola Cerita -->
            <a href="{{ route('admin.cerita.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.cerita.*') ? 'bg-terracotta text-white font-bold shadow-xs' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} transition duration-200">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.cerita.*') ? 'text-white' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <span class="flex-grow">4. Kelola Cerita</span>
                @if(request()->routeIs('admin.cerita.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- Section Label -->
            <div class="pt-5 pb-1 px-3">
                <p class="text-[10px] font-mono uppercase tracking-wider text-emerald-400/80 font-bold">Konfigurasi</p>
            </div>

            <!-- 5. Pengaturan Website -->
            <a href="{{ route('admin.pengaturan.index') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.pengaturan.*') ? 'bg-terracotta text-white font-bold shadow-xs' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }} transition duration-200">
                <svg class="w-4 h-4 {{ request()->routeIs('admin.pengaturan.*') ? 'text-white' : 'text-emerald-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="flex-grow">5. Pengaturan Website</span>
                @if(request()->routeIs('admin.pengaturan.*'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- Section Label -->
            <div class="pt-5 pb-1 px-3">
                <p class="text-[10px] font-mono uppercase tracking-wider text-emerald-400/80 font-bold">Tautan Luar</p>
            </div>

            <!-- Public Site Link -->
            <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:bg-slate-900 hover:text-white transition duration-200">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                <span>Lihat Website Publik</span>
            </a>

        </nav>

        <!-- Current User Profile & Logout Strip -->
        <div class="p-4 border-t border-slate-900 bg-slate-950">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5 truncate">
                    <div class="w-8 h-8 rounded-full bg-emerald-600/30 text-emerald-300 border border-emerald-500/40 flex items-center justify-center font-bold text-xs shrink-0 font-mono">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <span class="block text-xs font-bold text-white truncate leading-tight">{{ auth()->user()->name ?? 'Administrator' }}</span>
                        <span class="block text-[10px] text-emerald-300/80 truncate font-mono">{{ auth()->user()->email ?? 'admin@rwumkm.local' }}</span>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Keluar / Logout" class="p-2 rounded-lg text-slate-400 hover:text-terracotta hover:bg-slate-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-h-screen overflow-x-hidden">
        
        <!-- Top Institutional Header Bar -->
        <header class="h-20 bg-white border-b border-slate-200 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-10 shadow-2xs">
            <div>
                <span class="block text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold">Panel Manajemen Konten</span>
                <h1 class="font-corporate text-2xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    @yield('header_title', 'Dashboard')
                </h1>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-4">
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-bold font-mono bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    Sesi Admin Aktif
                </span>
                
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-slate-100 text-slate-700 hover:bg-slate-200 border border-slate-200 transition shadow-2xs">
                    <span>Lihat Web</span>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            </div>
        </header>

        <!-- Main Body Wrapper -->
        <main class="flex-grow p-6 sm:p-8 max-w-7xl w-full mx-auto space-y-6">
            
            <!-- Success Flash Alert -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center justify-between shadow-2xs">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold px-2 py-1">&times;</button>
                </div>
            @endif

            <!-- Error Flash Alert -->
            @if(session('error'))
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm flex items-center justify-between shadow-2xs">
                    <div class="flex items-center space-x-3">
                        <div class="w-7 h-7 rounded-full bg-red-600 text-white flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-900 font-bold px-2 py-1">&times;</button>
                </div>
            @endif

            <!-- Validation Errors List -->
            @if($errors->any())
                <div class="p-5 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm shadow-2xs">
                    <div class="flex items-center space-x-2 font-bold mb-2 text-red-900">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span>Mohon periksa kolom formulir berikut:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-xs text-red-700 pl-2">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Admin Institutional Footer -->
        <footer class="bg-white border-t border-slate-200 py-4 px-6 sm:px-8 text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2 mt-auto">
            <p>CMS Direktori Profil RW & UMKM &middot; Berbasis Laravel 12 & MySQL</p>
            <p class="font-mono text-[11px] text-slate-400">Sistem Desain Terintegrasi &middot; Profesional & Akuntabel</p>
        </footer>

    </div>

    @stack('scripts')
</body>
</html>
