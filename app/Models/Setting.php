<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_website',
        'tagline',
        'deskripsi_singkat',
        'logo',
        'hero_image',
        'kontak_email',
        'kontak_telepon',
        'alamat_sekretariat',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'warna_aksen',
    ];

    public static function getSettings(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'nama_website' => 'Direktori RW & UMKM',
                'tagline' => 'Mengenal Rukun Warga & Merayakan Ragam Usaha Lokal',
                'deskripsi_singkat' => 'Platform publikasi profil rukun warga dan direktori terkurasi usaha mikro, kecil, dan menengah untuk mendukung ekonomi warga.',
                'kontak_email' => 'sekretariat.rw@wilayah.id',
                'kontak_telepon' => '6281234567890',
                'alamat_sekretariat' => 'Balai Warga RW, Jl. Komunitas Raya No. 01',
                'instagram_url' => 'https://instagram.com',
                'facebook_url' => 'https://facebook.com',
                'warna_aksen' => '#14382c',
            ]
        );
    }

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            if (Str::startsWith($this->logo, ['http://', 'https://'])) {
                return $this->logo;
            }
            return asset($this->logo);
        }
        return null;
    }

    public function getHeroImageUrlAttribute(): string
    {
        if ($this->hero_image) {
            if (Str::startsWith($this->hero_image, ['http://', 'https://'])) {
                return $this->hero_image;
            }
            return asset($this->hero_image);
        }
        return 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=1600&q=80';
    }
}
