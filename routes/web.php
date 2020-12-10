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
Route::get('/2', function () {return view ('2');});

Route::get('/logout2', function (){
    Auth::logout();
    return redirect('/login');
});

Route::get('/', 'PagesController@index')->name('index');
Route::get('/house_digit', 'HousesController@digit');
Route::get('/rumah_cari_id/{id}', 'HousesController@cari_id');
Route::get('/rumah_cari_model/{model}', 'HousesController@cari_model');
Route::get('/rumah_info/{id}', 'HousesController@info');
Route::get('/rumah_cari_namapemilik/{nama}', 'HousesController@cari_namapemilik');
Route::get('/rumah_cari_nikpemilik/{nik}', 'HousesController@cari_nikpemilik');
Route::get('/rumah_cari_namapenghuni/{nama}', 'HousesController@cari_namapenghuni');
Route::get('/rumah_cari_nikpenghuni/{nik}', 'HousesController@cari_nikpenghuni');
Route::get('/rumah_cari_kkpenghuni/{kk}', 'HousesController@cari_kkpenghuni');
Route::get('/rumah_cari_sukupenghuni/{suku}', 'HousesController@cari_sukupenghuni');
Route::get('/rumah_cari_konstruksi/{k}', 'HousesController@cari_konstruksi');
Route::get('/rumah_cari_tahun/{tahun}', 'HousesController@cari_tahun');
Route::get('/rumah_cari_listrik/{listrik}', 'HousesController@cari_listrik');
Route::get('/rumah_cari_status/{s}', 'HousesController@cari_status');

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

Route::get('/pendidikan/digit', 'Educational_buildingsController@digit');
Route::get('/pendidikan/semua', 'Educational_buildingsController@semua');
Route::get('/pendidikan/nama/{nama}', 'Educational_buildingsController@cari_nama');
Route::get('/pendidikan/tingkat/{tingkat}', 'Educational_buildingsController@cari_tingkat');
Route::get('/pendidikan/jenis/{jenis}', 'Educational_buildingsController@cari_jenis');
Route::get('/pendidikan/jorong/{jorong}', 'Educational_buildingsController@cari_jorong');
Route::get('/pendidikan/model/{model}', 'Educational_buildingsController@cari_model');
Route::get('/pendidikan/info/{id}', 'Educational_buildingsController@info');
Route::get('/pendidikan/detail/{id}', 'Educational_buildingsController@detail');

Route::get('/kesehatan/digit', 'Health_service_buildingsController@digit');
Route::get('/kesehatan/semua', 'Health_service_buildingsController@semua');
Route::get('/kesehatan/nama/{nama}', 'Health_service_buildingsController@cari_nama');
Route::get('/kesehatan/jenis/{jenis}', 'Health_service_buildingsController@cari_jenis');
Route::get('/kesehatan/radius/{lat}/{lng}/{rad}', 'Health_service_buildingsController@cari_radius');
Route::get('/kesehatan/jorong/{jorong}', 'Health_service_buildingsController@cari_jorong');
Route::get('/kesehatan/fasilitas/{fasilitas}', 'Health_service_buildingsController@cari_fasilitas');
Route::get('/kesehatan/model/{model}', 'Health_service_buildingsController@cari_model');
Route::get('/kesehatan/info/{id}', 'Health_service_buildingsController@info');
Route::get('/kesehatan/detail/{id}', 'Health_service_buildingsController@detail');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    //Route::get('/bangunan', 'PagesController@bangunan')->name('bangunan');
    Route::livewire('/bangunan', 'building.index')->layout('layouts.admin')->name('bangunan');
    //Route::get('/spasial', function () { return view ('admin.building.spasial.index');})->name('spasial');
    Route::livewire('/spasial', 'building.spatial')->layout('layouts.admin')->name('spasial');
    Route::get('/spasial-info', function () { return view ('admin.building.spasial.info');});

    Route::get('/kependudukan', function () { return view ('admin.kependudukan.index');});
    //Route::get('/penduduk', function () { return view ('admin.kependudukan.penduduk');});
    Route::livewire('/penduduk', 'population.citizens')->layout('layouts.admin')->name('penduduk');

    //Route::get('/konstruksi', 'Type_of_constructionsController@index');
    Route::livewire('/konstruksi', 'building.construction')->layout('layouts.admin')->name('konstruksi');
    Route::post('/konstruksi', 'Type_of_constructionsController@store');
    Route::patch('/konstruksi/{Type_of_construction}', 'Type_of_constructionsController@update');
    Route::delete('/konstruksi/{Type_of_construction}', 'Type_of_constructionsController@destroy');

    //Route::get('/model', 'Building_modelsController@index');
    Route::livewire('/model', 'building.model')->layout('layouts.admin')->name('model');
    Route::post('/model', 'Building_modelsController@store');
    Route::patch('/model/{Building_model}', 'Building_modelsController@update');
    Route::delete('/model/{Building_model}', 'Building_modelsController@destroy');

    //Route::get('/suku', 'TribesController@index');
    Route::livewire('/suku', 'datuk.tribes')->layout('layouts.admin')->name('suku');
    Route::post('/suku', 'TribesController@store');
    Route::patch('/suku/{tribe}', 'TribesController@update');
    Route::delete('/suku/{tribe}', 'TribesController@destroy');

    //Route::get('/datuk', 'DatuksController@index');
    Route::livewire('/datuk', 'datuk.index')->layout('layouts.admin')->name('datuk');
    Route::post('/datuk', 'DatuksController@store');
    Route::patch('/datuk/{datuk}', 'DatuksController@update');
    Route::delete('/datuk/{datuk}', 'DatuksController@destroy');

    //Route::get('/pendidikan', 'EducationsController@index');
    Route::livewire('/pendidikan', 'population.edu')->layout('layouts.admin')->name('pendidikan');
    Route::post('/pendidikan', 'EducationsController@store');
    Route::patch('/pendidikan/{education}', 'EducationsController@update');
    Route::delete('/pendidikan/{education}', 'EducationsController@destroy');

    //Route::get('/pekerjaan', 'JobsController@index');
    Route::livewire('/pekerjaan', 'population.jobs')->layout('layouts.admin')->name('pekerjaan');
    Route::post('/pekerjaan', 'JobsController@store');
    Route::patch('/pekerjaan/{job}', 'JobsController@update');
    Route::delete('/pekerjaan/{job}', 'JobsController@destroy');

    //Route::get('/keluarga', 'Family_cardsController@index');
    Route::livewire('/keluarga', 'population.family')->layout('layouts.admin')->name('keluarga');
    Route::post('/keluarga', 'Family_cardsController@store');
    Route::delete('/keluarga/{family_card}', 'Family_cardsController@destroy');

    Route::livewire('/admin', 'admin.index')->layout('layouts.admin')->name('admin');

    Route::livewire('/post', 'post.index')->layout('layouts.app2')->name('post.index');
    Route::livewire('/post/tambah', 'post.create')->layout('layouts.app2')->name('post.create');
    Route::livewire('/post/edit/{id}', 'post.edit')->layout('layouts.app2')->name('post.edit');
});

Route::get('/tes', 'HomeController@tes');