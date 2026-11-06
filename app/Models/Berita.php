<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'tanggal',
        'ringkasan',
        'konten',
        'gambar',
        'penulis',
        'tags',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tags' => 'array',
    ];

    // Auto-generate slug jika belum ada
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    // Accessor tanggal terformat Bahasa Indonesia (cth: 08 Mei 2026)
    public function getTanggalFormattedAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->locale('id')->isoFormat('D MMMM Y') : '-';
    }

    // Accessor URL gambar
    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar && file_exists(public_path('images/' . $this->gambar))) {
            return asset('images/' . $this->gambar);
        }
        if ($this->gambar && file_exists(storage_path('app/public/' . $this->gambar))) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/1.webp');
    }
}

