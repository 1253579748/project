<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\ModelType;
use App\Spec;
use App\AttriBute;
use App\GoodsSpec;
use App\Goods as GoodsModel;
use App\GoodsImg;
use App\AttrItem;
use Illuminate\Support\Facades\Storage;
use App\GoodsDetail;

class Goods extends Controller
{
    
    public function add()
    {
        $type = Type::get()->toArray();
        $model = ModelType::get()->toArray();

        return view('admin.goods.add', [
                'type'=>$type, 
                'model'=>$model
            ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'type_id' => 'required|numeric',
            'model_id' => 'required|numeric',
            'price' => 'required|numeric',
            'img' => 'file'
        ]);

        $goods = new GoodsModel;
        $id = $goods->create([
                'name' => $request->name,
                'type_id' =>$request->type_id,
                'model_id' => $request->model_id,
                'price' => $request->price,
                'description' => $request->description ?? ''
        ])->id;

        $tmp = [];
        if (is_array($request->attr)) {
            foreach ($request->attr as $k => $v) {
                $arr = explode(',', $v);
                $tmp[$k] = [
                    'goods_id' => $id,
                    'attribute_id' => $arr[0],
                    'value' => $arr[1]
                ];
            }

            AttrItem::insert($tmp);
        }

        

        $goods_img = new GoodsImg();
        $goods_img->url = $request->img->store('goods', 'public');
        $goods_img->goods_id = $id;
        $goods_img->save();

        $spec = [];
        if (is_array($request->spec)) {
            foreach ($request->spec as $k => $v) {
                $arr = explode(',', $v);
                $key = '';
                foreach ($arr as $kk => $vv) {
                    if ($kk >= count($arr)-3) break;
                    $key = $key.'_'.$vv;
                }
                $key = trim($key, '_');
                $spec[$k] = [
                        'goods_id' => $id,
                        'key' => $key,
                        'price' => $arr[count($arr)-3],
                        'store_count' => $arr[count($arr)-2],
                        'key_name' => trim($arr[count($arr)-1], '_')
                    ];
            }

            $goods->find($id)
                ->GoodsSpec()
                ->createMany($spec);
            
        }


    }

    public function list(Request $request)
    {
        // $goods = GoodsModel::paginate(5);
        $echostr = $request->search;//不知道为什么没有也不会报错

        $goods = GoodsModel::where('name',$echostr)->orWhere('name','like','%'.$echostr.'%')->paginate(5)->appends($request->all());
        $showStatus = [1=>'上市', 2=>'下架'];
        return view('admin.goods.list', [
                'goods' => $goods,
                'showStatus' => $showStatus
            ]);
    }


    public function editImg($id)
    {
        $goods = GoodsModel::where('id', $id)
                    ->with(['GoodsImg'])
                    ->first();

        if (!$goods) return redirect('/admin/goods/list');

        return view('admin.goods.editImg', [
                'goods' => $goods
            ]);
    }

    public function editGoods($id)
    {

        $goods = GoodsModel::where('id', $id)
                    ->with(['GoodsSpec', 'AttrItem', 'AttrItem.AttriBute'])
                    ->first();

        if (!$goods) return redirect('/admin/goods/list');

        return view('admin.goods.editGoods', [
                'goods' => $goods->toArray()
            ]);
    }

    //检测修改是否可用
    public function editCheck(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'id' => 'required|numeric',
            'status' => 'required|numeric',
            'spec' => 'required',
            'attr' => 'required'
        ]);

        $goods = GoodsModel::find($request->id);

        if (!$goods) return response()->json(['msg'=>'没有这个商品'], 403);

        $goods->status = $request->status;
        $goods->name = $request->name;
        $goods->price = $request->price;
        if ($request->description) $goods->description = $request->description;
        $goods->save();

        if (is_array($request->spec)) {
            //修改规格价格
            foreach ($request->spec as $k=>$v) {
                $goods_spec = GoodsSpec::find($v[0]);
                $goods_spec->price = $v[1];
                $goods_spec->store_count = $v[2];
                $res = $goods_spec->save();
            }            
        }

        if (is_array($request->attr)) {
            //修改属性
            foreach ($request->attr as $k=>$v) {
                if ($v[1] == '' && $v[0] == '') continue;
                $goods_attr = AttrItem::where('goods_id', $request->id)
                    ->where('attribute_id', $v[0])
                    ->first();

                $goods_attr->value = $v[1] ?? '';
                $res = $goods_attr->save();

            }            
        }

    }

    //删除商品
    public function delGoods($id)
    {

        GoodsModel::where('id', $id)
                    ->first()
                    ->delete();
        return back();
    }

    //处理商品推荐
    public function push($id)
    {
        $goods = GoodsModel::where('id', $id)->first();
        if ($goods->is_push) $status = 0;
        if (!$goods->is_push) $status = 1;
        $model = GoodsModel::find($id);

        if (!$model) return response()->json(['msg'=>'商品不存在'], 403);

        $model->is_push = $status;
        $model->save();
        return $status;
    }

    //编辑商品详情图
    public function editDetail($id)
    {

        $goods = GoodsModel::where('id', $id)
                    ->with(['GoodsDetail'])
                    ->first();

        return view('admin.goods.editDetail', [
                'goods' => $goods
            ]);

    }

    //保存详情图片
    public function storeDetail(Request $request)
    {
        $this->validate($request, [
            'goods_id' => 'required|numeric',
            'img' => 'file'
        ]);
        $count = GoodsDetail::where('goods_id', $request->goods_id)->count();//当前商品的详情图片数量
        $goods_img = new GoodsDetail();
        $goods_img->img = $request->img->store('goods_detail', 'public');
        $goods_img->goods_id = $request->goods_id;
        $goods_img->position = $count+1;
        $goods_img->save();
    }

    public function updateDetail(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'who' => 'required',
            'val' => 'required'
        ]);
        $info = GoodsDetail::find($request->id);

        if ($request->who == 'position') {
            $info->position = $request->val;
        }
        if ($request->who == 'description') {
            $info->description = $request->val;
        } 

        $info->save();       
    }

    //删除详情图
    public function delDetail(Request $request)
    {
        GoodsDetail::destroy($request->id);
        $disk = Storage::disk('public');
        $disk->delete($request->url);

    }



    public function storeImg(Request $request)
    {
        $this->validate($request, [
            'goods_id' => 'required|numeric',
            'url' => 'request|max:255',
            'img' => 'file'
        ]);

        $goods_img = new GoodsImg();
        $goods_img->url = $request->img->store('goods', 'public');
        $goods_img->goods_id = $request->goods_id;
        $goods_img->save();       
    }

    public function delImg(Request $request)
    { 

        GoodsImg::destroy($request->id);
        $disk = Storage::disk('public');
        $disk->delete($request->url);

    }
}
