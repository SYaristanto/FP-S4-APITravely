<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\InformasiTravel;

class InformasiTravelCT extends Controller
{
    public function store( Request $request){
        $validator = Validator::make($request->all(), [
            'armada' => 'required|string|max:255',
            'keberangkatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jumlah_kursi' => 'required|string',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages()->toArray(), 400);
        }

        $informasiTravel = InformasiTravel::create( $request->all());
        
        return response()->json([
            'message' => 'Informasi Travel Berhasil Disimpan',
            'data' => $informasiTravel
        ], 201);
    }
    public function show () {
        $informasiTravel = InformasiTravel::all();

        return response()->json([
            'message' => 'Data Informasi Travel',
            'data' => $informasiTravel
        ], 200);
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make( $request->all(), [
            'armada' => 'sometimes|string|max:255',
            'keberangkatan' => 'sometimes|string|max:255',
            'tujuan' => 'sometimes|string|max:255',
            'jumlah_kursi' => 'sometimes|integer',
            'tanggal_keberangkatan' => 'sometimes|date',
            'jam_keberangkatan' => 'sometimes|date_format:H:i',
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->messages(), 442);
        }

        // Ambil data yang tervalidasi
        $validated = $validator->validated();

        // Cari data informasi travel berdasarkan ID
        $informasiTravel = InformasiTravel::find($id);

        // Cek jika data ditemukan
        if ($informasiTravel) {
            // Update data informasi travel
            InformasiTravel::where('id', $id)->update($validated);
            
            // Ambil data yang diupdate
            $updatedInformasiTravel = InformasiTravel::find($id);

            return response()->json([
                'message' => "Data dengan id: {$id} berhasil diupdate",
                'data' => $updatedInformasiTravel
                , 200]);
        }

        // Jika data tidak ditemukan
        return response()->json("Data dengan id: {$id} tidak ditemukan", 404);
    }
    public function delete($id) {
        $informasiTravel = InformasiTravel::where('id', $id)->get();

        if($informasiTravel) {
           InformasiTravel::where('id', $id)->delete();

           return response()->json("Data dengan id: {$id} berhasil dihapus", 200);
        }
    }
        
}

