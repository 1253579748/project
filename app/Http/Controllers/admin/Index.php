<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Index extends Controller
{
    
    public function Index()
    {
    	return view('admin.index.index');

    }

    public function logout()
    {
        //退出登录，删除session
        session()->forget('isLogin');
        session()->forget('userInfo');
        return redirect('/admin/login');
    }

}
