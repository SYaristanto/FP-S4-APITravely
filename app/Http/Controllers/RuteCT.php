<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;
use App\Models\InformasiTravel;
use Illuminate\Support\Facades\Validator;

class RuteCT extends Controller
{
    public function index ( Request $request) {
        $travels = InformasiTravel::all();
        $rutes = Rute::all();
        return view('data-travely.rute', compact('travels', 'rutes'));
    }

    public function addRute(Request $request)
    {
        $request->validate([
            // 'armada' => 'required|string',
            'keberangkatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'harga_per_orang' => 'required|string|max:255',
        ]);
    
        try {
            // InformasiTravel::create([
            //     'kendaraan_id' => $request->kendaraan_id,
            //     'keberangkatan' => $request->keberangkatan,
            //     'tujuan' => $request->tujuan,
            //     'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            //     'jam_keberangkatan' => $request->jam_keberangkatan,
            //     'kursi_tersedia' => $request->kursi_tersedia,
            // ]);
            Rute::create($request->all());
            return redirect()->back()->with('success', 'Data travel berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Gagal menambahkan data, silahkan periksa kembali!');
        }
    }

    public function updateRute(Request $request, $id) {

        $rutes = Rute::find($id);

        if($rutes) {
            $rutes->armada = $request->input('keberangkatan');
            $rutes->plat_nomor = $request->input('tujuan');
            $rutes->jumlah_kursi = $request->input('harga_per_orang');

            $rutes->save();

            return redirect()->route('rts.index', ['id' => $rutes->id])->with('success', 'Data rute berhasil diperbarui.');
        } else {
            return redirect()->route('rts.index')->with('warning', 'Gagal memperbarui Rute, silahkan periksa kembali!');
        }
    }

    public function deleteRute($id)
    {
        $rutes = Rute::find($id);
    
        if (!$rutes) {
            return redirect()->route('rts.index')->with('warning', 'Data travel tidak ditemukan.');
        }
    
        // Hapus data mobil dari database
        $rutes->delete();
    
        return redirect()->route('rts.index')->with('success', 'Data Travel berhasil dihapus.');
    }

    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
           'keberangkatan' => 'required|max:50',
           'tujuan' => 'required|max:50',
           'harga_per_orang' => 'required|max:50',
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
