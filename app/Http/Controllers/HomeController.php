<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response(
            view(
                'home',
                [
                    'name' => Auth::user()->name,
                    'search' => '',
                    'isAdmin' => Auth::user()->isAdmin
                ]
            ),
            200,
            ['api_token' => Auth::user()->api_token]
        );
    }
}
