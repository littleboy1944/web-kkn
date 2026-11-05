@extends('layouts.public')

@section('title', 'Kontak & Informasi Pengelola — Direktori RW & UMKM')

@section('content')
    <!-- Page Hero Banner (Inspirasi SIG: Terstruktur, Rapi, Profesional) -->
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
                    <span class="text-white font-semibold">Kontak</span>
                </nav>

                <div class="inline-flex items-center space-x-2.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-mono text-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="uppercase tracking-wider font-semibold">Pusat Layanan Warga</span>
                </div>

                <h1 class="font-corporate text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Kontak & Sekretariat Pengelola
                </h1>
                <p class="text-base sm:text-lg text-slate-200 font-normal leading-relaxed">
                    Pertanyaan seputar pendaftaran pelaku usaha baru, pembaruan profil rukun warga, atau kerja sama komunitas dapat disampaikan melalui kanal resmi berikut.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left: Official Contact Card -->
                <div class="lg:col-span-7 space-y-8">
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 sm:p-10 shadow-2xs space-y-6">
                        
                        <h2 class="font-corporate text-3xl font-extrabold text-slate-900">
                            Sekretariat Direktori RW & UMKM
                        </h2>
                        
                        <p class="text-base text-slate-600 leading-relaxed font-normal">
                            Platform ini dikelola secara kolektif oleh tim pendamping masyarakat dan perwakilan rukun warga untuk memastikan seluruh data UMKM terverifikasi dan akurat.
                        </p>

                        <div class="space-y-5 pt-4 border-t border-slate-100 text-sm">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center shrink-0 text-forest-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-mono uppercase tracking-wider text-slate-400">Alamat Sekretariat:</span>
                                    <span class="font-bold text-forest-900 text-base">{{ $settings->alamat_sekretariat ?? 'Balai Warga, Jl. Komunitas Raya No. 01' }}</span>
                                    <p class="text-xs text-slate-500 mt-0.5">Petunjuk: Bersebelahan dengan Balai Warga & Pos Ronda Utama.</p>
                                </div>
                            </div>

                            @if(!empty($settings->kontak_email))
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center shrink-0 text-forest-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-mono uppercase tracking-wider text-slate-400">Email Pengelola:</span>
                                        <a href="mailto:{{ $settings->kontak_email }}" class="font-bold text-terracotta hover:underline text-base">{{ $settings->kontak_email }}</a>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($settings->kontak_telepon))
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 rounded-xl bg-forest-50 flex items-center justify-center shrink-0 text-forest-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-mono uppercase tracking-wider text-slate-400">Telepon / WhatsApp Pengelola:</span>
                                        <span class="font-bold text-forest-900 text-base font-mono">+{{ $settings->kontak_telepon }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- Right: Information for Business Owners -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-forest-900 text-white rounded-2xl p-8 sm:p-10 space-y-6 shadow-xl">
                        <span class="text-xs font-mono uppercase tracking-wider px-3 py-1 rounded bg-forest-800 text-emerald-200 border border-forest-700">
                            Untuk Pelaku Usaha Baru
                        </span>

                        <h3 class="font-corporate text-2xl sm:text-3xl font-extrabold leading-tight">
                            Ingin mendaftarkan usaha Anda ke dalam direktori?
                        </h3>

                        <p class="text-sm text-emerald-100 leading-relaxed font-light">
                            Warga yang memiliki usaha rumah tangga, kuliner, kerajinan, produk pertanian, atau jasa di lingkungan RW dapat didaftarkan secara gratis ke dalam direktori ini melalui ketua RW setempat atau sekretariat pengelola direktori.
                        </p>

                        <div class="space-y-3 pt-2">
                            <div class="flex items-center space-x-2.5 text-xs text-emerald-100">
                                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Tanpa biaya pendaftaran (gratis untuk warga)</span>
                            </div>
                            <div class="flex items-center space-x-2.5 text-xs text-emerald-100">
                                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Terhubung tombol pemesanan WhatsApp langsung</span>
                            </div>
                            <div class="flex items-center space-x-2.5 text-xs text-emerald-100">
                                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Foto produk dan profil dikurasi dengan rapi</span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-forest-800">
                            @if(!empty($settings->kontak_telepon))
                                <a href="https://wa.me/{{ $settings->kontak_telepon }}?text={{ rawurlencode('Halo Pengelola Direktori RW & UMKM, saya ingin mendaftarkan usaha baru di lingkungan RW.') }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center space-x-2 px-6 py-3.5 rounded-xl bg-terracotta text-white font-bold text-xs uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    <span>Hubungi Pengelola via WhatsApp</span>
                                </a>
                            @else
                                <a href="mailto:{{ $settings->kontak_email }}" class="w-full inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-terracotta text-white font-bold text-xs uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                                    <span>Hubungi via Email</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
