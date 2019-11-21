<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use DB;
class Index extends Controller
{
    
    public function index()
    {
    	//查询轮播图
    	$banner= DB::table('banner_item')->get();
        //查询分类
        
        $type_index = Type::where('pid', 0)->get();
       
        return view('home.index.index',['banner'=>$banner,'data'=>$type_index]);
    }

    public function index2()
    {
        return view('home.user.frame');
    }

    public  function order(){

        return view('home.order.list');

    }
}
