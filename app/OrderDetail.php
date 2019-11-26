<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'order_details';

    public $timestamps = false;

    protected $fillable = ['goods_id', 'attribute_id', 'value'];
}
