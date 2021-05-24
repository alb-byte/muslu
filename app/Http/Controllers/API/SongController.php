<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Song;
use App\UserSong;

class SongController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $offset = $request->input('startFrom', 0);
        if ($request->has('album')) {

            // DB::enableQueryLog(); // Enable query log
            $items = array();
            foreach (Song::where("album_id", $request->input('album'))
                ->join('albums', 'songs.album_id', '=', 'albums.id')
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('songs.*', 'artists.name as artistName')
                ->cursor() as $song) {
                $song["saved"] = UserSong::where(['song_id' => $song->id, 'user_id' => $request->user()->id])->exists();
                array_push($items, $song);
            }

            // dd(DB::getQueryLog()); // Show results of log
        } else if ($request->has('name')) {
            $items = array();
            foreach (Song::whereRaw("UPPER(songs.name) LIKE '%" . strtoupper($request->input('name')) . "%'")
                ->join('albums', 'songs.album_id', '=', 'albums.id')
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('songs.*', 'artists.name as artistName')
                ->skip($offset)
                ->take(10)
                ->cursor() as $song) {
                $song["saved"] = UserSong::where(['song_id' => $song->id, 'user_id' => $request->user()->id])->exists();
                array_push($items, $song);
            }
        }
        return $this->sendResponse($items, 'Songs retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $item = Song::create($input);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function show($id)
    {
        $item = Song::find($id);
        if (is_null($item)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($item->toArray(), 'Album retrieved successfully.');
    }
    public function update(Request $request, Song $item)
    {
        $input = $request->all();
        $item->name = $input['name'];
        $item->save();
        return $this->sendResponse($item->toArray(), 'Product updated successfully.');
    }
    public function destroy(Song $item)
    {
        $item->delete();
        return $this->sendResponse($item->toArray(), 'Album deleted successfully.');
    }
}
