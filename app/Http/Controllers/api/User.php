<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class User extends Controller
{
    //
    public function getId($name)
    {
        $info = DB::table('user')
            ->where('username', $name)
            ->first();

        return $info;
    }
}
