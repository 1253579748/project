<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class GoodsSpec extends Model
{
    //
    protected $table = 'spec_goods_price';

    public $timestamps = false;

    protected $fillable = ['good_id', 'key', 'price', 'store_count', 'key_name'];

    public function Goods()
    {
        return $this->hasOne('App\Goods', 'id', 'goods_id');
    }

}
