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

Route::get('/', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'HomeController@admin')->name('home');
    Route::resource('/unit', 'UnitController');
    Route::resource('/bagian', 'BagianController');
    Route::resource('/jabatan', 'JabatanController');
    Route::resource('/karyawan', 'KaryawanController');
    Route::resource('/outsourcing', 'OutsourcingController');
    Route::resource('/peringatan', 'PeringatanController');
    Route::resource('/cuti', 'CutiController');
    Route::resource('/rencana', 'RencanaController');
    Route::resource('/mutasi', 'MutasiController');
});



Route::group([], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.post');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});