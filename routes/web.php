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

Route::get('/welcome', function () {
    return view ('welcome');
});

Route::get('/house_digit', 'HousesController@digit');
Route::get('/rumah_cari_id/{id}', 'HousesController@cari_id');
Route::get('/rumah_cari_model/{model}', 'HousesController@cari_model');
Route::get('/rumah_info/{id}', 'HousesController@info');
Route::get('/rumah_cari_namapemilik/{nama}', 'HousesController@cari_namapemilik')->middleware('auth');
Route::get('/rumah_cari_nikpemilik/{nik}', 'HousesController@cari_nikpemilik')->middleware('auth');
Route::get('/rumah_cari_namapenghuni/{nama}', 'HousesController@cari_namapenghuni')->middleware('auth');
Route::get('/rumah_cari_nikpenghuni/{nik}', 'HousesController@cari_nikpenghuni')->middleware('auth');
Route::get('/rumah_cari_kkpenghuni/{kk}', 'HousesController@cari_kkpenghuni')->middleware('auth');
Route::get('/rumah_cari_sukupenghuni/{suku}', 'HousesController@cari_sukupenghuni')->middleware('auth');
Route::get('/rumah_cari_konstruksi/{k}', 'HousesController@cari_konstruksi')->middleware('auth');
Route::get('/rumah_cari_tahun/{tahun}', 'HousesController@cari_tahun')->middleware('auth');
Route::get('/rumah_cari_listrik/{listrik}', 'HousesController@cari_listrik')->middleware('auth');
Route::get('/rumah_cari_status/{s}', 'HousesController@cari_status')->middleware('auth');

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
Route::get('/ibadah_cari_model/{model}', 'WorshipsController@cari_model');
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
Route::get('/umkm_cari_model/{model}', 'MsmesController@cari_model');
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
Route::get('/kantor_cari_model/{model}', 'OfficesController@cari_model');
Route::get('/kantor_info/{id}', 'OfficesController@info');
Route::get('/kantor_detail/{id}', 'OfficesController@detail');

Route::get('/educational_digit', 'EducationalsController@digit');
Route::get('/pendidikan_semua', 'EducationalsController@semua');
Route::get('/pendidikan_cari_nama/{nama}', 'EducationalsController@cari_nama');
Route::get('/pendidikan_cari_tingkat/{tingkat}', 'EducationalsController@cari_tingkat');
Route::get('/pendidikan_cari_jenis/{jenis}', 'EducationalsController@cari_jenis');
Route::get('/pendidikan_cari_konstruksi/{konstruksi}', 'EducationalsController@cari_konstruksi');
Route::get('/pendidikan_cari_luasbang/{luasbang}', 'EducationalsController@cari_luasbang');
Route::get('/pendidikan_cari_luastanah/{luastanah}', 'EducationalsController@cari_luastanah');
Route::get('/pendidikan_cari_tahun/{tahun}', 'EducationalsController@cari_tahun');
Route::get('/pendidikan_cari_radius/{rad}', 'EducationalsController@cari_radius');
Route::get('/pendidikan_cari_jorong/{jorong}', 'EducationalsController@cari_jorong');
Route::get('/pendidikan_cari_fasilitas/{fasilitas}', 'EducationalsController@cari_fasilitas');
Route::get('/pendidikan_cari_model/{model}', 'EducationalsController@cari_model');
Route::get('/pendidikan_info/{id}', 'EducationalsController@info');
Route::get('/pendidikan_detail/{id}', 'EducationalsController@detail');

Route::get('/health_digit', 'HealthsController@digit');
Route::get('/kesehatan_semua', 'HealthsController@semua');
Route::get('/kesehatan_cari_nama/{nama}', 'HealthsController@cari_nama');
Route::get('/kesehatan_cari_jenis/{jenis}', 'HealthsController@cari_jenis');
Route::get('/kesehatan_cari_radius/{rad}', 'HealthsController@cari_radius');
Route::get('/kesehatan_cari_jorong/{jorong}', 'HealthsController@cari_jorong');
Route::get('/kesehatan_cari_fasilitas/{fasilitas}', 'HealthsController@cari_fasilitas');
Route::get('/kesehatan_cari_model/{model}', 'HealthsController@cari_model');
Route::get('/kesehatan_info/{id}', 'HealthsController@info');
Route::get('/kesehatan_detail/{id}', 'HealthsController@detail');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pages', function () { return view ('admin.building.index');})->middleware('auth');
Route::get('/identitas', function () { return view ('admin.kependudukan.identitas');})->middleware('auth');
Route::get('/keluarga', function () { return view ('admin.kependudukan.keluarga');})->middleware('auth');