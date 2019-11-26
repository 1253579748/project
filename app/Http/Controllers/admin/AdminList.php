<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Role;

class AdminList extends Controller
{
    //管理员列表页面
    public function index(Request $request)
    {
        $al = DB::table('admin');

        $search = $request->input('name');

        if ($search) {
            $al->where('name', 'like', '%'.$search.'%');
        }
        $arr = $al->paginate(5);

        return view('admin.AdminList.index', [
            'arr' => $arr,'search'=>$search,
        ]);
    }

    //显示添加管理员页面
    public function add()
    {
        return view('admin.AdminList.add');
    }

    //添加到数据库
    public function sub(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'username' => '用户名',
            'password' => '密码',
            'phone' => '手机号',
        ]);
        $dd = DB::table('admin')->where('name', '=', $request->username)->first();
        //判断管理员是否存在
        if ($dd) {
            return response()->json([
                'code' => 2,
                'msg' => '用户名已存在',
            ], 500);
        } else {
            $data = [];

            $data['name'] = $request->username;
            $data['pwd'] = Hash::make($request->password);
            $data['phone'] = $request->phone;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $res = DB::table('admin')->insert($data);
            $re = DB::table('admin')->where('phone', '=', $request->phone)->first();
            DB::table('user_has_roles')->insert(['user_id'=>$re->id]);

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
    }

    //删除管理员
    public function del($id)
    {
        $res = DB::table('admin')->where('id', '=', $id)->delete();

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
         $re = DB::table('admin')->where('id',$id)->first();
         //查询数据后返回到显示页面
         return view('admin.AdminList.update',['re'=>$re]);
     }
    //修改数据
    public function upda()
    {
        $dat = [];
        $dat['id'] = $_POST['id'];
        $dat['name'] = $_POST['name'];
        $dat['pwd'] = Hash::make($_POST['pwd']);
        $dat['phone'] = $_POST['phone'];
        $dat['status'] = $_POST['status'];
        $dat['updated_at'] = date('Y-m-d H:i:s');

        $re = DB::table('admin')->where('id', '=', $dat['id'])->update($dat);
        if ($re){
            return redirect('/admin/adminList/index');
        }
    }
}