<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/access/denied',['as' => 'access.denied', 'uses'=>'HomeController@accessdenied']);

Route::group(['prefix' => 'pegawai', 'middleware' => 'admin'], function(){
	Route::get('index', 'PegawaiController@index')->name('pegawai.index');
	Route::get('create', 'PegawaiController@create');
	Route::post('save', 'PegawaiController@save');
	Route::get('edit/{id}', 'PegawaiController@edit');
	Route::patch('update/{id}', 'PegawaiController@update');
	Route::get('delete/{id}', 'PegawaiController@delete');
});

Route::group(['prefix' => 'jenis', 'middleware' => 'admin'], function(){
	Route::get('index', 'JenisController@index')->name('jenis.index');
	Route::get('create', 'JenisController@create');
	Route::post('save', 'JenisController@save');
	Route::get('edit/{id}', 'JenisController@edit');
	Route::patch('update/{id}', 'JenisController@update');
	Route::get('delete/{id}', 'JenisController@delete');
});

Route::group(['prefix' => 'ruang', 'middleware' => 'admin'], function(){
	Route::get('index', 'RuangController@index')->name('ruang.index');
	Route::get('create', 'RuangController@create');
	Route::post('save', 'RuangController@save');
	Route::get('edit/{id}', 'RuangController@edit');
	Route::patch('update/{id}', 'RuangController@update');
	Route::get('delete/{id}', 'RuangController@delete');
	// Route::get('getid', )
});

Route::group(['prefix' => 'level', 'middleware' => 'admin'], function(){
	Route::get('index', 'LevelController@index')->name('level.index');
	Route::get('create', 'LevelController@create');
	Route::post('save', 'LevelController@save');
	Route::get('edit/{id}', 'LevelController@edit');
	Route::patch('update/{id}', 'LevelController@update');
	Route::get('delete/{id}', 'LevelController@delete');
});

Route::group(['prefix' => 'inven', 'middleware' => 'admin'], function(){
	Route::get('index', 'InventarisController@index')->name('inven.index');
	Route::get('create', 'InventarisController@create');
	Route::post('save', 'InventarisController@save');
	Route::get('edit/{id}', 'InventarisController@edit');
	Route::patch('update/{id}', 'InventarisController@update');
	Route::get('delete/{id}', 'InventarisController@delete');
});

Route::group(['prefix' => 'peminjaman', 'middleware' => 'admin'], function(){
	Route::get('index', 'PeminjamanController@index')->name('peminjaman.index');
	Route::get('create', 'PeminjamanController@create');
	Route::post('save', 'PeminjamanController@save');
	Route::get('edit/{id}', 'PeminjamanController@edit');
	Route::patch('update/{id}', 'PeminjamanController@update');
	Route::patch('approve/{id}', 'PeminjamanController@approve');
	Route::patch('reject/{id}', 'PeminjamanController@reject');
});

Route::group(['prefix' => 'pengembalian', 'middleware' => 'admin'], function(){
	Route::get('index', 'DetailKembaliController@index')->name('pengembalian.index');
	Route::get('create/{id}', 'DetailKembaliController@create');
	Route::post('save/{id}', 'DetailKembaliController@save');
});

Route::group(['prefix' => 'report', 'middleware' => 'admin'],function(){
	Route::get('peminjaman', 'ReportController@peminjaman');
	Route::get('pengembalian', 'ReportController@pengembalian');
	Route::get('ruang', 'ReportController@ruang');
	Route::get('per/ruang/{id}', 'ReportController@perruang');
});

Route::group(['prefix' => 'pegawai/peminjaman', 'middleware' => 'pegawai'], function(){
	Route::get('index', 'PegawaiPinjamController@index')->name('pegawaisecond.peminjaman.index');
	Route::get('create', 'PegawaiPinjamController@create');
	Route::post('save', 'PegawaiPinjamController@save');
	Route::get('edit/{id}', 'PegawaiPinjamController@edit');
	Route::patch('update/{id}', 'PegawaiPinjamController@update');
});

Route::group(['prefix' => 'operator/peminjaman', 'middleware' => 'operator'], function(){
	Route::get('index', 'OperatorPinjamController@index')->name('operator.peminjaman.index');
	Route::get('create', 'OperatorPinjamController@create');
	Route::post('save', 'OperatorPinjamController@save');
	Route::get('edit/{id}', 'OperatorPinjamController@edit');
	Route::patch('update/{id}', 'OperatorPinjamController@update');
	Route::patch('approve/{id}', 'PeminjamanController@approve');
	Route::patch('reject/{id}', 'PeminjamanController@reject');
});

// Route::group(['prefix' => 'operator/pengembalian', 'middleware' => 'operator'], function(){
// 	Route::get('index', 'OperatorPengembalianController@index')->name('operator.pengembalian.index');
// 	Route::get('create/{id}', 'OperatorPengembalianController@create');
// 	Route::post('save/{id}', 'OperatorPengembalianController@save');
// });

Route::group(['prefix' => 'operator/pengembalian', 'middleware' => 'operator'], function(){
	Route::get('index', 'DetailKembaliOperatorController@index')->name('pengembalian.index');
	Route::get('create/{id}', 'DetailKembaliOperatorController@create');
	Route::post('save/{id}', 'DetailKembaliOperatorController@save');
});

Route::group(['prefix' => 'maintenance'], function(){
	Route::get('index', 'MaintenanceController@index')->name('maintenance.index');
	Route::get('edit/{id}', 'MaintenanceController@edit');
	Route::patch('update/{id}', 'MaintenanceController@update');
});
