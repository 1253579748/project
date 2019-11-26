<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class shopcart extends Controller
{
    public function show()
    {
        $arr =DB::table('shop_cart')->get();
        $data =DB::table('shop_cart')
            ->where('checkbox', '=', '1')
            ->get();
        $aa = 0 ;
        foreach ($data as $k=>$v){
          $aa += $v->price * $v->num ;
        }
        return view('home.shopcart.show',(['arr'=>$arr,'aa'=>$aa]));
    }

    public function del(Request $request)
    {
        $id = $request->id;

        $del =DB::table('shop_cart')->where('id', '=', $id)->delete();

        if ($del){
            return redirect('/home/shopcart/show');
        }else{
            echo "alert('删除失败')";
            return redirect('/home/shopcart/show');
        }
    }
    public function dels(Request $request)
    {
       $id = $request->id;
        $arr =DB::table('shop_cart')
            ->wherein('id', $id)
            ->delete();
        dump($arr);

}


    public function jia(Request $request)
    {

        $num = $request->num;
        $id = $request->id;
        $arr1 =DB::table('shop_cart')
            ->where('id', '=', $id)
            ->first();
        $key = $arr1->key;

        $arr2 =DB::table('spec_goods_price')
            ->where('id', '=', $key)
            ->first();
        $store_count =  $arr2->store_count;
        if ($num >= $store_count){
            echo "<script>alert('数量已经达到最大库存');</script>";
            $arr = DB::table('shop_cart')
                ->where('id', '=', $id)
                ->update([
                    'num'=>$store_count
                ]);
            return redirect('/home/shopcart/show');
        }
        $num++;
        $arr = DB::table('shop_cart')
            ->where('id', '=', $id)
            ->update([
                'num'=>$num
            ]);
        if ($arr){
            return redirect('/home/shopcart/show');
        }else{
            echo "alert('数量已经达到最大库存')";
            return redirect('/home/shopcart/show');
        }
    }

    public function jian(Request $request)
    {
        $id = $request->id;
        $num = $request->num;

        if ($num == 1){
            echo "alert('亲,不能在少了')";
            return redirect('/home/shopcart/show');
        }

        $num--;
        $arr = DB::table('shop_cart')
            ->where('id', '=', $id)
            ->update([
                'num'=>$num
            ]);
        if ($arr){
            return redirect('/home/shopcart/show');
        }else{
            echo "alert('数量已经达到最大库存')";
            return redirect('/home/shopcart/show');
        }
    }

    public function checkbox(Request $request)
    {
       $id = $request->id;
       $arr =DB::table('shop_cart')
           ->where('id', '=', $id)
           ->first();
       $checkbox = $arr->checkbox;

       if ($checkbox == 1){
           DB::table('shop_cart')
               ->where('id', '=', $id)
               ->update(['checkbox'=>0]);
       }else{
           DB::table('shop_cart')
               ->where('id', '=', $id)
               ->update(['checkbox'=>1]);
       }
        return redirect('/home/shopcart/show');
    }

    public function sub(Request $request)
    {
        $id =$request->id;
        $arr =DB::table('shop_cart')
            ->wherein('id', $id)
            ->get();

        $aa = 0 ;
        foreach ($arr as $k=>$v){
            $aa += $v->price * $v->num ;
            $uid = $v->uid;
        }
        $data =DB::table('address')
            ->where('uid', '=', $uid)
            ->get();
        dump($arr);
//        $id =serialize($id);
        dump($id);
        return view('home.shopcart.list',['arr'=>$arr,'aa'=>$aa,'data'=>$data,'id'=>$id]);
    }


    //确认购物车 提交到订单控制器
    public function data(Request $request)
    {
        //地址id
        $addid =$request->addid;


        //购物车id   数组
        $cartid =$request->cartid;

    }
}
