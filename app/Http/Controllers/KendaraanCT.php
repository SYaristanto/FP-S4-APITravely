<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kendaraan;

class KendaraanCT extends Controller
{

    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('data-travely.kendaraan', compact('kendaraan'));
    }

    public function addKendaraan(Request $request){
        $request->validate([
            'armada' => 'required|string',
            'plat_nomor' => 'required|string',
            'kapasitas' => 'required|string',
        ]);

        try {
            Kendaraan::create($request->all());
            return redirect()->back()->with('success', 'Data Kendaraan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Gagal menambahkan data, silahkan periksa kembali!');
        }
    }
    
    public function searchTiket(Request $request)
    {
        $request->validate([
            'keberangkatan' => 'required|string',
            'tujuan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $keberangkatan = $request->input('keberangkatan');
        $tujuan = $request->input('tujuan');
        $tanggal = $request->input('tanggal');

        // Misalnya, Anda bisa melakukan pencarian rute berdasarkan keberangkatan, tujuan, dan tanggal
        $rute = Kendaraan::where('keberangkatan', $keberangkatan)
            ->where('tujuan', $tujuan)
            ->where('tanggal_keberangkatan', $tanggal)
            ->get();

        return response()->json(['message' => 'Data Informasi Travel', 'data' => $rute]);
    }

    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
<<<<<<< HEAD
           'armada' => 'required|max:50',
           'plat_nomor' => 'required|max:50',
           'jumlah_kursi' => 'required|max:50'
=======
            'armada' => 'required|string',
            'plat_nomor' => 'required|string',
            'kapasitas' => 'required|string',
>>>>>>> 3abdc52060f516629b09aaa45d580524b6197167
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
