<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\UserRole;

class Power extends Controller
{
    //权限页面
    public function index(Request $request)
    {
        $res = DB::table('permissions');

        $search = $request->input('name');

        if ($search) {
            $res->where('name', 'like', '%'.$search.'%');
        }
        $arr = $res->paginate(5);

        return view('admin.Power.index', ['arr' => $arr,'search'=>$search,]);
    }

    //删除权限
    public function del($id)
    {
        $res = DB::table('permissions')->where('id', '=', $id)->delete();

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

    //显示添加权限页面
    public function add()
    {
        return view('admin.Power.add');
    }

    //添加到数据库
    public function sub(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'controller' => 'required',
            'action' => 'required',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'name' => '权限名称',
            'controller' => '控制器名称',
            'action' => '操作名称',
        ]);

        $data = [];

        $data['name'] = $request->name;
        $data['descr'] = $request->descr;
        $data['controller'] = $request->controller;
        $data['action'] = $request->action;

        $res = DB::table('permissions')->insert($data);

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

    //管理员角色页面
    public function user()
    {
        $rol = DB::table('user_has_roles')->paginate(5);
        $user_id = $rol->pluck('user_id');

        // $res = UserRole::with(['Users'])->get()->toArray();
        // // dd($res);
        // $len = count($res);
        // // dd($len);
        // for ($i = 0; $i < $len; $i++){
        //     $arr = $res[$i];
        //     // dd($arr);
        //     foreach($arr['users'] as $key=>$value){
        //         $name = $value['name'];
        //     }
        // }

        return view('admin.Power.user', ['rol' => $rol]);
    }

    //删除管理员角色
    public function updel($id)
    {
        $res = DB::table('user_has_roles')->where('id', '=', $id)->delete();

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

    //显示添加管理员角色页面
    public function useradd()
    {
        return view('admin.Power.useradd');
    }

    //添加管理员角色
    public function usersub(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'role_id' => 'required',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'user_id' => '用户id',
            'user_id' => '角色id',
        ]);
        $data = [];
        $data['user_id'] = $request->user_id;
        $data['role_id'] = $request->role_id;

        $res = DB::table('user_has_roles')->insert($data);

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

    //角色管理
    public function role()
    {
        $rol = DB::table('roles')->get();
        // dd($rol);
        return view('admin.Power.role', ['rol' => $rol]);
    }

    //显示添加角色页面
    public function roleadd()
    {
        return view('admin.Power.roleadd');
    }

    //添加角色
    public function rolesub(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'name' => '角色名称',
        ]);
        $data = [];
        $data['name'] = $request->name;

        $res = DB::table('roles')->insert($data);

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

    //删除角色
    public function roledel($id)
    {
        $res = DB::table('roles')->where('id', '=', $id)->delete();

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
}
