<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Users;

class UserRole extends Model
{
    protected $table = 'user_has_roles';

    public function Users()
    {
        return $this->hasMany('App\Users', 'id', 'user_id');
    }
}
