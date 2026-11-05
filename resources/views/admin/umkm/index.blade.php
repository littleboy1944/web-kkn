@extends('layouts.admin')

@section('title', 'Kelola Pelaku UMKM')
@section('header_title', 'Kelola Direktori Pelaku UMKM')

@section('content')
    <div class="space-y-6">
        
        <!-- Header Actions & Intro Card -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs">
            <div>
                <h2 class="font-corporate text-xl font-extrabold text-slate-900">Direktori Usaha Mikro, Kecil, dan Menengah</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola data pelaku UMKM warga, penempatan wilayah RW, pemesanan WhatsApp, dan katalog produk.</p>
            </div>
            <a href="{{ route('admin.umkm.create') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-forest-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta transition shadow-sm shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah UMKM Baru</span>
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <form action="{{ route('admin.umkm.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-5 relative">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama usaha, kategori, atau deskripsi..." class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-forest-900 focus:border-transparent">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="sm:col-span-3">
                    <select name="rw_id" class="w-full py-2.5 px-3 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-forest-900">
                        <option value="semua">Semua Wilayah RW</option>
                        @foreach($rws as $rw)
                            <option value="{{ $rw->id }}" {{ $rwId == $rw->id ? 'selected' : '' }}>
                                {{ $rw->nomor_rw }} &mdash; {{ $rw->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <select name="status" class="w-full py-2.5 px-3 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-forest-900">
                        <option value="">Semua Status</option>
                        <option value="terbit" {{ $status === 'terbit' ? 'selected' : '' }}>Terbit</option>
                        <option value="draf" {{ $status === 'draf' ? 'selected' : '' }}>Draf</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex items-center space-x-2">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-forest-900 text-white text-xs font-semibold transition">
                        Filter
                    </button>
                    @if($search || ($rwId && $rwId !== 'semua') || $status)
                        <a href="{{ route('admin.umkm.index') }}" class="px-3 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs transition font-medium">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card (SIG Enterprise Table Style) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-mono tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 px-5">Nama Usaha & Kategori</th>
                            <th class="py-4 px-5">Wilayah RW</th>
                            <th class="py-4 px-5">WhatsApp Penjual</th>
                            <th class="py-4 px-5">Produk</th>
                            <th class="py-4 px-5">Status</th>
                            <th class="py-4 px-5 text-right">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($umkms as $umkm)
                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                
                                <!-- Business Name & Category -->
                                <td class="py-4 px-5">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                            <img src="{{ $umkm->cover_url }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="block font-bold text-slate-900 text-sm leading-tight">{{ $umkm->nama_usaha }}</span>
                                            <div class="flex items-center space-x-1.5 mt-1">
                                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-mono bg-slate-100 text-slate-700 border border-slate-200 font-semibold">{{ $umkm->kategori }}</span>
                                                @if($umkm->is_unggulan)
                                                    <span class="inline-block px-1.5 py-0.5 rounded bg-terracotta text-[9px] text-white font-mono uppercase font-bold">Unggulan</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- RW Affiliation -->
                                <td class="py-4 px-5">
                                    <span class="font-bold text-forest-900 block text-xs">{{ $umkm->rw->nomor_rw ?? 'RW' }}</span>
                                    <span class="block text-[11px] text-slate-500 truncate max-w-[160px]">{{ $umkm->rw->nama ?? '' }}</span>
                                </td>

                                <!-- WhatsApp Contact -->
                                <td class="py-4 px-5 font-mono">
                                    @if($umkm->nomor_whatsapp)
                                        <a href="{{ $umkm->getWhatsappUrl() }}" target="_blank" class="inline-flex items-center space-x-1.5 text-emerald-700 hover:text-emerald-900 font-semibold transition" title="Buka WhatsApp">
                                            <svg class="w-3.5 h-3.5 fill-current text-emerald-600" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                            <span>+{{ $umkm->nomor_whatsapp }}</span>
                                        </a>
                                    @else
                                        <span class="text-slate-400 italic text-xs">Belum diisi</span>
                                    @endif
                                </td>

                                <!-- Product Count -->
                                <td class="py-4 px-5">
                                    <a href="{{ route('admin.produk.index', ['umkm_id' => $umkm->id]) }}" class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-slate-100 hover:bg-forest-50 hover:text-forest-900 text-slate-700 font-mono font-semibold transition" title="Lihat produk UMKM ini">
                                        <span>{{ $umkm->products_count }} produk</span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-5">
                                    @if($umkm->status === 'terbit')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                            Terbit
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1.5"></span>
                                            Draf
                                        </span>
                                    @endif
                                </td>

                                <!-- Action Buttons -->
                                <td class="py-4 px-5 text-right space-x-2">
                                    @if($umkm->status === 'terbit')
                                        <a href="{{ route('umkm.show', $umkm->slug) }}" target="_blank" class="inline-flex items-center px-2.5 py-1 rounded-lg text-slate-600 hover:text-forest-900 hover:bg-slate-100 transition font-medium text-xs" title="Buka Profil Publik UMKM">
                                            <span>Pratinjau</span>
                                            <svg class="w-3 h-3 ml-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-forest-50 hover:bg-forest-100 text-forest-900 font-semibold text-xs transition" title="Ubah UMKM">
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data UMKM {{ $umkm->nama_usaha }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-lg text-red-600 hover:bg-red-50 font-semibold text-xs transition" title="Hapus UMKM">
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 bg-slate-50/50">
                                    <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 mx-auto flex items-center justify-center mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="font-medium text-slate-700">Belum ada data UMKM terdaftar</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan data UMKM baru melalui tombol di atas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($umkms->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $umkms->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
