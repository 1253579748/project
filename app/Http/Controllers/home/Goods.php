<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goods as GoodsModel;
use App\Type;
use App\ShopCart;
use App\GoodsSpec;

class Goods extends Controller
{
    //
    public function list(Request $request, $id)
    {
        if (!is_numeric($id)) {
            return redirect('/');
        } 

        $type = Type::where('id', $id)->first();//查出传过来的分类

        if (!$type) { //没查到数据跳转首页
            return redirect('/');
        }

        $typeSon = Type::where('pid', $id)->first();

        if ($type->pid === 0) { //type为顶级分类时
            $twoTypes = Type::where('pid', $type->id)->get()->toArray();//二级分类

            $twoTypeIds = array_column($twoTypes, 'id');//拿出id

            $threeTypes = Type::whereIn('pid', $twoTypeIds)->get()->toArray();//三级分类

        } elseif (!$typeSon) { //type没有子分类时

            $threeTypes = Type::where('pid', $type->pid)->get()->toArray();//三级分类

            $oneId = Type::where('id', $type->pid)->select('pid')->first()->pid;

            $twoTypes = Type::where('pid', $oneId)->get()->toArray();

        } else { //type为二级分类时

            $twoTypes = Type::where('pid', $type->pid)->get()->toArray();

            // $twoTypeIds = array_column($twoTypes, 'id');

            $threeTypes = Type::where('pid', $id)->get()->toArray();
        }

        $order = ['id', 'asc'];//默认排序

        if ($request->buy == true) {
            $order = ['buy_count', 'asc'];
        } elseif (key_exists('buy', $request->all())) {
            $order = ['buy_count', 'desc'];
        }

        if ($request->look == true) {
            $order = ['look_count', 'asc'];
        } elseif (key_exists('look', $request->all())) {
            $order = ['look_count', 'desc'];
        }


        if ($request->money == true) {
            $order = ['price', 'asc'];
        } elseif ( key_exists('money', $request->all()) ) {
            $order = ['price', 'desc'];
        }


        if (!$typeSon) { //表示传过来的为三级分类id
            $goods = GoodsModel::where('type_id', $id)
                ->with(['GoodsImgOne'])
                ->where('status', '!=', 2)
                ->orderBy($order[0], $order[1])
                ->paginate(16)
                ->appends($request->all());

        } elseif($type->pid === 0) { //顶级分类商品显示
            $threeTypeIds = array_column($threeTypes, 'id');
            $goods = GoodsModel::whereIn('type_id', $threeTypeIds)
                ->where('status', '!=', 2)
                ->with(['GoodsImgOne'])
                ->orderBy($order[0], $order[1])
                ->paginate(16)
                ->appends($request->all());
            
        } else { //二级分类下商品显示
            $showTypes = Type::where('pid', $id)->get()->toArray();
            $showIds = array_column($showTypes, 'id');
            $goods = GoodsModel::whereIn('type_id', $showIds)
                ->where('status', '!=', 2)
                ->with(['GoodsImgOne'])
                ->orderBy($order[0], $order[1])
                ->paginate(16)
                ->appends($request->all());
        }

        //推荐位商品
        $push = GoodsModel::where('is_push', '1')
            ->with(['GoodsImgOne'])
            ->limit(3)
            ->get()
            ->toArray();


        return view('home.goods.list', [
                'twoTypes' => $twoTypes,
                'threeTypes' => $threeTypes,
                'goods' => $goods,
                'type' => $type,
                'push' => $push
            ]);
    }


    public function detail($id)
    {
        $goods = GoodsModel::where('id', $id)
            ->with(['GoodsSpec', 'AttrItem', 'AttrItem.AttriBute', 'GoodsImg', 'Comment', 'ModelType', 'ModelType.Spec', 'ModelType.Spec.SpecItem', 'ModelType.AttriBute', 'GoodsDetail'])
            ->first()
            ->toArray();

        //推荐位商品
        $push = GoodsModel::where('is_push', '1')
            ->with(['GoodsImgOne'])
            ->get()
            ->toArray();


        return view('home.goods.detail', ['goods'=>$goods, 'push'=>$push]);
    }

    public function addShopCar(Request $request)
    {

        $userId = session()->get('homeuserInfo.id'); //获取用户ID

        $result = Shopcart::where('key', $request->id)
            ->where('uid', $userId ?? 1)
            ->first();

        // dump($result);
        if ($result) {
            return response()->json([
                'msg' => '购物车已经有这件商品啦~'
            ], 200);
        }

        $info = GoodsSpec::where('id', $request->id)
            ->with(['Goods', 'Goods.GoodsImgOne'])
            ->first()
            ->toArray();


        //判断购买量是否超出库存
        if ($request->buy_count <= $info['store_count']) {
            $num = $request->buy_count;
        } else {
            $num = $info['store_count'];
        }

        $shopcart = new ShopCart;//购物车模型
        $shopcart->name = $info['goods']['name'];
        $shopcart->uid = $userId ?? 1; //暂无用户数据，
        $shopcart->gid = $info['goods_id'];
        $shopcart->key = $info['id']; //规格对应ID
        $shopcart->bar_code = $info['key_name'];//选择规格的名字
        $shopcart->price = $info['price'];
        $shopcart->num = $num;
        $shopcart->img = $info['goods']['goods_img_one']['url'];

        $shopcart->save();

        return response()->json([
            'msg' => '添加购物车成功'
        ], 200);
    }
}
