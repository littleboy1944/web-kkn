<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'konten',
        'foto_sampul',
        'tanggal_publikasi',
        'status',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'date',
    ];

    public function getFormattedDateAttribute(): string
    {
        if (! $this->tanggal_publikasi) {
            return $this->created_at->translatedFormat('d F Y');
        }
        return Carbon::parse($this->tanggal_publikasi)->translatedFormat('d F Y');
    }

    public function getEstimatedReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->konten ?? $this->ringkasan ?? ''));
        return max(1, (int) ceil($words / 200));
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->foto_sampul) {
            if (Str::startsWith($this->foto_sampul, ['http://', 'https://'])) {
                return $this->foto_sampul;
            }
            return asset($this->foto_sampul);
        }
        return 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80';
    }
}
