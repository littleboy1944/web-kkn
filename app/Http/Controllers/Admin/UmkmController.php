<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rw;
use App\Models\Umkm;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UmkmController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = $request->query('q');
        $rwId = $request->query('rw_id');
        $status = $request->query('status');

        $query = Umkm::with('rw')->withCount('products')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($rwId && $rwId !== 'semua') {
            $query->where('rw_id', $rwId);
        }

        if ($status && in_array($status, ['terbit', 'draf'])) {
            $query->where('status', $status);
        }

        $umkms = $query->paginate(10)->withQueryString();
        $rws = Rw::orderBy('nomor_rw')->get();

        return view('admin.umkm.index', compact('umkms', 'rws', 'search', 'rwId', 'status'));
    }

    public function create(): View
    {
        $rws = Rw::orderBy('nomor_rw')->get();
        return view('admin.umkm.create', compact('rws'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:umkms,slug'],
            'rw_id' => ['required', 'exists:rws,id'],
            'kategori' => ['required', 'string', 'max:100'],
            'nama_pemilik' => ['nullable', 'string', 'max:100'],
            'is_owner_public' => ['nullable', 'boolean'],
            'deskripsi' => ['nullable', 'string'],
            'foto_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'foto_galeri' => ['nullable', 'array', 'max:10'],
            'foto_galeri.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'nomor_whatsapp' => ['nullable', 'string', 'max:30'],
            'pesan_whatsapp_template' => ['nullable', 'string'],
            'jam_operasional' => ['nullable', 'string', 'max:100'],
            'tautan_sosmed' => ['nullable', 'string', 'max:255'],
            'alamat_spesifik' => ['nullable', 'string', 'max:255'],
            'is_unggulan' => ['nullable', 'boolean'],
            'status' => ['required', 'in:terbit,draf'],
        ], [
            'nama_usaha.required' => 'Nama usaha UMKM wajib diisi.',
            'rw_id.required' => 'Rukun Warga (RW) wajib dipilih.',
            'rw_id.exists' => 'RW yang dipilih tidak ditemukan.',
            'kategori.required' => 'Kategori usaha wajib dipilih atau diisi.',
            'foto_sampul.image' => 'File sampul harus berupa gambar.',
            'foto_sampul.max' => 'Ukuran foto maksimal 3MB.',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['nama_usaha']);
            $slug = $baseSlug;
            $count = 1;
            while (Umkm::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_owner_public'] = $request->boolean('is_owner_public');
        $validated['is_unggulan'] = $request->boolean('is_unggulan');

        if ($request->hasFile('foto_sampul')) {
            $validated['foto_sampul'] = $this->uploadImage($request->file('foto_sampul'), 'umkm');
        }

        if ($request->hasFile('foto_galeri')) {
            $galleryPaths = [];
            foreach ($request->file('foto_galeri') as $file) {
                $galleryPaths[] = $this->uploadImage($file, 'umkm_gallery');
            }
            $validated['foto_galeri'] = $galleryPaths;
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Profil UMKM berhasil ditambahkan.');
    }

    public function edit(Umkm $umkm): View
    {
        $rws = Rw::orderBy('nomor_rw')->get();
        return view('admin.umkm.edit', compact('umkm', 'rws'));
    }

    public function update(Request $request, Umkm $umkm): RedirectResponse
    {
        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:umkms,slug,' . $umkm->id],
            'rw_id' => ['required', 'exists:rws,id'],
            'kategori' => ['required', 'string', 'max:100'],
            'nama_pemilik' => ['nullable', 'string', 'max:100'],
            'is_owner_public' => ['nullable', 'boolean'],
            'deskripsi' => ['nullable', 'string'],
            'foto_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'foto_galeri' => ['nullable', 'array', 'max:10'],
            'foto_galeri.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'nomor_whatsapp' => ['nullable', 'string', 'max:30'],
            'pesan_whatsapp_template' => ['nullable', 'string'],
            'jam_operasional' => ['nullable', 'string', 'max:100'],
            'tautan_sosmed' => ['nullable', 'string', 'max:255'],
            'alamat_spesifik' => ['nullable', 'string', 'max:255'],
            'is_unggulan' => ['nullable', 'boolean'],
            'status' => ['required', 'in:terbit,draf'],
        ], [
            'nama_usaha.required' => 'Nama usaha UMKM wajib diisi.',
            'rw_id.required' => 'Rukun Warga (RW) wajib dipilih.',
            'kategori.required' => 'Kategori usaha wajib diisi.',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama_usaha']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_owner_public'] = $request->boolean('is_owner_public');
        $validated['is_unggulan'] = $request->boolean('is_unggulan');

        if ($request->hasFile('foto_sampul')) {
            $this->deleteUploadedImage($umkm->foto_sampul);
            $validated['foto_sampul'] = $this->uploadImage($request->file('foto_sampul'), 'umkm');
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', "Profil UMKM {$umkm->nama_usaha} berhasil diperbarui.");
    }

    public function destroy(Umkm $umkm): RedirectResponse
    {
        $nama = $umkm->nama_usaha;
        $this->deleteUploadedImage($umkm->foto_sampul);
        $umkm->delete();

        return redirect()->route('admin.umkm.index')
            ->with('success', "Profil UMKM {$nama} berhasil dihapus.");
    }
}
