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
            'kapasitas' => 'required|string',
        ]);

        try {
            Kendaraan::create($request->all());
            return redirect()->back()->with('success', 'Data Kendaraan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Gagal menambahkan data, silahkan periksa kembali!');
        }
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
