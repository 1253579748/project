<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function show()
    {
        return view('Admin.login');
    }

    public function login(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'username' => 'required|exists:admin,name',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'required' => ':attribute必须填写',
            'exists' => ':attribute错误',
            'captcha' => '请输入正确的:attribute',
        ], [
            'username' => '用户名或密码',
            'password' => '密码',
            'captcha' => '验证码',
        ]);

        //验证身份
        $userInfo = DB::table('admin')
                ->where('name', '=', $request->username)
                ->first();
        //验证用户状态
        if (($userInfo->status) == 1) {
            //验证密码
            if (password_verify($request->password, $userInfo->pwd)) {
                //保存登录状态
                session([
                    'isLogin' => true,
                    'userInfo' => [
                        'id' => $userInfo->id,
                        'username' => $userInfo->name,
                    ]
                ]);
                //跳转后台首页
                return redirect('/Admin');
            }
        } else {
            return back()->withInput();
        }
        
    }
}