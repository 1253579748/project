<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GoodsImg;
use DB;

class Goods extends Model
{
    protected $fillable = ['name','type_id', 'model_id', 'price', 'description', 'id'];

    //关联商品图片
    public function GoodsImg()
    {
        return $this->hasMany('App\GoodsImg', 'goods_id', 'id');
    }

    public function GoodsDetail()
    {
        return $this->hasMany('App\GoodsDetail', 'goods_id', 'id');
    }

    //取一张图片
    public function GoodsImgOne()
    {
        return $this->hasOne('App\GoodsImg', 'goods_id', 'id');
    }

    //关联商品规格
    public function GoodsSpec()
    {
        return $this->hasMany('App\GoodsSpec', 'goods_id', 'id');
    }

    public function ModelType()
    {
        return $this->hasOne('App\ModelType', 'id', 'model_id');
    }

    //关联商品属性
    public function AttrItem()
    {
        return $this->hasMany('App\AttrItem', 'goods_id', 'id');
    }

    public function Comment()
    {
        return $this->hasMany('App\Comment', 'gid', 'id');
    }


    //删除商品时关联删除对应图片
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($goods){
            $goods->GoodsImg()->delete();
            $goods->AttrItem()->delete();
            $goods->GoodsSpec()->delete();
        });
    }





}
