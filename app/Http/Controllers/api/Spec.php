<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelType;
use App\Spec as SpecModel;
use App\AttriBute;

class Spec extends Controller
{


    public function getSpec($id)
    {

        $spec = ModelType::where('id', $id)
                ->with(['Spec', 'Spec.SpecItem'])
                ->get()
                ->toArray();
        return $spec;     
    }

    public function getAttr($id)
    {
        $attr = AttriBute::where('model_id', $id)
                    // ->with(['AttrItem'])
                    ->get()
                    ->toArray();
        foreach ($attr as $k=>$v){
            $attr[$k]['attr_item'] = explode('_', $v['attr_value']);
        }
        // dump($attr);
        return $attr;
    }
}
