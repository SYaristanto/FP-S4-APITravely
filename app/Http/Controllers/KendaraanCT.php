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
            'armada' => 'required|string',
            'plat_nomor' => 'required|string',
            'kapasitas' => 'required|string',
        ]);
        
        if ( $validator->fails() ) {
            return response()->json( $validator->messages() )->setStatusCode(442);
        }

        $validated = $validator->validated();

        Kendaraan::create( $validated );

        return response()->json("Data berhasil disimpan", 200);
    }
}
