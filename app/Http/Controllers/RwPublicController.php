<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RwPublicController extends Controller
{
    public function index(Request $request): View
    {
        $settings = Setting::getSettings();
        $search = $request->query('q');

        $query = Rw::where('status', 'terbit')
            ->withCount(['umkms' => function ($q) {
                $q->where('status', 'terbit');
            }])
            ->orderBy('nomor_rw');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nomor_rw', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('potensi_kegiatan', 'like', "%{$search}%");
            });
        }

        $rws = $query->paginate(9)->withQueryString();

        return view('rw.index', compact('rws', 'settings', 'search'));
    }

    public function show(string $slug): View
    {
        $settings = Setting::getSettings();

        $rw = Rw::where('slug', $slug)
            ->where('status', 'terbit')
            ->firstOrFail();

        $umkms = $rw->umkms()
            ->where('status', 'terbit')
            ->with(['products' => function ($q) {
                $q->where('status', 'terbit');
            }])
            ->latest()
            ->paginate(12);

        $activeUmkmCount = $rw->publishedUmkms()->count();

        // Get unique categories within this RW for quick filter
        $categories = $rw->publishedUmkms()
            ->pluck('kategori')
            ->unique()
            ->values();

        // Get recent community stories / activities if available
        $latestArticles = \App\Models\Article::where('status', 'terbit')
            ->orderByDesc('tanggal_publikasi')
            ->take(3)
            ->get();

        return view('rw.show', compact('rw', 'umkms', 'activeUmkmCount', 'categories', 'settings', 'latestArticles'));
    }
}
