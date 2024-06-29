<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTravel extends Model
{
    use HasFactory;
    protected $table = 'informasi_travel';
    protected $fillable = [
        'keberangkatan',
        'tujuan',
        'tanggal_keberangkatan',
        'jam_keberangkatan',
        'kursi_tersedia',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function rute()
    {
        return $this->belongsTo(Rute::class);
    }
}
