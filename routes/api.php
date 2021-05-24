<?php

// Route::middleware('auth:api')->group(function () {
//     Route::resource('albums', 'API\AlbumController');
// });

Route::apiResource('albums', 'API\AlbumController');
Route::apiResource('artists', 'API\ArtistController');
Route::apiResource('songs', 'API\SongController');
Route::apiResource('videos', 'API\VideoController');
Route::apiResource('user_songs', 'API\UserSongController');
Route::apiResource('user_albums', 'API\UserAlbumController');
Route::apiResource('user_videos', 'API\UserVideoController');
