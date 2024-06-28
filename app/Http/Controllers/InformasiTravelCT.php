<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\InformasiTravel;

class InformasiTravelCT extends Controller
{
    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
           'armada' => 'required|max:50',
           'keberangkatan' => 'required|max:50',
           'tujuan' => 'required|max:50',
           'tanggal_keberangkatan' => 'required|date',
           'jam_keberangkatan' => 'required|date_format:H:i',
           'kursi_tersedia' => 'required|max:50'
        ]);
        
        if ( $validator->fails() ) {
            return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();

        InformasiTravel::create( $validated );

        return response()->json("Data berhasil disimpan", 200);
    }
    public function show () {
        $informasiTravel = InformasiTravel::all();

        return response()->json([
            'message' => 'Data Informasi Travel',
            'data' => $informasiTravel
        ], 200);
    }
    public function update( Request $request, $id){
        $validator = Validator::make( $request->all(), [
            'armada' => 'sometimes|max:50',
            'keberangkatan' => 'sometimes|max:50',
            'tujuan' => 'sometimes|max:50',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'kursi_tersedia' => 'required|max:50'
         ]);
         
         if ( $validator->fails() ) {
             return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();
        $informasitravel = InformasiTravel::find( $id );

        if ( $informasitravel ) {
            InformasiTravel::where( 'id', $id )->update($validated);

            return response()->json("Data dengan id: {$id} berhasil di update", 200);
        }
    }
    public function delete($id) {
        $informasitravel = InformasiTravel::where('id', $id)->get();

        if($informasitravel) {
           InformasiTravel::where('id', $id)->delete();

           return response()->json("Data dengan id: {$id} berhasil dihapus", 200);
        }
    }
        
}

