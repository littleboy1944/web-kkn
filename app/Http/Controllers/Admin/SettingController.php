<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        $settings = Setting::getSettings();
        return view('admin.pengaturan.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = Setting::getSettings();

        $validated = $request->validate([
            'nama_website' => ['required', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'hero_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'kontak_email' => ['nullable', 'email', 'max:100'],
            'kontak_telepon' => ['nullable', 'string', 'max:50'],
            'alamat_sekretariat' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'warna_aksen' => ['nullable', 'string', 'max:20'],
        ]);

        if ($request->hasFile('logo')) {
            $this->deleteUploadedImage($settings->logo);
            $validated['logo'] = $this->uploadImage($request->file('logo'), 'settings');
        }

        if ($request->hasFile('hero_image')) {
            $this->deleteUploadedImage($settings->hero_image);
            $validated['hero_image'] = $this->uploadImage($request->file('hero_image'), 'settings');
        }

        $settings->update($validated);

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
