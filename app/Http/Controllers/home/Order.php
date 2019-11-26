<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use DB;
class Order extends Controller
{

    public  function list(){
        
        return view('home.order.list');

    }
    public function addOrder(){
        echo '添加订单';
    }
}
