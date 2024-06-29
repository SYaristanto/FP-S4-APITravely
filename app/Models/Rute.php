<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rute';
    protected $fillable = ['keberangkatan', 'tujuan', 'harga_per_orang'];

    public function informasitravel()
    {
        return $this->hasMany(InformasiTravel::class);
    }
}
