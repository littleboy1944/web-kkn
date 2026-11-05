@extends('layouts.admin')

@section('title', "Edit {$rw->nomor_rw}")
@section('header_title', "Edit Profil {$rw->nomor_rw}")

@section('content')
    <div class="max-w-4xl space-y-6">
        
        <!-- Breadcrumb & Public Preview Link -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.rw.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold text-slate-500 hover:text-slate-900 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Daftar RW</span>
            </a>
            @if($rw->status === 'terbit')
                <a href="{{ route('rw.show', $rw->slug) }}" target="_blank" class="inline-flex items-center space-x-1 text-xs font-semibold text-terracotta hover:underline">
                    <span>Lihat Halaman Publik RW</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
            @endif
        </div>

        <!-- Form Card (SIG Corporate Structured Form) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            
            <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="font-corporate text-xl font-extrabold text-slate-900">Perbarui Profil {{ $rw->nomor_rw }} &mdash; {{ $rw->nama }}</h2>
                    <p class="text-xs text-slate-500 mt-1">Perubahan data akan langsung tercermin di profil publik setelah disimpan.</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-mono font-semibold {{ $rw->status === 'terbit' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }} shrink-0">
                    Status: {{ strtoupper($rw->status) }}
                </span>
            </div>

            <form action="{{ route('admin.rw.update', $rw->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Section 1: Identitas Pokok Wilayah -->
                <div class="space-y-4">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">1. Identitas Pokok Wilayah</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="nomor_rw" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Nomor RW <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nomor_rw" name="nomor_rw" value="{{ old('nomor_rw', $rw->nomor_rw) }}" required class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>

                        <div>
                            <label for="nama" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Nama Wilayah RW <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $rw->nama) }}" required class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="slug" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Slug URL Profil Publik
                        </label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $rw->slug) }}" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        <p class="text-[11px] text-slate-400 mt-1">URL publik saat ini: <code class="bg-slate-100 px-1 py-0.5 rounded text-emerald-700">/rw/{{ $rw->slug }}</code></p>
                    </div>
                </div>

                <!-- Section 2: Narasi & Potensi Lingkungan -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">2. Narasi & Potensi Lingkungan</span>
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Deskripsi Profil Wilayah
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none leading-relaxed">{{ old('deskripsi', $rw->deskripsi) }}</textarea>
                    </div>

                    <div>
                        <label for="potensi_kegiatan" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Potensi, Ciri Khas, atau Kegiatan Unggulan RW
                        </label>
                        <textarea id="potensi_kegiatan" name="potensi_kegiatan" rows="3" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none leading-relaxed">{{ old('potensi_kegiatan', $rw->potensi_kegiatan) }}</textarea>
                    </div>
                </div>

                <!-- Section 3: Foto Sampul -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">3. Foto Sampul Wilayah</span>
                    </div>

                    <div>
                        @if($rw->foto_sampul)
                            <div class="mb-3">
                                <span class="block text-[11px] font-mono text-slate-400 uppercase mb-1">Foto Sampul Aktif:</span>
                                <div class="w-48 aspect-[16/10] rounded-xl overflow-hidden border border-slate-200 shadow-2xs">
                                    <img src="{{ $rw->cover_url }}" alt="{{ $rw->nama }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif
                        <label for="foto_sampul" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Unggah Foto Baru (Kosongkan jika tidak ingin mengubah)
                        </label>
                        <input type="file" id="foto_sampul" name="foto_sampul" accept="image/*" class="mt-1.5 block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-forest-50 file:text-forest-900 hover:file:bg-forest-100 cursor-pointer">
                    </div>
                </div>

                <!-- Section 4: Informasi Ketua RW & Privasi -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">4. Informasi Pengurus RW & Pengaturan Privasi</span>
                    </div>

                    <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/90 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_ketua_rw" class="block text-xs font-medium text-slate-700">Nama Ketua RW (Opsional)</label>
                                <input type="text" id="nama_ketua_rw" name="nama_ketua_rw" value="{{ old('nama_ketua_rw', $rw->nama_ketua_rw) }}" class="mt-1 block w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                            </div>

                            <div>
                                <label for="kontak_ketua_rw" class="block text-xs font-medium text-slate-700">Nomor Telepon/HP (Opsional)</label>
                                <input type="text" id="kontak_ketua_rw" name="kontak_ketua_rw" value="{{ old('kontak_ketua_rw', $rw->kontak_ketua_rw) }}" class="mt-1 block w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-200/60 flex items-start space-x-3">
                            <input type="checkbox" id="is_leader_public" name="is_leader_public" value="1" {{ old('is_leader_public', $rw->is_leader_public) ? 'checked' : '' }} class="mt-0.5 rounded border-slate-300 text-forest-900 focus:ring-forest-900 w-4 h-4 cursor-pointer">
                            <label for="is_leader_public" class="text-xs text-slate-700 leading-relaxed cursor-pointer">
                                <strong class="text-slate-900">Izinkan publikasi nama dan kontak ketua RW</strong> di halaman profil publik.<br>
                                <span class="text-slate-500">Jika tidak dicentang, data pengurus hanya disimpan dalam sistem administrasi internal.</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Status Publikasi & Action Buttons -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">5. Status Publikasi</span>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Status Penerbitan <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" class="mt-1.5 block w-full sm:w-64 px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                            <option value="terbit" {{ old('status', $rw->status) === 'terbit' ? 'selected' : '' }}>Terbit (Muncul di Website Publik)</option>
                            <option value="draf" {{ old('status', $rw->status) === 'draf' ? 'selected' : '' }}>Draf (Disimpan Sementara)</option>
                        </select>
                    </div>
                </div>

                <!-- Action Button Strip -->
                <div class="pt-6 border-t border-slate-200 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.rw.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-7 py-2.5 rounded-xl bg-forest-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta transition shadow-sm">
                        Perbarui Profil RW
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
