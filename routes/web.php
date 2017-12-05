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
    return view('welcome');
});
Route::get('/laporan','Pengguna\HomeController@list');
Route::get('/laporan/{id}','Pengguna\HomeController@show');
Route::get('/kategori/{id}','Pengguna\HomeController@kategori');
Route::get('/status/{id}','Pengguna\HomeController@status');

Route::group(['prefix' => 'penduduk'], function () {
  Route::get('/login', 'PendudukAuth\LoginController@showLoginForm')->name('penduduk.login');
  Route::post('/login', 'PendudukAuth\LoginController@login');
  Route::post('/logout', 'PendudukAuth\LoginController@logout')->name('penduduk.logout');

  Route::get('/register', 'PendudukAuth\RegisterController@showRegistrationForm')->name('penduduk.register');
  Route::post('/register', 'PendudukAuth\RegisterController@register');

  Route::post('/password/email', 'PendudukAuth\ForgotPasswordController@sendResetLinkEmail')->name('penduduk.password.request');
  Route::post('/password/reset', 'PendudukAuth\ResetPasswordController@reset')->name('penduduk.password.email');
  Route::get('/password/reset', 'PendudukAuth\ForgotPasswordController@showLinkRequestForm')->name('penduduk.password.reset');
  Route::get('/password/reset/{token}', 'PendudukAuth\ResetPasswordController@showResetForm');
  Route::get('/confirmation/{token}', 'PendudukAuth\RegisterController@confirmation')->name('penduduk.confirmation');
});


Route::group(['prefix' => 'administrator'], function () {
  Route::get('/login', 'AdministratorAuth\LoginController@showLoginForm')->name('administrator.login');
  Route::post('/login', 'AdministratorAuth\LoginController@login');
  Route::post('/logout', 'AdministratorAuth\LoginController@logout')->name('administrator.logout');
  Route::get('/logout', 'AdministratorAuth\LoginController@logout');

  Route::get('/register', 'AdministratorAuth\RegisterController@showRegistrationForm')->name('administrator.register');
  Route::post('/register', 'AdministratorAuth\RegisterController@register');

  Route::post('/password/email', 'AdministratorAuth\ForgotPasswordController@sendResetLinkEmail')->name('administrator.password.request');
  Route::post('/password/reset', 'AdministratorAuth\ResetPasswordController@reset')->name('administrator.password.email');
  Route::get('/password/reset', 'AdministratorAuth\ForgotPasswordController@showLinkRequestForm')->name('administrator.password.reset');
  Route::get('/password/reset/{token}', 'AdministratorAuth\ResetPasswordController@showResetForm');
});
