<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type as TypeModel;

class Type extends Controller
{
    public function getType($id)
    {
        $type = new TypeModel;
        $types = $type->getTypeByPid($id);

        return $types;
    } 

    public function getTypeAll()
    {
        $type = new TypeModel;
        $types = $type->getTypeAll();
        return $types;
    }   


}