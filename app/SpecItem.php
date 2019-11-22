<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecItem extends Model
{
    //
    protected $table = 'spec_item';

    public $timestamps = false;

    protected $fillable = ['item', 'spec_id'];

}
