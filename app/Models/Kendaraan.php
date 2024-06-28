<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
<<<<<<< HEAD
    
    protected $table = 'kendaraan';
    protected $fillable = ['armada', 'plat_nomor', 'jumlah_kursi'] ;
    
    public function informasitravel()
    {
        return $this->hasMany(InformasiTravel::class);
    }
=======

    protected $table = 'kendaraan';
    protected $fillable = [
        'armada',
        'plat_nomor', 
        'kapasitas'
    ];
>>>>>>> 3abdc52060f516629b09aaa45d580524b6197167
}
