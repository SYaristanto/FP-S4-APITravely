<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTravel extends Model
{
    use HasFactory;
    protected $table = 'informasi_travel';
    protected $fillable = [
        'kendaraan_id',
        'rute_id',
        'kursi_tersedia',
        'tanggal_keberangkatan',
        'jam_keberangkatan',
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
