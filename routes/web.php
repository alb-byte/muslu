<?php
Route::get('/', function () {
    return view('start');
})->name('start');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/albums', 'AlbumController@index')->name('album');
