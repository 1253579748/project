<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Has_Permissions extends Model
{
    protected $table = 'user_has_permissions';

    public function Permissions()
    {
        return $this->hasMany('App\Permissions', 'id', 'permission_id');
    }
}
