<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getIsSelesaiAttribute(): bool
    {
        if (! $this->tanggal) {
            return false;
        }

        $zonaWaktu = 'Asia/Jakarta';
        $tanggalAgenda = $this->tanggal->copy()->setTimezone($zonaWaktu)->startOfDay();
        $sekarang = Carbon::now($zonaWaktu);

        if ($sekarang->lt($tanggalAgenda)) {
            return false;
        }
        if ($sekarang->gt($tanggalAgenda->copy()->endOfDay())) {
            return true;
        }

        // Jika rentang waktu memiliki jam selesai, tandai selesai setelah jam itu.
        // Untuk format "08:00 WIB - Selesai", agenda selesai pada akhir hari H.
        preg_match_all('/(\d{1,2})[:.](\d{2})/', (string) $this->waktu, $matches);
        if (count($matches[0]) < 2) {
            return false;
        }

        $jam = (int) $matches[1][1];
        $menit = (int) $matches[2][1];
        $waktuSelesai = $tanggalAgenda->copy()->setTime($jam, $menit);

        return $sekarang->greaterThanOrEqualTo($waktuSelesai);
    }

    public static function getSortedAgendas()
    {
        $today = Carbon::now('Asia/Jakarta')->startOfDay()->toDateString();

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
