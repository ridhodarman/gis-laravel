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
    //return view('index', 'MapsController@index');
    return view ('index', ['api' => 'AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE']);
});

Route::get('/buildings', 'BuildingsController@index');