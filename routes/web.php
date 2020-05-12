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
    return view ('index', ['api' => 'AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE']);
});

Route::get('/house_digit', 'HousesController@digit');

Route::get('/worship_digit', 'WorshipsController@digit');
Route::get('/ibadah_semua', 'WorshipsController@semua');
Route::get('/ibadah_cari_nama/{nama}', 'WorshipsController@cari_nama');
Route::get('/ibadah_cari_jenis/{jenis}', 'WorshipsController@cari_jenis');
Route::get('/ibadah_cari_konstruksi/{konstruksi}', 'WorshipsController@cari_konstruksi');
Route::get('/ibadah_cari_luasbang/{luasbang}', 'WorshipsController@cari_luasbang');
Route::get('/ibadah_cari_luastanah/{luastanah}', 'WorshipsController@cari_luastanah');
Route::get('/ibadah_cari_tahun/{tahun}', 'WorshipsController@cari_tahun');
Route::get('/ibadah_cari_radius/{rad}', 'WorshipsController@cari_radius');
Route::get('/ibadah_cari_jorong/{jorong}', 'WorshipsController@cari_jorong');
Route::get('/ibadah_cari_fasilitas/{fasilitas}', 'WorshipsController@cari_fasilitas');
Route::get('/ibadah_info/{id}', 'WorshipsController@info');
Route::get('/ibadah_detail/{id}', 'WorshipsController@detail');

Route::get('/umkm_semua', 'MsmesController@semua');
Route::get('/umkm_cari_nama/{nama}', 'MsmesController@cari_nama');
Route::get('/umkm_cari_jenis/{jenis}', 'MsmesController@cari_jenis');
Route::get('/umkm_cari_konstruksi/{konstruksi}', 'MsmesController@cari_konstruksi');
Route::get('/umkm_cari_luasbang/{luasbang}', 'MsmesController@cari_luasbang');
Route::get('/umkm_cari_luastanah/{luastanah}', 'MsmesController@cari_luastanah');
Route::get('/umkm_cari_tahun/{tahun}', 'MsmesController@cari_tahun');
Route::get('/umkm_cari_radius/{rad}', 'MsmesController@cari_radius');
Route::get('/umkm_cari_jorong/{jorong}', 'MsmesController@cari_jorong');
Route::get('/umkm_cari_fasilitas/{fasilitas}', 'MsmesController@cari_fasilitas');
Route::get('/umkm_info/{id}', 'MsmesController@info');
Route::get('/umkm_detail/{id}', 'MsmesController@detail');

Route::get('/msme_digit', 'MsmesController@digit');