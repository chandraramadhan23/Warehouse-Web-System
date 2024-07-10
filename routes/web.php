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

// Login
Route::get('/', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LogoutController@logout');


Route::middleware('auth')->group(function() {
    // Dashboarad
    Route::get('/dashboard', 'DashboardController@index');


    // Stok Barang
    Route::get('/stokBarang', 'StokBarangController@index');
    Route::get('/showTableStokBarang', 'StokBarangController@showTable');
    Route::post('/deleteByStokBarang', 'StokBarangController@delete');


    // Barang Masuk
    Route::get('/barangMasuk', 'BarangMasukController@index');
    Route::get('/showOptionCategoryMasuk', 'BarangMasukController@showOption');
    Route::post('/endSaveMasuk', 'BarangMasukController@save');


    // Barang Keluar
    Route::get('/barangKeluar', 'BarangKeluarController@index');
    Route::get('/showOptionCategoryKeluar', 'BarangKeluarController@showOption');
    Route::post('/endSaveKeluar', 'BarangKeluarController@save');



    // Laporan Barang Masuk
    Route::get('/laporanBarangMasuk', 'LaporanBarangMasukController@index');
    Route::get('/showTableLaporanBarangMasuk', 'LaporanBarangMasukController@showTable');
    Route::post('/deleteLaporanMasuk/{id}', 'LaporanBarangMasukController@delete');


    // Laporan Barang Keluar
    Route::get('/laporanBarangKeluar', 'LaporanBarangKeluarController@index');
    Route::get('/showTableLaporanBarangKeluar', 'LaporanBarangKeluarController@showTable');
    Route::post('/deleteLaporanKeluar/{id}', 'LaporanBarangKeluarController@delete');


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
});