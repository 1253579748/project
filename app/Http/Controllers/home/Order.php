<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\Order as OrderModel;
use App\Goods;
use DB;
class Order extends Controller
{
    //个人中心订单显示
    public  function list(){

        $orders = OrderModel::where('user_id', session()->get('homeuserInfo.id'))
                    ->with('OrderDetail')
                    ->get()
                    ->groupBy('status');

 
        $showStatus = [
            0 => '已作废',
            1 => '未付款',
            2 => '待发货',
            3 => '已发货',
            4 => '已完成',
            5 => '历史订单'
        ];

        return view('home.order.list',[
                'orders'=>$orders->toArray(),
                'showStatus'=>$showStatus
            ]);

    }
       //确认购物车 提交到订单控制器
    public function addOrder(Request $request)
    {

        $this->validate($request, [

            'addid' => 'required',
        ], [
            'required' => ':attribute未选择',
        ], [
            'addid' => '地址',
        ]);
        //地址id
        $addid =$request->addid;
        //购物车id   数组
        $cartid =$request->cartid;

        $uadd = DB::table('address')->where('id',$addid)->first();
        $res = DB::table('shop_cart')->wherein('id',$cartid)->get();
        $order['getman'] = $uadd->username;
        $order['phone'] = $uadd->phone;
        $order['address'] = $uadd->address.$uadd->addrinfo;
        $order['user_id'] = $uadd->uid;
        $order['created_at'] = date('Y-m-d H:i:s',time());
        $order['updated_at'] = date('Y-m-d H:i:s',time());
        $order['total'] = 0 ;
        dump($uadd);
        dump($res);

        //开启事务
        DB::beginTransaction();

            foreach ($res as $k => $v) {
                $order['total'] +=$v->price*$v->num;
               
            }
            // 返回插入订单的ID号 
            $idd = DB::table('orders')->insertGetId($order);
           
            foreach ($res as $k => $v) {

                //商品ID
                $gid = $v->gid;
                //商品规格
                $key = $v->key;
                //规格数量
                $num = $v->num;
                //规格信息
                $gnum = DB::table('spec_goods_price')->where('id',$v->key)->first();               
                //判断是否大于库存
                if($gnum->store_count - $num >=0){
                    $store = $gnum->store_count - $num;
                    DB::table('spec_goods_price')->where('id',$key)->update(['store_count'=>$store]);
                    DB::table('goods')->where('id',$gid)->update(['buy_count'=>$num]);
                    DB::table('shop_cart')->where('id',$v->id)->delete();                    
                }else{
                    return redirect('/home/shopcart/show')->with('error','有商品超出库存，请重新修改购物车购买数量');
                }
                $order_details['order_id'] = $idd;
                $order_details['goods_id'] = $v->gid;
                $order_details['goods_name']=$v->name;
                $order_details['spec_id'] = $key;
                $order_details['key_name'] = $v->bar_code;
                $order_details['goods_img'] = $v->img;
                $order_details['price'] = $v->price;
                $order_details['num'] = $num;
                $ord = DB::table('order_details')->insert($order_details);
            }
            
            DB::commit();
            //DB::rollBack();
            
            return redirect('home/personal/order');

            // ('home.order.addOrder',['id'=>$idd,'total'=>$order['total'],'res'=>$res,'uadd'=>$uadd]);

    }
}
