@extends('layouts.admin')

@section('title', 'Kelola Cerita & Kegiatan')
@section('header_title', 'Kelola Cerita & Kegiatan Warga')

@section('content')
    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-sm text-slate-500">Publikasi artikel, profil usaha inspiratif, dan dokumentasi kegiatan rukun warga.</p>
            </div>
            <a href="{{ route('admin.cerita.create') }}" class="inline-flex items-center space-x-1.5 px-4 py-2.5 rounded-xl bg-terracotta text-white text-xs font-bold uppercase tracking-wider hover:bg-terracotta-hover transition shadow">
                <span>+ Tulis Cerita Baru</span>
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
            <form action="{{ route('admin.cerita.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                <div class="relative flex-grow w-full">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul artikel atau isi cerita..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-terracotta">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="w-full sm:w-44">
                    <select name="status" class="w-full py-2 px-3 rounded-xl border border-slate-300 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-terracotta">
                        <option value="">Semua Status</option>
                        <option value="terbit" {{ $status === 'terbit' ? 'selected' : '' }}>Terbit</option>
                        <option value="draf" {{ $status === 'draf' ? 'selected' : '' }}>Draf</option>
                        <option value="terjadwal" {{ $status === 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                    </select>
                </div>
                <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition">
                    Filter
                </button>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-mono tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-3.5 px-4">Judul & Kategori</th>
                            <th class="py-3.5 px-4">Tanggal Publikasi</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($articles as $art)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-9 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                                            <img src="{{ $art->cover_url }}" alt="{{ $art->judul }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="block font-bold text-slate-900 text-sm leading-snug">{{ $art->judul }}</span>
                                            <span class="inline-block px-1.5 py-0.5 rounded bg-slate-100 text-[10px] text-slate-600 font-mono">{{ $art->kategori }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 font-mono text-slate-500">
                                    {{ $art->formatted_date }}
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($art->status === 'terbit')
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700">Terbit</span>
                                    @elseif($art->status === 'terjadwal')
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-blue-50 text-blue-700">Terjadwal</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-slate-600">Draf</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    @if($art->status === 'terbit')
                                        <a href="{{ route('cerita.show', $art->slug) }}" target="_blank" class="text-slate-500 hover:text-forest-900 font-medium">
                                            Pratinjau
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.cerita.edit', $art->id) }}" class="text-forest-900 hover:text-terracotta font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.cerita.destroy', $art->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?');">
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
                                <td colspan="4" class="py-10 text-center text-slate-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <span>Belum ada artikel cerita atau kegiatan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($articles->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
