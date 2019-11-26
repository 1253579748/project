<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function Role_Has_Permissions()
    {
        return $this->hasMany('App\Role_Has_Permissions','role_id', 'id');
    }
}
