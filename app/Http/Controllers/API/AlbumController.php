<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Album;
// use Illuminate\Support\Facades\DB;

class AlbumController extends BaseController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
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
        }
        else if($request->has('artistId')){
            $items = Album::where('artist_id',$request->input('artistId'))
                ->join('artists', 'albums.artist_id', '=', 'artists.id')
                ->select('albums.*', 'artists.name as artistName')
                ->skip($offset)
                ->take(10)
                ->get();
        }
        // dd($items);
        return $this->sendResponse($items, 'Albums retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $album = Album::create($input);
        return $this->sendResponse($album->toArray(), 'Album created successfully.');
    }
    public function show($id)
    {
        $album = Album::find($id)
            ->join('artists', 'albums.artist_id', '=', 'artists.id')
            ->leftJoin('user_albums', 'albums.id', '=', 'user_albums.id')
            ->select('albums.*', 'artists.name as artistName', 'user_albums.id as saved')
            ->first();
        if (is_null($album)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($album, 'Album retrieved successfully.');
    }
    public function update(Request $request, Album $album)
    {
        $input = $request->all();
        $album->name = $input['name'];
        $album->save();
        return $this->sendResponse($album->toArray(), 'Product updated successfully.');
    }
    public function destroy(Album $album)
    {
        $album->delete();
        return $this->sendResponse($album->toArray(), 'Album deleted successfully.');
    }
}
