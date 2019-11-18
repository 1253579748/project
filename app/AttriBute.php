<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttriBute extends Model
{

    public $timestamps = false;

    protected $fillable = ['model_id', 'attr_name', 'attr_value'];

    protected $table = 'goods_attribute';

    // public function AttrItem()
    // {
    //     return $this->hasMany('App\AttrItem', 'attribute_id', 'id');
    // }


}
