<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Video;
use App\UserVideo;

class VideoController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
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
    public function show($id)
    {
        $video = Video::where('id',$id)->first();
        $video["saved"] = UserVideo::where(['video_id' => $video->id, 'user_id' => auth()->user()->id])->exists();

        if (is_null($video)) {
            return $this->sendError('Video not found.');
        }
        return $this->sendResponse($video, 'Video retrieved successfully.');
    }
}
