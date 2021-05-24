<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('video', ['name' => Auth::user()->name, 'video' => request('video'), 'search' => '']);
    }
}
