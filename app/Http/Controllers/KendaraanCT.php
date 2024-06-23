<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kendaraan;

class KendaraanCT extends Controller
{
    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
           'jenis_kendaraan' => 'required|max:50',
           'plat_nomor' => 'required|string',
           'jumlah_kursi' => 'required|string',
        ]);
        
        if ( $validator->fails() ) {
            return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();

        Kendaraan::create( $validated );

        return response()->json("Data berhasil disimpan", 200);
    }
}
