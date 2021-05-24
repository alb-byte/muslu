<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Video;

class VideoController extends BaseController
{
    public function index(Request $request)
    {
        $offset = $request->input('startFrom', 0);
        if ($request->has('artistId')) {
            $items = Video::where('artist_id', $request->input('artistId'))
                ->skip($offset)
                ->take(10)
                ->get();
        } else {
            $items = Video::all();
        }
        return $this->sendResponse($items, 'Videos retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $item = Artist::create($input);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function show($id)
    {
        $video = Video::find($id);
        if (is_null($video)) {
            return $this->sendError('Video not found.');
        }
        return $this->sendResponse($video, 'Video retrieved successfully.');
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
