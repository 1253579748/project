<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order as OrderModel;

class Order extends Controller
{
    //
    public function add()
    {
        return view('admin/order/add');
    }

    public function list()
    {
        $orders = OrderModel::get();

        dump($orders);
        return view('admin/order/list', [
                'order' => $orders
            ]);
    }
}
