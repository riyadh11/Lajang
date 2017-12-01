<?php

Route::get('/',"Penduduk\HomeController@index")->middleware('auth');
Route::get('/home',"Penduduk\HomeController@index")->middleware('auth');
Route::get('/laporan','Penduduk\LaporanController@list')->middleware('auth');

Route::get('/laporan/buat','Penduduk\LaporanController@gstore')->middleware('auth');
Route::post('/laporan/buat','Penduduk\LaporanController@store')->middleware('auth');

Route::get('/laporan/ubah/{id}','Penduduk\LaporanController@gupdate')->middleware('auth');
Route::post('/laporan/ubah/','Penduduk\LaporanController@update')->middleware('auth');

Route::post('/laporan/perkembangan','Penduduk\DetailLaporanController@store')->middleware('auth');
Route::post('/laporan/vote','Penduduk\VoteController@store')->middleware('auth');