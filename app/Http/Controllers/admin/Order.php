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

        $config = array (   
                //应用ID,您的APPID。
                'app_id' => "2016101500689566",

                //商户私钥
                'merchant_private_key' => "MIIEpAIBAAKCAQEAsqflgqiBl782pdR8pxtae361heGPRv1b1hiR9XrIaf+eka3P3DRbCiHF/2OpnGfSmaZ6U20+40N8RRksE2gY4lN7ECkd2wed7qPQLnoMwlAmm73g3Sc3OtQZH9gaSaP5Qx77qcS4TNeYFryf5wO9v17450ho0MDGrll0ULjX7X9oQJQARCQe2eiLuCfP/oWKfkk0dzfyB5npFIWLvagZyxO9ELPXqB/IFRPKGNuIBCvqUkc3IRki7VhyLs83KwYMpO6dFftX8UazCWy5JjThVFuzsBqM1WCZRcuA8aY+hp+tG01EarTRR9ez206kFRXLL1AcDnQ9t2wVu8LMn7gMZwIDAQABAoIBAGoYKMSx2tvJ0uMhz7DRHqet9JCABb0Lomj/CFa2RqQkB//NL14+vT3EFrf2cHgQc9GJOqWmf60om3jRXQpdTEHDf5Z2RGOZH2HjaDLhiggu3u6oEQxkSHkoEY+Gnv3SYalJkfwcdbI0af4+n9rprtohxUBcENq/UH2jY964ForTmQnHSF3EF7OH2Wd3na/YUup9iYMaoLs62i6abMov+3wjblbNAtdZKvrVX7HNyV0DuRgMYX+8cGfDyICGaH0WnxW9KDf90KZQJY3ntzU38ByGpSVz+w7j3doCDxDPlhHe16GimteQPQAfzDjfFYl/N2rvzdvFsp9TuICsojWLHpECgYEA9iVc3akDrzchyAVe/gdiIk48y50sSlwyScBJmGYkfgFuAOcUamc6h03KhFs8gMl03mK5jcj4VHWUbbY9KgYPjOQV8CeOeLD9ZfLj0TdDT33bRK08gFk7Yvaj/TmjU5M65zVv8x6YE8rxPkzMbFfkvlOc8SEqTv0jirjNIiDUTS8CgYEAuc7by58M9MxvtUp+bmUNfCBJAQEd1JVdjJKlhxS7Rz/dEGOrUlx53MAZ2Y/HEOS1zy2vDZ8aRhwEjoXne7adFGvrVj+kBbydLoBG8zOWlXjr4+CwQEJmUGCw9ocncDTopAhN3CceTv4CiZMyU/5Hux2FqFCmGqkPfsSK1lk0FkkCgYBoRAFnf72ozfDIWsYXUydVotCL66MkSJOgvAwwuyvAGHjxdvEl9V5MjD45/K/PWgbgYO96yOOwWzIpmyWjlHen1cIZPZhTNZ3RPqcUK5WeqZBlMgDL2YCXdiSXEoBF2br8z50BXjdLQw8Xtc5uInkpyh9T4Rmb5gzVKVzzlPZ5TwKBgQCsZdErmXRFAhY3qFmshhg/7hiuVOHfp4K39iydK9Aj6I5tMXz5GxJ6jsatRSjXdM134BRG2DNhj4du0bEY6TPPid4+FShTplBUn/K0nk3+e8aqlYQS60jRFRW8d2RRSNX9tDLBrI4Djsy95xRQOGNHqrmjlMi5fdkBrsx+2x9n+QKBgQDB7fWITI1OdnZg4tdm6tIVAWPxrbmXpA2d3TepIB0Q0S3HltWkqZf4tDPxfv0tp3JNZVpGnVVVpEujSVnJLuu7JW8Xg1Npi0CitxsNjWoOi1nSS6pjuqkjWkLY1jGAED9lWQFkkxwD0gT12VFGylQ42FZwQniJicLE9XfbTsUpJg==",
                
                //异步通知地址
                'notify_url' => "",
                
                //同步跳转
                'return_url' => "http://www.phpon.cn",

                //编码格式
                'charset' => "UTF-8",

                //签名方式
                'sign_type'=>"RSA2",

                //支付宝网关
                'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

                //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlSfDyuPyDEKHjaBaWWMrCI8ATajr8JvGa4yaVxvPGBRGbrecz/EaLVhzVUdDv9BbaJ+hQU7O56mTKK4D6r6L4oYyMoRS40dGTD3lQ8ZjSsOemLVHXr8bk7s8LDiky0s66FGz2rpMkDVxaphgPEaW5RzXr2S5yRs+I9qpcNVGLEaqNa5CAdFel9eYVtiVSdqBm4AVn9sG1aqCDbpBjwnNYPiGyohQeSMx3BXALSdfO1zK0d8guUuycawBL3QXWfd0ocj1ZqqFakD424Zk/hFHjoXiOZRXxfNsvuPqAKMrhSMYTxIQdwUCqoZ3E8PxrWtDapisCrtM/1VzzKI4jCOTlwIDAQAB",
        );

        //商户订单号，商户网站订单系统中唯一订单号，必填
        // $out_trade_no = trim($_POST['WIDout_trade_no']);
        $out_trade_no = '201911251990';

        //订单名称，必填
        // $subject = trim($_POST['WIDsubject']);
        $subject = '星心光商城在线支付';

        //付款金额，必填
        // $total_amount = trim($_POST['WIDtotal_amount']);
        $total_amount = 999;

        //商品描述，可空
        // $body = trim($_POST['WIDbody']);
        $body = '情趣内衣一件';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);

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
            'odd' => 'required|numeric'
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
