<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Goods extends Controller
{
    //
    public function list()
    {
        return view('home.goods.list');
    }
}
