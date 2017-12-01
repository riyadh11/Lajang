<?php

Route::get('/','Administrator\HomeController@index')->middleware('auth');
// Awal Laporan Controller //
Route::get('/laporan','Administrator\LaporanController@list')->middleware('auth');
Route::get('/laporan/{id}','Administrator\LaporanController@show')->middleware('auth');

Route::get('/laporan/ubah/{id}','Administrator\LaporanController@gupdate')->middleware('auth');
Route::post('/laporan/ubah','Administrator\LaporanController@update')->middleware('auth');
Route::get('/laporan/hapus/{id}','Administrator\LaporanController@remove')->middleware('auth');
Route::get('/laporan/aktivasi/{id}','Administrator\LaporanController@activate')->middleware('auth');

Route::post('/laporan/perkembangan/buat','Administrator\DetailLaporanController@store')->middleware('auth');
Route::post('/laporan/perkembangan/ubah','Administrator\DetailLaporanController@update')->middleware('auth');
Route::get('/laporan/perkembangan/hapus/{id}','Administrator\DetailLaporanController@remove')->middleware('auth');


Route::get('/laporan/pertanggung-jawaban/{id}','Administrator\PertanggungJawabanController@show')->middleware('auth');
Route::post('/laporan/pertanggung-jawaban/buat','Administrator\PertanggungJawabanController@store')->middleware('auth');

// Batas Laporan Controller //

// Awal Kategori Controller //
Route::get('/kategori','Administrator\KategoriController@index')->middleware('auth');
Route::post('/kategori/buat','Administrator\KategoriController@store')->middleware('auth');
Route::post('/kategori/ubah','Administrator\KategoriController@update')->middleware('auth');
Route::get('/kategori/hapus/{id}','Administrator\KategoriController@remove')->middleware('auth');
Route::get('/kategori/aktivasi/{id}','Administrator\KategoriController@activate')->middleware('auth');
Route::get('/kategori/{id}','Administrator\KategoriController@list')->middleware('auth');

// Batas Kategori Controller //

// Awal Status Controller //
// ---Status Laporan--- //
Route::get('/status/laporan','Administrator\StatusLaporanController@index')->middleware('auth');
Route::post('/status/laporan/buat','Administrator\StatusLaporanController@store')->middleware('auth');
Route::post('/status/laporan/ubah','Administrator\StatusLaporanController@update')->middleware('auth');
Route::get('/status/laporan/hapus/{id}','Administrator\StatusLaporanController@remove')->middleware('auth');
Route::get('/status/laporan/aktivasi/{id}','Administrator\StatusLaporanController@activate')->middleware('auth');
Route::get('/status/laporan/{id}','Administrator\StatusLaporanController@list')->middleware('auth');
// ---End Status Laporan--- //

// ---Status Penduduk--- //
Route::get('/status/penduduk','Administrator\StatusPendudukController@index')->middleware('auth');
Route::post('/status/penduduk/buat','Administrator\StatusPendudukController@store')->middleware('auth');
Route::post('/status/penduduk/ubah','Administrator\StatusPendudukController@update')->middleware('auth');
Route::get('/status/penduduk/hapus/{id}','Administrator\StatusPendudukController@remove')->middleware('auth');
Route::get('/status/penduduk/aktivasi/{id}','Administrator\StatusPendudukController@activate')->middleware('auth');
Route::get('/status/penduduk/{id}','Administrator\StatusPendudukController@list')->middleware('auth');
// ---End Status Penduduk--- //

// -- Batas Status Controller //

//Awal Penduduk Controller //
Route::get('/penduduk','Administrator\PendudukController@index')->middleware('auth');
Route::get('/penduduk/{id}','Administrator\PendudukController@list')->middleware('auth');
Route::get('/penduduk/aktivasi/{id}','Administrator\PendudukController@activate')->middleware('auth');
Route::get('/penduduk/hapus/{id}','Administrator\PendudukController@remove')->middleware('auth');

// Batas Penduduk Controller //

//Awal Daerah Controller //
// -- Kecamatan -- //
Route::get('/daerah/kecamatan','Administrator\KecamatanController@index')->middleware('auth');
Route::get('/daerah/kecamatan/{id}','Administrator\KecamatanController@index_k')->middleware('auth');
Route::get('/daerah/kecamatan/{id}/laporan','Administrator\KecamatanController@list')->middleware('auth');
Route::post('/daerah/kecamatan/buat','Administrator\KecamatanController@store')->middleware('auth');
Route::post('/daerah/kecamatan/ubah','Administrator\KecamatanController@update')->middleware('auth');
Route::get('/daerah/kecamatan/hapus/{id}','Administrator\KecamatanController@remove')->middleware('auth');
Route::get('/daerah/kecamatan/aktivasi/{id}','Administrator\KecamatanController@activate')->middleware('auth');
// -- End Kecamatan-- //

// -- Kelurahan -- //
Route::get('/daerah/kelurahan','Administrator\KelurahanController@index')->middleware('auth');
Route::get('/daerah/kelurahan/{id}','Administrator\KelurahanController@list')->middleware('auth');
Route::post('/daerah/kelurahan/buat','Administrator\KelurahanController@store')->middleware('auth');
Route::post('/daerah/kelurahan/ubah','Administrator\KelurahanController@update')->middleware('auth');
Route::get('/daerah/kelurahan/hapus/{id}','Administrator\KelurahanController@remove')->middleware('auth');
Route::get('/daerah/kelurahan/aktivasi/{id}','Administrator\KelurahanController@activate')->middleware('auth');