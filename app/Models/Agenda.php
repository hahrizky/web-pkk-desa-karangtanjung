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

    public function getWaktuMulaiAttribute(): string
    {
        if (! $this->waktu) {
            return '00:00';
        }
        if (preg_match('/(\d{1,2})[:.](\d{2})/', $this->waktu, $matches)) {
            return sprintf('%02d:%02d', (int) $matches[1], (int) $matches[2]);
        }
        return '00:00';
    }

    public static function getSortedAgendas()
    {
        $today = now()->startOfDay()->toDateString();

        return static::all()->sort(function ($a, $b) use ($today) {
            $tA = $a->tanggal ? $a->tanggal->toDateString() : '';
            $tB = $b->tanggal ? $b->tanggal->toDateString() : '';

            $isUpcomingA = ($tA !== '' && $tA >= $today) ? 0 : 1;
            $isUpcomingB = ($tB !== '' && $tB >= $today) ? 0 : 1;

            if ($isUpcomingA !== $isUpcomingB) {
                return $isUpcomingA <=> $isUpcomingB;
            }

            $wA = $a->waktu_mulai;
            $wB = $b->waktu_mulai;

            if ($isUpcomingA === 0) {
                // Agenda mendatang / hari ini: urutkan tanggal ASC (terdekat), lalu jam mulai ASC
                if ($tA !== $tB) {
                    return $tA <=> $tB;
                }
                return $wA <=> $wB;
            } else {
                // Agenda lewat: urutkan tanggal DESC (paling baru lewat), lalu jam mulai DESC
                if ($tA !== $tB) {
                    return $tB <=> $tA;
                }
                return $wB <=> $wA;
            }
        })->values();
    }
}
