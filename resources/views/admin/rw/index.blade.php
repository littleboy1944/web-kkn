@extends('layouts.admin')

@section('title', 'Kelola Rukun Warga (RW)')
@section('header_title', 'Kelola Profil Rukun Warga')

@section('content')
    <div class="space-y-6">
        
        <!-- Header Actions & Intro -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-2xs">
            <div>
                <h2 class="font-corporate text-xl font-extrabold text-slate-900">Daftar Wilayah Rukun Warga</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola data resmi wilayah, profil lingkungan, potensi khas, dan izin privasi pengurus RW.</p>
            </div>
            <a href="{{ route('admin.rw.create') }}" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-forest-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta transition shadow-sm shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah RW Baru</span>
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <form action="{{ route('admin.rw.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                <div class="relative flex-grow w-full">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama atau nomor RW (misal: RW 01, Krajan)..." class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-forest-900 focus:border-transparent">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="w-full sm:w-48">
                    <select name="status" class="w-full py-2.5 px-3 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-forest-900">
                        <option value="">Semua Status Publikasi</option>
                        <option value="terbit" {{ $status === 'terbit' ? 'selected' : '' }}>Terbit (Publik)</option>
                        <option value="draf" {{ $status === 'draf' ? 'selected' : '' }}>Draf (Tersimpan)</option>
                    </select>
                </div>
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-forest-900 text-white text-xs font-semibold transition">
                    Filter
                </button>
                @if($search || $status)
                    <a href="{{ route('admin.rw.index') }}" class="w-full sm:w-auto text-center px-4 py-2.5 rounded-xl bg-slate-100 text-slate-600 text-xs hover:bg-slate-200 transition font-medium">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Card (SIG Enterprise Table Style) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-mono tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 px-5">Nomor & Nama RW</th>
                            <th class="py-4 px-5">Ketua RW & Privasi</th>
                            <th class="py-4 px-5">UMKM Terhubung</th>
                            <th class="py-4 px-5">Status</th>
                            <th class="py-4 px-5 text-right">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($rws as $rw)
                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                <!-- RW Name & Photo -->
                                <td class="py-4 px-5">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                            <img src="{{ $rw->cover_url }}" alt="{{ $rw->nama }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="block font-bold text-slate-900 text-sm leading-tight">{{ $rw->nomor_rw }} &mdash; {{ $rw->nama }}</span>
                                            <span class="block text-[11px] font-mono text-emerald-700 mt-0.5">/rw/{{ $rw->slug }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Leader & Privacy Status -->
                                <td class="py-4 px-5">
                                    @if($rw->nama_ketua_rw)
                                        <span class="font-medium text-slate-900 block">{{ $rw->nama_ketua_rw }}</span>
                                        @if($rw->is_leader_public)
                                            <span class="inline-flex items-center text-[10px] text-emerald-700 font-mono mt-0.5 font-semibold">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1"></span>
                                                Ditampilkan Publik
                                            </span>
                                        @else
                                            <span class="inline-flex items-center text-[10px] text-slate-400 font-mono mt-0.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1"></span>
                                                Privat / Hanya Admin
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-slate-400 italic text-xs">Belum diisi</span>
                                    @endif
                                </td>

                                <!-- UMKM Count -->
                                <td class="py-4 px-5">
                                    <a href="{{ route('admin.umkm.index', ['rw_id' => $rw->id]) }}" class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-slate-100 hover:bg-forest-50 hover:text-forest-900 text-slate-700 font-mono font-semibold transition">
                                        <span>{{ $rw->umkms_count }} UMKM</span>
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-5">
                                    @if($rw->status === 'terbit')
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

                                <!-- Actions -->
                                <td class="py-4 px-5 text-right space-x-2">
                                    @if($rw->status === 'terbit')
                                        <a href="{{ route('rw.show', $rw->slug) }}" target="_blank" class="inline-flex items-center px-2.5 py-1 rounded-lg text-slate-600 hover:text-forest-900 hover:bg-slate-100 transition font-medium text-xs" title="Buka Profil Publik">
                                            <span>Pratinjau</span>
                                            <svg class="w-3 h-3 ml-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('admin.rw.edit', $rw->id) }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-forest-50 hover:bg-forest-100 text-forest-900 font-semibold text-xs transition" title="Ubah Profil RW">
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('admin.rw.destroy', $rw->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil {{ $rw->nomor_rw }}? Seluruh data UMKM di bawah RW ini juga akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-lg text-red-600 hover:bg-red-50 font-semibold text-xs transition" title="Hapus Profil RW">
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400 bg-slate-50/50">
                                    <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 mx-auto flex items-center justify-center mb-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <p class="font-medium text-slate-700">Belum ada data Rukun Warga</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Silakan tambahkan data RW pertama melalui tombol di atas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($rws->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $rws->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
