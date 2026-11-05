@extends('layouts.public')

@section('title', 'Cerita & Kegiatan — Publikasi Editorial Komunitas RW')

@section('content')
    <!-- Page Hero Banner (Inspirasi SIG: Terstruktur, Modern, Rapi) -->
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
                    <span class="text-white font-semibold">Cerita & Kegiatan</span>
                </nav>

                <div class="inline-flex items-center space-x-2.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-mono text-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="uppercase tracking-wider font-semibold">Publikasi Komunitas & Warga</span>
                </div>

                <h1 class="font-corporate text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Cerita dan Ragam Kegiatan
                </h1>
                <p class="text-base sm:text-lg text-slate-200 font-normal leading-relaxed">
                    Kumpulan narasi seputar kisah perjuangan pelaku UMKM, proses pembuatan karya lokal, serta denyut kegiatan warga rukun warga.
                </p>
            </div>

            <!-- Categories and Search -->
            <div class="mt-8 pt-6 border-t border-white/15 flex flex-col md:flex-row items-center justify-between gap-4">
                <!-- Filter Chips -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('cerita.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ empty($kategori) || $kategori === 'semua' ? 'bg-terracotta text-white shadow-md' : 'bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('cerita.index', ['kategori' => $cat]) }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition {{ $kategori === $cat ? 'bg-terracotta text-white shadow-md' : 'bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                <!-- Search -->
                <form action="{{ route('cerita.index') }}" method="GET" class="w-full md:w-72">
                    <div class="relative">
                        <input type="text" name="q" value="{{ $search }}" placeholder="Cari artikel..." class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-400 shadow-md">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Main Content Articles -->
    <section class="py-14 sm:py-18 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Featured Top Story -->
            @if($featuredArticle && ! $search && ! $kategori)
                <div class="mb-14">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-white rounded-2xl border border-slate-200 overflow-hidden p-6 lg:p-8 shadow-2xs hover:shadow-lg transition">
                        <div class="lg:col-span-7 aspect-[16/10] rounded-xl overflow-hidden bg-slate-100">
                            <img src="{{ $featuredArticle->cover_url }}" alt="{{ $featuredArticle->judul }}" class="w-full h-full object-cover">
                        </div>
                        <div class="lg:col-span-5 space-y-4">
                            <div class="flex items-center space-x-2 text-xs font-mono text-terracotta">
                                <span class="bg-terracotta/10 text-terracotta px-2.5 py-0.5 rounded font-bold uppercase tracking-wider">Sorotan Utama</span>
                                <span>&middot;</span>
                                <span class="text-slate-400">{{ $featuredArticle->formatted_date }}</span>
                            </div>
                            <h2 class="font-corporate text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight hover:text-terracotta transition">
                                <a href="{{ route('cerita.show', $featuredArticle->slug) }}">
                                    {{ $featuredArticle->judul }}
                                </a>
                            </h2>
                            <p class="text-sm sm:text-base text-slate-500 leading-relaxed font-normal">
                                {{ $featuredArticle->ringkasan }}
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('cerita.show', $featuredArticle->slug) }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-slate-900 hover:text-terracotta transition">
                                    <span>Baca Cerita Lengkap</span>
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col group">
                        
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $article->cover_url }}" alt="{{ $article->judul }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-3 left-3">
                                <span class="text-[11px] font-mono font-semibold px-2.5 py-1 rounded bg-white/95 text-slate-900 border border-slate-200 shadow-2xs">
                                    {{ $article->kategori }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <span class="text-xs font-mono text-slate-400">
                                    {{ $article->formatted_date }} &middot; {{ $article->estimated_reading_time }} menit baca
                                </span>
                                
                                <h3 class="font-corporate text-xl font-bold text-slate-900 group-hover:text-terracotta transition mt-2 leading-snug">
                                    <a href="{{ route('cerita.show', $article->slug) }}">
                                        {{ $article->judul }}
                                    </a>
                                </h3>

                                <p class="text-sm text-slate-500 mt-3 line-clamp-3 leading-relaxed font-light">
                                    {{ $article->ringkasan }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <a href="{{ route('cerita.show', $article->slug) }}" class="text-xs font-bold uppercase tracking-wider text-forest-900 hover:text-terracotta transition flex items-center space-x-1">
                                    <span>Baca Cerita</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>

                    </article>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <p class="font-corporate text-xl font-bold text-slate-400">Belum ada artikel cerita atau kegiatan yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="mt-12 pt-6 border-t border-slate-200">
                    {{ $articles->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
