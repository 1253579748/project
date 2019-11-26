<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
class Finance extends Controller
{
    //

    public function orderPay(Request $request)
    {
        if (!is_numeric($request->order)) return [];

        $order = Order::where('id', $request->order)->with(['OrderDetail'])->first();//查找订单

        
        if ($order) {

            if ($order->status !== 1) {
                return ['msg'=>'请检查订单状态是否待支付！'];
            }

            $body = '';
            foreach ($order->toArray()['order_detail'] as $k=>$v) {
                $body .= '+'.$v['goods_name'].':'.$v['key_name'];
            }
        } else {
            return ['msg'=>'没有相关订单信息！'];
        }


        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($request->order);

        //订单名称，必填
        $subject = '星心光商城订单支付';

        //付款金额，必填
        $total_amount = $order->total;

        //商品描述，可空
        // $body = trim($_POST['WIDbody']);
        $body = trim($body, '+');

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService(config('pay'));//传入配置文件

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,config('pay.return_url'), config('pay.notify_url'));

        //输出表单
        var_dump($response);

    }

    public function payNotify()
    {
        $arr = $_POST;
        $alipaySevice = new \AlipayTradeService(config('pay')); 
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);



        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];

            $order = Order::find($_POST['out_trade_no']);//查找订单

            $order->status = 2;
            $order->save();

            //付款的金额不等于数据库的订单金额
            if ((!$order) || !($order->total == $_POST['total_amount'])) {
                echo 'fail';
                return 'fail';
            } 

            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序
                if ($order->status === 1) {
                    $order->status = 2;
                    $order->save();
                }
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                if ($order->status === 1) {
                    $order->status = 2;
                    $order->save();
                }
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序            
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success"; //请不要修改或删除
            // var_dump($_POST);
        }else {
            //验证失败
            echo "fail";

        }


    }
}
