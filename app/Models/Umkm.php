<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'rw_id',
        'nama_usaha',
        'slug',
        'kategori',
        'nama_pemilik',
        'is_owner_public',
        'deskripsi',
        'foto_sampul',
        'foto_galeri',
        'nomor_whatsapp',
        'pesan_whatsapp_template',
        'jam_operasional',
        'tautan_sosmed',
        'alamat_spesifik',
        'is_unggulan',
        'status',
    ];

    protected $casts = [
        'foto_galeri' => 'array',
        'is_owner_public' => 'boolean',
        'is_unggulan' => 'boolean',
    ];

    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function publishedProducts(): HasMany
    {
        return $this->hasMany(Product::class)->where('status', 'terbit');
    }

    /**
     * Clean and normalize WhatsApp number (digits only, e.g. 6281234567890).
     */
    public static function normalizePhone(?string $phone): ?string
    {
        if (! $phone) {
            return null;
        }

        // Strip non-digit characters
        $digits = preg_replace('/[^\d]/', '', $phone);

        if (empty($digits)) {
            return null;
        }

        // If starts with 08..., convert to 628...
        if (Str::startsWith($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits;
    }

    /**
     * Mutator to ensure whatsapp number is always saved in international format without plus or dashes
     */
    public function setNomorWhatsappAttribute($value): void
    {
        $this->attributes['nomor_whatsapp'] = self::normalizePhone($value);
    }

    /**
     * Generate WhatsApp Direct Link
     */
    public function getWhatsappUrl(?string $productName = null): ?string
    {
        if (empty($this->nomor_whatsapp)) {
            return null;
        }

        $cleanPhone = $this->nomor_whatsapp;

        if ($productName) {
            $msg = "Halo, saya melihat profil {$this->nama_usaha} di website. Saya ingin bertanya tentang produk \"{$productName}\".";
        } elseif (! empty($this->pesan_whatsapp_template)) {
            $msg = str_replace(
                ['[NAMA_UMKM]', '[NAMA_PRODUK]'],
                [$this->nama_usaha, 'produk Anda'],
                $this->pesan_whatsapp_template
            );
        } else {
            $msg = "Halo, saya melihat profil {$this->nama_usaha} di website. Saya ingin bertanya tentang produk dan layanan Anda.";
        }

        return 'https://wa.me/' . $cleanPhone . '?text=' . rawurlencode($msg);
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->foto_sampul) {
            if (Str::startsWith($this->foto_sampul, ['http://', 'https://'])) {
                return $this->foto_sampul;
            }
            return asset($this->foto_sampul);
        }
        return 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1000&q=80';
    }
}
