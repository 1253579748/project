<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Has_Roles extends Model
{
    protected $table = 'user_has_roles';

    public function Role()
    {
        return $this->hasMany('App\Role', 'id', 'role_id');
    }
}
