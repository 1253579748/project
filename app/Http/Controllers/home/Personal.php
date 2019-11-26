<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Personal extends Controller
{
    //个人资料
    public function show()
    {
        //通过session中找到用户id，查询用户详细信息
        $info = session()->get('homeuserInfo');
        if ($info == null){
            return redirect('/home/login');
        }
        $res = DB::table('users')->where('id', '=', $info['id'])->first();
        //通过用户id到用户详情表查询用户详情
        $user = DB::table('user_info')->where('uid', '=', $res->id)->first();

        return view('home.personal.show', ['res'=>$res, 'user'=>$user]);
    }

    //修改个人信息
    public function update()
    {
        //接收ID
        $id = $_GET['id'];
        $uid = $_GET['uid'];
        $users = DB::table('users')->where('id',$id)->first();
        $userinfo = DB::table('user_info')->where('uid',$uid)->first();

        return view('home.personal.update', ['users'=>$users, 'userinfo'=>$userinfo]);
    }
    public function upda()
    {
        $dat = [];
        $dat['id'] = $_POST['id'];
        $dat['username'] = $_POST['username'];
        $dat['phone'] = $_POST['phone'];
        $dat['email'] = $_POST['email'];
        $dat['updated_at'] = date('Y-m-d H:i:s');

        $ree = DB::table('users')->where('id', '=', $dat['id'])->update($dat);
        if ($ree){
            return redirect('/home/personal/show');
        }
    }
    public function upd(Request $request)
    {
        $da = [];
        $da['uid'] = $_POST['uid'];
        $da['name'] = $_POST['name'];
        $da['sex'] = $request->get('checkboxName', 3);

        $ino = DB::table('user_info')->where('uid', '=', $da['uid'])->update($da);
        if ($ino){
            return redirect('/home/personal/show');
        }
    }

    //修改支付密码
    public function paypwd()
    {
        $id = $_GET['id'];
        $pay = DB::table('user_info')->where('uid', '=', $id)->first();

        return view('home.personal.paypwd', ['pay'=>$pay]);
    }
    public function paypass(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'pay_pwd' => 'required|regex:/^\d{6}$/',
            'pay_pw' => 'required|regex:/^\d{6}$/',
            'captcha' => 'required|captcha',
        ], [
            'required' => ':attribute未填写',
            'captcha' => '请输入正确的:attribute',
            'regex' => ':attribute格式错误',
        ], [
            'pay_pwd' => '密码',
            'pay_pw' => '确认密码',
            'captcha' => '验证码',
        ]);
        $pay_pwd = $request->pay_pwd;
        $pay_pw = $request->pay_pw;
        //验证两次输入的密码是否一致
        if ($pay_pwd == $pay_pw) {
            $paa = DB::table('user_info')->where('id', '=', $request->id)->update(['pay_pwd'=>$pay_pwd]);
            if ($paa) {
                return redirect('/home/personal/show');
            }
        } else {
            echo("<script>alert('两次密码不一致');location='/home/personal/show'</script>");
        }
    }

    //修改登录密码
    public function logpwd()
    {
        $id = $_GET['id'];
        $log = DB::table('users')->where('id', '=', $id)->first();

        return view('home.personal.logpwd', ['log'=>$log]);
    }
    public function logpass(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'password' => 'required|regex:/^[a-zA-Z\d]{6,12}$/',
            'pass' => 'required|regex:/^[a-zA-Z\d]{6,12}$/',
            'captcha' => 'required|captcha',
        ], [
            'required' => ':attribute未填写',
            'captcha' => '请输入正确的:attribute',
            'regex' => ':attribute格式错误',
        ], [
            'password' => '密码',
            'pass' => '确认密码',
            'captcha' => '验证码',
        ]);
        $password = $request->password;
        $pass = $request->pass;
        //验证两次输入的密码是否一致
        if ($password == $pass) {
            $pwd = Hash::make($password);
            $pa = DB::table('users')->where('id', '=', $request->id)->update(['password'=>$pwd]);
            if ($pa) {
                return redirect('/home/personal/show');
            }
        } else {
            echo("<script>alert('两次密码不一致');location='/home/personal/show'</script>");
        }
    }

    //收货地址
    public function address()
    {
        $in = session()->get('homeuserInfo.id');
        $address = DB::table('address')->where('uid', '=', $in)->get();
        // dd($address);

        return view('home.personal.address', ['address'=>$address]);
    }
    //添加地址
    public function addres(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'username' => 'required',
            'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
            'address' => 'required',
            'addrinfo' => 'required',
        ], [
            'required' => ':attribute未填写',
            'regex' => ':attribute格式错误',
        ], [
            'username' => '收货人',
            'phone' => '手机号码',
            'address' => '收货地址',
            'addrinfo' => '详细地址',
        ]);
        $data = [];
        $data['uid'] = $request->session()->get('homeuserInfo.id');
        $data['username'] = $request->username;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['addrinfo'] = $request->addrinfo;

        $res = DB::table('address')->insert($data);
        if ($res) {
            return [
                'code' => 0,
                'msg' => '添加成功',
            ];
        } else {
            return response()->json([
                'code' => 2,
                'msg' => '添加失败',
            ], 500);
        }
    }
    //修改地址
    public function upres(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'name' => 'required',
            'phon' => 'required|regex:/^1[345789][0-9]{9}$/',
            'addres' => 'required',
            'addrinf' => 'required',
        ], [
            'required' => ':attribute未填写',
            'regex' => ':attribute格式错误',
        ], [
            'name' => '收货人',
            'phon' => '手机号码',
            'addres' => '收货地址',
            'addrinf' => '详细地址',
        ]);
        $da = [];
        $da['id'] = $request->id;
        $da['username'] = $request->name;
        $da['phone'] = $request->phon;
        $da['address'] = $request->addres;
        $da['addrinfo'] = $request->addrinf;

        $red = DB::table('address')->where('id', '=', $request->id)->update($da);
        if ($red) {
            return [
                'code' => 0,
                'msg' => '修改成功',
            ];
        } else {
            return response()->json([
                'code' => 2,
                'msg' => '修改失败',
            ], 500);
        }
    }

    //删除地址
    public function delres($id)
    {
        $res = DB::table('address')->where('id', '=', $id)->delete();

        if ($res) {
            return [
                'code' => 0,
                'msg' => '删除成功',
            ];
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '删除失败',
            ], 500);
        }
    }

    //设置默认地址
    public function defa($id)
    {
        //取消其他的默认地址
        $map['is_default'] = 1;
        $map['uid'] = session()->get('homeuserInfo.id');
        $up = DB::table('address')->where($map)->update(['is_default'=>0]);

        //设置默认
        $de = DB::table('address')->where('id', '=', $id)->update(['is_default'=>1]);
        if ($de) {
            return redirect('/home/personal/address');
        }
    }

    //头像
    public function headimg()
    {
        return view('home.personal.headimg');
    }
    public function head(Request $request)
    {
        if ($request->headimg) {
            return "ok";
        } else {
            return "no";
        }
    }
}
