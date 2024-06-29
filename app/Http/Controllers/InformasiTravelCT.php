<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\InformasiTravel;

class InformasiTravelCT extends Controller
{
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
        $rute = InformasiTravel::where('keberangkatan', $keberangkatan)
            ->where('tujuan', $tujuan)
            ->where('tanggal_keberangkatan', $tanggal)
            ->get();

        return response()->json(['message' => 'Data Informasi Travel', 'data' => $rute]);
    }

    public function store( Request $request){
        $validator = Validator::make($request->all(), [
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

