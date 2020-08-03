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

Route::get('/welcome', function () {return view ('welcome');});

Route::get('/logout2', function (){
    Auth::logout();
    return redirect('/login');
});

Route::get('/', 'PagesController@index')->name('index');
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

Route::get('/ibadah/digit', 'Worship_buildingsController@digit');
Route::get('/ibadah_semua', 'Worship_buildingsController@semua');
Route::get('/ibadah/nama/{nama}', 'Worship_buildingsController@cari_nama');
Route::get('/ibadah/jenis/{jenis}', 'Worship_buildingsController@cari_jenis');
Route::get('/ibadah/konstruksi/{konstruksi}', 'Worship_buildingsController@cari_konstruksi');
Route::get('/ibadah/luasbang/{luasbang}', 'Worship_buildingsController@cari_luasbang');
Route::get('/ibadah/parkir/{parkir}', 'Worship_buildingsController@cari_luasparkir');
Route::get('/ibadah/tahun/{tahun}', 'Worship_buildingsController@cari_tahun');
Route::get('/ibadah/radius/{lat}/{lng}/{rad}', 'Worship_buildingsController@cari_radius');
Route::get('/ibadah/jorong/{jorong}', 'Worship_buildingsController@cari_jorong');
Route::get('/ibadah/fasilitas/{fasilitas}', 'Worship_buildingsController@cari_fasilitas');
Route::get('/ibadah/model/{model}', 'Worship_buildingsController@cari_model');
Route::get('/ibadah/info/{id}', 'Worship_buildingsController@info');
Route::get('/ibadah/detail/{id}', 'Worship_buildingsController@detail');

Route::get('/umkm', 'Msme_buildingsController@index')->name('umkm');
Route::get('/umkm/digit', 'Msme_buildingsController@digit');
Route::get('/umkm/semua', 'Msme_buildingsController@semua');
Route::get('/umkm/nama/{nama}', 'Msme_buildingsController@cari_nama');
Route::get('/umkm/jenis/{jenis}', 'Msme_buildingsController@cari_jenis');
Route::get('/umkm/radius/{lat}/{lng}/{rad}', 'Msme_buildingsController@cari_radius');
Route::get('/umkm/fasilitas/{fas}', 'Msme_buildingsController@cari_fasilitas');
Route::get('/umkm/jorong/{jorong}', 'Msme_buildingsController@cari_jorong');
Route::get('/umkm/model/{model}', 'Msme_buildingsController@cari_model');
Route::get('/umkm/info/{id}', 'Msme_buildingsController@info');
Route::get('/umkm/detail/{id}', 'Msme_buildingsController@detail');

Route::get('/kantor/digit', 'Office_buildingsController@digit');
Route::get('/kantor/semua', 'Office_buildingsController@semua');
Route::get('/kantor/nama/{nama}', 'Office_buildingsController@cari_nama');
Route::get('/kantor/jenis/{jenis}', 'Office_buildingsController@cari_jenis');
Route::get('/kantor/tahun/{tahun}', 'Office_buildingsController@cari_tahun');
Route::get('/kantor/model/{model}', 'Office_buildingsController@cari_model');
Route::get('/kantor/info/{id}', 'Office_buildingsController@info');
Route::get('/kantor/detail/{id}', 'Office_buildingsController@detail');

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

Route::get('/bangunan', function () { return view ('admin.building.index');})->middleware('auth');

Route::get('/spasial', function () { return view ('admin.building.spasial.index');})->middleware('auth');
Route::get('/spasial-info', function () { return view ('admin.building.spasial.info');})->middleware('auth');

Route::get('/kependudukan', function () { return view ('admin.kependudukan.index');})->middleware('auth');
Route::get('/penduduk', function () { return view ('admin.kependudukan.penduduk');})->middleware('auth');

Route::get('/konstruksi', 'Type_of_constructionsController@index')->middleware('auth');
Route::post('/konstruksi', 'Type_of_constructionsController@store')->middleware('auth');
Route::patch('/konstruksi/{Type_of_construction}', 'Type_of_constructionsController@update')->middleware('auth');
Route::delete('/konstruksi/{Type_of_construction}', 'Type_of_constructionsController@destroy')->middleware('auth');

Route::get('/model', 'Building_modelsController@index')->middleware('auth');
Route::post('/model', 'Building_modelsController@store')->middleware('auth');
Route::patch('/model/{Building_model}', 'Building_modelsController@update')->middleware('auth');
Route::delete('/model/{Building_model}', 'Building_modelsController@destroy')->middleware('auth');

Route::get('/suku', 'TribesController@index')->middleware('auth');
Route::post('/suku', 'TribesController@store')->middleware('auth');
Route::patch('/suku/{tribe}', 'TribesController@update')->middleware('auth');
Route::delete('/suku/{tribe}', 'TribesController@destroy')->middleware('auth');

Route::get('/datuk', 'DatuksController@index')->middleware('auth');
Route::post('/datuk', 'DatuksController@store')->middleware('auth');
Route::patch('/datuk/{datuk}', 'DatuksController@update')->middleware('auth');
Route::delete('/datuk/{datuk}', 'DatuksController@destroy')->middleware('auth');

Route::get('/pendidikan', 'EducationsController@index')->middleware('auth');
Route::post('/pendidikan', 'EducationsController@store')->middleware('auth');
Route::patch('/pendidikan/{education}', 'EducationsController@update')->middleware('auth');
Route::delete('/pendidikan/{education}', 'EducationsController@destroy')->middleware('auth');

Route::get('/pekerjaan', 'JobsController@index')->middleware('auth');
Route::post('/pekerjaan', 'JobsController@store')->middleware('auth');
Route::patch('/pekerjaan/{job}', 'JobsController@update')->middleware('auth');
Route::delete('/pekerjaan/{job}', 'JobsController@destroy')->middleware('auth');

//Route::get('/keluarga', function () { return view ('admin.kependudukan.keluarga');})->middleware('auth');
Route::get('/keluarga', 'Family_cardsController@index')->middleware('auth');
Route::post('/keluarga', 'Family_cardsController@store')->middleware('auth');
Route::delete('/keluarga/{family_card}', 'Family_cardsController@destroy')->middleware('auth');

Route::get('/tes', 'HomeController@tes');