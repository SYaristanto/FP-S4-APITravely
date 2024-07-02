<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pesanan;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PesananCT extends Controller
{
    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
            'keberangkatan' => 'required|string',
            'tujuan' => 'required|string',
            'nama_penumpang' => 'required|string',
            'no_kursi' => 'required|string',
            'total_harga' => 'required|string',
        ]);
        
        if ( $validator->fails() ) {
            return response()->json( $validator->messages() )->setStatusCode(442);
        }

        // Ambil data yang sudah divalidasi
        $validated = $validator->validated();

        // Generate kode_pesanan secara acak
        $validated['kode_pesanan'] = $this->generateRandomString();

        // Isi tanggal_pemesanan dengan tanggal saat ini
        $validated['tanggal_pemesanan'] = Carbon::now()->format('Y-m-d');

        // Buat pesanan baru
        Pesanan::create( $validated );

        return response()->json("Data berhasil disimpan", 200);
    }
    
        // Fungsi untuk menghasilkan string acak
        private function generateRandomString($length = 6)
    {
        return Str::random($length);
    }

    public function show () {
        $pesanan = Pesanan::all();

        return response()->json([
            'message' => 'Data Pesanan',
            'data' => $pesanan
        ], 200);
    }
}
