<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api','prefix' => 'pegawai'], function(){
	Route::get('index', 'PegawaiController@index')->name('pegawai.index');
	// Route::get('create', 'PegawaiController@create');
	Route::post('save', 'PegawaiController@save');
	Route::get('edit/{id}', 'PegawaiController@edit');
	Route::post('update/{id}', 'PegawaiController@update');
	Route::get('delete/{id}', 'PegawaiController@delete');
});

Route::group(['namespace' => 'Api','prefix' => 'jenis'], function(){
	Route::get('index', 'Admin\JenisController@index')->name('jenis.index');
	// Route::get('create', 'JenisController@create');
	Route::post('save', 'Admin\JenisController@save');
	Route::get('edit/{id}', 'Admin\JenisController@edit');
	Route::post('update/{id}', 'Admin\JenisController@update');
	Route::get('delete/{id}', 'Admin\JenisController@delete');
});
