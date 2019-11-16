<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AttriBute;

class AttrItem extends Model
{
    //
    protected $table = 'goods_attr';

    public $timestamps = false;

    protected $fillable = ['goods_id', 'attribute_id', 'value'];

    public function AttriBute()
    {
        return $this->hasOne('App\AttriBute', 'id', 'attribute_id');
    }
}
