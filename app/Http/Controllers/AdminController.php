<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view(
            'admin',
            [
                'name' => Auth::user()->name,
                'album' => request('album'),
                'search' => '',
                'isAdmin' => Auth::user()->isAdmin
            ]
        );
    }
}
