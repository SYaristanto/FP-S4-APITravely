<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kendaraan;

class KendaraanCT extends Controller
{
    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
           'armada' => 'required|max:50',
           'plat_nomor' => 'required|max:50',
           'jumlah_kursi' => 'required|max:50'
        ]);
        
        if ( $validator->fails() ) {
            return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();

        Kendaraan::create( $validated );

        return response()->json("Data berhasil disimpan", 200);
    }
    public function show () {
        $kendaraan = Kendaraan::all();

        return response()->json([
            'message' => 'Data Kendaraan',
            'data' => $kendaraan
        ], 200);
    }
    
    public function update( Request $request, $id){
        $validator = Validator::make( $request->all(), [
            'armada' => 'sometimes|max:50',
            'plat_nomor' => 'sometimes|max:50',
            'jumlah_kursi' => 'sometimes|max:50'
         ]);
         
         if ( $validator->fails() ) {
             return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();
        $kendaraan = Kendaraan::find( $id );

        if ( $kendaraan ) {
            Kendaraan::where( 'id', $id )->update($validated);

            return response()->json("Data dengan id: {$id} berhasil di update", 200);
        }
    }
    public function delete($id) {
        $kendaraan = Kendaraan::where('id', $id)->get();

        if($kendaraan) {
           Kendaraan::where('id', $id)->delete();

           return response()->json("Data dengan id: {$id} berhasil dihapus", 200);
        }
    }

}
