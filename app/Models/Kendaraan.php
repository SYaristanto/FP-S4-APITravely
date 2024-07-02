<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    
    protected $table = 'kendaraan';
    protected $fillable = [
        'armada', 
        'plat_nomor', 
        'jumlah_kursi'
    ];
    
    public function informasitravel()
    {
        return $this->hasMany(InformasiTravel::class);
    }
}
