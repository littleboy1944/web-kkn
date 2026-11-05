<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Setting;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UmkmPublicController extends Controller
{
    public function index(Request $request): View
    {
        $settings = Setting::getSettings();
        $search = $request->query('q');
        $kategori = $request->query('kategori');
        $rwSlug = $request->query('rw');

        $query = Umkm::where('status', 'terbit')
            ->with(['rw', 'products' => function ($q) {
                $q->where('status', 'terbit');
            }])
            ->latest();

        // Search by business name OR product name OR description
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('products', function ($pq) use ($search) {
                      $pq->where('nama_produk', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by category
        if ($kategori && $kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        // Filter by RW
        if ($rwSlug && $rwSlug !== 'semua') {
            $query->whereHas('rw', function ($q) use ($rwSlug) {
                $q->where('slug', $rwSlug)->orWhere('nomor_rw', $rwSlug);
            });
        }

        $umkms = $query->paginate(12)->withQueryString();

        // Data for filter chips
        $rws = Rw::where('status', 'terbit')->orderBy('nomor_rw')->get();
        $categories = Umkm::where('status', 'terbit')
            ->pluck('kategori')
            ->unique()
            ->values();

        return view('umkm.index', compact(
            'umkms',
            'rws',
            'categories',
            'settings',
            'search',
            'kategori',
            'rwSlug'
        ));
    }

    public function show(string $slug): View
    {
        $settings = Setting::getSettings();

        $umkm = Umkm::where('slug', $slug)
            ->where('status', 'terbit')
            ->with(['rw', 'products' => function ($q) {
                $q->where('status', 'terbit');
            }])
            ->firstOrFail();

        // Other UMKM in the same RW
        $relatedUmkms = Umkm::where('status', 'terbit')
            ->where('rw_id', $umkm->rw_id)
            ->where('id', '!=', $umkm->id)
            ->take(3)
            ->get();

        return view('umkm.show', compact('umkm', 'relatedUmkms', 'settings'));
    }
}
