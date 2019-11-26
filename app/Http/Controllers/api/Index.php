<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    //

    public function getJoke()
    {
        return file_get_contents('http://v.juhe.cn/joke/content/text.php?page=&pagesize=10&key=55de95f8ee7877afb61e97958b59a198');

    }
}
