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
    Route::get('/laporan', 'LaporanController@index')->name('laporan');
    Route::get('/laporan/{id}', 'LaporanController@show')->name('laporan.show');
    Route::resource('/periode', 'PeriodeController');
    Route::resource('/periode/{periode}/pelatihan', 'PelatihanController');
    Route::get('/periode/{periode}/pelatihan/{pelatihan}/pdf/usulan', 'PelatihanPdfController@usulan')->name("pdf.usulan");
    Route::get('/periode/{periode}/pelatihan/{pelatihan}/pdf/daftar-hadir', 'PelatihanPdfController@daftar_hadir')->name("pdf.daftar_hadir");
    Route::get('/periode/{periode}/pelatihan/{pelatihan}/pdf/laporan', 'PelatihanPdfController@laporan')->name("pdf.laporan");
    Route::get('/periode/{periode}/pelatihan/{pelatihan}/pdf/evaluasi', 'PelatihanPdfController@evaluasi')->name("pdf.evaluasi");
    Route::get('/periode/{periode}/pelatihan/{pelatihan}/pdf/riwayat', 'PelatihanPdfController@riwayat')->name("pdf.riwayat");
    Route::get('/periode/{periode}/pelatihan/{pelatihan}/pdf/sertifikat', 'PelatihanPdfController@sertifikat')->name("pdf.sertifikat");
});



Route::group([], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.post');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});


Route::get('foto_karyawan/{filename}', function ($filename)
{
    $path = storage_path('app/foto_karyawan/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('foto_karyawan');