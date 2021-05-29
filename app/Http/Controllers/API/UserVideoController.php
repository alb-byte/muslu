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
        $items = UserVideo::where('user_videos.user_id', auth()->user()->id)
            ->join('videos', 'videos.id', '=', 'user_videos.video_id')
            ->join('artists', 'videos.artist_id', '=', 'artists.id')
            ->select('videos.*', 'artists.name as artistName')
            ->get();
        return $this->sendResponse($items, 'Albums retrieved successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $item = UserVideo::create(["user_id" => $request->user()->id, "video_id" => $input["id"]]);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    public function destroy($id)
    {
        $item = UserVideo::where(["user_id" => auth()->user()->id, "video_id" => $id])->delete();
        return $this->sendResponse($item, 'Album deleted successfully.');
    }
}
