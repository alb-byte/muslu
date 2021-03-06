<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Album;
use App\UserAlbum;

class AlbumController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $offset = $request->input('startFrom', 0);
        if ($request->has('artist')) {
            $items = Album::where('artist_id', $request->input('artist'))->skip($offset)->take(10);
        } else if ($request->has('name')) {
            $items = Album::whereRaw("UPPER(albums.name) LIKE '%" . strtoupper($request->input('name')) . "%'")
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('albums.*', 'artists.name as artistName')
                ->skip($offset)
                ->take(10)
                ->get();
        } else if ($request->has('artistId')) {
            $items = Album::where('artist_id', $request->input('artistId'))
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('albums.*', 'artists.name as artistName')
                ->skip($offset)
                ->take(10)
                ->get();
        }
        return $this->sendResponse($items, 'Albums retrieved successfully.');
    }
    public function show($id)
    {
        $album = Album::where('albums.id', $id)
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->select('albums.*', 'artists.name as artistName')
            ->first();

        $album["saved"] = UserAlbum::where(['album_id' => $album->id, 'user_id' => auth()->user()->id])->exists();
        if (is_null($album)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($album, 'Album retrieved successfully.');
    }
}
