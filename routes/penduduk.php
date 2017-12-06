<?php

Route::get('/',"Penduduk\HomeController@index");
Route::get('/home',"Penduduk\HomeController@index");
Route::get('/laporan','Penduduk\LaporanController@list');

Route::get('/profil',"Penduduk\PendudukController@index");
Route::post('/profil/ubah',"Penduduk\PendudukController@update");

Route::get('/laporan/buat','Penduduk\LaporanController@gstore');
Route::post('/laporan/buat','Penduduk\LaporanController@store');

Route::get('/laporan/ubah/{id}','Penduduk\LaporanController@gupdate');
Route::post('/laporan/ubah/','Penduduk\LaporanController@update');

Route::post('/laporan/komentar','Penduduk\KomentarController@store');
Route::post('/laporan/komentar/ubah','Penduduk\KomentarController@update');
Route::get('/laporan/komentar/hapus/{id}','Penduduk\KomentarController@remove');
Route::post('/laporan/vote','Penduduk\VoteController@store');