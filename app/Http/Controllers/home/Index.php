<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    //
    public function index()
    {
        return view('home.index.index');
    }

    public function index2()
    {
        return view('home.user.frame');
    }

    public function logout()
    {
        //退出登录，删除session
        session()->forget('homeisLogin');
        session()->forget('homeuserInfo');
        return redirect('/home/login');
    }
}
