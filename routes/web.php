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


// Dashboarad
Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');


// Stok Barang
Route::get('/stokBarang', 'StokBarangController@index');
Route::get('/showTableStokBarang', 'StokBarangController@showTable');


// Barang Masuk
Route::get('/barangMasuk', 'BarangMasukController@index');
Route::get('/showTableBarangMasuk', 'BarangMasukController@showTable');
Route::get('/showOptionCategory', 'BarangMasukController@showOption');
Route::post('/deleteSession/{id}', 'BarangMasukController@delete');
Route::post('/saveToStokBarang', 'BarangMasukController@save');


// Barang Keluar
Route::get('/barangKeluar', 'BarangKeluarController@index');


// Laporan Barang Masuk
Route::get('/laporanBarangMasuk', 'LaporanBarangMasukController@index');


// Laporan Barang Keluar
Route::get('/laporanBarangKeluar', 'LaporanBarangKeluarController@index');


// Pengaturan Barang
Route::get('/barang', 'PengaturanBarangController@index');
Route::post('/addProduct', 'PengaturanBarangController@add');
Route::get('/showTableProductsByCategory', 'PengaturanBarangController@showTable');
Route::post('/deleteProductByCategory/{id}', 'PengaturanBarangController@delete');


// Pengaturan Kategori
Route::get('/kategori', 'PengaturanKategoriController@index');
Route::get('/showTableKategori', 'PengaturanKategoriController@showTable');
Route::post('/addCategory', 'PengaturanKategoriController@add');
Route::post('/deleteCategory/{id}', 'PengaturanKategoriController@delete');


// Pengaturan Supplier
Route::get('/supplier', 'PengaturanSupplierController@index');
Route::get('/showTableSupplier', 'PengaturanSupplierController@showTable');
Route::post('/addSupplier', 'PengaturanSupplierController@add');
Route::put('/editSupplier', 'PengaturanSupplierController@update');
Route::post('/deleteSupplier/{id}', 'PengaturanSupplierController@delete');


