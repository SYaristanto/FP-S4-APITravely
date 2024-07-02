<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\InformasiTravel;
use Illuminate\Support\Facades\Validator;

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
            'jumlah_kursi' => 'required|string',
        ]);

        try {
            Kendaraan::create($request->all());
            return redirect()->back()->with('success', 'Data Kendaraan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Gagal menambahkan data, silahkan periksa kembali!');
        }
    }

    public function updateKendaraan(Request $request, $id) {

        $kendaraan = Kendaraan::find($id);

        if($kendaraan) {
            $kendaraan->armada = $request->input('armada');
            $kendaraan->plat_nomor = $request->input('plat_nomor');
            $kendaraan->jumlah_kursi = $request->input('jumlah_kursi');

            $kendaraan->save();

            return redirect()->route('kdr.index', ['id' => $kendaraan->id])->with('success', 'Data Kendaraan berhasil diperbarui.');
        } else {
            return redirect()->route('kdr.index')->with('warning', 'Gagal memperbarui Kendaraan, silahkan periksa kembali!');
        }
    }

    public function deleteKendaraan($id)
    {
        $kendaraan = Kendaraan::find($id);
    
        if (!$kendaraan) {
            return redirect()->route('kdr.index')->with('warning', 'Data Kendaraan tidak ditemukan.');
        }
    
        // Hapus data mobil dari database
        $kendaraan->delete();
    
        return redirect()->route('kdr.index')->with('success', 'Data Kendaraan berhasil dihapus.');
    }
    

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
