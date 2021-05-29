<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\UserAlbum;
class UserAlbumController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $items = UserAlbum::where('user_albums.user_id', auth()->user()->id)
        ->join('albums', 'albums.id', '=', 'user_albums.album_id')
        ->join('artists', 'albums.artist_id', '=', 'artists.id')
        ->select('albums.*', 'artists.name as artistName')
        ->get();
    return $this->sendResponse($items, 'Albums retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $item = UserAlbum::create(["user_id"=>$request->user()->id,"album_id"=>$input["id"]]);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function destroy($id)
    {
        $item = UserAlbum::where(["user_id" => auth()->user()->id, "album_id" => $id])->delete();
        return $this->sendResponse($item, 'Album deleted successfully.');
    }
}