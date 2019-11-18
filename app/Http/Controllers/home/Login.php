<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    public function show()
    {
        return view('home.login.login');
    }
}
