@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('header_title', 'Pengaturan & Identitas Website')

@section('content')
    <div class="max-w-4xl space-y-6">
        
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Site Title & Tagline -->
                <div>
                    <div class="border-b border-slate-100 pb-3 mb-6">
                        <span class="text-xs font-mono uppercase tracking-wider text-terracotta font-bold">01 — Identitas Dasar Website</span>
                        <p class="text-xs text-slate-500 mt-1">Nama dan kalimat pengantar yang tampil pada header publik, hero beranda, dan footer.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_website" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Nama / Judul Website <span class="text-terracotta">*</span>
                            </label>
                            <input type="text" id="nama_website" name="nama_website" value="{{ old('nama_website', $settings->nama_website) }}" required class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>

                        <div>
                            <label for="tagline" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Tagline / Kalimat Pengantar
                            </label>
                            <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $settings->tagline) }}" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="deskripsi_singkat" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Deskripsi Singkat / Pernyataan Misi
                        </label>
                        <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">{{ old('deskripsi_singkat', $settings->deskripsi_singkat) }}</textarea>
                    </div>
                </div>

                <!-- Media (Logo & Hero) -->
                <div>
                    <div class="border-b border-slate-100 pb-3 mb-6">
                        <span class="text-xs font-mono uppercase tracking-wider text-terracotta font-bold">02 — Media & Gambar Utama</span>
                        <p class="text-xs text-slate-500 mt-1">Aset visual yang menjadi latar belakang hero banner beranda.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider mb-2">
                                Gambar Utama / Hero Image Beranda
                            </label>
                            @if($settings->hero_image)
                                <div class="w-full aspect-[16/9] rounded-xl overflow-hidden border border-slate-200 mb-3 shadow-2xs">
                                    <img src="{{ $settings->hero_image_url }}" alt="Hero Image" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input type="file" id="hero_image" name="hero_image" accept="image/*" class="mt-1 block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-800 hover:file:bg-slate-200 transition">
                        </div>

                        <div>
                            <label for="warna_aksen" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Warna Aksen Pokok (Hex Code)
                            </label>
                            <div class="flex items-center space-x-3 mt-2">
                                <input type="color" id="warna_picker" value="{{ $settings->warna_aksen ?? '#14382c' }}" onchange="document.getElementById('warna_aksen').value = this.value" class="w-10 h-10 rounded-lg border border-slate-300 cursor-pointer p-0.5">
                                <input type="text" id="warna_aksen" name="warna_aksen" value="{{ old('warna_aksen', $settings->warna_aksen ?? '#14382c') }}" class="block w-36 px-3.5 py-2 rounded-xl border border-slate-300 text-xs font-mono focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none">
                            </div>
                            <p class="text-[11px] text-slate-400 mt-2">Warna primer yang digunakan untuk penekanan visual elemen navigasi dan tombol.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div>
                    <div class="border-b border-slate-100 pb-3 mb-6">
                        <span class="text-xs font-mono uppercase tracking-wider text-terracotta font-bold">03 — Kontak Sekretariat Pengelola</span>
                        <p class="text-xs text-slate-500 mt-1">Saluran komunikasi rukun warga yang ditampilkan di footer publik dan halaman hubungi kami.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="kontak_email" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Email Resmi Pengelola
                            </label>
                            <input type="email" id="kontak_email" name="kontak_email" value="{{ old('kontak_email', $settings->kontak_email) }}" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>

                        <div>
                            <label for="kontak_telepon" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Nomor Telepon / WhatsApp Sekretariat
                            </label>
                            <input type="text" id="kontak_telepon" name="kontak_telepon" value="{{ old('kontak_telepon', $settings->kontak_telepon) }}" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="alamat_sekretariat" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Alamat Sekretariat Pengelola
                        </label>
                        <textarea id="alamat_sekretariat" name="alamat_sekretariat" rows="2" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">{{ old('alamat_sekretariat', $settings->alamat_sekretariat) }}</textarea>
                    </div>
                </div>

                <!-- Social Links -->
                <div>
                    <div class="border-b border-slate-100 pb-3 mb-6">
                        <span class="text-xs font-mono uppercase tracking-wider text-terracotta font-bold">04 — Tautan Media Sosial Komunitas</span>
                        <p class="text-xs text-slate-500 mt-1">Kanal sosial warga untuk memperluas jangkauan dan publikasi kegiatan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label for="instagram_url" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Instagram URL
                            </label>
                            <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/..." class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>

                        <div>
                            <label for="facebook_url" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Facebook URL
                            </label>
                            <input type="url" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/..." class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>

                        <div>
                            <label for="youtube_url" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                YouTube Channel URL
                            </label>
                            <input type="url" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="https://youtube.com/..." class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-200 flex items-center justify-end">
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                        Simpan Semua Pengaturan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
