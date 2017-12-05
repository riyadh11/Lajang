<?php

Route::get('/',"Penduduk\HomeController@index");
Route::get('/home',"Penduduk\HomeController@index");
Route::get('/laporan','Penduduk\LaporanController@list');

Route::get('/laporan/buat','Penduduk\LaporanController@gstore');
Route::post('/laporan/buat','Penduduk\LaporanController@store');

Route::get('/laporan/ubah/{id}','Penduduk\LaporanController@gupdate');
Route::post('/laporan/ubah/','Penduduk\LaporanController@update');

Route::post('/laporan/perkembangan','Penduduk\DetailLaporanController@store');
Route::post('/laporan/perkembangan/ubah','Penduduk\DetailLaporanController@update');
Route::get('/laporan/perkembangan/hapus/{id}','Penduduk\DetailLaporanController@remove');
Route::post('/laporan/vote','Penduduk\VoteController@store');