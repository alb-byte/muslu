<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\UserSong;
class UserSongController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = UserSong::all();
        return $this->sendResponse($items->toArray(), 'Albums retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $item = UserSong::create($input);
        return $this->sendResponse($item->toArray(), 'Album created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = UserSong::find($id);
        if (is_null($item)) {
            return $this->sendError('Album not found.');
        }
        return $this->sendResponse($item->toArray(), 'Album retrieved successfully.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSong $item)
    {
        $input = $request->all();
        $item->name = $input['name'];
        $item->save();
        return $this->sendResponse($item->toArray(), 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSong $item)
    {
        $item->delete();
        return $this->sendResponse($item->toArray(), 'Album deleted successfully.');
    }
}