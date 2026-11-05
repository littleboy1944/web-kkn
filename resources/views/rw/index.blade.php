@extends('layouts.public')

@section('title', 'Daftar Rukun Warga — Profil Wilayah & Potensi Lokal')

@section('content')

    <!-- =========================================================================
         PAGE HERO BANNER (Inspirasi SIG: Terstruktur, Modern, Rapi)
    ========================================================================= -->
    <section class="editorial-hero relative bg-slate-950 text-white overflow-hidden py-14 lg:py-18">
        <!-- Subtle Pattern Accent -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 opacity-95"></div>
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <nav class="flex items-center space-x-2 text-xs font-mono text-emerald-200/80 mb-2">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                    <span class="text-white/40">/</span>
                    <span class="text-white font-semibold">Daftar RW</span>
                </nav>

                <div class="inline-flex items-center space-x-2.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-mono text-emerald-200 font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="uppercase tracking-wider">Direktori Wilayah Komunitas</span>
                </div>

                <h1 class="font-corporate text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Daftar Rukun Warga
                </h1>
                <p class="text-base sm:text-lg text-slate-200 font-normal leading-relaxed">
                    Telusuri profil setiap wilayah rukun warga, kenali keunggulan khas lingkungan, dan temukan ragam pelaku UMKM yang tumbuh di dalamnya.
                </p>
            </div>

            <!-- Search Bar -->
            <div class="mt-8 pt-6 border-t border-white/15 max-w-xl">
                <form action="{{ route('rw.index') }}" method="GET" class="flex items-center space-x-3">
                    <div class="relative flex-grow">
                        <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama atau nomor RW (misal: RW 01)..." class="w-full pl-11 pr-4 py-3 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-terracotta shadow-md">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow-md">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('rw.index') }}" class="px-3.5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur-md border border-white/20 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         RW GRID SECTION (Modern Scan-Friendly Cards)
    ========================================================================= -->
    <section class="py-14 sm:py-18 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8 pb-3 border-b border-slate-200 text-xs text-slate-500 font-mono">
                <span>Menampilkan <strong class="text-slate-900 font-bold text-sm">{{ $rws->total() }}</strong> Rukun Warga Terdaftar</span>
                @if($search)
                    <span class="text-terracotta font-semibold">Hasil pencarian: "{{ $search }}"</span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($rws as $rw)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col group">
                        
                        <!-- Cover Image with Badges -->
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $rw->cover_url }}" alt="{{ $rw->nama }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-4 left-4">
                                <span class="text-xs font-mono font-bold px-3 py-1 rounded-md bg-slate-900 text-white shadow-md">
                                    {{ $rw->nomor_rw }}
                                </span>
                            </div>
                            <div class="absolute bottom-3 right-3">
                                <span class="text-[11px] font-mono font-bold px-2.5 py-1 rounded bg-white/95 backdrop-blur-xs text-slate-900 border border-slate-200 shadow-2xs">
                                    {{ $rw->umkms_count }} UMKM Terdaftar
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-5">
                            <div>
                                <h2 class="font-corporate text-2xl font-bold text-slate-900 group-hover:text-terracotta transition leading-snug">
                                    <a href="{{ route('rw.show', $rw->slug) }}">
                                        {{ $rw->nama }}
                                    </a>
                                </h2>
                                
                                <p class="text-sm text-slate-500 mt-3 line-clamp-3 leading-relaxed font-normal">
                                    {{ $rw->deskripsi ?? 'Profil wilayah rukun warga dan pemberdayaan ekonomi lokal.' }}
                                </p>

                                @if($rw->potensi_kegiatan)
                                    <div class="mt-4 pt-3 border-t border-slate-100">
                                        <p class="text-[11px] font-mono uppercase tracking-wider text-terracotta font-bold">Ciri Khas & Potensi:</p>
                                        <p class="text-xs text-slate-600 mt-1 line-clamp-2 font-normal">
                                            {{ $rw->potensi_kegiatan }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('rw.show', $rw->slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition group-hover:translate-x-0.5">
                                    <span>Buka Profil Wilayah</span>
                                    <svg class="ml-1 w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>

                                <a href="{{ route('rw.show', $rw->slug) }}#daftar-umkm" class="text-xs font-mono text-terracotta font-bold hover:underline">
                                    Lihat {{ $rw->umkms_count }} UMKM &rarr;
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-corporate text-2xl font-bold text-slate-900">Tidak ada Rukun Warga ditemukan</h3>
                        <p class="text-sm text-slate-500 mt-2 font-normal">Coba ubah kata kunci pencarian Anda.</p>
                        <div class="mt-4">
                            <a href="{{ route('rw.index') }}" class="inline-flex px-5 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta transition shadow">
                                Tampilkan Semua RW
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($rws->hasPages())
                <div class="mt-12 pt-6 border-t border-slate-200">
                    {{ $rws->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection
