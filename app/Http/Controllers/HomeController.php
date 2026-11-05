<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Rw;
use App\Models\Setting;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = Setting::getSettings();
        
        $rws = Rw::where('status', 'terbit')
            ->withCount(['umkms' => function ($query) {
                $query->where('status', 'terbit');
            }])
            ->orderBy('nomor_rw')
            ->take(4)
            ->get();

        $featuredUmkms = Umkm::where('status', 'terbit')
            ->where('is_unggulan', true)
            ->with(['rw', 'products'])
            ->take(6)
            ->get();

        if ($featuredUmkms->isEmpty()) {
            $featuredUmkms = Umkm::where('status', 'terbit')
                ->with(['rw', 'products'])
                ->latest()
                ->take(6)
                ->get();
        }

        $featuredProducts = Product::where('status', 'terbit')
            ->where('is_unggulan', true)
            ->with(['umkm.rw'])
            ->take(8)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::where('status', 'terbit')
                ->with(['umkm.rw'])
                ->latest()
                ->take(8)
                ->get();
        }

        $latestArticles = Article::where('status', 'terbit')
            ->orderByDesc('tanggal_publikasi')
            ->take(3)
            ->get();

        $stats = [
            'total_rw' => Rw::where('status', 'terbit')->count(),
            'total_umkm' => Umkm::where('status', 'terbit')->count(),
            'total_produk' => Product::where('status', 'terbit')->count(),
            'total_cerita' => Article::where('status', 'terbit')->count(),
        ];

        return view('home', compact(
            'settings',
            'rws',
            'featuredUmkms',
            'featuredProducts',
            'latestArticles',
            'stats'
        ));
    }
}
