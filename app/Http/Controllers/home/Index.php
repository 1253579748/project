<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    //
    public function index()
    {
        return view('home.index.index');
    }

    public function index2()
    {
        return view('home.user.frame');
    }
}
