<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelType;
use App\Spec;
use App\SpecItem;
use Illuminate\Support\Facades\DB;
use App\ModelType as ModelDB;

class Model extends Controller
{
    public function list(Request $request)
    {

        $echostr = $request->search;//不知道为什么没有也不会报错

        $model = ModelType::where('name',$echostr)->orWhere('name','like','%'.$echostr.'%')->get();

        return view('admin.model.list', [
                'model' => $model
            ]);
    }

    public function add()
    {
        return view('admin.model.add');
    }

    public function edit($id)
    {

        if (!is_numeric($id)) {
            return [];
        }

        $model = ModelDB::with(['Spec', 'Spec.SpecItem', 'AttriBute'])->find($id);
        if (!$model) return ['msg'=>'没有相关模型！'];


        // dump($model->toArray());

        return view('admin.model.edit', [
                'model' => $model->toArray()
            ]);
    }   


    public function addSpecItem(Request $request)
    {
        $this->validate($request, [
            'spec_id' => 'required|numeric',
            'val' => 'required'
        ]);

        $spec_item = new SpecItem;
        $spec_item->spec_id = $request->spec_id;
        $spec_item->item = $request->val;
        $spec_item->save();          

    }

    public function delSpecItem(Request $request)
    {
        $this->validate($request, [
            'spec_item_id' => 'required|numeric'
        ]);

        dump($request->spec_item_id);
        SpecItem::destroy($request->spec_item_id);          

    }

    public function store(Request $request)
    {       
        dump( $request->all() );

        $type_id = ModelType::create([
                'name' => $request->name
            ])->id;



        foreach($request->all()['spec'] as $v) {
            $arr = explode(',', $v);
            $spec_id = Spec::create([
                    'type_id' => $type_id,
                    'name' => $arr[0]
                ])->id;
            $tmp = [];
            foreach($arr as $k=>$v) {
                if ($k == 0) continue;
                $tmp[$k]['spec_id'] = $spec_id;
                $tmp[$k]['item'] = $v; 
            }
            Spec::find($spec_id)
                ->SpecItem()
                ->createMany($tmp);

        }

        foreach($request->all()['attr'] as $k=>$v){
            $arr = explode(',', $v);
            $tmp = [];
            foreach($arr as $key=>$v) {
                if ($key == 0) {
                    $tmp[$k]['attr_name'] = $v;
                } else {
                    $tmp[$k]['model_id'] = $type_id;
                    $tmp[$k]['attr_value'] = !isset($tmp[$k]['attr_value']) ? $v : $tmp[$k]['attr_value'].'_'.$v;    
                }
            }

            $data[] = $tmp[$k];
        }

        ModelType::find($type_id)
            ->Attribute()
            ->createMany($data);

    }

    public function del(Request $request) {
        $this->validate($request, [
            'id' => 'required|numeric'
        ]);       
        ModelType::destroy($request->id);
        dump($request->all());
    }
}
