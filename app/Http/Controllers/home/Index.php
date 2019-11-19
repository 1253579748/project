<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Index extends Controller
{
    //
    public function index()
    {
    	//查询轮播图
    	$arr= DB::table('banner_item')->get();

        return view('home.index.index',['arr'=>$arr]);
    }

    public function index2()
    {
        return view('home.user.frame');
    }
}
