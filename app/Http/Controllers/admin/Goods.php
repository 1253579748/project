<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;

class Goods extends Controller
{
    
    public function add()
    {
        $type = Type::get()->toArray();
        // dump($type);
        return view('admin.goods.add', ['type'=>$type]);
    }

    public function store(Request $request)
    {
        dump($request->all());
    }
}
