<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    protected $table = 'spec';

    public $timestamps = false;

    protected $fillable = ['name', 'type_id'];
    //
    public function specItem()
    {
        return $this->hasMany('App\SpecItem');
    }

    //删除规格时，删除对应的关联
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($spec){
            $spec->SpecItem()->destroy();
        });
    }

}
