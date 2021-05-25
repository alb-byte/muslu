<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Album;
use App\UserSong;
use App\UserAlbum;
use App\UserVideo;
use App\Song;
use App\Video;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        if ($request->has('video')) {
            $items = $this->getTopVideos();
        } else if ($request->has('album')) {
            $items = $this->getTopAlbums();
        } else if ($request->has('song')) {
            $items = $this->getTopSongs();
        } else if ($request->has('user')) {
            $items = $this->getTopUsers();
        }
        return $this->sendResponse($items, 'Artist retrieved successfully.');
    }
    private function getTopVideos()
    {
        $items = array();
        foreach (UserVideo::select('user_videos.video_id as id', DB::raw('count(user_videos.video_id) as count'))
            ->groupBy('user_videos.video_id')
            ->orderBy('count', 'DESC')
            ->take(10)
            ->cursor() as $video) {
            $item = Video::where('videos.id', $video->id)
                ->join('artists', 'videos.artist_id', '=', 'artists.id')
                ->select('videos.*', 'artists.name as artistName')
                ->first();
            $item['count'] = $video->count;
            array_push($items, $item);
        }
    }
    private function getTopSongs()
    {
        $items = array();
        foreach (UserSong::select('user_songs.song_id as id', DB::raw('count(user_songs.song_id) as count'))
            ->groupBy('user_songs.song_id')
            ->orderBy('count', 'DESC')
            ->take(10)
            ->cursor() as $song) {
            $item = Song::where('songs.id', $song->id)
                ->join('albums', 'songs.album_id', '=', 'albums.id')
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('songs.*', 'artists.name as artistName')
                ->first();
            $item['count'] = $song->count;
            array_push($items, $item);
        }
        return $items;
    }
    private function getTopAlbums()
    {
        $items = array();
        foreach (UserAlbum::select('user_albums.album_id as id', DB::raw('count(user_albums.album_id) as count'))
            ->groupBy('user_albums.album_id')
            ->orderBy('count', 'DESC')
            ->take(10)
            ->cursor() as $album) {
            $item = Album::where('albums.id', $album->id)
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('albums.*', 'artists.name as artistName')
                ->first();
            $item['count'] = $album->count;
            array_push($items, $item);
        }
        return $items;
    }
    private function getTopUsers()
    {
        $items = array();
        foreach (UserSong::select('user_songs.user_id as id', DB::raw('count(user_songs.user_id) as count'))
            ->groupBy('user_songs.user_id')
            ->orderBy('count', 'DESC')
            ->take(10)
            ->cursor() as $user) {
            $item = User::find($user->id);
            $item['count'] = $user->count;
            array_push($items, $item);
        }
        return $items;
    }
}
