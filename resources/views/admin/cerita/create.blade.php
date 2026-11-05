@extends('layouts.admin')

@section('title', 'Tulis Cerita Baru')
@section('header_title', 'Tulis Cerita & Kegiatan Baru')

@section('content')
    <div class="max-w-4xl space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.cerita.index') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-900 flex items-center space-x-1.5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Daftar Cerita</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('admin.cerita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="judul" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Judul Cerita / Artikel <span class="text-terracotta">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Menghidupkan Tradisi Jamu Gendong di Tengah Era Digital" required class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="kategori" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Kategori Cerita <span class="text-terracotta">*</span>
                        </label>
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori') }}" list="kategori-cerita-list" placeholder="Pilih atau ketik kategori..." required class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        <datalist id="kategori-cerita-list">
                            <option value="Kisah UMKM">
                            <option value="Kegiatan Warga">
                            <option value="Potensi Wilayah">
                            <option value="Inovasi & Kriya">
                            <option value="Festival & Pasar">
                        </datalist>
                    </div>

                    <div>
                        <label for="tanggal_publikasi" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Tanggal Publikasi
                        </label>
                        <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                    </div>
                </div>

                <div>
                    <label for="slug" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Slug URL (Otomatis jika dikosongkan)
                    </label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                </div>

                <div>
                    <label for="ringkasan" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Ringkasan Singkat / Lead Paragraph
                    </label>
                    <textarea id="ringkasan" name="ringkasan" rows="2" placeholder="Satu atau dua kalimat pembuka yang merangkum inti cerita..." class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">{{ old('ringkasan') }}</textarea>
                </div>

                <div>
                    <label for="konten" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Isi Cerita Lengkap <span class="text-terracotta">*</span>
                    </label>
                    <textarea id="konten" name="konten" rows="8" placeholder="Tuliskan narasi lengkap cerita atau kegiatan di sini (dapat menggunakan format paragraf biasa)..." required class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm leading-relaxed focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">{{ old('konten') }}</textarea>
                </div>

                <div>
                    <label for="foto_sampul" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Foto Sampul Artikel (JPG, PNG, WEBP - Maks 3MB)
                    </label>
                    <input type="file" id="foto_sampul" name="foto_sampul" accept="image/*" class="mt-1 block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-800 hover:file:bg-slate-200 transition">
                </div>

                <div>
                    <label for="status" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Status Publikasi <span class="text-terracotta">*</span>
                    </label>
                    <select id="status" name="status" class="mt-1 block w-full sm:w-60 px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        <option value="terbit" {{ old('status', 'terbit') === 'terbit' ? 'selected' : '' }}>Terbit Langsung</option>
                        <option value="draf" {{ old('status') === 'draf' ? 'selected' : '' }}>Draf</option>
                        <option value="terjadwal" {{ old('status') === 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.cerita.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                        Publikasikan Cerita
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
