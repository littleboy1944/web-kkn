@extends('layouts.admin')

@section('title', 'Dashboard CMS')
@section('header_title', 'Ringkasan & Dashboard Pengelolaan')

@section('content')
    <div class="space-y-8">
        
        <!-- Welcome Executive Banner (SIG Modern Style) -->
        <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 rounded-2xl p-6 sm:p-8 text-white flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-md border border-slate-800 relative overflow-hidden">
            <!-- Subtle accent lines in background -->
            <div class="absolute right-0 top-0 bottom-0 w-1/3 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

            <div class="space-y-2 max-w-xl relative z-10">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-[11px] font-mono text-emerald-300 font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Sistem Manajemen Konten Aktif</span>
                </div>
                <h2 class="font-corporate text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-tight">
                    Selamat datang di Panel CMS {{ $settings->nama_website }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    Kelola identitas wilayah rukun warga, kurasi direktori UMKM lokal, katalog produk, dan publikasi kegiatan secara terintegrasi dan akuntabel.
                </p>
            </div>

            <!-- Quick Action Buttons (SIG Action Button Style) -->
            <div class="flex flex-wrap gap-2.5 shrink-0 relative z-10">
                <a href="{{ route('admin.rw.create') }}" class="inline-flex items-center space-x-1.5 px-4 py-2.5 rounded-xl bg-white text-slate-900 text-xs font-bold uppercase tracking-wider hover:bg-slate-100 transition shadow-sm">
                    <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Tambah RW</span>
                </a>
                <a href="{{ route('admin.umkm.create') }}" class="inline-flex items-center space-x-1.5 px-4 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Tambah UMKM</span>
                </a>
                <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center space-x-1.5 px-4 py-2.5 rounded-xl bg-slate-800 text-white text-xs font-bold uppercase tracking-wider hover:bg-slate-700 border border-slate-700 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <!-- 4 Metric KPI Cards (SIG Corporate Style with Top Accent Bars) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- RW KPI Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs hover:shadow-md transition-shadow duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-slate-900"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block">Total Rukun Warga</span>
                        <span class="block font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1.5">{{ $stats['total_rw'] }}</span>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-900 flex items-center justify-center shrink-0 border border-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-emerald-700 font-bold flex items-center font-mono text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        {{ $stats['published_rw'] }} Terbit Publik
                    </span>
                    <a href="{{ route('admin.rw.index') }}" class="text-slate-400 hover:text-slate-900 font-mono text-[11px] font-bold">&rarr; Kelola</a>
                </div>
            </div>

            <!-- UMKM KPI Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs hover:shadow-md transition-shadow duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-terracotta"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block">Total Pelaku UMKM</span>
                        <span class="block font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1.5">{{ $stats['total_umkm'] }}</span>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-terracotta/10 text-terracotta flex items-center justify-center shrink-0 border border-terracotta/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-emerald-700 font-bold flex items-center font-mono text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        {{ $stats['published_umkm'] }} Terbit Aktif
                    </span>
                    <a href="{{ route('admin.umkm.index') }}" class="text-slate-400 hover:text-terracotta font-mono text-[11px] font-bold">&rarr; Kelola</a>
                </div>
            </div>

            <!-- Produk KPI Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs hover:shadow-md transition-shadow duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-amber-500"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block">Koleksi Produk</span>
                        <span class="block font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1.5">{{ $stats['total_product'] }}</span>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0 border border-amber-200/60">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-emerald-700 font-bold flex items-center font-mono text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        {{ $stats['published_product'] }} Produk Siap
                    </span>
                    <a href="{{ route('admin.produk.index') }}" class="text-slate-400 hover:text-amber-700 font-mono text-[11px] font-bold">&rarr; Kelola</a>
                </div>
            </div>

            <!-- Cerita KPI Card -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs hover:shadow-md transition-shadow duration-300 relative overflow-hidden flex flex-col justify-between">
                <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-600"></div>
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 font-bold block">Cerita & Kegiatan</span>
                        <span class="block font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1.5">{{ $stats['total_article'] }}</span>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center shrink-0 border border-emerald-200/60">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-emerald-700 font-bold flex items-center font-mono text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        {{ $stats['published_article'] }} Terbit Publik
                    </span>
                    <a href="{{ route('admin.cerita.index') }}" class="text-slate-400 hover:text-emerald-700 font-mono text-[11px] font-bold">&rarr; Kelola</a>
                </div>
            </div>

        </div>

        <!-- Split Tables Grid: Recent UMKM & Recent Products -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Recent UMKM Table Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h3 class="font-corporate text-lg font-bold text-slate-900">UMKM Terdaftar Terbaru</h3>
                        <p class="text-xs text-slate-500 font-normal">Usaha lokal yang baru terhubung ke dalam direktori</p>
                    </div>
                    <a href="{{ route('admin.umkm.index') }}" class="text-xs font-bold text-terracotta hover:underline font-mono">
                        Lihat Semua &rarr;
                    </a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentUmkms as $umkm)
                        <div class="p-4 flex items-center justify-between hover:bg-slate-50/80 transition duration-150">
                            <div class="flex items-center space-x-3.5 truncate">
                                <div class="w-11 h-11 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    <img src="{{ $umkm->cover_url }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover">
                                </div>
                                <div class="truncate">
                                    <h4 class="text-sm font-bold text-slate-900 truncate">{{ $umkm->nama_usaha }}</h4>
                                    <div class="flex items-center space-x-2 text-xs text-slate-500 font-mono mt-0.5">
                                        <span class="font-bold text-slate-900">{{ $umkm->rw->nomor_rw ?? 'RW' }}</span>
                                        <span>&middot;</span>
                                        <span>{{ $umkm->kategori }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2.5 shrink-0 ml-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $umkm->status === 'terbit' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $umkm->status }}
                                </span>
                                <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition" title="Ubah UMKM">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-slate-400">Belum ada UMKM terdaftar.</div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Products Table Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h3 class="font-corporate text-lg font-bold text-slate-900">Produk Terbaru Ditambahkan</h3>
                        <p class="text-xs text-slate-500 font-normal">Katalog karya olahan dan barang siap pesan</p>
                    </div>
                    <a href="{{ route('admin.produk.index') }}" class="text-xs font-bold text-terracotta hover:underline font-mono">
                        Lihat Semua &rarr;
                    </a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentProducts as $prod)
                        <div class="p-4 flex items-center justify-between hover:bg-slate-50/80 transition duration-150">
                            <div class="flex items-center space-x-3.5 truncate">
                                <div class="w-11 h-11 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    <img src="{{ $prod->photo_url }}" alt="{{ $prod->nama_produk }}" class="w-full h-full object-cover">
                                </div>
                                <div class="truncate">
                                    <h4 class="text-sm font-bold text-slate-900 truncate">{{ $prod->nama_produk }}</h4>
                                    <div class="flex items-center space-x-2 text-xs text-slate-500 mt-0.5">
                                        <span class="font-medium text-slate-700 truncate max-w-[150px]">{{ $prod->umkm->nama_usaha ?? 'UMKM' }}</span>
                                        <span>&middot;</span>
                                        <span class="font-mono text-emerald-700 font-bold">{{ $prod->formatted_price ?? 'Harga Sesuai Pesanan' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 shrink-0 ml-3">
                                <a href="{{ route('admin.produk.edit', $prod->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition" title="Ubah Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-slate-400">Belum ada produk yang ditambahkan.</div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
@endsection
