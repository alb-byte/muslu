<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Artist;
class ArtistController extends BaseController
{
    public function index(Request $request)
    {
        $offset = $request->input('startFrom',0);
        if($request->has('name')){
            $items = Artist::whereRaw("UPPER(name) LIKE '%". strtoupper($request->input('name'))."%'")->skip($offset)->take(10)->get();
        }
        else{
            $items = Artist::all();
        }
        return $this->sendResponse($items, 'Artist retrieved successfully.');
    }
    public function show($id)
    {
        $artist = Artist::where('artists.id',$id)
            ->join('contacts', 'artists.id', '=', 'contacts.artist_id')
            ->select('artists.*', 'contacts.instagram','contacts.twitter','contacts.youtube')
            ->first();
        if (is_null($artist)) {
            return $this->sendError('Artist not found.');
        }
        return $this->sendResponse($artist, 'Artist retrieved successfully.');
    }
}