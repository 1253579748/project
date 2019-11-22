<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelType extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'type_id'];
    //
    public function getModelAll()
    {
        
    }  

    public function Spec()
    {
        return $this->hasMany('App\Spec', 'type_id', 'id');
    }

    public function AttriBute()
    {
        return $this->hasMany('App\AttriBute', 'model_id', 'id');
    } 

    //删除模型时，删除对应的关联
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($model){
            $model->Spec()->delete();
            $model->AttriBute()->delete();
        });
    }

}
