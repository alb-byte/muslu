<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\UserVideo;
class UserVideoController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $items = UserVideo::all();
        return $this->sendResponse($items->toArray(), 'Albums retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $item = UserVideo::create(["user_id"=>$request->user()->id,"video_id"=>$input["id"]]);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function show($id)
    {
        $item = UserVideo::find($id);
        if (is_null($item)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($item->toArray(), 'Album retrieved successfully.');
    }
    public function update(Request $request, UserVideo $item)
    {
        $input = $request->all();
        $item->name = $input['name'];
        $item->save();
        return $this->sendResponse($item->toArray(), 'Product updated successfully.');
    }
    public function destroy(UserVideo $item)
    {
        $item->delete();
        return $this->sendResponse($item->toArray(), 'Album deleted successfully.');
    }
}