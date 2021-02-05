<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\Api\KotaController;
use App\Http\Controllers\Api\KecamatanController;
use App\Http\Controllers\Api\KelurahanController;
use App\Http\Controllers\Api\RwController;
use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Api\ApiController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [UserController::class,'login']);
Route::post('register', [UserController::class,'register']);
// provinsi
Route::get('provinsi',[ ApiController::class,'provinsi']);
Route::get('provinsi/{id}',[ ApiController::class,'getprovinsi']);
Route::get('provinsi/{idp}/kota',[ ApiController::class,'kota']);
Route::get('kota',[ ApiController::class,'allkota']);
Route::get('provinsi/{idp}/kota/{id}',[ ApiController::class,'getkota']);
Route::get('kecamatan',[ ApiController::class,'kecamatan']);
Route::get('kelurahan',[ ApiController::class,'kelurahan']);
Route::get('rw',[ ApiController::class,'rw']);
Route::get('indonesia',[ ApiController::class,'indonesia']);
Route::get('negara',[ ApiController::class,'negara']);
Route::get('positif',[ ApiController::class,'positif']);
Route::get('sembuh',[ ApiController::class,'sembuh']);
Route::get('meninggal',[ ApiController::class,'meninggal']);
// Route::get('provinsi',[ ProvinsiController::class,'index']);
// Route::post('provinsi/create',[ ProvinsiController::class,'store']);
// Route::get('provinsi/show/{id}',[ ProvinsiController::class,'show']);
// Route::put('provinsi/edit/{id}',[ ProvinsiController::class,'update']);
// Route::delete('provinsi/delete/{id}',[ ProvinsiController::class,'destroy']);

Route::get('tracking',[ TrackingController::class,'tracking']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user/detail', [UserController::class,'details']);
    Route::post('logout',[ UserController::class,'logout']);
}); 
