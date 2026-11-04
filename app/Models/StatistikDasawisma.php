<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikDasawisma extends Model
{
    use HasFactory;

    protected $table = 'statistik_dasawisma';

    protected $fillable = [
        'judul',
        'nilai',
        'deskripsi',
        'warna',
        'icon',
        'urutan',
    ];
}

