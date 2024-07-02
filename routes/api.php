<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiTravelCT;
use App\Http\Controllers\KendaraanCT;
use App\Models\InformasiTravel;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthCT;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Panggil AuthCT sebagai object


// Api Register & Login
Route::post('/register', [AuthCT::class, 'register']);
Route::post('/login', [AuthCT::class, 'login']);

//Panggil InformasiTravelCT sebagai object

//Api CRUD data travel
Route::get('/InformasiTravel/search',[InformasiTravelCT::class, 'searchTiket']);
Route::post('/InformasiTravel', [InformasiTravelCT::class, 'store']);
Route::get('/InformasiTravel', [InformasiTravelCT::class, 'show']);
Route::put('InformasiTravel/{id}', [InformasiTravelCT::class, 'update']);
Route::delete('InformasiTravel/{id}', [InformasiTravelCT::class, 'delete']);
Route::get('InformasiTravel/{id}/seats', [informasiTravelCT::class, 'getSeatStatus']);
// Route::get('InformasiTravel/{id}/book', [InformasiTravelCT::class, 'bookSeats']);
Route::post('InformasiTravel/{id}/book', [InformasiTravelCT::class, 'bookSeats']);

// Api CRUD users
Route::get('/users/{id}', [UserController::class, 'show']);
//Panggil InformasiTravelCT sebagai object

//Api CRUD Data Kendaraan 
Route::post('/Kendaraan', [KendaraanCT::class, 'store']);
Route::get('/Kendaraan', [KendaraanCT::class, 'show']);
Route::put('Kendaraan/{id}', [KendaraanCT::class, 'update']);
Route::delete('Kendaraan/{id}', [KendaraanCT::class, 'delete']);

//Panggil RuteCT sebagai object
use App\Http\Controllers\RuteCT;

//Api CRUD Data Rute
Route::post('/Rute', [RuteCT::class, 'store']);
Route::get('/Rute', [RuteCT::class, 'show']);
Route::put('Rute/{id}', [RuteCT::class, 'update']);
Route::delete('Rute/{id}', [RuteCT::class, 'delete']);
