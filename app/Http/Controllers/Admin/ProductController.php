<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Umkm;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = $request->query('q');
        $umkmId = $request->query('umkm_id');
        $status = $request->query('status');

        $query = Product::with('umkm.rw')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($umkmId && $umkmId !== 'semua') {
            $query->where('umkm_id', $umkmId);
        }

        if ($status && in_array($status, ['terbit', 'draf'])) {
            $query->where('status', $status);
        }

        $products = $query->paginate(12)->withQueryString();
        $umkms = Umkm::orderBy('nama_usaha')->get();

        return view('admin.produk.index', compact('products', 'umkms', 'search', 'umkmId', 'status'));
    }

    public function create(Request $request): View
    {
        $selectedUmkmId = $request->query('umkm_id');
        $umkms = Umkm::orderBy('nama_usaha')->get();
        return view('admin.produk.create', compact('umkms', 'selectedUmkmId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150'],
            'umkm_id' => ['required', 'exists:umkms,id'],
            'deskripsi' => ['nullable', 'string'],
            'foto_produk' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'harga' => ['nullable', 'numeric', 'min:0'],
            'status_ketersediaan' => ['required', 'in:tersedia,habis,pre_order'],
            'is_unggulan' => ['nullable', 'boolean'],
            'status' => ['required', 'in:terbit,draf'],
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'umkm_id.required' => 'UMKM pemilik produk wajib dipilih.',
            'umkm_id.exists' => 'UMKM yang dipilih tidak valid.',
            'foto_produk.image' => 'File harus berupa gambar.',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['nama_produk']);
            $slug = $baseSlug;
            $count = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_unggulan'] = $request->boolean('is_unggulan');

        if ($request->hasFile('foto_produk')) {
            $validated['foto_produk'] = $this->uploadImage($request->file('foto_produk'), 'products');
        }

        Product::create($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $produk): View
    {
        $umkms = Umkm::orderBy('nama_usaha')->get();
        return view('admin.produk.edit', compact('produk', 'umkms'));
    }

    public function update(Request $request, Product $produk): RedirectResponse
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150'],
            'umkm_id' => ['required', 'exists:umkms,id'],
            'deskripsi' => ['nullable', 'string'],
            'foto_produk' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'harga' => ['nullable', 'numeric', 'min:0'],
            'status_ketersediaan' => ['required', 'in:tersedia,habis,pre_order'],
            'is_unggulan' => ['nullable', 'boolean'],
            'status' => ['required', 'in:terbit,draf'],
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'umkm_id.required' => 'UMKM pemilik produk wajib dipilih.',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama_produk']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_unggulan'] = $request->boolean('is_unggulan');

        if ($request->hasFile('foto_produk')) {
            $this->deleteUploadedImage($produk->foto_produk);
            $validated['foto_produk'] = $this->uploadImage($request->file('foto_produk'), 'products');
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', "Produk {$produk->nama_produk} berhasil diperbarui.");
    }

    public function destroy(Product $produk): RedirectResponse
    {
        $nama = $produk->nama_produk;
        $this->deleteUploadedImage($produk->foto_produk);
        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', "Produk {$nama} berhasil dihapus.");
    }
}
