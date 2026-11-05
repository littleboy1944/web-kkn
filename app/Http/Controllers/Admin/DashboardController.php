<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\Rw;
use App\Models\Setting;
use App\Models\Umkm;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $settings = Setting::getSettings();

        $stats = [
            'total_rw' => Rw::count(),
            'published_rw' => Rw::where('status', 'terbit')->count(),
            'total_umkm' => Umkm::count(),
            'published_umkm' => Umkm::where('status', 'terbit')->count(),
            'total_product' => Product::count(),
            'published_product' => Product::where('status', 'terbit')->count(),
            'total_article' => Article::count(),
            'published_article' => Article::where('status', 'terbit')->count(),
        ];

        $recentUmkms = Umkm::with('rw')->latest()->take(5)->get();
        $recentProducts = Product::with('umkm')->latest()->take(5)->get();
        $recentArticles = Article::latest()->take(5)->get();
        $recentRws = Rw::withCount('umkms')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'settings',
            'stats',
            'recentUmkms',
            'recentProducts',
            'recentArticles',
            'recentRws'
        ));
    }
}
