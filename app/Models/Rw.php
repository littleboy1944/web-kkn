<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Rw extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_rw',
        'nama',
        'slug',
        'deskripsi',
        'potensi_kegiatan',
        'foto_sampul',
        'foto_galeri',
        'nama_ketua_rw',
        'kontak_ketua_rw',
        'is_leader_public',
        'status',
    ];

    protected $casts = [
        'foto_galeri' => 'array',
        'is_leader_public' => 'boolean',
    ];

    public function umkms(): HasMany
    {
        return $this->hasMany(Umkm::class);
    }

    public function publishedUmkms(): HasMany
    {
        return $this->hasMany(Umkm::class)->where('status', 'terbit');
    }

    public function getActiveUmkmCountAttribute(): int
    {
        return $this->publishedUmkms()->count();
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->foto_sampul) {
            if (Str::startsWith($this->foto_sampul, ['http://', 'https://'])) {
                return $this->foto_sampul;
            }
            return asset($this->foto_sampul);
        }
        return 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80';
    }
}
