<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = $request->query('q');
        $status = $request->query('status');

        $query = Article::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%");
            });
        }

        if ($status && in_array($status, ['terbit', 'draf', 'terjadwal'])) {
            $query->where('status', $status);
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('admin.cerita.index', compact('articles', 'search', 'status'));
    }

    public function create(): View
    {
        return view('admin.cerita.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:articles,slug'],
            'kategori' => ['required', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string'],
            'konten' => ['required', 'string'],
            'foto_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'tanggal_publikasi' => ['nullable', 'date'],
            'status' => ['required', 'in:terbit,draf,terjadwal'],
        ], [
            'judul.required' => 'Judul cerita/kegiatan wajib diisi.',
            'kategori.required' => 'Kategori artikel wajib diisi.',
            'konten.required' => 'Isi artikel lengkap wajib diisi.',
            'foto_sampul.image' => 'File sampul harus berupa gambar.',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['judul']);
            $slug = $baseSlug;
            $count = 1;
            while (Article::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if (empty($validated['tanggal_publikasi'])) {
            $validated['tanggal_publikasi'] = now()->toDateString();
        }

        if ($request->hasFile('foto_sampul')) {
            $validated['foto_sampul'] = $this->uploadImage($request->file('foto_sampul'), 'articles');
        }

        Article::create($validated);

        return redirect()->route('admin.cerita.index')
            ->with('success', 'Cerita & kegiatan berhasil dipublikasikan.');
    }

    public function edit(Article $ceritum): View
    {
        $article = $ceritum;
        return view('admin.cerita.edit', compact('article'));
    }

    public function update(Request $request, Article $ceritum): RedirectResponse
    {
        $article = $ceritum;
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200', 'unique:articles,slug,' . $article->id],
            'kategori' => ['required', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string'],
            'konten' => ['required', 'string'],
            'foto_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'tanggal_publikasi' => ['nullable', 'date'],
            'status' => ['required', 'in:terbit,draf,terjadwal'],
        ], [
            'judul.required' => 'Judul cerita/kegiatan wajib diisi.',
            'konten.required' => 'Isi artikel lengkap wajib diisi.',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['judul']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if ($request->hasFile('foto_sampul')) {
            $this->deleteUploadedImage($article->foto_sampul);
            $validated['foto_sampul'] = $this->uploadImage($request->file('foto_sampul'), 'articles');
        }

        $article->update($validated);

        return redirect()->route('admin.cerita.index')
            ->with('success', "Artikel \"{$article->judul}\" berhasil diperbarui.");
    }

    public function destroy(Article $ceritum): RedirectResponse
    {
        $article = $ceritum;
        $judul = $article->judul;
        $this->deleteUploadedImage($article->foto_sampul);
        $article->delete();

        return redirect()->route('admin.cerita.index')
            ->with('success', "Artikel \"{$judul}\" berhasil dihapus.");
    }
}
