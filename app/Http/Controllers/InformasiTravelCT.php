<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\InformasiTravel;

class InformasiTravelCT extends Controller
{
<<<<<<< HEAD
    public function store( Request $request) {
        $validator = Validator::make( $request->all(), [
           'armada' => 'required|max:50',
           'keberangkatan' => 'required|max:50',
           'tujuan' => 'required|max:50',
           'tanggal_keberangkatan' => 'required|date',
           'jam_keberangkatan' => 'required|date_format:H:i',
           'kursi_tersedia' => 'required|max:50'
=======
    public function index()
    {
        $travels = InformasiTravel::all();
        return view('data-travely.informasi-travely', compact('travels'));
    }


    public function addTravel(Request $request)
    {
        $request->validate([
            'keberangkatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jumlah_kursi' => 'required|string',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
        ]);
    
        try {
            InformasiTravel::create($request->all());
            return redirect()->back()->with('success', 'Data travel berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Gagal menambahkan data, silahkan periksa kembali!');
        }
    }
    
    public function updateTravel(Request $request, $id)
    {
        $request->validate([
            'keberangkatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jumlah_kursi' => 'required|string',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
        ]);
    
        $travels = InformasiTravel::find($id);
    
        if (!$travels) {
            return redirect()->route('itr.index')->with('warning', 'Data travel tidak ditemukan.');
        }
    
        try {
            $travels->update([
                'keberangkatan' => $request->input('keberangkatan'),
                'tujuan' => $request->input('tujuan'),
                'jumlah_kursi' => $request->input('jumlah_kursi'),
                'tanggal_keberangkatan' => $request->input('tanggal_keberangkatan'),
                'jam_keberangkatan' => $request->input('jam_keberangkatan'),
            ]);
    
            return redirect()->route('itr.index')->with('success', 'Data travel berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('itr.index')->with('warning', 'Gagal memperbarui data travel, silahkan periksa kembali!');
        }
    }

    public function deleteTravel($id)
    {
        $travels = InformasiTravel::find($id);
    
        if (!$travels) {
            return redirect()->route('itr.index')->with('warning', 'Data travel tidak ditemukan.');
        }
    
        // Hapus data mobil dari database
        $travels->delete();
    
        return redirect()->route('itr.index')->with('success', 'Data Travel berhasil dihapus.');
    }
    
    

    public function store( Request $request){
        $validator = Validator::make($request->all(), [
            'keberangkatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'jumlah_kursi' => 'required|string',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
>>>>>>> 3abdc52060f516629b09aaa45d580524b6197167
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
<<<<<<< HEAD
            'armada' => 'sometimes|max:50',
            'keberangkatan' => 'sometimes|max:50',
            'tujuan' => 'sometimes|max:50',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'kursi_tersedia' => 'required|max:50'
         ]);
         
         if ( $validator->fails() ) {
             return response()->json( $validator->messages() )->setStatusCode(442);
=======
            'keberangkatan' => 'sometimes|string|max:255',
            'tujuan' => 'sometimes|string|max:255',
            'jumlah_kursi' => 'sometimes|integer',
            'tanggal_keberangkatan' => 'sometimes|date',
            'jam_keberangkatan' => 'sometimes|date_format:H:i',
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->messages(), 442);
>>>>>>> 3abdc52060f516629b09aaa45d580524b6197167
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

