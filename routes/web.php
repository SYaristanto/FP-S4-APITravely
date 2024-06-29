<?php

use App\Http\Controllers\AuthCT;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiTravelCT;
use App\Http\Controllers\KendaraanCT;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
<<<<<<< HEAD
=======

Route::get('/', function () {  //halaman login
    return redirect('/login');
});

Route::get('/login', [AuthCT::class, 'index'])->name('login');
Route::post('/login', [AuthCT::class, 'authenticate']);

Route::get('/home', function () {  //halaman home
    return view('home');    
});

Route::get('/rute', function () {  //halaman data travely (rute)
    return view('data-travely.rute');
});

// start CRUD data travely (kendaraan)
Route::get('/kendaraan', function () {  //halaman data travely (kendaraan)
    return view('data-travely.kendaraan');   
});
Route::get('/kendaraan', [KendaraanCT::class, 'index'])->name('kdr.index');
Route::post('/kendaraan', [KendaraanCT::class, 'addKendaraan'])->name('kdr.addKendaraan');
// end CRUD data travely (kendaraan)

// Start CRUD data travel (Informasi Travely)
Route::get('/itr', function () {  //halaman data travely (informasi travely)
    return view('data-travely.informasi-travely');   
});
Route::get('/InformasiTravel/search',[InformasiTravelCT::class, 'searchTiket']);
Route::get('/itr',[InformasiTravelCT::class, 'index'])->name('itr.index');
Route::post('/informasiTravel',[InformasiTravelCT::class, 'addTravel'])->name('itr.addTravel');
Route::put('/informasiTravel/{id}',[InformasiTravelCT::class, 'updateTravel'])->name('itr.updateTravel');
Route::delete('/itr/{id}', [InformasiTravelCT::class, 'deleteTravel'])->name('itr.deleteTravel');

//Api CRUD data travel
Route::post('/InformasiTravel', [InformasiTravelCT::class, 'store'])->name('itr.store');
Route::get('/InformasiTravel',[InformasiTravelCT::class, 'show']);
Route::put('InformasiTravel/{id}', [InformasiTravelCT::class, 'update']);
Route::delete('InformasiTravel/{id}', [InformasiTravelCT::class, 'delete']);
// End CRUD data travel (Informasi Travely)

Route::get('/detail_pesanan', function () {  //halaman informasi travely
    return view('detail_pesanan');   
});

Route::get('/cusin', function () {  //halaman customer informasi
    return view('customer_informasi');   
});

Route::get('/feecus', function () {  //halaman feedback customer
    return view('feedback_customer');   
});

Route::get('/otp', function () {
    return view('otp');   
});

Route::get('/sb', function () {
    return view('sandi_baru');   
});

Route::get('/notif', function () {
    return view('notifikasi');
});

Route::get('/profile', function () {
    return view('profile');   
});

Route::get('/gks', function () {
    return view('ganti_kata_sandi');
});
>>>>>>> 3abdc52060f516629b09aaa45d580524b6197167
