<?php

Route::get('/','Administrator\HomeController@index');
Route::get('/home','Administrator\HomeController@index');
// Awal Laporan Controller //
Route::get('/laporan','Administrator\LaporanController@list');
Route::get('/laporan/{id}','Administrator\LaporanController@show');

Route::get('/laporan/ubah/{id}','Administrator\LaporanController@gupdate');
Route::post('/laporan/ubah','Administrator\LaporanController@update');
Route::get('/laporan/hapus/{id}','Administrator\LaporanController@remove');
Route::get('/laporan/aktivasi/{id}','Administrator\LaporanController@activate');

Route::post('/laporan/perkembangan/buat','Administrator\DetailLaporanController@store');
Route::post('/laporan/perkembangan/ubah','Administrator\DetailLaporanController@update');
Route::get('/laporan/perkembangan/hapus/{id}','Administrator\DetailLaporanController@remove');


Route::get('/laporan/pertanggung-jawaban/{id}','Administrator\PertanggungJawabanController@show');
Route::post('/laporan/pertanggung-jawaban/buat','Administrator\PertanggungJawabanController@store');

// Batas Laporan Controller //

// Awal Kategori Controller //
Route::get('/kategori','Administrator\KategoriController@index');
Route::post('/kategori/buat','Administrator\KategoriController@store');
Route::post('/kategori/ubah','Administrator\KategoriController@update');
Route::get('/kategori/hapus/{id}','Administrator\KategoriController@remove');
Route::get('/kategori/aktivasi/{id}','Administrator\KategoriController@activate');
Route::get('/kategori/{id}','Administrator\KategoriController@list');

// Batas Kategori Controller //

// Awal Status Controller //
// ---Status Laporan--- //
Route::get('/status/laporan','Administrator\StatusLaporanController@index');
Route::post('/status/laporan/buat','Administrator\StatusLaporanController@store');
Route::post('/status/laporan/ubah','Administrator\StatusLaporanController@update');
Route::get('/status/laporan/hapus/{id}','Administrator\StatusLaporanController@remove');
Route::get('/status/laporan/aktivasi/{id}','Administrator\StatusLaporanController@activate');
Route::get('/status/laporan/{id}','Administrator\StatusLaporanController@list');
// ---End Status Laporan--- //

// ---Status Penduduk--- //
Route::get('/status/penduduk','Administrator\StatusPendudukController@index');
Route::post('/status/penduduk/buat','Administrator\StatusPendudukController@store');
Route::post('/status/penduduk/ubah','Administrator\StatusPendudukController@update');
Route::get('/status/penduduk/hapus/{id}','Administrator\StatusPendudukController@remove');
Route::get('/status/penduduk/aktivasi/{id}','Administrator\StatusPendudukController@activate');
Route::get('/status/penduduk/{id}','Administrator\StatusPendudukController@list');
// ---End Status Penduduk--- //

// -- Batas Status Controller //

//Awal Penduduk Controller //
Route::get('/penduduk','Administrator\PendudukController@index');
Route::get('/penduduk/{id}','Administrator\PendudukController@list');
Route::get('/penduduk/aktivasi/{id}','Administrator\PendudukController@activate');
Route::get('/penduduk/hapus/{id}','Administrator\PendudukController@remove');

// Batas Penduduk Controller //

//Awal Daerah Controller //
// -- Kecamatan -- //
Route::get('/daerah/kecamatan','Administrator\KecamatanController@index');
Route::get('/daerah/kecamatan/{id}','Administrator\KecamatanController@index_k');
Route::get('/daerah/kecamatan/{id}/laporan','Administrator\KecamatanController@list');
Route::post('/daerah/kecamatan/buat','Administrator\KecamatanController@store');
Route::post('/daerah/kecamatan/ubah','Administrator\KecamatanController@update');
Route::get('/daerah/kecamatan/hapus/{id}','Administrator\KecamatanController@remove');
Route::get('/daerah/kecamatan/aktivasi/{id}','Administrator\KecamatanController@activate');
// -- End Kecamatan-- //

// -- Kelurahan -- //
Route::get('/daerah/kelurahan','Administrator\KelurahanController@index');
Route::get('/daerah/kelurahan/{id}','Administrator\KelurahanController@list');
Route::post('/daerah/kelurahan/buat','Administrator\KelurahanController@store');
Route::post('/daerah/kelurahan/ubah','Administrator\KelurahanController@update');
Route::get('/daerah/kelurahan/hapus/{id}','Administrator\KelurahanController@remove');
Route::get('/daerah/kelurahan/aktivasi/{id}','Administrator\KelurahanController@activate');