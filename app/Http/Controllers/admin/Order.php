<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Order extends Controller
{
    //
    public function add()
    {
        return view('admin/order/add');
    }
}
