<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rute;

class RuteCT extends Controller
{
    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
           'keberangkatan' => 'required|max:50',
           'tujuan' => 'required|max:50',
           'jam_keberangkatan' => 'required|date_format:H:i',
           'harga_per_orang' => 'required|max:50',
           'kursi_tersedia' => 'required|max:50'
        ]);
        
        if ( $validator->fails() ) {
            return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();

        Rute::create( $validated );

        return response()->json("Data berhasil disimpan", 200);
    }
    public function show () {
        $rute = Rute::all();

        return response()->json([
            'message' => 'Data Kendaraan',
            'data' => $rute
        ], 200);
    }
    public function update( Request $request, $id){
        $validator = Validator::make( $request->all(), [
            'keberangkatan' => 'sometimes|max:50',
            'tujuan' => 'sometimes|max:50',
            'jam_keberangkatan' => 'sometimes|date_format:H:i',
            'harga_per_orang' => 'sometimes|max:50',
            'kursi_tersedia' => 'sometimes|max:50',
         ]);
         
         if ( $validator->fails() ) {
             return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();
        $rute = Rute::find( $id );

        if ( $rute ) {
            Rute::where( 'id', $id )->update($validated);

            return response()->json("Data dengan id: {$id} berhasil di update", 200);
        }
    }
    public function delete($id) {
        $rute = Rute::where('id', $id)->get();

        if($rute) {
           Rute::where('id', $id)->delete();

           return response()->json("Data dengan id: {$id} berhasil dihapus", 200);
        }
    }
}
