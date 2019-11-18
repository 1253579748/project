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



}
