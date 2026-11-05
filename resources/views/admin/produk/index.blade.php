@extends('layouts.admin')

@section('title', 'Kelola Produk UMKM')
@section('header_title', 'Kelola Katalog Produk UMKM')

@section('content')
    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-sm text-slate-500">Kelola daftar produk, karya kriya, makanan, dan layanan dari setiap pelaku UMKM.</p>
            </div>
            <a href="{{ route('admin.produk.create') }}" class="inline-flex items-center space-x-1.5 px-4 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                <span>+ Tambah Produk Baru</span>
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
            <form action="{{ route('admin.produk.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-6 relative">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama produk atau deskripsi..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-terracotta">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="sm:col-span-3">
                    <select name="umkm_id" class="w-full py-2 px-3 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-terracotta">
                        <option value="semua">Semua UMKM</option>
                        @foreach($umkms as $u)
                            <option value="{{ $u->id }}" {{ $umkmId == $u->id ? 'selected' : '' }}>
                                {{ $u->nama_usaha }} ({{ $u->rw->nomor_rw ?? 'RW' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <select name="status" class="w-full py-2 px-3 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-terracotta">
                        <option value="">Semua Status</option>
                        <option value="terbit" {{ $status === 'terbit' ? 'selected' : '' }}>Terbit</option>
                        <option value="draf" {{ $status === 'draf' ? 'selected' : '' }}>Draf</option>
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <button type="submit" class="w-full py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-mono tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-3.5 px-4">Produk</th>
                            <th class="py-3.5 px-4">UMKM Pemilik</th>
                            <th class="py-3.5 px-4">Harga</th>
                            <th class="py-3.5 px-4">Ketersediaan</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($products as $prod)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                                            <img src="{{ $prod->photo_url }}" alt="{{ $prod->nama_produk }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="block font-bold text-slate-900 text-sm">{{ $prod->nama_produk }}</span>
                                            @if($prod->is_unggulan)
                                                <span class="inline-block px-1.5 py-0.5 rounded bg-terracotta text-[9px] text-white font-mono uppercase">Unggulan</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="font-bold text-slate-900">{{ $prod->umkm->nama_usaha ?? 'UMKM' }}</span>
                                    <span class="block text-[11px] text-slate-400 font-mono">{{ $prod->umkm->rw->nomor_rw ?? '' }}</span>
                                </td>
                                <td class="py-3.5 px-4 font-mono">
                                    @if($prod->harga)
                                        <span class="font-bold text-forest-900">{{ $prod->formatted_price }}</span>
                                    @else
                                        <span class="text-slate-400 italic">Belum diisi</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($prod->status_ketersediaan === 'tersedia')
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700">Tersedia</span>
                                    @elseif($prod->status_ketersediaan === 'pre_order')
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700">Pre-Order</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">Habis</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $prod->status === 'terbit' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $prod->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    <a href="{{ route('admin.produk.edit', $prod->id) }}" class="text-forest-900 hover:text-terracotta font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.produk.destroy', $prod->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk {{ $prod->nama_produk }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-slate-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        <span>Belum ada produk. Silakan tambahkan produk baru.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
