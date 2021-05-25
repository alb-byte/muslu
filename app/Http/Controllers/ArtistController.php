<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        return view(
            'artist',
            [
                'name' => Auth::user()->name,
                'id' => request('id'),
                'search' => '',
                'isAdmin' => Auth::user()->isAdmin
            ]
        );
    }
}
