<?php


Route::get('/','buku_tamuController@index');
Route::get('pengunjung-data','buku_tamuController@dataajax');
Route::post('isi_buku','buku_tamuController@isi');
Route::post('buku_tamu/store','buku_tamuController@store');
