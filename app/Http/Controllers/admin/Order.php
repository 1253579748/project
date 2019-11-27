<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order as OrderModel;
use App\Express;
use DB;

class Order extends Controller
{
    //
    public function add()
    {   

    }

    public function list()
    {

        $model = DB::table('orders');


        if (isset($_GET['status']) && is_numeric($_GET['status'])) {

            $model->whereRaw('status=?',[$_GET['status']]);
        } else {

            $model->where([['status', '!=', '0'], ['status', '!=', '5']]);//默认作废和历史订单不查询
        }

        if (isset($_GET['odd'])) {

            $model->whereRaw('id like ?', ['%'.$_GET['odd'].'%']);
        }

        //筛选下单时间
        if (isset($_GET['start_at'])) {

            $model->whereRaw('UNIX_TIMESTAMP(created_at) >= UNIX_TIMESTAMP(?)', [$_GET['start_at'].' 00:00:00']);
        }

        if (isset($_GET['stop_at'])) {

            $model->whereRaw('UNIX_TIMESTAMP(created_at) <= UNIX_TIMESTAMP(?)', [$_GET['stop_at'].' 00:00:00']);
        }
      

        $order = $model->get();

        $showStatus = [
            0 => '已作废',
            1 => '未付款',
            2 => '待发货',
            3 => '已发货',
            4 => '已完成',
            5 => '历史订单'
        ];

        // dd($orders);
        return view('admin/order/list', [
                'order' => $order,
                'showStatus' => $showStatus
            ]);
    }

    public function sendOut(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|numeric',
            'express' => 'required',
            'odd' => 'required'
        ]);

        $express = new Express;
        $express->order_id = $request->order_id;
        $express->name = $request->express;
        $express->odd = $request->odd;
        $express->description = $request->message ?? '';

        $express->save();

        dump($request->all());
    }

    function changeStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|numeric|between:0,5',
            'order_id' => 'required|numeric'
        ]);

        $id = $request->order_id;
        $status = $request->status;

        //为零时表示需要作废此订单
        if ($status == 0) {
            OrderModel::where('id', $id)
                ->where('status', 1)
                ->decrement('status');
            return [];
        }

        OrderModel::where('id', $id)
            ->where('status', $status-1) //验证订单状态必须循序改变
            ->increment('status');
    }



    function getOrderDetail($id)
    {
        if (!is_numeric($id)) return ['msg'=>'未查询到订单'];


        $order = OrderModel::where('id', $id)
                    ->with(['OrderDetail'])
                    ->first();

        if (!$order) return ['msg'=>'未查询到订单'];

        $result = $order->toArray();

        return $result;


    }



    function getExpress($id)
    {
        if (!is_numeric($id)) return ['msg'=>'未查询到订单'];


        $order = OrderModel::where('id', $id)
                    ->with(['Express'])
                    ->first();

        if (!$order) return ['msg'=>'未查询到订单'];

        $express = $order->toArray()['express'];

 
        $odd = $express['odd'];//订单编号


        $host = "https://wuliu.market.alicloudapi.com";//api访问链接
        $path = "/kdi";//API访问后缀
        $method = "GET";
        $appcode = "4f7e1a4c70774f83b4e178f5bb69cf0e";//替换成自己的阿里云appcode
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "no=".$odd;  //参数写在这里//订单编号
        $bodys = "";
        $url = $host . $path . "?" . $querys;//url拼接

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        //curl_setopt($curl, CURLOPT_HEADER, true); 如不输出json, 请打开这行代码，打印调试头部状态码。
        //状态码: 200 正常；400 URL无效；401 appCode错误； 403 次数用完； 500 API网管错误
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        echo(curl_exec($curl));

    }

}
