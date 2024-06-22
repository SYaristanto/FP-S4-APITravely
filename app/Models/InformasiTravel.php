<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTravel extends Model
{
    use HasFactory;

    protected $fillable = [
        'armada',
        'keberangkatan',
        'tujuan',
        'jumlah_kursi',
        'tanggal_keberangkatan',
        'jam_keberangkatan',
    ];
}
