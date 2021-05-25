<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\UserSong;

class UserSongController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $items = array();
        foreach (UserSong::where('user_songs.user_id', auth()->user()->id)
            ->join('songs', 'songs.id', '=', 'user_songs.song_id')
            ->join('albums', 'songs.album_id', '=', 'albums.id')
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->select('songs.*', 'artists.name as artistName')
            ->cursor() as $song) {
            $song["saved"] = UserSong::where(['song_id' => $song->id, 'user_id' => auth()->user()->id])->exists();
            array_push($items, $song);
        }
        return $this->sendResponse($items, 'Albums retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $item = UserSong::create(["user_id" => auth()->user()->id, "song_id" => $input["id"]]);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function show($id)
    {
        $item = UserSong::find($id);
        if (is_null($item)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($item->toArray(), 'Album retrieved successfully.');
    }
    public function destroy($id)
    {
        $item = UserSong::where(["user_id" => auth()->user()->id, "song_id" => $id])->delete();
        return $this->sendResponse($item, 'Album deleted successfully.');
    }
}
