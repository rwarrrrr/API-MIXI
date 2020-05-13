<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => 'auth:api'], function() {

    Route::post('details', 'Api\UserController@details');
    Route::post('update-profile' , 'Api\UserController@update');

    // Crud Artikel
    Route::get('artikel' , 'Api\ArtikelController@index');
    Route::get('artikel/{key}' , 'Api\ArtikelController@search');
    Route::post('artikel/tambah' , 'Api\ArtikelController@tambah');
    Route::post('artikel/{id}/update' , 'Api\ArtikelController@edit');
    Route::post('artikel/{id}/delete' , 'Api\ArtikelController@delete');

    // Crud Kegiatan Galery
    Route::get('keg-gallery' , 'Api\KegiatanGaleryController@index');
    Route::get('keg-gallery/{key}' , 'Api\KegiatanGaleryController@search');
    Route::post('keg-gallery/tambah' , 'Api\KegiatanGaleryController@tambah');
    Route::post('keg-gallery/{id}/update' , 'Api\KegiatanGaleryController@edit');
    Route::post('keg-gallery/{id}/delete' , 'Api\KegiatanGaleryController@delete');

    // Crud Gallery
    Route::get('gallery' , 'Api\GalleryController@index');
    Route::get('gallery/{key}' , 'Api\GalleryController@search');
    Route::post('gallery/tambah' , 'Api\GalleryController@tambah');
    Route::post('gallery/{id}/update' , 'Api\GalleryController@edit');
    Route::post('gallery/{id}/delete' , 'Api\GalleryController@delete');

    // Crud Member
    Route::get('member' , 'Api\MemberController@index');
    Route::get('member/{key}' , 'Api\MemberController@search');
    Route::post('member/tambah' , 'Api\MemberController@tambah');
    Route::post('member/{id}/update' , 'Api\MemberController@edit');
    Route::post('member/{id}/delete' , 'Api\MemberController@delete');

    // Crud Agenda
    Route::get('agenda' , 'Api\AgendaController@index');
    Route::get('agenda/{key}' , 'Api\AgendaController@search');
    Route::post('agenda/tambah' , 'Api\AgendaController@tambah');
    Route::post('agenda/{id}/update' , 'Api\AgendaController@edit');
    Route::post('agenda/{id}/delete' , 'Api\AgendaController@delete');

    // Crud Barang
    Route::get('barang' , 'Api\BarangController@index');
    Route::get('barang/{key}' , 'Api\BarangController@search');
    Route::post('barang/tambah' , 'Api\BarangController@tambah');
    Route::post('barang/{id}/update' , 'Api\BarangController@edit');
    Route::post('barang/{id}/delete' , 'Api\BarangController@delete');

    // Crud Kategori Barang
    Route::get('kat-barang' , 'Api\KategoriBarangController@index');
    Route::get('kat-barang/{key}' , 'Api\KategoriBarangController@search');
    Route::post('kat-barang/tambah' , 'Api\KategoriBarangController@tambah');
    Route::post('kat-barang/{id}/update' , 'Api\KategoriBarangController@edit');
    Route::post('kat-barang/{id}/delete' , 'Api\KategoriBarangController@delete');

    // Crud Penjual Barang
    Route::get('penjual' , 'Api\PenjualController@index');
    Route::get('penjual/{key}' , 'Api\PenjualController@search');
    Route::post('penjual/tambah' , 'Api\PenjualController@tambah');
    Route::post('penjual/{id}/update' , 'Api\PenjualController@edit');
    Route::post('penjual/{id}/delete' , 'Api\PenjualController@delete');

    // Crud Keranjang Barang User
    Route::get('keranjang' , 'Api\KeranjangController@index');
    Route::get('keranjang/{key}' , 'Api\KeranjangController@search');
    Route::post('keranjang/tambah' , 'Api\KeranjangController@tambah');
    Route::post('keranjang/{id}/update' , 'Api\KeranjangController@edit');
    Route::post('keranjang/{id}/delete' , 'Api\KeranjangController@delete');

    // Upload Dan Download Gambar
    Route::get('file/download/{nama}' , 'Api\FileController@download');
    Route::post('file/upload' , 'Api\FileController@upload');


});
