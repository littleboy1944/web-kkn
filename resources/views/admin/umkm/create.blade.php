@extends('layouts.admin')

@section('title', 'Tambah Pelaku UMKM Baru')
@section('header_title', 'Tambah Profil Pelaku UMKM')

@section('content')
    <div class="max-w-4xl space-y-6">
        
        <!-- Back Link -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.umkm.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold text-slate-500 hover:text-slate-900 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Daftar UMKM</span>
            </a>
        </div>

        <!-- Form Card (SIG Corporate Structured Form) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            
            <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
                <h2 class="font-corporate text-xl font-extrabold text-slate-900">Formulir Pendaftaran Pelaku Usaha UMKM</h2>
                <p class="text-xs text-slate-500 mt-1">Daftarkan usaha warga ke dalam direktori. Pastikan nomor WhatsApp diisi dengan benar agar pembeli dapat menghubungi langsung.</p>
            </div>

            <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                @csrf

                <!-- Section 1: Data Pokok Usaha & Penempatan RW -->
                <div class="space-y-4">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">1. Data Pokok Usaha & Wilayah RW</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_usaha" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Nama Usaha UMKM <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_usaha" name="nama_usaha" value="{{ old('nama_usaha') }}" placeholder="Contoh: Kopi Seduh Krajan" required class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>

                        <div>
                            <label for="rw_id" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Rukun Warga (RW) Wilayah Usaha <span class="text-red-500">*</span>
                            </label>
                            <select id="rw_id" name="rw_id" required class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                                <option value="">-- Pilih Wilayah Rukun Warga --</option>
                                @foreach($rws as $rw)
                                    <option value="{{ $rw->id }}" {{ old('rw_id') == $rw->id ? 'selected' : '' }}>
                                        {{ $rw->nomor_rw }} &mdash; {{ $rw->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-[11px] text-slate-400 mt-1">UMKM akan otomatis tampil pada halaman profil RW yang dipilih.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="kategori" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Kategori Usaha <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="kategori" name="kategori" value="{{ old('kategori') }}" list="kategori-list" placeholder="Pilih atau ketik kategori..." required class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                            <datalist id="kategori-list">
                                <option value="Makanan & Minuman">
                                <option value="Kerajinan Tangan">
                                <option value="Fesyen & Tekstil">
                                <option value="Pertanian & Perkebunan">
                                <option value="Jasa & Reparasi">
                                <option value="Kriya & Dekorasi">
                            </datalist>
                        </div>

                        <div>
                            <label for="slug" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Slug URL (Dibuat otomatis jika kosong)
                            </label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Contoh: kopi-seduh-krajan" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Pemilik & Pengaturan Privasi -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">2. Identitas Pengelola & Privasi</span>
                    </div>

                    <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/90 space-y-3">
                        <div>
                            <label for="nama_pemilik" class="block text-xs font-medium text-slate-700">Nama Pemilik / Pengelola (Opsional)</label>
                            <input type="text" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik') }}" placeholder="Contoh: Ibu Siti Aminah" class="mt-1 block w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>
                        <div class="pt-2 border-t border-slate-200/60 flex items-start space-x-3">
                            <input type="checkbox" id="is_owner_public" name="is_owner_public" value="1" {{ old('is_owner_public') ? 'checked' : '' }} class="mt-0.5 rounded border-slate-300 text-forest-900 focus:ring-forest-900 w-4 h-4 cursor-pointer">
                            <label for="is_owner_public" class="text-xs text-slate-700 leading-relaxed cursor-pointer">
                                <strong class="text-slate-900">Izinkan publikasi nama pemilik</strong> pada kartu dan halaman profil publik UMKM.<br>
                                <span class="text-slate-500">Jika tidak dicentang, hanya nama usaha yang ditampilkan demi privasi warga.</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Cerita & Narasi Usaha -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">3. Profil Usaha & Cerita Singkat</span>
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Deskripsi Usaha & Cerita Produk
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Ceritakan bagaimana usaha ini berawal, bahan baku yang digunakan, proses pembuatan, atau keunggulan produk bagi pelanggan..." class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none leading-relaxed">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label for="foto_sampul" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Foto Sampul Usaha (JPG, PNG, WEBP - Maks 3MB)
                        </label>
                        <input type="file" id="foto_sampul" name="foto_sampul" accept="image/*" class="mt-1.5 block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-forest-50 file:text-forest-900 hover:file:bg-forest-100 cursor-pointer">
                    </div>
                </div>

                <!-- Section 4: WhatsApp Integration & Operasional -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">4. Integrasi Pemesanan WhatsApp & Operasional</span>
                    </div>

                    <div class="p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200 space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold font-mono uppercase tracking-wider text-emerald-950">Tombol Pemesanan Langsung WhatsApp</h4>
                                <p class="text-xs text-emerald-800 mt-0.5">Nomor akan otomatis diformat ke standar internasional (contoh: <code>0812...</code> disimpan sebagai <code>62812...</code>).</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                            <div>
                                <label for="nomor_whatsapp" class="block text-xs font-semibold text-emerald-950">
                                    Nomor WhatsApp Penjual
                                </label>
                                <input type="text" id="nomor_whatsapp" name="nomor_whatsapp" value="{{ old('nomor_whatsapp') }}" placeholder="Contoh: 081234567890" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl bg-white border border-emerald-300 text-sm font-mono text-emerald-950 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
                            </div>

                            <div>
                                <label for="pesan_whatsapp_template" class="block text-xs font-semibold text-emerald-950">
                                    Template Pesan Awal (Opsional)
                                </label>
                                <input type="text" id="pesan_whatsapp_template" name="pesan_whatsapp_template" value="{{ old('pesan_whatsapp_template', 'Halo, saya melihat profil [NAMA_UMKM] di website. Saya ingin bertanya tentang produk Anda.') }}" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl bg-white border border-emerald-300 text-xs text-emerald-950 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_operasional" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Jam Operasional (Opsional)
                            </label>
                            <input type="text" id="jam_operasional" name="jam_operasional" value="{{ old('jam_operasional') }}" placeholder="Contoh: Setiap Hari: 08.00 - 17.00 WIB" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>

                        <div>
                            <label for="tautan_sosmed" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Tautan Media Sosial / Instagram
                            </label>
                            <input type="text" id="tautan_sosmed" name="tautan_sosmed" value="{{ old('tautan_sosmed') }}" placeholder="Contoh: https://instagram.com/namausaha" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="alamat_spesifik" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Alamat / Patokan Lokasi Usaha
                        </label>
                        <input type="text" id="alamat_spesifik" name="alamat_spesifik" value="{{ old('alamat_spesifik') }}" placeholder="Contoh: Jl. Melati No. 14, RT 02 (Dekat Balai Warga)" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                    </div>
                </div>

                <!-- Section 5: Status Publikasi & Unggulan -->
                <div class="space-y-4 pt-2">
                    <div class="border-b border-slate-100 pb-2">
                        <span class="text-xs font-mono uppercase tracking-wider text-forest-900 font-bold">5. Status Publikasi & Fitur</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                        <div>
                            <label for="status" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                                Status Publikasi <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status" class="mt-1.5 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-forest-900 focus:border-transparent focus:outline-none">
                                <option value="terbit" {{ old('status', 'terbit') === 'terbit' ? 'selected' : '' }}>Terbit (Langsung Tayang di Direktori)</option>
                                <option value="draf" {{ old('status') === 'draf' ? 'selected' : '' }}>Draf (Disimpan Sementara)</option>
                            </select>
                        </div>

                        <div class="pt-5">
                            <label class="flex items-center space-x-2.5 cursor-pointer">
                                <input type="checkbox" name="is_unggulan" value="1" {{ old('is_unggulan') ? 'checked' : '' }} class="rounded border-slate-300 text-terracotta focus:ring-terracotta w-4 h-4">
                                <span class="text-xs font-semibold text-slate-800">Tandai sebagai UMKM Unggulan di Beranda</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Button Strip -->
                <div class="pt-6 border-t border-slate-200 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.umkm.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-7 py-2.5 rounded-xl bg-forest-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta transition shadow-sm">
                        Simpan Profil UMKM
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
