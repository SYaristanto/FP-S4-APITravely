<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = [
        'kode_pesanan', 
        'tanggal_pemesanan', 
        'keberangkatan',
        'tujuan',
        'nama_penumpang',
        'no_kursi',
        'total_harga',
    ] ;
}
