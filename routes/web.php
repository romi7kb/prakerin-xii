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
    Route::get('/form-basic', function () {
        return view('adminnice.form-basic');
    });
    Route::get('/icon-material', function () {
        return view('adminnice.icon-material');
    });
    Route::get('/pages-profile', function () {
        return view('adminnice.pages-profile');
    });
    Route::get('/starter-kit', function () {
        return view('adminnice.starter-kit');
    });
    Route::get('/table-basic', function () {
        return view('adminnice.table-basic');
    });
    Route::get('/error', function () {
        return view('adminnice.error');
    });
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

