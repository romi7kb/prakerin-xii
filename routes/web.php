<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('adminnice.index');
});
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
