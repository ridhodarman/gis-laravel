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

Route::get('/msme_digit', 'MsmesController@digit');
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

Route::get('/office_digit', 'OfficesController@digit');
Route::get('/kantor_semua', 'OfficesController@semua');
Route::get('/kantor_cari_nama/{nama}', 'OfficesController@cari_nama');
Route::get('/kantor_cari_jenis/{jenis}', 'OfficesController@cari_jenis');
Route::get('/kantor_cari_konstruksi/{konstruksi}', 'OfficesController@cari_konstruksi');
Route::get('/kantor_cari_luasbang/{luasbang}', 'OfficesController@cari_luasbang');
Route::get('/kantor_cari_luastanah/{luastanah}', 'OfficesController@cari_luastanah');
Route::get('/kantor_cari_tahun/{tahun}', 'OfficesController@cari_tahun');
Route::get('/kantor_cari_radius/{rad}', 'OfficesController@cari_radius');
Route::get('/kantor_cari_jorong/{jorong}', 'OfficesController@cari_jorong');
Route::get('/kantor_cari_fasilitas/{fasilitas}', 'OfficesController@cari_fasilitas');
Route::get('/kantor_info/{id}', 'OfficesController@info');
Route::get('/kantor_detail/{id}', 'OfficesController@detail');

Route::get('/msme_digit', 'MsmesController@digit');