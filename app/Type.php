<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public $timestamps = false;

    public function Goods()
    {
        $this->hasMany('App\Goods', 'type_id', 'id');
    }

    
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
}
