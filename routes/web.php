<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;



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

Route::post('/pelanggans/store', 'PelangganController@store')->name('storePelanggan');
Route::get('/pelanggans/total', 'PelangganController@getTotalPelanggan')->name('getTotalPelanggan');


Route::get('pelanggans', 'PelangganController@index')->name('pelanggans.index');
Route::get('pelanggans/create', 'PelangganController@create')->name('pelanggans.create');
Route::post('pelanggans', 'PelangganController@store')->name('pelanggans.store');
Route::get('pelanggans/{pelanggan}', 'PelangganController@show')->name('pelanggans.show');
Route::get('pelanggans/{pelanggan}/edit', 'PelangganController@edit')->name('pelanggans.edit');
Route::put('pelanggans/{pelanggan}', 'PelangganController@update')->name('pelanggans.update');;
Route::delete('pelanggans/{pelanggan}', 'PelangganController@destroy')->name('pelanggans.destroy');;




Route::group(['prefix' => 'penjualans'], function () {
    Route::get('/', 'PenjualanController@index')->name('penjualans.index');
    Route::get('/create', 'PenjualanController@create')->name('penjualans.create');
    Route::post('/store', 'PenjualanController@store')->name('penjualans.store');
    Route::get('/{id}', 'PenjualanController@show')->name('penjualans.show');
    Route::get('/{id}/edit', 'PenjualanController@edit')->name('penjualans.edit');
    Route::put('/{id}', 'PenjualanController@update')->name('penjualans.update');
    Route::delete('/{id}', 'PenjualanController@destroy')->name('penjualans.destroy');
    Route::get('/laporans/cetak', 'PenjualanController@cetakLaporan')->name('laporans.cetak');
    Route::get('/tpenjualanstotal', 'PenjualanController@getTotalPenjualan')->name('getTotalPenjualan');
    Route::get('/getTotalPendapatan', 'HomeController@getTotalPendapatan')->name('getTotalPendapatan');
    Route::get('/laporans/custom', 'LaporansController@custom')->name('laporans.custom');
    Route::get('/laporans/range', 'LaporansController@range')->name('laporans.range');
    


});

Route::get('/laporans', 'PenjualanController@laporan')->name('laporans.index');





Route::post('/produks/store', 'ProdukController@store')->name('storeProduk');
Route::get('/produks/total', 'ProdukController@getTotalProduk')->name('getTotalProduk');
Route::get('produks', 'ProdukController@index')->name('produks.index');
Route::get('produks/create', 'ProdukController@create')->name('produks.create');
Route::post('produks', 'ProdukController@store')->name('produks.store');
Route::get('produks/{produk}/edit', 'ProdukController@edit')->name('produks.edit');
Route::put('produks/{produk}', 'ProdukController@update')->name('produks.update');
Route::delete('produks/{produk}', 'ProdukController@destroy')->name('produks.destroy');
Route::get('/dashboard/stok-rendah', 'DashboardController@getStokRendah')->name('getStokRendah');




Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('/home', 'HomeController@index')->name('home');

// Proteksi route dashboard agar hanya bisa diakses setelah login
Route::group(['middleware' => 'auth'], function () {
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


