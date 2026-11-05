@extends('layouts.public')

@section('title', "{$rw->nomor_rw} — {$rw->nama}")
@section('meta_description', Str::limit(strip_tags($rw->deskripsi), 160))

@section('content')

    <!-- =========================================================================
         1. WIDE HERO BANNER (Inspirasi SIG: Panoramik, Modern, Elegan & Berwibawa)
    ========================================================================= -->
    <section class="profile-hero relative bg-slate-950 text-white overflow-hidden">
        <!-- Panoramic Background Image with Gradient Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $rw->cover_url }}" alt="{{ $rw->nama }}" class="w-full h-full object-cover object-center opacity-30 scale-105 transform motion-safe:transition-transform motion-safe:duration-1000">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-slate-900/60"></div>
            <!-- Subtle Grid Pattern Accent -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-16 lg:pt-14 lg:pb-20">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center space-x-2 text-xs font-mono text-emerald-200/80 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                <span class="text-white/40">/</span>
                <a href="{{ route('rw.index') }}" class="hover:text-white transition">Daftar RW</a>
                <span class="text-white/40">/</span>
                <span class="text-white font-semibold">{{ $rw->nomor_rw }}</span>
            </nav>

            <div class="max-w-4xl space-y-6">
                <!-- Status & Identification Badge -->
                <div class="inline-flex items-center space-x-2.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-mono text-emerald-200 font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="tracking-wider uppercase">Profil Wilayah Resmi Rukun Warga</span>
                    <span class="text-white/40">&middot;</span>
                    <span class="text-white/90">{{ $rw->nomor_rw }}</span>
                </div>

                <!-- Hero Heading (Modern Corporate Sans-Serif) -->
                <h1 class="font-corporate text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12]">
                    {{ $rw->nama }}
                </h1>

                <!-- Brief Narrative Introduction -->
                <p class="text-base sm:text-xl text-slate-200 font-normal leading-relaxed max-w-3xl">
                    {{ Str::limit(strip_tags($rw->deskripsi ?? 'Wilayah rukun warga dengan beragam potensi usaha mandiri, gotong royong komunitas, dan produk berkualitas buatan warga.'), 220) }}
                </p>

                <!-- Hero CTAs (SIG Signature Buttons) -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="#daftar-umkm" class="inline-flex items-center justify-center px-7 py-3.5 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider bg-terracotta text-white hover:bg-terracotta-hover shadow-lg hover:shadow-xl transition-all duration-300 group">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Jelajahi {{ $activeUmkmCount }} UMKM di {{ $rw->nomor_rw }}</span>
                    </a>
                    <a href="#sekilas-rw" class="inline-flex items-center justify-center px-6 py-3.5 rounded-xl text-xs sm:text-sm font-bold tracking-wide bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 transition duration-300">
                        <span>Sekilas Profil & Potensi</span>
                    </a>
                </div>
            </div>

            <!-- Quick Fact Metric Strips (SIG Inspired Metric Band) -->
            <div class="mt-12 pt-8 border-t border-white/15 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Pelaku UMKM Aktif</span>
                    <span class="block font-corporate text-2xl sm:text-3xl font-extrabold text-white mt-1">{{ $activeUmkmCount }}</span>
                    <span class="block text-[11px] text-slate-300 mt-0.5">Usaha Terdaftar & Terverifikasi</span>
                </div>
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Kategori Usaha</span>
                    <span class="block font-corporate text-2xl sm:text-3xl font-extrabold text-white mt-1">{{ $categories->count() > 0 ? $categories->count() : '1' }}</span>
                    <span class="block text-[11px] text-slate-300 mt-0.5">Sektor Produksi & Jasa</span>
                </div>
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Status Profil</span>
                    <span class="inline-flex items-center space-x-1.5 mt-2 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold font-mono">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        <span>Terbit Publik</span>
                    </span>
                    <span class="block text-[11px] text-slate-300 mt-1">Dikelola Pengurus RW</span>
                </div>
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Pusat Informasi</span>
                    <span class="block font-sans text-sm font-bold text-white mt-2 truncate">{{ $rw->nomor_rw }}</span>
                    <a href="#kontak-wilayah" class="inline-block text-[11px] text-emerald-300 hover:text-white underline mt-0.5 font-semibold">Lihat Kontak & Lokasi &rarr;</a>
                </div>
            </div>

        </div>
    </section>


    <!-- =========================================================================
         2. SEKILAS TENTANG RW (Inspirasi SIG: Tata Letak Bersih, Terstruktur & Luas)
    ========================================================================= -->
    <section id="sekilas-rw" class="py-16 sm:py-24 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="max-w-3xl mb-12">
                <div class="inline-flex items-center space-x-2 text-xs font-mono text-terracotta uppercase tracking-wider mb-2 font-bold">
                    <span class="w-2 h-2 rounded-full bg-terracotta"></span>
                    <span>Tentang Wilayah</span>
                </div>
                <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-snug">
                    Mengenal Lingkungan & Karakter {{ $rw->nomor_rw }}
                </h2>
                <p class="text-base text-slate-600 mt-2 font-normal">
                    Gambaran umum tata ruang wilayah, kerukunan warga, dan komitmen mendukung pertumbuhan usaha lokal.
                </p>
            </div>

            <!-- Two-Column Structured Presentation -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                
                <!-- Left Column: Narrative & Visual Gallery -->
                <div class="lg:col-span-7 space-y-8">
                    <div class="prose prose-slate max-w-none text-slate-700 text-base sm:text-lg leading-relaxed font-normal space-y-4">
                        @if($rw->deskripsi)
                            {!! nl2br(e($rw->deskripsi)) !!}
                        @else
                            <p>Wilayah {{ $rw->nomor_rw }} — {{ $rw->nama }} merupakan lingkungan pemukiman yang berdaya, dengan kerukunan warga yang kuat serta potensi usaha mikro, kecil, dan menengah yang terus berkembang.</p>
                        @endif
                    </div>

                    <!-- Photo Gallery (if available) -->
                    @if(!empty($rw->foto_galeri) && is_array($rw->foto_galeri) && count($rw->foto_galeri) > 0)
                        <div class="pt-6 border-t border-slate-100">
                            <h3 class="text-xs font-mono uppercase tracking-wider text-slate-400 font-bold mb-3">
                                Dokumentasi Lingkungan & Suasana Wilayah
                            </h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($rw->foto_galeri as $photo)
                                    <div class="aspect-[4/3] rounded-xl overflow-hidden bg-slate-100 border border-slate-200 group">
                                        <img src="{{ Str::startsWith($photo, ['http://', 'https://']) ? $photo : asset($photo) }}" alt="Dokumentasi {{ $rw->nomor_rw }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Institutional Identity Card (SIG Inspired Corporate Info Box) -->
                <div class="lg:col-span-5">
                    <div class="sticky top-28 bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs space-y-6">
                        
                        <div class="flex items-center space-x-3 pb-4 border-b border-slate-100">
                            <div class="w-12 h-12 rounded-xl bg-forest-900 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                                RW
                            </div>
                            <div>
                                <span class="block text-xs font-mono uppercase tracking-wider text-slate-400 font-bold">Data Administrasi</span>
                                <h3 class="font-corporate text-lg font-bold text-slate-900 leading-tight">{{ $rw->nama }}</h3>
                            </div>
                        </div>

                        <!-- Data Points -->
                        <div class="space-y-4 text-xs sm:text-sm">
                            <div class="flex items-start justify-between py-2 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Nomor Wilayah</span>
                                <span class="font-bold text-slate-900 font-mono">{{ $rw->nomor_rw }}</span>
                            </div>

                            <div class="flex items-start justify-between py-2 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Jumlah UMKM Terdata</span>
                                <span class="font-bold text-slate-900 font-mono">{{ $activeUmkmCount }} Usaha Aktif</span>
                            </div>

                            @if($rw->is_leader_public && $rw->nama_ketua_rw)
                                <div class="flex items-start justify-between py-2 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Ketua RW</span>
                                    <span class="font-semibold text-slate-900 text-right">{{ $rw->nama_ketua_rw }}</span>
                                </div>
                            @else
                                <div class="flex items-start justify-between py-2 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Pengurus RW</span>
                                    <span class="text-slate-400 italic text-right">Tercatat dalam administrasi</span>
                                </div>
                            @endif

                            @if($rw->is_leader_public && $rw->kontak_ketua_rw)
                                <div class="flex items-start justify-between py-2 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Kontak Pengurus</span>
                                    <span class="font-mono font-bold text-forest-900">{{ $rw->kontak_ketua_rw }}</span>
                                </div>
                            @endif

                            <div class="flex items-start justify-between py-2 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Status Publikasi</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold font-mono bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Terbit & Terverifikasi
                                </span>
                            </div>

                            <div class="flex items-start justify-between py-2">
                                <span class="text-slate-500 font-medium">Pembaruan Data</span>
                                <span class="text-slate-600 font-mono text-xs">{{ $rw->updated_at->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="pt-2">
                            <a href="#daftar-umkm" class="w-full inline-flex items-center justify-center space-x-2 px-5 py-3 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase tracking-wider hover:bg-terracotta transition shadow-sm">
                                <span>Lihat Seluruh UMKM Wilayah Ini</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- =========================================================================
         3. POTENSI & CIRI KHAS WILAYAH (Jika Data Tersedia - SIG Pillar Cards)
    ========================================================================= -->
    @if($rw->potensi_kegiatan)
        <section id="potensi-wilayah" class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="max-w-3xl mb-12">
                    <div class="inline-flex items-center space-x-2 text-xs font-mono text-emerald-700 uppercase tracking-wider mb-2 font-bold">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        <span>Potensi & Ciri Khas</span>
                    </div>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Potensi Unggulan & Kegiatan Warga
                    </h2>
                    <p class="text-base text-slate-600 mt-2 font-normal">
                        Kekuatan khas lingkungan yang menjadi motor penggerak ekonomi, kemandirian sosial, dan kebersamaan di {{ $rw->nomor_rw }}.
                    </p>
                </div>

                <!-- Structured Feature Cards Grid (Inspirasi SIG: Pillar Cards) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Card 1: Potensi Utama -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-7 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center mb-5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            </div>
                            <span class="text-[11px] font-mono uppercase tracking-wider text-emerald-700 font-bold block mb-1">Ciri Khas & Keunggulan</span>
                            <h3 class="font-corporate text-xl font-bold text-slate-900 leading-snug">
                                Potensi Spesifik Wilayah
                            </h3>
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed font-normal">
                                {{ $rw->potensi_kegiatan }}
                            </p>
                        </div>
                        <div class="pt-5 mt-5 border-t border-slate-100 text-[11px] font-mono text-slate-400">
                            Terdata Resmi &middot; {{ $rw->nomor_rw }}
                        </div>
                    </div>

                    <!-- Card 2: Penguatan UMKM -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-7 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-terracotta/10 text-terracotta flex items-center justify-center mb-5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-[11px] font-mono uppercase tracking-wider text-terracotta font-bold block mb-1">Ekonomi Kerakyatan</span>
                            <h3 class="font-corporate text-xl font-bold text-slate-900 leading-snug">
                                Direktori Usaha Berkelanjutan
                            </h3>
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed font-normal">
                                Terdapat {{ $activeUmkmCount }} unit usaha mikro, kecil, dan menengah aktif yang terhubung langsung ke pembeli via kanal pemesanan digital.
                            </p>
                        </div>
                        <div class="pt-5 mt-5 border-t border-slate-100 text-[11px] font-mono text-slate-400">
                            {{ $categories->count() }} Kategori Usaha Tersebar
                        </div>
                    </div>

                    <!-- Card 3: Solidaritas Komunitas -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-7 shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-800 flex items-center justify-center mb-5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-[11px] font-mono uppercase tracking-wider text-slate-700 font-bold block mb-1">Kemandirian Komunitas</span>
                            <h3 class="font-corporate text-xl font-bold text-slate-900 leading-snug">
                                Gotong Royong & Kebersamaan
                            </h3>
                            <p class="text-sm text-slate-600 mt-3 leading-relaxed font-normal">
                                Menjalin sinergi antara warga, pelaku usaha, dan pengurus lingkungan demi menciptakan wilayah yang aman, produktif, dan harmonis.
                            </p>
                        </div>
                        <div class="pt-5 mt-5 border-t border-slate-100 text-[11px] font-mono text-slate-400">
                            Komunitas Warga Mandiri
                        </div>
                    </div>

                </div>

            </div>
        </section>
    @endif


    <!-- =========================================================================
         4. DAFTAR UMKM DI RW (Inspirasi SIG: Grid Kartu Bersih, Rapi & Konsisten)
    ========================================================================= -->
    <section id="daftar-umkm" class="py-16 sm:py-24 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Title & Category Filter Badges -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-6 border-b border-slate-200 gap-4">
                <div>
                    <div class="inline-flex items-center space-x-2 text-xs font-mono text-terracotta uppercase tracking-wider mb-2 font-bold">
                        <span class="w-2 h-2 rounded-full bg-terracotta"></span>
                        <span>Direktori Pelaku Usaha</span>
                    </div>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        Pelaku UMKM di Wilayah {{ $rw->nomor_rw }}
                    </h2>
                    <p class="text-base text-slate-600 mt-2 font-normal max-w-2xl">
                        Dukung usaha tetangga. Hubungi langsung pelaku usaha untuk pemesanan produk, layanan, atau kerja sama.
                    </p>
                </div>

                <!-- Category Filters -->
                @if($categories->count() > 0)
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-mono text-slate-400 mr-1 font-semibold">Sektor:</span>
                        @foreach($categories as $cat)
                            <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $cat }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- UMKM Grid Cards (SIG Card Style: Clean Border, Smooth Scale, Red Arrow Link) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($umkms as $umkm)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                        
                        <!-- Thumbnail Image -->
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $umkm->cover_url }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Badges floating on cover -->
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-white/95 backdrop-blur-xs text-slate-900 shadow-2xs border border-slate-200 font-mono">
                                    {{ $umkm->kategori }}
                                </span>
                            </div>

                            @if($umkm->is_unggulan)
                                <div class="absolute top-3 right-3">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-terracotta text-white shadow-xs font-mono">
                                        Unggulan
                                    </span>
                                </div>
                            @endif

                            <div class="absolute bottom-3 left-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-950/80 backdrop-blur-xs text-white">
                                    {{ $rw->nomor_rw }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-corporate text-2xl font-bold text-slate-900 group-hover:text-terracotta transition leading-snug">
                                    <a href="{{ route('umkm.show', $umkm->slug) }}">
                                        {{ $umkm->nama_usaha }}
                                    </a>
                                </h3>
                                
                                @if($umkm->is_owner_public && $umkm->nama_pemilik)
                                    <p class="text-xs text-slate-500 mt-1">
                                        Pengelola: <span class="text-slate-800 font-semibold">{{ $umkm->nama_pemilik }}</span>
                                    </p>
                                @endif

                                <p class="text-sm text-slate-600 mt-3 line-clamp-2 leading-relaxed font-normal">
                                    {{ $umkm->deskripsi }}
                                </p>

                                @if($umkm->products->count() > 0)
                                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                        <span class="font-mono text-slate-400">Katalog Produk:</span>
                                        <span class="font-bold text-forest-900 bg-forest-50 px-2 py-0.5 rounded text-[11px] font-mono">{{ $umkm->products->count() }} Macam Produk</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Card Action Buttons -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                                <a href="{{ route('umkm.show', $umkm->slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition">
                                    <span>Lihat Profil</span>
                                    <span class="ml-1">&rarr;</span>
                                </a>

                                @if($umkm->nomor_whatsapp)
                                    <a href="{{ $umkm->getWhatsappUrl() }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-xl text-xs font-bold bg-emerald-600 text-white hover:bg-emerald-700 shadow-xs transition duration-200">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        <span>WhatsApp</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-slate-50 rounded-2xl border border-slate-200 p-8">
                        <div class="w-12 h-12 rounded-full bg-slate-200 text-slate-500 mx-auto flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <p class="font-corporate text-xl font-bold text-slate-800">Belum ada UMKM terdaftar di {{ $rw->nomor_rw }}</p>
                        <p class="text-sm text-slate-500 mt-1 max-w-md mx-auto">Data pelaku usaha mikro dan produk lokal untuk wilayah ini sedang dalam tahap kurasi dan akan segera diperbarui.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($umkms->hasPages())
                <div class="mt-12 pt-6 border-t border-slate-200">
                    {{ $umkms->links() }}
                </div>
            @endif

        </div>
    </section>


    <!-- =========================================================================
         5. KEGIATAN & WARTA TERKAIT (Jika Fitur & Data Tersedia)
    ========================================================================= -->
    @if(isset($latestArticles) && $latestArticles->count() > 0)
        <section class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 pb-4 border-b border-slate-200 gap-4">
                    <div>
                        <div class="inline-flex items-center space-x-2 text-xs font-mono text-terracotta uppercase tracking-wider mb-2 font-bold">
                            <span class="w-2 h-2 rounded-full bg-terracotta"></span>
                            <span>Kabar & Artikel Terkait</span>
                        </div>
                        <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                            Cerita & Denyut Kegiatan Komunitas
                        </h2>
                    </div>
                    <a href="{{ route('cerita.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition">
                        <span>Lihat Seluruh Cerita</span>
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($latestArticles as $article)
                        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col group">
                            <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                                <img src="{{ $article->cover_url }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                                <div>
                                    <div class="flex items-center space-x-2 text-xs font-mono text-slate-400">
                                        <span class="font-bold text-terracotta uppercase tracking-wider">{{ $article->kategori }}</span>
                                        <span>&middot;</span>
                                        <span>{{ $article->formatted_date }}</span>
                                    </div>
                                    <h3 class="font-corporate text-xl font-bold text-slate-900 mt-2 leading-snug group-hover:text-terracotta transition">
                                        <a href="{{ route('cerita.show', $article->slug) }}">
                                            {{ $article->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-2 line-clamp-2 leading-relaxed font-normal">
                                        {{ $article->ringkasan }}
                                    </p>
                                </div>
                                <div class="pt-3 border-t border-slate-100">
                                    <a href="{{ route('cerita.show', $article->slug) }}" class="text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition inline-flex items-center">
                                        <span>Baca Artikel</span>
                                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>
    @endif


    <!-- =========================================================================
         6. KONTAK & CALL-TO-ACTION KOMUNITAS
    ========================================================================= -->
    <section id="kontak-wilayah" class="py-16 sm:py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <div class="lg:col-span-8 space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full bg-slate-800 text-emerald-300 text-xs font-mono uppercase tracking-wider border border-slate-700 font-bold">
                        Pemberdayaan Warga {{ $rw->nomor_rw }}
                    </span>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold leading-tight">
                        Punya Usaha di Wilayah {{ $rw->nomor_rw }}?
                    </h2>
                    <p class="text-base text-slate-300 font-normal leading-relaxed max-w-2xl">
                        Daftarkan usaha mikro, kerajinan, atau produk kuliner Anda ke dalam direktori resmi rukun warga. Gratis untuk seluruh warga di lingkungan {{ $rw->nomor_rw }}.
                    </p>
                </div>

                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-end">
                    @if(!empty($settings->kontak_telepon))
                        <a href="https://wa.me/{{ $settings->kontak_telepon }}?text={{ rawurlencode('Halo Pengelola Direktori, saya warga ' . $rw->nomor_rw . ' ingin mendaftarkan UMKM baru.') }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-2 px-6 py-3.5 rounded-xl bg-terracotta text-white font-bold text-xs uppercase tracking-wider hover:bg-terracotta-hover shadow-lg transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Hubungi Pengelola via WhatsApp</span>
                        </a>
                    @endif
                    <a href="{{ route('kontak.index') }}" class="w-full inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-slate-800 text-white hover:bg-slate-700 border border-slate-700 font-bold text-xs uppercase tracking-wider transition">
                        <span>Informasi Sekretariat Lengkap</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
