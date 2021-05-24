<?php

// Route::middleware('auth:api')->group(function () {
//     Route::resource('albums', 'API\AlbumController');
// });

Route::apiResource('albums', 'API\AlbumController');
Route::apiResource('artists', 'API\ArtistController');
Route::apiResource('songs', 'API\SongController');
Route::apiResource('videos', 'API\VideoController');
Route::apiResource('usersongs', 'API\UserSongController');
Route::apiResource('useralbums', 'API\UserAlbumController');
Route::apiResource('uservideos', 'API\UserVideoController');
