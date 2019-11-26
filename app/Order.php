<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    
    public function Express()
    {
        return $this->hasOne('App\Express', 'order_id', 'id');
    }

    public function OrderDetail()
    {
        return $this->hasMany('App\OrderDetail', 'order_id', 'id');
    }
}
