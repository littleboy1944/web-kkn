<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Direktori Profil RW & Ragam UMKM Lokal') — {{ $settings->nama_website ?? 'Direktori RW & UMKM' }}</title>
    <meta name="description" content="@yield('meta_description', $settings->deskripsi_singkat ?? 'Publikasi profil rukun warga dan direktori terkurasi usaha mikro, kecil, dan menengah lokal.')">
    <meta property="og:title" content="@yield('title', 'Direktori RW & UMKM')">
    <meta property="og:description" content="@yield('meta_description', $settings->deskripsi_singkat ?? 'Katalog usaha lokal dan potensi rukun warga.')">
    <meta property="og:type" content="website">

    <!-- One variable font family; system fonts remain the fallback. -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col selection:bg-terracotta selection:text-white bg-slate-50 text-slate-900">

    <!-- Top Announcement & Status Bar (SIG Inspired: Minimalist, Corporate, Transparan) -->
    <div class="bg-slate-950 text-slate-300 text-xs py-2 px-4 border-b border-slate-900">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2.5">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-[11px] font-mono uppercase tracking-wider font-bold text-emerald-300">Portal Profil Resmi Rukun Warga</span>
                <span class="hidden md:inline text-slate-600">|</span>
                <span class="hidden md:inline text-slate-300 text-[11px]">Transparansi Wilayah, Kemandirian Usaha Warga & Direktori UMKM Terverifikasi</span>
            </div>
            <div class="flex items-center text-[11px] font-mono text-slate-400">
                <span class="hidden sm:inline">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Corporate Header Navigation (SIG Inspired: Putih Bersih, Rapi, Indikator Aktif Tegas) -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/90 shadow-2xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3.5 group">
                    <div class="w-11 h-11 rounded-xl bg-forest-900 text-white flex items-center justify-center font-bold text-xl shadow-xs group-hover:bg-terracotta transition-colors duration-300">
                        RW
                    </div>
                    <div>
                        <span class="block font-corporate text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900 leading-tight">
                            {{ $settings->nama_website ?? 'DIREKTORI RW & UMKM' }}
                        </span>
                        <span class="block text-[11px] font-mono tracking-wider uppercase text-slate-500 font-semibold">
                            Portal Wilayah & Direktori Usaha Warga
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu (SIG Inspired with signature bottom border on active) -->
                <nav class="hidden md:flex items-center space-x-7 lg:space-x-8">
                    <a href="{{ route('home') }}" class="text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('home') ? 'nav-item-active text-slate-900' : 'text-slate-600 hover:text-slate-900' }}">
                        Beranda
                    </a>
                    <a href="{{ route('rw.index') }}" class="text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('rw.*') ? 'nav-item-active text-slate-900' : 'text-slate-600 hover:text-slate-900' }}">
                        Profil RW
                    </a>
                    <a href="{{ route('umkm.index') }}" class="text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('umkm.*') ? 'nav-item-active text-slate-900' : 'text-slate-600 hover:text-slate-900' }}">
                        Direktori UMKM
                    </a>
                    <a href="{{ route('cerita.index') }}" class="text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('cerita.*') ? 'nav-item-active text-slate-900' : 'text-slate-600 hover:text-slate-900' }}">
                        Cerita & Kegiatan
                    </a>
                    <a href="{{ route('kontak.index') }}" class="text-xs font-bold uppercase tracking-wider transition-colors {{ request()->routeIs('kontak.index') ? 'nav-item-active text-slate-900' : 'text-slate-600 hover:text-slate-900' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Desktop Action Button (SIG CTA Style) -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('umkm.index') }}" class="inline-flex items-center justify-center space-x-2 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-terracotta text-white hover:bg-terracotta-hover shadow-sm hover:shadow-md transition-all duration-300 group">
                        <span>Jelajahi UMKM</span>
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex md:hidden items-center">
                    <button id="mobileMenuBtn" type="button" aria-label="Buka Menu" class="p-2.5 rounded-xl text-slate-700 hover:bg-slate-100 transition border border-slate-200">
                        <svg id="menuIconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg id="menuIconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileDrawer" class="hidden md:hidden border-t border-slate-200 bg-white px-4 pt-4 pb-6 space-y-2 shadow-xl">
            <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'bg-slate-100 text-terracotta' : 'text-slate-700 hover:bg-slate-50' }}">
                Beranda
            </a>
            <a href="{{ route('rw.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('rw.*') ? 'bg-slate-100 text-terracotta' : 'text-slate-700 hover:bg-slate-50' }}">
                Profil RW
            </a>
            <a href="{{ route('umkm.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('umkm.*') ? 'bg-slate-100 text-terracotta' : 'text-slate-700 hover:bg-slate-50' }}">
                Direktori UMKM
            </a>
            <a href="{{ route('cerita.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('cerita.*') ? 'bg-slate-100 text-terracotta' : 'text-slate-700 hover:bg-slate-50' }}">
                Cerita & Kegiatan
            </a>
            <a href="{{ route('kontak.index') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('kontak.index') ? 'bg-slate-100 text-terracotta' : 'text-slate-700 hover:bg-slate-50' }}">
                Kontak
            </a>
            <div class="pt-3 border-t border-slate-200">
                <a href="{{ route('umkm.index') }}" class="w-full inline-flex items-center justify-center px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-wider bg-terracotta text-white hover:bg-terracotta-hover transition shadow">
                    <span>Jelajahi Seluruh UMKM</span>
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Modern Corporate Footer (Inspirasi SIG: Terstruktur, Rapi, Lengkap) -->
    <footer class="bg-slate-950 text-slate-200 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-12">
                
                <!-- Brand statement -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center space-x-3.5">
                        <div class="w-10 h-10 rounded-xl bg-terracotta text-white flex items-center justify-center font-bold text-xl shadow-sm">
                            RW
                        </div>
                        <span class="font-corporate text-2xl font-extrabold tracking-tight text-white">
                            {{ $settings->nama_website ?? 'Direktori RW & UMKM' }}
                        </span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed max-w-sm font-normal">
                        {{ $settings->deskripsi_singkat ?? 'Publikasi digital profil rukun warga dan direktori terkurasi produk serta pelaku UMKM lokal untuk memperkuat ekonomi komunitas warga.' }}
                    </p>
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-md bg-slate-900 text-[11px] font-mono text-emerald-300 border border-slate-800">
                        <span>Hirarki Wilayah: RW &rarr; Pelaku UMKM &rarr; Produk</span>
                    </div>
                </div>

                <!-- Navigation Columns -->
                <div class="md:col-span-2 space-y-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-400 font-mono">Navigasi Utama</p>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('rw.index') }}" class="hover:text-white transition">Profil RW</a></li>
                        <li><a href="{{ route('umkm.index') }}" class="hover:text-white transition">Direktori UMKM</a></li>
                        <li><a href="{{ route('cerita.index') }}" class="hover:text-white transition">Cerita & Kegiatan</a></li>
                        <li><a href="{{ route('kontak.index') }}" class="hover:text-white transition">Kontak Wilayah</a></li>
                    </ul>
                </div>

                <!-- Sektor UMKM -->
                <div class="md:col-span-2 space-y-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-400 font-mono">Sektor Usaha</p>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li><a href="{{ route('umkm.index', ['kategori' => 'Makanan & Minuman']) }}" class="hover:text-white transition">Makanan & Minuman</a></li>
                        <li><a href="{{ route('umkm.index', ['kategori' => 'Kerajinan Tangan']) }}" class="hover:text-white transition">Kerajinan Tangan</a></li>
                        <li><a href="{{ route('umkm.index', ['kategori' => 'Fesyen & Tekstil']) }}" class="hover:text-white transition">Fesyen & Tekstil</a></li>
                        <li><a href="{{ route('umkm.index', ['kategori' => 'Pertanian & Perkebunan']) }}" class="hover:text-white transition">Pertanian & Kebun</a></li>
                    </ul>
                </div>

                <!-- Secretary & Contact Info -->
                <div class="md:col-span-3 space-y-3">
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-400 font-mono">Sekretariat Pengelola</p>
                    <p class="text-sm text-slate-300 leading-relaxed font-normal">
                        {{ $settings->alamat_sekretariat ?? 'Balai Warga, Jl. Komunitas Raya No. 01' }}
                    </p>
                    @if(!empty($settings->kontak_email))
                        <p class="text-xs text-slate-300">
                            Email: <a href="mailto:{{ $settings->kontak_email }}" class="text-emerald-300 hover:underline">{{ $settings->kontak_email }}</a>
                        </p>
                    @endif
                    @if(!empty($settings->kontak_telepon))
                        <p class="text-xs text-slate-300">
                            WhatsApp: <a href="https://wa.me/{{ $settings->kontak_telepon }}" target="_blank" rel="noopener noreferrer" class="text-emerald-300 hover:underline font-mono">+{{ $settings->kontak_telepon }}</a>
                        </p>
                    @endif
                    <div class="pt-4 border-t border-slate-800">
                        <a href="{{ route('kontak.index') }}" class="inline-flex items-center text-xs font-semibold text-emerald-300 hover:text-white transition">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <span>Hubungi Sekretariat Pengelola</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Sub-footer -->
            <div class="mt-12 pt-8 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 space-y-4 sm:space-y-0">
                <p>&copy; {{ date('Y') }} {{ $settings->nama_website ?? 'Direktori RW & UMKM' }}. Seluruh hak cipta dilindungi.</p>
                <div class="flex items-center space-x-3 font-mono text-[11px]">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Sistem Terverifikasi Komunitas Warga</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle script -->
    <script>
        const menuBtn = document.getElementById('mobileMenuBtn');
        const drawer = document.getElementById('mobileDrawer');
        const iconOpen = document.getElementById('menuIconOpen');
        const iconClose = document.getElementById('menuIconClose');

        if (menuBtn && drawer) {
            menuBtn.addEventListener('click', () => {
                drawer.classList.toggle('hidden');
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
