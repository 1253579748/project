<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Type extends Model
{
    //
    public $timestamps = false;

    public function getTypeByPid($id = '')
    {
        return self::where('pid', '=', $id)
                    ->get();
    }

    public function getTypeAll()
    {
        $id = $this->getTypeByPid(0);

        $arr = $id->toArray();
        foreach($arr as $key => $val) {
            $arr[$key]['son'] = self::where('pid', '=', $val['id'])->get()->toArray() ;
            foreach($arr[$key]['son'] as $k=>$v) {
                $arr[$key]['son'][$k] = self::where('pid', '=', $v['id'])->get()->toArray() ;               
            }
        }      

        return $arr;
    }
    public function getType2($id){
        
        // if(Cache::has('type'.$id)){
        //     $ca = Cache::get('type'.$id);
        //     $array = json_decode($ca,true);
        //     return $array;
        // }
        //$this相当于调用的foreach循环里面的$v
        $arr = $this->where('pid',$id)->get()->toArray();
        $s = json_encode($arr);
        $c = Cache::add('type'.$id,$s,10);
        return $arr;
    }
}

