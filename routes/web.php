<?php
Route::get('/', function () {
    return view('start');
})->name('start');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/album', 'AlbumController@index')->name('album');
Route::get('/artist', 'ArtistController@index')->name('artist');
Route::get('/video', 'VideoController@index')->name('video');
Route::get('/admin', 'AdminController@index')->name('admin');
