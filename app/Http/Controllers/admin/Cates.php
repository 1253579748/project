<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Cates extends Controller
{
    
    public function Index()
    {
    	$data = DB::table('types')->get();
    	dump($data);
    	return view('admin.cates.index',['data'=>$data]);
    }


    public function create()
    {
		$data['name'] = $_POST['name'];
		if(empty($_POST['pid'])){
			$_POST['pid']=0;
			$data['pid']=$_POST['pid'];
			$data['path']='0'.',';
			
		}

		
		$res = DB::table('types')->insert($data);
		if($res){
			return "1";
		}else{
			return "2";
		}

    	
    	
    }
}
