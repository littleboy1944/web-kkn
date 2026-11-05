<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticlePublicController extends Controller
{
    public function index(Request $request): View
    {
        $settings = Setting::getSettings();
        $search = $request->query('q');
        $kategori = $request->query('kategori');

        $query = Article::where('status', 'terbit')->orderByDesc('tanggal_publikasi');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if ($kategori && $kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        $featuredArticle = null;
        if (! $search && ! $kategori) {
            $featuredArticle = (clone $query)->first();
            if ($featuredArticle) {
                $query->where('id', '!=', $featuredArticle->id);
            }
        }

        $articles = $query->paginate(9)->withQueryString();

        $categories = Article::where('status', 'terbit')
            ->pluck('kategori')
            ->unique()
            ->values();

        return view('cerita.index', compact(
            'articles',
            'featuredArticle',
            'categories',
            'settings',
            'search',
            'kategori'
        ));
    }

    public function show(string $slug): View
    {
        $settings = Setting::getSettings();

        $article = Article::where('slug', $slug)
            ->where('status', 'terbit')
            ->firstOrFail();

        $relatedArticles = Article::where('status', 'terbit')
            ->where('id', '!=', $article->id)
            ->orderByDesc('tanggal_publikasi')
            ->take(3)
            ->get();

        return view('cerita.show', compact('article', 'relatedArticles', 'settings'));
    }
}
