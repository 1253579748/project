<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function show()
    {
        return view('home.login.login');
    }

    //前台登录
    public function login(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'telphone' => 'required|exists:users,phone|regex:/^1[345789][0-9]{9}$/',
            'password' => 'required',
            'checkcode' => 'required',
        ], [
            'required' => ':attribute未填写',
            'exists' => ':attribute错误',
            'regex' => ':attribute格式错误',
        ], [
            'telphone' => '手机号码或密码',
            'password' => '密码',
            'checkcode' => '验证码',
        ]);
        // //验证身份
        $userInfo = DB::table('users')
                ->where('phone', '=', $request->telphone)
                ->first();
        //验证用户状态
        if (($userInfo->status) == 1) {

            //验证验证码是否正确
            //接收输入的手机验证码
            $checkcode = $_POST['checkcode'];
            $code = $request->session()->get('code');
            //把生成发送的验证码和用户手机收到的验证码进行比对
            if ($code == $checkcode) {

                //验证密码
                if (password_verify($request->password, $userInfo->password)) {
                    //判断用户名是否为空，为空则随机生成
                    if(($userInfo->username) == null) {
                        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $suoyin = rand(0, 52);
                        //随机用户名
                        $username = "XXGSTOP_".substr($str,$suoyin, 1).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                        $re = DB::table('users')->where('id', '=', $userInfo->id)->update(['username'=>$username]);
                        $res = DB::table('users')->where('id', '=', $userInfo->id)->first();
                        if ($re) {
                            //保存登录状态
                            session([
                                'homeisLogin' => true,
                                'homeuserInfo' => [
                                    'id' => $userInfo->id,
                                    'username' => $res->username,
                                    'password' => $userInfo->password,
                                    'phone' => $userInfo->phone,
                                ]
                            ]);
                            //跳转前台首页
                            return redirect('/home/index');  
                        }
                    } else {
                        //用户名不为空则直接保存登录状态，然后跳转首页
                        session([
                            'homeisLogin' => true,
                            'homeuserInfo' => [
                                'id' => $userInfo->id,
                                'username' => $userInfo->username,
                                'password' => $userInfo->password,
                                'phone' => $userInfo->phone,
                            ]
                        ]);
                        //跳转前台首页
                        return redirect('/home/index');
                    }
                } else {
                  echo("<script>alert('密码错误');location='/home/login'</script>");
                }
            }else {
                echo("<script>alert('验证码错误');location='/home/login'</script>");
            }
        } else {
            return back()->withInput();
        }
    }

    //登录验证码
    public function yan(Request $request)
    {
        include(base_path('duanxin/Demo/SendTemplateSMS.php'));
        //生成验证码
        $code = rand(100000,999999);

        //生成的验证码存放到session，方便后续的验证操作
        session(['code'=>$code]);

        $telphone = $request->telphone;
        $res = sendTemplateSMS($telphone,[$code],"1");//手机号码，替换内容数组，模板ID
        
        if ($res) {

            return response()->json([
                'code' => 0,
                'msg' => '发送成功！',
            ], 200);

        } else {

            return response()->json([
                'code' => 1,
                'msg' => '发送失败！',
            ], 500);

        }
    }
    //注册验证码
    public function yanre(Request $request)
    {
        include(base_path('duanxin/Demo/SendTemplateSMS.php'));
        //生成验证码
        $cod = rand(100000,999999); 
        // dd($cod);

        //生成的验证码存放到session，方便后续的验证操作
        session(['cod'=>$cod]);

        $phone = $request->phone;

        $res = sendTemplateSMS($phone,[$cod],"1");//手机号码，替换内容数组，模板ID

        // dd($res);

        if ($res) {

            return response()->json([
                'code' => 0,
                'msg' => '发送成功！',
            ], 200);

        } else {

            return response()->json([
                'code' => 1,
                'msg' => '发送失败！',
            ], 500);

        }
    }
    //修改密码验证码
    public function yanup(Request $request)
    {
        include(base_path('duanxin/Demo/SendTemplateSMS.php'));
        //生成验证码
        $co = rand(100000,999999);

        //生成的验证码存放到session，方便后续的验证操作
        session(['co'=>$co]);

        $phon = $request->phon;
        $res = sendTemplateSMS($phon,[$co],"1");//手机号码，替换内容数组，模板ID
        
        if ($res) {

            return response()->json([
                'code' => 0,
                'msg' => '发送成功！',
            ], 200);

        } else {

            return response()->json([
                'code' => 1,
                'msg' => '发送失败！',
            ], 500);

        }
    }

    //前台注册
    public function register(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
            'pwd' => 'required|regex:/^[a-zA-Z\d]{6,12}$/',
            'smscode' => 'required',
        ], [
            'required' => ':attribute未填写',
            'exists' => ':attribute错误',
            'regex' => ':attribute格式错误',
        ], [
            'phone' => '手机号码或密码',
            'pwd' => '密码',
            'smscode' => '验证码',
        ]);
        //验证号码是否存在
        $phone = DB::table('users')
                ->where('phone', '=', $request->phone)
                ->first();
        if ($phone == true) {
            return response()->json([
                'code' => 2,
                'msg' => '该手机号码已注册！',
            ], 500);
        } else {
            //验证验证码是否正确
            //接收输入的手机验证码
            $smscode = $_POST['smscode'];
            $cod = $request->session()->get('cod');
            //把生成发送的验证码和用户手机收到的验证码进行比对
            if ($cod == $smscode) {
                $data = [];
                $data['password'] = Hash::make($request->pwd);
                $data['phone'] = $request->phone;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                $res = DB::table('users')->insert($data);
                //插用户id进用户详情表，方便后续操作
                $re = DB::table('users')->where('phone', '=', $request->phone)->first();
                $info = DB::table('user_info')->insert(['uid'=>$re->id]);
                if ($res) {
                    return [
                        'code' => 0,
                        'msg' => '注册成功',
                    ];
                }
            } else {
                return response()->json([
                    'code' => 2,
                    'msg' => '验证码错误！',
                ], 500);
            }
        }
    }

    //前台修改密码
    public function resetpwd(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'phon' => 'required|exists:users,phone',
            'pass' => 'required|regex:/^[a-zA-Z\d]{6,12}$/',
            'sms' => 'required',
        ], [
            'required' => ':attribute未填写',
            'exists' => ':attribute错误',
            'regex' => ':attribute格式错误',
        ], [
            'phon' => '手机号码或密码',
            'pass' => '密码',
            'sms' => '验证码',
        ]);
        //验证身份
        $phon = DB::table('users')
                ->where('phone', '=', $request->phon)
                ->first();
        if (($phon->status) == 1) {
            //验证验证码是否正确
            //接收输入的手机验证码
            $sms = $_POST['sms'];
            $co = $request->session()->get('co');
            //把生成发送的验证码和用户手机收到的验证码进行比对
            if ($co == $sms) {
                $da = [];
                $da['password'] = Hash::make($request->pass);
                $da['updated_at'] = date('Y-m-d H:i:s');
                $res = DB::table('users')->where('id', '=', $phon->id)->update($da);
                if ($res) {
                    return [
                        'code' => 0,
                        'msg' => '修改成功',
                    ];
                }
            } else {
                return response()->json([
                    'code' => 2,
                    'msg' => '验证码错误！',
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 2,
                'msg' => '该手机号已停用！请联系管理员',
            ], 500);
        }
    }
}
