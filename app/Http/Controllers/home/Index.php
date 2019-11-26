<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use DB;
use App\Goods;
class Index extends Controller
{
    
    public function index()
    {
    	//查询轮播图
        //查询分类


        $oneTypes = Type::where('pid', '0')->get()->toArray();
        $oneTypeIds = array_column($oneTypes, 'id');

        $typeGoods = [];
        foreach($oneTypeIds as $k=>$id) {
            $twoTypes = Type::where('pid', $id)->get()->toArray();
            if ($twoTypes) {

                $twoTypeIds = array_column($twoTypes, 'id');
                $threeTypes = Type::whereIn('pid', $twoTypeIds)->get()->toArray();
                $threeTypeIds = array_column($threeTypes, 'id');
                $goods = Goods::whereIn('type_id', $threeTypeIds)->with(['GoodsImgOne'])->limit(8)->get();

                $typeGoods[$id] = $twoTypes;//二级分类
                $typeGoods[$id]['goods'] = $goods->toArray();//顶级分类的商品
                $typeGoods[$id]['topName'] = $oneTypes[$k]['name'];//顶级分类名
            }
        }
        // dd($typeGoods); 

       
        return view('home.index.homeIndex', [
                'typeGoods' => $typeGoods
            ]);

    }

    public function index2()
    {
        return view('home.user.frame');
    }

    public function logout()
    {
        //退出登录，删除session
        session()->forget('homeisLogin');
        session()->forget('homeuserInfo');
        return redirect('/home/login');
    }
}
