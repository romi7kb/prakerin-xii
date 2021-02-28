<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\TrackingController;

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
// admin route

Route::group(['prefix'=> 'admin', 'middleware'=> ['auth']], function ()
{
    Route::get('/', function () {
        return view('adminnice.index');
    });
    Route::resource('provinsi', ProvinsiController::class);
    Route::resource('kota', KotaController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class);
    Route::resource('rw', RwController::class);
    Route::resource('tracking', TrackingController::class);
});
Route::get('/',[TrackingController::class,'show']);
Route::get('/kota/{id}',[TrackingController::class,'showKot']);
Route::get('/kecamatan/{id}',[TrackingController::class,'showKec']);
Route::get('/kelurahan/{id}',[TrackingController::class,'showKel']);
Route::get('/rw/{id}',[TrackingController::class,'showRW']);

Auth::routes(['register' => false,]);

