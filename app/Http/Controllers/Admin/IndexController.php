<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('Admin.index');
    }

    public function logout()
    {
        //退出登录，删除session
        session()->forget('isLogin');
        session()->forget('userInfo');
        return redirect('/Admin/login');
    }
}
