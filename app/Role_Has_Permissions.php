<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_Has_Permissions extends Model
{
    protected $table = 'role_has_permissions';

    public function Permissions()
    {
        return $this->hasMany('App\Permissions', 'id', 'permission_id');
    }
}
