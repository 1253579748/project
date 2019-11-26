<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    public function User_Has_Roles()
    {
        return $this->hasMany('App\User_Has_Roles','user_id', 'id');
    }
}
