<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rw;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RwController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = $request->query('q');
        $status = $request->query('status');

        $query = Rw::withCount('umkms')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nomor_rw', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        if ($status && in_array($status, ['terbit', 'draf'])) {
            $query->where('status', $status);
        }

        $rws = $query->paginate(10)->withQueryString();

        return view('admin.rw.index', compact('rws', 'search', 'status'));
    }

    public function create(): View
    {
        return view('admin.rw.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_rw' => ['required', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:rws,slug'],
            'deskripsi' => ['nullable', 'string'],
            'potensi_kegiatan' => ['nullable', 'string'],
            'foto_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'foto_galeri' => ['nullable', 'array', 'max:10'],
            'foto_galeri.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'nama_ketua_rw' => ['nullable', 'string', 'max:100'],
            'kontak_ketua_rw' => ['nullable', 'string', 'max:50'],
            'is_leader_public' => ['nullable', 'boolean'],
            'status' => ['required', 'in:terbit,draf'],
        ], [
            'nomor_rw.required' => 'Nomor RW wajib diisi (misal: RW 01).',
            'nama.required' => 'Nama RW wajib diisi.',
            'slug.unique' => 'Slug URL sudah digunakan oleh RW lain.',
            'foto_sampul.image' => 'File sampul harus berupa gambar valid.',
            'foto_sampul.max' => 'Ukuran foto maksimal 3MB.',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['nomor_rw'] . '-' . $validated['nama']);
            $slug = $baseSlug;
            $count = 1;
            while (Rw::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_leader_public'] = $request->boolean('is_leader_public');

        if ($request->hasFile('foto_sampul')) {
            $validated['foto_sampul'] = $this->uploadImage($request->file('foto_sampul'), 'rw');
        }

        // Multiple gallery photos if uploaded
        if ($request->hasFile('foto_galeri')) {
            $galleryPaths = [];
            foreach ($request->file('foto_galeri') as $file) {
                $galleryPaths[] = $this->uploadImage($file, 'rw_gallery');
            }
            $validated['foto_galeri'] = $galleryPaths;
        }

        Rw::create($validated);

        return redirect()->route('admin.rw.index')
            ->with('success', 'Profil RW berhasil ditambahkan.');
    }

    public function edit(Rw $rw): View
    {
        return view('admin.rw.edit', compact('rw'));
    }

    public function update(Request $request, Rw $rw): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_rw' => ['required', 'string', 'max:50'],
            'nama' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:rws,slug,' . $rw->id],
            'deskripsi' => ['nullable', 'string'],
            'potensi_kegiatan' => ['nullable', 'string'],
            'foto_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'foto_galeri' => ['nullable', 'array', 'max:10'],
            'foto_galeri.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'nama_ketua_rw' => ['nullable', 'string', 'max:100'],
            'kontak_ketua_rw' => ['nullable', 'string', 'max:50'],
            'is_leader_public' => ['nullable', 'boolean'],
            'status' => ['required', 'in:terbit,draf'],
        ], [
            'nomor_rw.required' => 'Nomor RW wajib diisi.',
            'nama.required' => 'Nama RW wajib diisi.',
            'slug.unique' => 'Slug URL sudah digunakan oleh RW lain.',
            'foto_sampul.image' => 'File sampul harus berupa gambar valid.',
            'foto_sampul.max' => 'Ukuran foto maksimal 3MB.',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nomor_rw'] . '-' . $validated['nama']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $validated['is_leader_public'] = $request->boolean('is_leader_public');

        if ($request->hasFile('foto_sampul')) {
            $this->deleteUploadedImage($rw->foto_sampul);
            $validated['foto_sampul'] = $this->uploadImage($request->file('foto_sampul'), 'rw');
        }

        $rw->update($validated);

        return redirect()->route('admin.rw.index')
            ->with('success', "Profil {$rw->nomor_rw} berhasil diperbarui.");
    }

    public function destroy(Rw $rw): RedirectResponse
    {
        $nomor = $rw->nomor_rw;
        $this->deleteUploadedImage($rw->foto_sampul);
        $rw->delete();

        return redirect()->route('admin.rw.index')
            ->with('success', "Profil {$nomor} berhasil dihapus.");
    }
}
