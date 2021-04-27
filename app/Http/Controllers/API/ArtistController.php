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
    public function store(Request $request)
    {
        $input = $request->all();
        $item = Artist::create($input);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function show($id)
    {
        $item = Artist::find($id);
        if (is_null($item)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($item->toArray(), 'Album retrieved successfully.');
    }
    public function update(Request $request, Artist $item)
    {
        $input = $request->all();
        $item->name = $input['name'];
        $item->save();
        return $this->sendResponse($item->toArray(), 'Product updated successfully.');
    }
    public function destroy(Artist $item)
    {
        $item->delete();
        return $this->sendResponse($item->toArray(), 'Album deleted successfully.');
    }
}