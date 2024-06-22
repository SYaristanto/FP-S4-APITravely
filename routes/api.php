<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\AuthCT;

// Api Register & Login
Route::post('/register', [AuthCT::class, 'register']);
Route::post('/login', [AuthCT::class, 'login']);

//Panggil InformasiTravelCT sebagai object
use App\Http\Controllers\InformasiTravelCT;
use App\Models\InformasiTravel;

//Api CRUD data travel
Route::post('/InformasiTravel', [InformasiTravelCT::class, 'store']);
Route::get('/InformasiTravel',[InformasiTravelCT::class, 'show']);
Route::put('InformasiTravel/{id}', [InformasiTravelCT::class, 'update']);
Route::delete('InformasiTravel/{id}', [InformasiTravelCT::class, 'delete']);