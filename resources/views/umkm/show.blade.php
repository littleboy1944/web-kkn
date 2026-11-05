@extends('layouts.public')

@section('title', "{$umkm->nama_usaha} — {$umkm->rw->nomor_rw}")
@section('meta_description', Str::limit(strip_tags($umkm->deskripsi), 160))

@section('content')
    <!-- UMKM Profile Header (Inspirasi SIG: Terstruktur, Rapi, Profesional) -->
    <article class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center space-x-2 text-xs font-mono text-slate-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-forest-900 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('umkm.index') }}" class="hover:text-forest-900 transition">Direktori UMKM</a>
                <span>/</span>
                <a href="{{ route('rw.show', $umkm->rw->slug) }}" class="hover:text-forest-900 transition">{{ $umkm->rw->nomor_rw }}</a>
                <span>/</span>
                <span class="text-terracotta font-semibold">{{ $umkm->nama_usaha }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Left: Business Info & Story -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('rw.show', $umkm->rw->slug) }}" class="text-xs font-mono font-bold px-3 py-1 rounded bg-forest-900 text-white hover:bg-terracotta transition shadow-xs">
                            {{ $umkm->rw->nomor_rw }} &mdash; {{ $umkm->rw->nama }}
                        </a>
                        <span class="text-xs font-mono font-semibold px-3 py-1 rounded bg-slate-100 text-slate-700 border border-slate-200">
                            {{ $umkm->kategori }}
                        </span>
                        @if($umkm->is_unggulan)
                            <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-terracotta text-white uppercase shadow-xs">
                                Unggulan
                            </span>
                        @endif
                    </div>

                    <h1 class="font-corporate text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.12]">
                        {{ $umkm->nama_usaha }}
                    </h1>

                    <!-- Owner & Location metadata strip -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        @if($umkm->is_owner_public && $umkm->nama_pemilik)
                            <div>
                                <span class="block text-slate-400 font-mono uppercase tracking-wider text-[11px]">Pengelola / Pemilik</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $umkm->nama_pemilik }}</span>
                            </div>
                        @else
                            <div>
                                <span class="block text-slate-400 font-mono uppercase tracking-wider text-[11px]">Pengelola</span>
                                <span class="text-slate-400 italic">Informasi privat / tidak dipublikasikan</span>
                            </div>
                        @endif

                        @if($umkm->jam_operasional)
                            <div>
                                <span class="block text-slate-400 font-mono uppercase tracking-wider text-[11px]">Jam Operasional</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $umkm->jam_operasional }}</span>
                            </div>
                        @endif

                        @if($umkm->alamat_spesifik)
                            <div class="sm:col-span-2 pt-3 border-t border-slate-200">
                                <span class="block text-slate-400 font-mono uppercase tracking-wider text-[11px]">Alamat & Lokasi</span>
                                <span class="font-medium text-slate-800">{{ $umkm->alamat_spesifik }}, {{ $umkm->rw->nomor_rw }}</span>
                            </div>
                        @endif

                        @if($umkm->tautan_sosmed)
                            <div class="sm:col-span-2 pt-3 border-t border-slate-200">
                                <span class="block text-slate-400 font-mono uppercase tracking-wider text-[11px]">Media Sosial</span>
                                <a href="{{ Str::startsWith($umkm->tautan_sosmed, 'http') ? $umkm->tautan_sosmed : 'https://' . $umkm->tautan_sosmed }}" target="_blank" rel="noopener noreferrer" class="text-terracotta font-semibold hover:underline inline-flex items-center space-x-1">
                                    <span>{{ $umkm->tautan_sosmed }}</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Narrative & Story -->
                    <div class="space-y-3">
                        <h2 class="font-corporate text-2xl font-extrabold text-slate-900 tracking-tight">
                            Cerita Usaha & Profil
                        </h2>
                        <div class="text-slate-600 text-base sm:text-lg leading-relaxed font-normal">
                            <p>{{ $umkm->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- PROMINENT WHATSAPP ACTION BOX -->
                    @if($umkm->nomor_whatsapp)
                        <div class="p-6 sm:p-7 rounded-2xl bg-forest-900 text-white shadow-xl space-y-4">
                            <div class="flex items-start space-x-3.5">
                                <div class="w-10 h-10 rounded-xl bg-forest-800 border border-forest-700 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 fill-current text-emerald-400" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-corporate text-xl sm:text-2xl font-extrabold leading-tight">
                                        Hubungi Langsung via WhatsApp
                                    </h3>
                                    <p class="text-xs text-emerald-200 mt-1 font-mono">
                                        Nomor Resmi: +{{ $umkm->nomor_whatsapp }}
                                    </p>
                                </div>
                            </div>
                            
                            <a href="{{ $umkm->getWhatsappUrl() }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-2 px-6 py-4 rounded-xl bg-terracotta text-white font-bold text-xs uppercase tracking-wider hover:bg-terracotta-hover transition shadow-md">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Kirim Pesan WhatsApp Sekarang</span>
                            </a>
                        </div>
                    @endif

                </div>

                <!-- Right: Cover Photo & Gallery -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden border border-slate-200 shadow-xl bg-slate-100">
                        <img src="{{ $umkm->cover_url }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover">
                    </div>

                    @if(!empty($umkm->foto_galeri) && is_array($umkm->foto_galeri) && count($umkm->foto_galeri) > 0)
                        <div class="grid grid-cols-3 gap-3 pt-2">
                            @foreach($umkm->foto_galeri as $photo)
                                <div class="aspect-square rounded-xl overflow-hidden border border-slate-200 bg-slate-100">
                                    <img src="{{ Str::startsWith($photo, ['http://', 'https://']) ? $photo : asset($photo) }}" alt="Galeri {{ $umkm->nama_usaha }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </article>

    <!-- SECTION: DAFTAR PRODUK UMKM INI -->
    <section class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10 pb-4 border-b border-slate-200 flex flex-col md:flex-row md:items-end justify-between">
                <div>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-terracotta">[ KATALOG PRODUK ]</span>
                    <h2 class="font-corporate text-3xl sm:text-4xl font-extrabold text-slate-900 mt-1">
                        Produk dari {{ $umkm->nama_usaha }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Pilih produk dan hubungi penjual via WhatsApp untuk pemesanan atau info ketersediaan.
                    </p>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($umkm->products as $product)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-lg transition-all duration-300 flex flex-col group">
                        
                        <!-- Image -->
                        <div class="aspect-[4/3] overflow-hidden bg-slate-100 relative">
                            <img src="{{ $product->photo_url }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover zoom-img">
                            <div class="absolute top-3 right-3">
                                @if($product->status_ketersediaan === 'tersedia')
                                    <span class="text-[10px] font-mono font-bold px-2.5 py-1 rounded bg-emerald-600 text-white shadow-xs">
                                        Tersedia
                                    </span>
                                @elseif($product->status_ketersediaan === 'pre_order')
                                    <span class="text-[10px] font-mono font-bold px-2.5 py-1 rounded bg-amber-600 text-white shadow-xs">
                                        Pre-Order
                                    </span>
                                @else
                                    <span class="text-[10px] font-mono font-bold px-2.5 py-1 rounded bg-slate-500 text-white shadow-xs">
                                        Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-corporate text-xl font-bold text-slate-900 group-hover:text-terracotta transition">
                                    {{ $product->nama_produk }}
                                </h3>

                                <div class="mt-2">
                                    @if($product->harga)
                                        <span class="font-mono text-xl font-bold text-forest-900">
                                            {{ $product->formatted_price }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">
                                            Hubungi penjual untuk konfirmasi harga
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-slate-500 mt-3 line-clamp-3 leading-relaxed font-normal">
                                    {{ $product->deskripsi ?? 'Produk orisinal buatan warga lokal berkualitas.' }}
                                </p>
                            </div>

                            <!-- Product WhatsApp Action -->
                            @if($product->whatsapp_inquiry_url)
                                <div class="pt-4 border-t border-slate-100">
                                    <a href="{{ $product->whatsapp_inquiry_url }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-forest-900 text-white font-bold text-xs uppercase tracking-wider hover:bg-terracotta transition shadow-sm">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        <span>Pesan / Tanya via WhatsApp</span>
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-slate-200 p-8">
                        <p class="font-corporate text-lg text-slate-400">Belum ada daftar produk terperinci untuk UMKM ini.</p>
                        @if($umkm->nomor_whatsapp)
                            <div class="mt-4">
                                <a href="{{ $umkm->getWhatsappUrl() }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-forest-900 text-white text-xs font-semibold">
                                    <span>Tanya Langsung ke Penjual via WhatsApp</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- SECTION: UMKM TERKAIT DI RW SAMA -->
    @if($relatedUmkms->count() > 0)
        <section class="py-16 bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8 pb-3 border-b border-slate-200 flex items-center justify-between">
                    <h3 class="font-corporate text-2xl font-bold text-slate-900">
                        UMKM Lain di {{ $umkm->rw->nomor_rw }}
                    </h3>
                    <a href="{{ route('rw.show', $umkm->rw->slug) }}" class="text-xs font-bold uppercase tracking-wider text-terracotta hover:underline">
                        Lihat Semua di {{ $umkm->rw->nomor_rw }} &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedUmkms as $rel)
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center space-x-4 shadow-2xs hover:shadow-md transition group">
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                <img src="{{ $rel->cover_url }}" alt="{{ $rel->nama_usaha }}" class="w-full h-full object-cover zoom-img">
                            </div>
                            <div class="flex-grow min-w-0">
                                <span class="text-[10px] font-mono text-terracotta font-semibold uppercase">{{ $rel->kategori }}</span>
                                <h4 class="font-corporate text-base font-bold text-slate-900 truncate group-hover:text-terracotta transition">
                                    <a href="{{ route('umkm.show', $rel->slug) }}">
                                        {{ $rel->nama_usaha }}
                                    </a>
                                </h4>
                                <a href="{{ route('umkm.show', $rel->slug) }}" class="text-[11px] font-semibold text-slate-500 hover:text-forest-900">
                                    Lihat Usaha &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
