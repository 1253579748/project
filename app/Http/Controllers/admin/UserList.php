<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserList extends Controller
{
    //用户信息
    public function index(Request $request)
    {
        $al = DB::table('users');

        $search = $request->input('name');

        if ($search) {
            $al->where('username', 'like', '%'.$search.'%');
        }
        $arr = $al->paginate(5);
        return view('admin.UserList.index', [
            'arr' => $arr,'search'=>$search,
        ]);
    }

    //显示添加用户页面
    public function add()
    {
        return view('admin.UserList.add');
    }

    //添加用户到数据库
    public function sub(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'email'=> 'required',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'username' => '用户名',
            'password' => '密码',
            'phone' => '手机号',
            'email' => '邮箱',
        ]);

        $data = [];

        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $res = DB::table('users')->insert($data);

        if ($res) {
            return [
                'code' => 0,
                'msg' => '添加成功',
            ];
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '添加失败',
            ], 500);
        }
    }

    //删除用户
    public function del($id)
    {
        $res = DB::table('users')->where('id', '=', $id)->delete();

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

    //修改页面
    public function update()
     {
        //接收id
         $id = $_GET['id'];
         $re = DB::table('users')->where('id',$id)->first();
         //查询数据后返回到显示页面
         return view('admin.UserList.update',['re'=>$re]);
     }
    //修改数据
    public function upda()
    {
        $dat = [];
        $dat['id'] = $_POST['id'];
        $dat['username'] = $_POST['username'];
        $dat['password'] = Hash::make($_POST['password']);
        $dat['phone'] = $_POST['phone'];
        $dat['email'] = $_POST['email'];
        $dat['status'] = $_POST['status'];
        $dat['updated_at'] = date('Y-m-d H:i:s');

        $re = DB::table('users')->where('id', '=', $dat['id'])->update($dat);
        if ($re){
            return redirect('/admin/userList/index');
        }
    }

    public function other(Request $request)
    {
        $al = DB::table('address');

        $search = $request->input('name');

        if ($search) {
            $al->where('username', 'like', '%'.$search.'%');
        }
        $arr = $al->paginate(5);
        return view('admin.UserList.other', [
            'arr' => $arr,'search'=>$search,
        ]);
    }
}
