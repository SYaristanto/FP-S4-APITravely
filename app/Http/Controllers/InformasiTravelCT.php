<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Kursi;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\InformasiTravel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class InformasiTravelCT extends Controller
{
    public function index()
    {
        $travels = InformasiTravel::all();
        $kendaraan = Kendaraan::all();
        $rutes = Rute::all();
        return view('data-travely.informasi-travely', compact('travels', 'kendaraan', 'rutes'));
    }


    public function addTravel(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'rute_id' => 'required|exists:rute,id',
            'kursi_tersedia' => 'required|integer',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
        ]);

    
        try {
            InformasiTravel::create([
                'kendaraan_id' => $request->kendaraan_id,
                'rute_id' => $request->rute_id,
                'kursi_tersedia' => $request->kursi_tersedia,
                'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
                'jam_keberangkatan' => $request->jam_keberangkatan,
            ]);    
            // InformasiTravel::create($request->all());
            return redirect()->back()->with('success', 'Data travel berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Gagal menambahkan data, silahkan periksa kembali!');
        }
    }
    
    public function updateTravel(Request $request, $id)
    {
        $travels = InformasiTravel::find($id);

        if($travels) {
            $travels->kendaraan_id = $request->input('kendaraan_id');
            $travels->rute_id = $request->input('rute_id');
            $travels->kursi_tersedia = $request->input('kursi_tersedia');
            $travels->tanggal_keberangkatan = $request->input('tanggal_keberangkatan');
            $travels->jam_keberangkatan = $request->input('jam_keberangkatan');

            $travels->save();

            return redirect()->route('itr.index', ['id' => $travels->id])->with('success', 'Data travel berhasil diperbarui.');
        } else {
            return redirect()->route('itr.index')->with('warning', 'Gagal memperbarui data travel, silahkan periksa kembali!');
        }

        // $request->validate([
        //     'kendaraan_id' => 'sometimes|string|max:255',
        //     'rute_id' => 'sometimes|string|max:255',
        //     'kursi_tersedia' => 'sometimes|string',
        //     'tanggal_keberangkatan' => 'sometimes|date',
        //     'jam_keberangkatan' => 'sometimes|date_format:H:i',
        // ]);
    
    
        if (!$travels) {
            return redirect()->route('itr.index')->with('warning', 'Data travel tidak ditemukan.');
        }
    
        // try {
        //     // Hanya memperbarui kolom yang diisi dalam request
        //     $travels->fill($request->only([
        //         'kendaraan_id',
        //         'rute_id',
        //         'kursi_tersedia',
        //         'tanggal_keberangkatan',
        //         'jam_keberangkatan'
        //     ]));

        //     $travels->save();
    
        // } catch (\Exception $e) {
        // }
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
    
        $rute = InformasiTravel::with(['kendaraan', 'rute'])
            ->whereHas('rute', function($query) use ($keberangkatan, $tujuan, $tanggal) {
                $query->where('keberangkatan', $keberangkatan)
                      ->where('tujuan', $tujuan)
                      ->where('tanggal_keberangkatan', $tanggal);
            })
            ->get();
    
        return response()->json(['message' => 'Data Informasi Travel', 'data' => $rute]);
    }

    public function create(Request $request)
{
    // Validasi dan buat rute baru di table informasi_travel
    $informasiTravel = InformasiTravel::create($request->all());

    // Tambahkan kursi untuk rute baru
    for ($i = 1; $i <= 11; $i++) {
        Kursi::create([
            'travel_id' => $informasiTravel->id,
            'seat_number' => $i,
            'status' => 'tersedia',
        ]);
    }

    return response()->json(['message' => 'Rute dan kursi berhasil ditambahkan']);
}

    // Fungsi untuk mendapatkan status kursi
    public function getSeatStatus($id)
    {
        $occupiedSeats = Kursi::where('travel_id', $id)->where('status', 'terisi')->pluck('seat_number')->toArray();
        return response()->json(['occupiedSeats' => $occupiedSeats]);
    }

    // Fungsi untuk memesan kursi
    public function bookSeats(Request $request, $id)
    {
        $seats = $request->input('seats');

        foreach ($seats as $seatNumber) {
            Kursi::updateOrCreate(
                ['travel_id' => $id, 'seat_number' => $seatNumber],
                ['status' => 'terisi']
            );
        }

        // Update kursi_tersedia di informasiTravel
        $informasiTravel = InformasiTravel::find($id);
        $informasiTravel->kursi_tersedia -= count($seats);
        $informasiTravel->save();

        return response()->json(['message' => 'Seats booked successfully']);
    }


    // // Fungsi untuk mendapatkan status kursi
    // public function getSeatStatus($id)
    // {
    //     $occupiedSeats = Kursi::where('travel_id', $id)->where('status', 'terisi')->pluck('seat_number')->toArray();
    //     return response()->json(['occupiedSeats' => $occupiedSeats]);
    // }

    // // Fungsi untuk memesan kursi
    // public function bookSeats(Request $request, $id)
    // {
    //     $seats = $request->input('seats');

    //     foreach ($seats as $seatNumber) {
    //         Kursi::updateOrCreate(
    //             ['travel_id' => $id, 'seat_number' => $seatNumber],
    //             ['status' => 'terisi']
    //         );
    //     }

    //     // Update kursi_tersedia di informasiTravel
    //     $informasiTravel = InformasiTravel::find($id);
    //     $informasiTravel->kursi_tersedia -= count($seats);
    //     $informasiTravel->save();

    //     return response()->json(['message' => 'Seats booked successfully']);
    // }

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
         
    //      if ( $validator->fails() ) {
    //          return response()->json( $validator->messages() )->setStatusCode(442);
    //         'keberangkatan' => 'sometimes|string|max:255',
    //         'tujuan' => 'sometimes|string|max:255',
    //         'jumlah_kursi' => 'sometimes|integer',
    //         'tanggal_keberangkatan' => 'sometimes|date',
    //         'jam_keberangkatan' => 'sometimes|date_format:H:i',
    // }

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->messages(), 442);
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

