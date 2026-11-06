<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'judul',
        'kategori',
        'tanggal',
        'waktu',
        'lokasi',
        'penyelenggara',
        'deskripsi',
        'isi',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getTanggalFormattedAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->locale('id')->isoFormat('D MMMM Y') : '-';
    }

    public function getHariAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->locale('id')->isoFormat('dddd') : '-';
    }

    public function getBulanSingkatAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->locale('id')->isoFormat('MMM') : '-';
    }

    public function getHariTanggalAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->format('d') : '-';
    }
}

