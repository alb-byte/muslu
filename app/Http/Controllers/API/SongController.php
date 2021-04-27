<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Song;
class SongController extends BaseController
{
    public function index(Request $request)
    {
        $offset = $request->input('startFrom',0);
        if($request->has('album')){
            $items = Song::where('album_id', $request->input('album'))->skip($offset)->take(10);
        }
        else if($request->has('name')){
            $items = Song::whereRaw("UPPER(name) LIKE '%". strtoupper($request->input('name'))."%'")->skip($offset)->take(10)->get();
        }
        // // dd($items);
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