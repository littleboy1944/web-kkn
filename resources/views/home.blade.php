@extends('layouts.public')

@section('title', 'Beranda — Mengenal Rukun Warga & Ragam UMKM Lokal')

@section('content')

    <!-- =========================================================================
         HERO SECTION (Inspirasi SIG: Panoramik, Modern, Elegan & Berwibawa)
    ========================================================================= -->
    <section class="home-hero relative bg-slate-950 text-white overflow-hidden">
        <!-- Panoramic Background Accent -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $settings->hero_image_url }}" alt="Potensi RW dan UMKM" class="w-full h-full object-cover object-center opacity-25 scale-105 transform motion-safe:transition-transform motion-safe:duration-1000">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-slate-900/60"></div>
            <!-- Subtle Radial Dot Matrix -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
            <div class="max-w-3xl space-y-6">
                
                <!-- Status Badge -->
                <div class="inline-flex items-center space-x-2.5 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-mono text-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="tracking-wider uppercase font-bold">Portal Profil Wilayah & Direktori Usaha Warga</span>
                </div>

                <!-- Main Headline (Bold Corporate Sans-Serif like SIG) -->
                <h1 class="font-corporate text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12]">
                    Wajah Komunitas, Denyut Usaha Lokal.
                </h1>

                <!-- Sub-narrative -->
                <p class="text-base sm:text-xl text-slate-200 font-normal leading-relaxed">
                    Mengenal potensi setiap rukun warga dan menemukan produk autentik buatan tetangga. Dari roastery kopi mikro, kriya anyaman bambu, hingga jamu resep leluhur—terintegrasi dalam satu sistem terpercaya.
                </p>

                <!-- Dual Action CTAs (SIG Signature Button Styling) -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <a href="{{ route('umkm.index') }}" class="inline-flex items-center justify-center px-7 py-3.5 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider bg-terracotta text-white hover:bg-terracotta-hover shadow-lg hover:shadow-xl transition-all duration-300 group">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Jelajahi Direktori UMKM</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('rw.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 rounded-xl text-xs sm:text-sm font-bold tracking-wide bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 transition duration-300">
                        <span>Lihat Profil Wilayah RW &rarr;</span>
                    </a>
                </div>

            </div>

            <!-- SIG Inspired Corporate Facts Strip (Clean Metric Tiles with Subtle Borders) -->
            <div class="mt-14 pt-8 border-t border-white/15 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Rukun Warga Terdata</span>
                    <span class="block font-corporate text-3xl font-extrabold text-white mt-1">{{ $stats['total_rw'] }}</span>
                    <span class="block text-[11px] text-slate-300 mt-0.5">Wilayah Pemukiman Terdaftar</span>
                </div>
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Pelaku UMKM Aktif</span>
                    <span class="block font-corporate text-3xl font-extrabold text-white mt-1">{{ $stats['total_umkm'] }}</span>
                    <span class="block text-[11px] text-slate-300 mt-0.5">Unit Usaha Mandiri Warga</span>
                </div>
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Katalog Produk</span>
                    <span class="block font-corporate text-3xl font-extrabold text-white mt-1">{{ $stats['total_produk'] }}</span>
                    <span class="block text-[11px] text-slate-300 mt-0.5">Karya Kuliner & Kerajinan</span>
                </div>
                <div class="p-4 rounded-xl bg-white/5 backdrop-blur-xs border border-white/10">
                    <span class="block text-[11px] font-mono text-emerald-300 uppercase tracking-wider font-bold">Kisah & Kegiatan</span>
                    <span class="block font-corporate text-3xl font-extrabold text-white mt-1">{{ $stats['total_cerita'] }}</span>
                    <span class="block text-[11px] text-slate-300 mt-0.5">Artikel & Publikasi Warga</span>
                </div>
            </div>

        </div>
    </section>


    <!-- =========================================================================
         SECTION 1: SOROTAN RUKUN WARGA (Modern Clean Corporate Grid)
    ========================================================================= -->
    <section class="py-16 sm:py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-terracotta">[ 01 &mdash; WILAYAH & STRUKTUR ]</span>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1">
                        Sorotan Rukun Warga
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Profil resmi tiap lingkungan rukun warga, potensi wilayah, dan penggerak ekonomi warganya.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('rw.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition group">
                        <span>Lihat Semua Rukun Warga</span>
                        <svg class="ml-1.5 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- RW Cards Grid (SIG Card Style: Clean Border, High-Contrast Typography, Smooth Zoom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($rws as $rw)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col group">
                        <!-- Cover Image -->
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $rw->cover_url }}" alt="{{ $rw->nama }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-3 left-3">
                                <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-md bg-slate-900 text-white shadow-sm">
                                    {{ $rw->nomor_rw }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-corporate text-xl font-bold text-slate-900 group-hover:text-terracotta transition">
                                    <a href="{{ route('rw.show', $rw->slug) }}">
                                        {{ $rw->nama }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed font-normal">
                                    {{ $rw->deskripsi ?? 'Profil wilayah dan ragam kegiatan masyarakat lokal.' }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <span class="font-mono text-terracotta font-bold text-[11px]">
                                    {{ $rw->umkms_count }} UMKM Terdaftar
                                </span>
                                <a href="{{ route('rw.show', $rw->slug) }}" class="font-bold text-slate-900 hover:text-terracotta flex items-center space-x-1 text-xs uppercase tracking-wider group-hover:translate-x-0.5 transition">
                                    <span>Buka Profil</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <p class="font-corporate text-xl text-slate-400">Belum ada data Rukun Warga yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- =========================================================================
         SECTION 2: DIREKTORI UMKM PILIHAN (Scan-friendly Corporate Solution Cards)
    ========================================================================= -->
    <section class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-terracotta">[ 02 &mdash; KURASI USAHA ]</span>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1">
                        Pelaku UMKM Pilihan
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Usaha unggulan warga dengan karya autentik dan komitmen mutu terbaik di lingkungan RW.
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('umkm.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition group">
                        <span>Lihat Seluruh Direktori UMKM</span>
                        <svg class="ml-1.5 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- UMKM Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredUmkms as $umkm)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col group">
                        
                        <!-- Image & badges -->
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $umkm->cover_url }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="text-[11px] font-mono font-bold px-2.5 py-1 rounded bg-slate-900 text-white shadow-xs">
                                    {{ $umkm->rw->nomor_rw ?? 'RW' }}
                                </span>
                                <span class="text-[11px] font-mono font-semibold px-2 py-0.5 rounded bg-white text-slate-700 border border-slate-200 shadow-xs">
                                    {{ $umkm->kategori }}
                                </span>
                            </div>
                            @if($umkm->is_unggulan)
                                <div class="absolute top-3 right-3">
                                    <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-terracotta text-white uppercase shadow-sm">
                                        Unggulan
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-corporate text-2xl font-bold text-slate-900 group-hover:text-terracotta transition">
                                    <a href="{{ route('umkm.show', $umkm->slug) }}">
                                        {{ $umkm->nama_usaha }}
                                    </a>
                                </h3>
                                @if($umkm->is_owner_public && $umkm->nama_pemilik)
                                    <p class="text-xs text-slate-500 mt-1">
                                        Pemilik: <span class="font-semibold text-slate-700">{{ $umkm->nama_pemilik }}</span>
                                    </p>
                                @endif
                                <p class="text-sm text-slate-500 mt-3 line-clamp-2 leading-relaxed font-normal">
                                    {{ $umkm->deskripsi }}
                                </p>
                            </div>

                            <!-- Action row (Red arrow link + WhatsApp CTA) -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('umkm.show', $umkm->slug) }}" class="text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition flex items-center space-x-1 group-hover:translate-x-0.5">
                                    <span>Detail Profil</span>
                                    <span>&rarr;</span>
                                </a>

                                @if($umkm->nomor_whatsapp)
                                    <a href="{{ $umkm->getWhatsappUrl() }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-600 hover:text-white transition">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        <span>Hubungi Penjual</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <p class="font-corporate text-xl text-slate-400">Belum ada UMKM yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- =========================================================================
         SECTION 3: PRODUK UNGGULAN (Koleksi Karya Warga)
    ========================================================================= -->
    <section class="py-16 sm:py-20 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10 pb-4 border-b border-slate-200 flex flex-col md:flex-row md:items-end justify-between">
                <div>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-terracotta">[ 03 &mdash; KARYA & KUDAPAN ]</span>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1">
                        Produk Pilihan Warga
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Dibuat dengan dedikasi lokal, siap dipesan langsung ke pembuatnya via WhatsApp.
                    </p>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-lg transition flex flex-col group">
                        
                        <!-- Product Photo -->
                        <div class="aspect-square overflow-hidden bg-slate-100 relative">
                            <img src="{{ $product->photo_url }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-2.5 left-2.5">
                                <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded bg-white/95 text-slate-800 border border-slate-200 shadow-2xs">
                                    {{ $product->umkm->rw->nomor_rw ?? 'RW' }}
                                </span>
                            </div>
                            <div class="absolute bottom-2.5 right-2.5">
                                @if($product->status_ketersediaan === 'tersedia')
                                    <span class="text-[9px] font-mono font-bold px-2 py-0.5 rounded bg-emerald-600 text-white shadow-xs">Tersedia</span>
                                @elseif($product->status_ketersediaan === 'pre_order')
                                    <span class="text-[9px] font-mono font-bold px-2 py-0.5 rounded bg-amber-600 text-white shadow-xs">Pre-Order</span>
                                @else
                                    <span class="text-[9px] font-mono font-bold px-2 py-0.5 rounded bg-slate-500 text-white shadow-xs">Habis</span>
                                @endif
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-4 flex-grow flex flex-col justify-between space-y-3">
                            <div>
                                <p class="text-[11px] font-mono uppercase tracking-wider text-slate-400 truncate font-semibold">
                                    {{ $product->umkm->nama_usaha }}
                                </p>
                                <h4 class="font-corporate text-base font-bold text-slate-900 mt-1 line-clamp-1 group-hover:text-terracotta transition">
                                    {{ $product->nama_produk }}
                                </h4>
                                <div class="mt-2">
                                    @if($product->harga)
                                        <span class="text-sm font-bold text-slate-900 font-mono">{{ $product->formatted_price }}</span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Hubungi penjual untuk harga</span>
                                    @endif
                                </div>
                            </div>

                            @if($product->whatsapp_inquiry_url)
                                <a href="{{ $product->whatsapp_inquiry_url }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-1 px-3 py-2 rounded-xl text-xs font-bold bg-slate-100 hover:bg-slate-900 hover:text-white transition">
                                    <span>Tanya via WhatsApp</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-10 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <p class="font-corporate text-lg text-slate-400">Belum ada produk yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- =========================================================================
         SECTION 4: CERITA & INISIATIF KOMUNITAS (News & Media)
    ========================================================================= -->
    <section class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-terracotta">[ 04 &mdash; KISAH & KEGIATAN ]</span>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1">
                        Cerita dan Denyut Kegiatan
                    </h2>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('cerita.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition group">
                        <span>Baca Seluruh Cerita</span>
                        <svg class="ml-1.5 w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestArticles as $article)
                    <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-lg transition flex flex-col group">
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="{{ $article->cover_url }}" alt="{{ $article->judul }}" class="w-full h-full object-cover zoom-img">
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex items-center space-x-2 text-xs font-mono text-terracotta">
                                    <span class="font-bold uppercase tracking-wider">{{ $article->kategori }}</span>
                                    <span>&middot;</span>
                                    <span class="text-slate-400">{{ $article->formatted_date }}</span>
                                </div>
                                <h3 class="font-corporate text-xl font-bold text-slate-900 mt-2 leading-snug group-hover:text-terracotta transition">
                                    <a href="{{ route('cerita.show', $article->slug) }}">
                                        {{ $article->judul }}
                                    </a>
                                </h3>
                                <p class="text-sm text-slate-500 mt-2 line-clamp-3 leading-relaxed font-normal">
                                    {{ $article->ringkasan }}
                                </p>
                            </div>
                            <div class="pt-3 border-t border-slate-100">
                                <a href="{{ route('cerita.show', $article->slug) }}" class="text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition flex items-center space-x-1 group-hover:translate-x-0.5">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full py-8 text-center bg-white rounded-2xl border border-slate-200 p-6">
                        <p class="font-corporate text-lg text-slate-400">Belum ada artikel cerita atau kegiatan.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <!-- =========================================================================
         SECTION 5: CORPORATE CALL-TO-ACTION (Inspirasi SIG: Bersih & Terbuka)
    ========================================================================= -->
    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <span class="text-xs font-mono uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-slate-800 text-emerald-300 border border-slate-700 font-bold">
                Kolaborasi & Pemberdayaan Warga
            </span>
            <h2 class="font-corporate text-3xl sm:text-5xl font-extrabold text-white max-w-3xl mx-auto leading-tight">
                Dukung Usaha Tetangga, Majukan Potensi Wilayah Bersama.
            </h2>
            <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed font-normal">
                Setiap transaksi yang Anda lakukan langsung kepada pelaku UMKM di lingkungan rukun warga membantu menghidupkan kemandirian ekonomi keluarga dan komunitas.
            </p>
            <div class="pt-4 flex flex-wrap justify-center gap-4">
                <a href="{{ route('umkm.index') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider bg-terracotta text-white hover:bg-terracotta-hover shadow-lg transition">
                    <span>Jelajahi Semua UMKM</span>
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('kontak.index') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-xs sm:text-sm font-bold tracking-wide bg-slate-800 text-white hover:bg-slate-700 border border-slate-700 transition">
                    <span>Hubungi Pengelola Direktori</span>
                </a>
            </div>
        </div>
    </section>

@endsection
