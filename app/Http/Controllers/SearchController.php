<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view(
            'search',
            [
                'name' => Auth::user()->name,
                'search' => request('data'),
                'isAdmin' => Auth::user()->isAdmin
            ]
        );
    }
}
