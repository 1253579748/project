<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\ModelType;
use App\Spec;
use App\AttriBute;
use App\Goods as GoodsModel;
use App\GoodsImg;
use App\AttrItem;
use Illuminate\Support\Facades\Storage;

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


        dump($tmp);
        

        $goods_img = new GoodsImg();
        $goods_img->url = $request->img->store('goods', 'public');
        $goods_img->goods_id = $id;
        $goods_img->save();
        dump($request->all());
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
            dump($spec);

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

        return view('admin.goods.list', [
                'goods' => $goods
            ]);
    }


    public function editImg($id)
    {
        $goods = GoodsModel::where('id', $id)
                    ->with(['GoodsImg'])
                    ->first();
        return view('admin.goods.editImg', [
                'goods' => $goods
            ]);
    }

    public function editGoods($id)
    {

        $goods = GoodsModel::where('id', $id)
                    ->with(['GoodsSpec', 'AttrItem', 'AttrItem.AttriBute'])
                    ->first();

        return view('admin.goods.editGoods', [
                'goods' => $goods->toArray()
            ]);
    }

    public function editCheck(Request $request)
    {
        dump($request->all());

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'id' => 'required|numeric'
        ]);

        $goods = GoodsModel::
                    update($request->all());

        dump($goods);

        dump(GoodsModel::toSql(5));


    }

    public function delGoods($id)
    {

        GoodsModel::where('id', $id)
                    ->first()
                    ->delete();
        return back();
    }



    public function storeImg(Request $request)
    {
        $this->validate($request, [
            'goods_id' => 'required|numeric',
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
