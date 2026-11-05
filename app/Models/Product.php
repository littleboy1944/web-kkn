<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'slug',
        'deskripsi',
        'foto_produk',
        'harga',
        'status_ketersediaan',
        'is_unggulan',
        'status',
    ];

    protected $casts = [
        'is_unggulan' => 'boolean',
        'harga' => 'integer',
    ];

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class);
    }

    public function getFormattedPriceAttribute(): ?string
    {
        if ($this->harga === null) {
            return null;
        }
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getAvailabilityLabelAttribute(): string
    {
        return match ($this->status_ketersediaan) {
            'habis' => 'Habis',
            'pre_order' => 'Pre-Order',
            default => 'Tersedia',
        };
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->foto_produk) {
            if (Str::startsWith($this->foto_produk, ['http://', 'https://'])) {
                return $this->foto_produk;
            }
            return asset($this->foto_produk);
        }
        return 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80';
    }

    public function getWhatsappInquiryUrlAttribute(): ?string
    {
        if (! $this->umkm) {
            return null;
        }
        return $this->umkm->getWhatsappUrl($this->nama_produk);
    }
}
