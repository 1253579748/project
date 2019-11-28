<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    const UPDATED_AT = null;

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'uid');
    }
}
