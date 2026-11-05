@extends('layouts.admin')

@section('title', "Edit {$produk->nama_produk}")
@section('header_title', "Edit Produk {$produk->nama_produk}")

@section('content')
    <div class="max-w-4xl space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.produk.index') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-900 flex items-center space-x-1.5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Daftar Produk</span>
            </a>
            @if($produk->umkm && $produk->umkm->status === 'terbit')
                <a href="{{ route('umkm.show', $produk->umkm->slug) }}" target="_blank" class="text-xs font-semibold text-terracotta hover:underline">
                    Lihat di Halaman Profil UMKM &rarr;
                </a>
            @endif
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
            <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_produk" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Nama Produk <span class="text-terracotta">*</span>
                        </label>
                        <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                    </div>

                    <div>
                        <label for="umkm_id" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            UMKM Pemilik Produk <span class="text-terracotta">*</span>
                        </label>
                        <select id="umkm_id" name="umkm_id" required class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                            @foreach($umkms as $u)
                                <option value="{{ $u->id }}" {{ old('umkm_id', $produk->umkm_id) == $u->id ? 'selected' : '' }}>
                                    {{ $u->nama_usaha }} ({{ $u->rw->nomor_rw ?? 'RW' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="harga" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Harga (Rupiah, Kosongkan jika belum tersedia)
                        </label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-mono text-slate-400">Rp</span>
                            <input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" class="block w-full pl-10 pr-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-mono focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label for="status_ketersediaan" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Status Ketersediaan <span class="text-terracotta">*</span>
                        </label>
                        <select id="status_ketersediaan" name="status_ketersediaan" class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                            <option value="tersedia" {{ old('status_ketersediaan', $produk->status_ketersediaan) === 'tersedia' ? 'selected' : '' }}>Tersedia (Ready Stock)</option>
                            <option value="pre_order" {{ old('status_ketersediaan', $produk->status_ketersediaan) === 'pre_order' ? 'selected' : '' }}>Pre-Order</option>
                            <option value="habis" {{ old('status_ketersediaan', $produk->status_ketersediaan) === 'habis' ? 'selected' : '' }}>Habis (Stok Kosong)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                        Deskripsi Produk
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider mb-2">
                        Foto Produk Saat Ini
                    </label>
                    @if($produk->foto_produk)
                        <div class="w-32 h-32 rounded-xl overflow-hidden border border-slate-200 mb-2">
                            <img src="{{ $produk->photo_url }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" id="foto_produk" name="foto_produk" accept="image/*" class="mt-1 block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-800 hover:file:bg-slate-200 transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-slate-200">
                    <div>
                        <label for="status" class="block text-xs font-semibold text-slate-700 uppercase font-mono tracking-wider">
                            Status Publikasi <span class="text-terracotta">*</span>
                        </label>
                        <select id="status" name="status" class="mt-1 block w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-terracotta focus:border-terracotta focus:outline-none transition">
                            <option value="terbit" {{ old('status', $produk->status) === 'terbit' ? 'selected' : '' }}>Terbit (Tampil di Katalog)</option>
                            <option value="draf" {{ old('status', $produk->status) === 'draf' ? 'selected' : '' }}>Draf</option>
                        </select>
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="flex items-center space-x-2.5 cursor-pointer">
                            <input type="checkbox" name="is_unggulan" value="1" {{ old('is_unggulan', $produk->is_unggulan) ? 'checked' : '' }} class="rounded border-slate-300 text-terracotta focus:ring-terracotta">
                            <span class="text-xs font-semibold text-slate-800">Tampilkan di Produk Pilihan Beranda</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.produk.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                        Perbarui Produk
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
