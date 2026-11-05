@extends('layouts.public')

@section('title', "{$article->judul} — Cerita & Kegiatan")
@section('meta_description', Str::limit(strip_tags($article->ringkasan), 160))

@section('content')
    <article class="py-10 sm:py-16 bg-white border-b border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Breadcrumb & Tag -->
            <nav class="flex items-center space-x-2 text-xs font-mono text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-forest-900 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('cerita.index') }}" class="hover:text-forest-900 transition">Cerita & Kegiatan</a>
                <span>/</span>
                <span class="text-terracotta">{{ $article->kategori }}</span>
            </nav>

            <!-- Headline block -->
            <header class="space-y-4">
                <div class="flex items-center space-x-2 text-xs font-mono text-terracotta">
                    <span class="px-2.5 py-1 rounded bg-slate-100 text-forest-900 font-semibold border border-slate-200">{{ $article->kategori }}</span>
                    <span>&middot;</span>
                    <span class="text-slate-400">{{ $article->formatted_date }}</span>
                    <span>&middot;</span>
                    <span class="text-slate-400">{{ $article->estimated_reading_time }} menit baca</span>
                </div>

                <h1 class="font-corporate text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                    {{ $article->judul }}
                </h1>

                @if($article->ringkasan)
                    <p class="text-lg sm:text-xl text-slate-600 font-normal leading-relaxed pt-2 border-l-2 border-terracotta pl-4">
                        {{ $article->ringkasan }}
                    </p>
                @endif
            </header>

            <!-- Cover Image -->
            <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 shadow-md">
                <img src="{{ $article->cover_url }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
            </div>

            <!-- Body Content -->
            <div class="pt-6 border-t border-slate-100">
                <div class="prose prose-slate prose-lg max-w-none text-slate-800 leading-relaxed font-normal space-y-6">
                    @php
                        $contentWithBreaks = preg_replace('/<\s*\/?\s*(p|div|li|h[1-6])\b[^>]*>|<\s*br\s*\/?\s*>/i', "\n", $article->konten) ?? $article->konten;
                    @endphp
                    {!! nl2br(e(strip_tags($contentWithBreaks))) !!}
                </div>
            </div>

            <!-- Share / Return Strip -->
            <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('cerita.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-forest-900 hover:text-terracotta transition">
                    <svg class="mr-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span>Kembali ke Semua Cerita</span>
                </a>

                <div class="flex items-center space-x-2">
                    <span class="text-xs font-mono text-slate-500">Bagikan cerita:</span>
                    <a href="https://wa.me/?text={{ rawurlencode($article->judul . ' ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-1.5 rounded-xl bg-emerald-50 text-emerald-800 text-xs font-bold hover:bg-emerald-600 hover:text-white transition">
                        WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </article>

    <!-- RELATED STORIES -->
    @if($relatedArticles->count() > 0)
        <section class="py-16 bg-slate-50 border-t border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8 pb-3 border-b border-slate-200">
                    <h3 class="font-corporate text-2xl font-extrabold text-slate-900">
                        Cerita Lainnya
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $rel)
                        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden p-6 space-y-3 shadow-2xs hover:shadow-md transition group">
                            <span class="text-[11px] font-mono text-terracotta font-semibold">{{ $rel->kategori }} &middot; {{ $rel->formatted_date }}</span>
                            <h4 class="font-corporate text-lg font-bold text-slate-900 leading-snug group-hover:text-terracotta transition">
                                <a href="{{ route('cerita.show', $rel->slug) }}">
                                    {{ $rel->judul }}
                                </a>
                            </h4>
                            <p class="text-xs text-slate-500 line-clamp-2 font-light">
                                {{ $rel->ringkasan }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
