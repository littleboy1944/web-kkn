@extends('layouts.public')

@section('title', 'Direktori UMKM — Jelajahi Usaha Lokal per Rukun Warga')

@section('content')

    <!-- =========================================================================
         PAGE HERO BANNER (Inspirasi SIG: Terstruktur, Modern, Rapi)
    ========================================================================= -->
    <section class="editorial-hero relative bg-forest-950 text-white overflow-hidden py-14 lg:py-18">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-forest-950 via-forest-900 to-forest-950 opacity-95"></div>
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <nav class="flex items-center space-x-2 text-xs font-mono text-emerald-200/80 mb-2">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                    <span class="text-white/40">/</span>
                    <span class="text-white font-semibold">Direktori UMKM</span>
                </nav>

                <div class="inline-flex items-center space-x-2.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-mono text-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="uppercase tracking-wider font-semibold">Katalog Usaha Warga Komunitas</span>
                </div>

                <h1 class="font-corporate text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Direktori Pelaku UMKM
                </h1>
                <p class="text-base sm:text-lg text-slate-200 font-normal leading-relaxed">
                    Temukan produk lokal, kerajinan tangan, kudapan khas, dan ragam jasa yang digerakkan oleh warga di setiap lingkungan Rukun Warga.
                </p>
            </div>

            <!-- Filter & Search Controls -->
            <div class="mt-8 pt-6 border-t border-white/15">
                <form action="{{ route('umkm.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        
                        <!-- Search input -->
                        <div class="md:col-span-6 relative">
                            <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama usaha, produk, atau kata kunci..." class="w-full pl-11 pr-4 py-3 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-md">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>

                        <!-- Filter by RW -->
                        <div class="md:col-span-3">
                            <select name="rw" class="w-full py-3 px-3 rounded-xl bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-md">
                                <option value="semua">Semua Wilayah RW</option>
                                @foreach($rws as $rw)
                                    <option value="{{ $rw->slug }}" {{ $rwSlug === $rw->slug ? 'selected' : '' }}>
                                        {{ $rw->nomor_rw }} &mdash; {{ $rw->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter by Category -->
                        <div class="md:col-span-3">
                            <select name="kategori" class="w-full py-3 px-3 rounded-xl bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-md">
                                <option value="semua">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $kategori === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- Filter action buttons -->
                    <div class="flex items-center space-x-3 pt-1">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow-md">
                            Terapkan Filter
                        </button>
                        @if($search || ($kategori && $kategori !== 'semua') || ($rwSlug && $rwSlug !== 'semua'))
                            <a href="{{ route('umkm.index') }}" class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur-md border border-white/20 transition">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         MAIN RESULTS SECTION (Clean Cards Grid)
    ========================================================================= -->
    <section class="py-14 sm:py-18 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 pb-3 border-b border-slate-200 text-xs text-slate-500 font-mono gap-2">
                <div>
                    Menampilkan <strong class="text-forest-900 font-bold text-sm">{{ $umkms->total() }}</strong> pelaku UMKM aktif
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    @if($rwSlug && $rwSlug !== 'semua')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-white border border-slate-200 text-forest-900 font-mono text-[11px] shadow-2xs">
                            Wilayah: {{ $rwSlug }}
                        </span>
                    @endif
                    @if($kategori && $kategori !== 'semua')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-white border border-slate-200 text-forest-900 font-mono text-[11px] shadow-2xs">
                            Kategori: {{ $kategori }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- UMKM Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($umkms as $umkm)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col group">
                        
                        <!-- Image & badge -->
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $umkm->cover_url }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="text-[11px] font-mono font-bold px-2.5 py-1 rounded bg-forest-900 text-white shadow-xs">
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

                        <!-- Content -->
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-corporate text-2xl font-bold text-slate-900 group-hover:text-terracotta transition leading-snug">
                                    <a href="{{ route('umkm.show', $umkm->slug) }}">
                                        {{ $umkm->nama_usaha }}
                                    </a>
                                </h3>

                                @if($umkm->is_owner_public && $umkm->nama_pemilik)
                                    <p class="text-xs text-slate-500 mt-1">
                                        Pemilik: <span class="font-medium text-slate-700">{{ $umkm->nama_pemilik }}</span>
                                    </p>
                                @endif

                                <p class="text-sm text-slate-500 mt-3 line-clamp-3 leading-relaxed font-normal">
                                    {{ $umkm->deskripsi }}
                                </p>

                                @if($umkm->products->count() > 0)
                                    <div class="mt-4 pt-3 border-t border-slate-100">
                                        <p class="text-[11px] font-mono text-slate-400">
                                            Katalog: <strong class="text-forest-900 font-sans">{{ $umkm->products->count() }} produk terdaftar</strong>
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('umkm.show', $umkm->slug) }}" class="text-xs font-bold uppercase tracking-wider text-forest-900 hover:text-terracotta transition">
                                    Buka Profil &rarr;
                                </a>

                                @if($umkm->nomor_whatsapp)
                                    <a href="{{ $umkm->getWhatsappUrl() }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-600 hover:text-white transition">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        <span>Pesan via WA</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="font-corporate text-2xl font-extrabold text-slate-900">Belum ada UMKM yang sesuai</h3>
                        <p class="text-sm text-slate-500 mt-2 font-normal">Silakan coba dengan filter kategori atau wilayah lain.</p>
                        <div class="mt-4">
                            <a href="{{ route('umkm.index') }}" class="inline-flex px-5 py-2.5 rounded-xl bg-forest-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta transition shadow">
                                Bersihkan Pencarian
                            </a>
                        </div>
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

@endsection
