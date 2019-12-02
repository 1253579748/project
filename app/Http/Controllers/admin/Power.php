<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\User_Has_Roles;
use App\Role;

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
    //修改权限页面
    public function update()
     {
        //接收id
         $id = $_GET['id'];
         $re = DB::table('permissions')->where('id',$id)->first();
         //查询数据后返回到显示页面
         return view('admin.Power.update',['re'=>$re]);
     }
    //修改权限
    public function upda()
    {
        $dat = [];
        $dat['id'] = $_POST['id'];
        $dat['name'] = $_POST['name'];
        $dat['descr'] = $_POST['descr'];
        $dat['controller'] = $_POST['controller'];
        $dat['action'] = $_POST['action'];

        $re = DB::table('permissions')->where('id', '=', $dat['id'])->update($dat);
        if ($re){
            return redirect('/admin/power/index');
        }
    }

    //管理员角色页面
    public function user()
    {
        $rol = DB::table('user_has_roles')->paginate(5);
        $user_id = $rol->pluck('user_id');

        $res = Admin::with(['User_Has_Roles.Role'])->get()->toArray();
        // dd($res);
        $len = count($res);
        $arr = [];
        for ($i = 0; $i < $len; $i++){
            //用户表id
            $arr[$i]['user_id'] = $res[$i]['id'];
            //用户名
            $arr[$i]['name'] = $res[$i]['name'];
            if (($res[$i]['user__has__roles']) != null) {
                //用户拥有的角色表id
                // $arr[$i]['id'] = $res[$i]['user__has__roles'][0]['id'];
                // dump($arr);
                for ($r = 0; $r < $len; $r++) {
                    $ar = $res[$r]['user__has__roles'];
                    // dump($ar);
                    $le = count($ar);
                    for ($k = 0; $k < $le; $k++) {
                        //用户拥有的角色表id
                        $arr[$r]['id'][$k] = $ar[$k]['id'];
                        $aa = $ar[$k]['role'];
                        // dump($aa);
                        foreach ($aa as $value) {
                            // dump($value['name']);
                            //角色名称
                            $arr[$r]['role'][$k] = $value['name'];
                        }
                    }
                }
            }
        }
        // dd($arr);
        // return 123;
        return view('admin.Power.user', ['arr'=>$arr]);
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
        $res = DB::table('admin')->get();
        $role = DB::table('roles')->get();
        // dd($role);
        return view('admin.Power.useradd', ['res'=>$res, 'role'=>$role]);
    }

    //添加管理员角色
    public function usersub(Request $request)
    {
        $dd = DB::table('admin')->where('name', '=', $request->valu)->first();

        $data = [];
        $data['user_id'] = $dd->id;
        $data['role_id'] = $request->role_id;
        // dd($data);
        $df = DB::table('user_has_roles')
                ->where([
                    ['role_id', '=', $data['role_id']],
                    ['user_id', '=', $data['user_id']]
                ])->first();
        // dd($df);
        //判断用户是否已经拥有角色
        if ($df != null) {
            return response()->json([
                'code' => 1,
                'msg' => '添加失败',
            ], 500);
        } else {
            $res = DB::table('user_has_roles')->insert($data);

            if ($res){
                return [
                    'code'=>0,
                    'msg'=>'添加成功',
                ];
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => '添加失败',
                ], 500);
            }
        }
    }
    //修改管理员角色页面
    public function adupdate()
     {
        //接收id
         $id = $_GET['id'];
         $re = DB::table('user_has_roles')->where('id',$id)->first();
         $rr = DB::table('roles')->get();
         //查询数据后返回到显示页面
         return view('admin.Power.adupdate',['re'=>$re, 'rr'=>$rr]);
     }
    //修改管理员角色
    public function adupda(Request $request)
    {
        $dat = [];
        $dat['id'] = $request->id;
        $dat['role_id'] = $request->role_id;

        $re = DB::table('user_has_roles')->where('id', '=', $dat['id'])->update($dat);
        if ($re){
            return [
                'code'=>0,
                'msg'=>'修改成功',
            ];
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '修改失败',
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
        $re = DB::table('user_has_roles')->where('role_id', '=', $id)->first();
        // dd($re);

        //判断用户是否有角色
        if ($re) {
            return response()->json([
                'code' => 1,
                'msg' => '删除失败',
            ], 500);
        } else {
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
    //修改角色页面
    public function roleupdate()
     {
        //接收id
         $id = $_GET['id'];
         $re = DB::table('roles')->where('id',$id)->first();
         //查询数据后返回到显示页面
         return view('admin.Power.roleupdate',['re'=>$re]);
     }
    //修改角色
    public function roleupda()
    {
        $dat = [];
        $dat['id'] = $_POST['id'];
        $dat['name'] = $_POST['name'];

        $re = DB::table('roles')->where('id', '=', $dat['id'])->update($dat);
        if ($re){
            return redirect('/admin/power/role');
        }
    }

    //角色权限
    public function rolpow()
    {
        $res = Role::with(['Role_Has_Permissions.Permissions'])->get()->toArray();
        // dd($res);
        $len = count($res);
        $arr = [];
        for ($i = 0; $i < $len; $i++){
            //角色名
            $arr[$i]['name'] = $res[$i]['name'];
            if (($res[$i]['role__has__permissions']) != null) {
                for ($r = 0; $r < $len; $r++) {
                    $ar = $res[$r]['role__has__permissions'];
                    $le = count($ar);
                    for ($k = 0; $k < $le; $k++) {
                        //角色拥有的权限表id
                        $arr[$r]['id'][$k] = $ar[$k]['id'];
                        $aa = $ar[$k]['permissions'];
                        // dump($aa);
                        foreach ($aa as $value) {
                            //权限名称
                            $arr[$r]['rolename'][$k] = $value['name'];
                            //权限对应的控制器
                            $arr[$r]['controller'][$k] = $value['controller'].'@'.$value['action'];
                            //权限对应的方法
                            // $arr[$r]['action'][$k] = $value['action'];
                        }
                    }
                }
            }
        }
        // dd($arr);
        // return 123;
        return view('admin.Power.rolpow', ['arr'=>$arr]);
    }
    //修改角色权限页面
    public function rpupde()
    {
        //接收id
        $id = $_GET['id'];
        $res = DB::table('role_has_permissions')->where('id',$id)->first();

        $rr = DB::table('permissions')->get();

        return view('admin.Power.rpupde', ['res'=>$res, 'rr'=>$rr]);
    }
    //修改角色权限
    public function rpup(Request $request)
    {
        $da = [];
        $da['id'] = $request->id;
        $da['permission_id'] = $request->permission_id;
        //判断用户是否已经拥有该权限
        $dd = DB::table('role_has_permissions')
                ->where([
                    ['id', '=', $da['id']],
                    ['permission_id', '=', $da['permission_id']]
                ])->first();

        if ($dd == null) {
            $res = DB::table('role_has_permissions')->where('id', '=', $da['id'])->update($da);

            if ($res){
                return [
                    'code'=>0,
                    'msg'=>'修改成功',
                ];
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => '修改失败',
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '修改失败',
            ], 500);
        }
    }
    //删除角色权限
    public function rpdel($id)
    {
        $res = DB::table('role_has_permissions')->where('id', '=', $id)->delete();

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
    //添加角色权限页面
    public function ropo()
    {
        $ee = DB::table('permissions')->get();
        $tt = DB::table('roles')->get();
        // dd($ee);
        return view('admin.Power.ropo', ['ee'=>$ee, 'tt'=>$tt]);
    }
    //添加角色权限
    public function roposub(Request $request)
    {
        $data = [];
        $data['role_id'] = $request->role_id;
        $data['permission_id'] = $request->permission_id;

        //判断角色是否已经拥有将要添加权限
        $ff = DB::table('role_has_permissions')
                    ->where([
                        ['role_id', '=', $data['role_id']],
                        ['permission_id', '=', $data['permission_id']]
                    ])->first();
        // dd($ff);
        if ($ff == null) {
            $re = DB::table('role_has_permissions')->insert($data);
            if ($re){
                return [
                    'code'=>0,
                    'msg'=>'添加成功',
                ];
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => '添加失败',
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '添加失败',
            ], 500);
        }
    }

    //用户权限
    public function userole()
    {
        $res = Admin::with(['User_Has_Permissions.Permissions'])->get()->toArray();
        // dd($res);
        $len = count($res);
        $arr = [];
        for ($i = 0; $i < $len; $i++){
            //用户名
            $arr[$i]['name'] = $res[$i]['name'];
            if (($res[$i]['user__has__permissions']) != null) {
                for ($r = 0; $r < $len; $r++) {
                    $ar = $res[$r]['user__has__permissions'];
                    $le = count($ar);
                    for ($k = 0; $k < $le; $k++) {
                        //用户拥有的权限表id
                        $arr[$r]['id'][$k] = $ar[$k]['id'];
                        $aa = $ar[$k]['permissions'];
                        // dump($aa);
                        foreach ($aa as $value) {
                            //权限名称
                            $arr[$r]['usename'][$k] = $value['name'];
                            //权限对应的控制器和方法
                            $arr[$r]['controller'][$k] = $value['controller'].'@'.$value['action'];
                        }
                    }
                }
            }
        }
        // dd($arr);
        // return 123;
        return view('admin.Power.userole', ['arr'=>$arr]);
    }
    //显示添加用户权限页面
    public function userpem()
    {
        //用户
        $res = DB::table('admin')->get();
        //权限
        $re = DB::table('permissions')->get();
        return view('admin.Power.userpem', ['res'=>$res, 're'=>$re]);
    }
    //添加用户权限
    public function usesub(Request $request)
    {
        $data = [];
        $data['user_id'] = $request->user_id;
        $data['permission_id'] = $request->permission_id;

        //判断用户是否已经拥有将要添加的权限
        $ff = DB::table('user_has_permissions')
                    ->where([
                        ['user_id', '=', $data['user_id']],
                        ['permission_id', '=', $data['permission_id']]
                    ])->first();
        // dd($ff);
        if ($ff == null) {
            $re = DB::table('user_has_permissions')->insert($data);
            if ($re){
                return [
                    'code'=>0,
                    'msg'=>'添加成功',
                ];
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => '添加失败',
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '添加失败',
            ], 500);
        }
    }
    //显示修改用户权限页面
    public function ueupde()
    {
        //接收id
        $id = $_GET['id'];
        $res = DB::table('user_has_permissions')->where('id',$id)->first();

        $rr = DB::table('permissions')->get();

        return view('admin.Power.ueupde', ['res'=>$res, 'rr'=>$rr]);
    }
    //修改用户权限
    public function ueup(Request $request)
    {
        $da = [];
        $da['id'] = $request->id;
        $da['permission_id'] = $request->permission_id;
        //判断用户是否已经拥有该权限
        $dd = DB::table('user_has_permissions')
                ->where([
                    ['id', '=', $da['id']],
                    ['permission_id', '=', $da['permission_id']]
                ])->first();

        if ($dd == null) {
            $res = DB::table('user_has_permissions')->where('id', '=', $da['id'])->update($da);

            if ($res){
                return [
                    'code'=>0,
                    'msg'=>'修改成功',
                ];
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => '修改失败',
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 1,
                'msg' => '修改失败',
            ], 500);
        }
    }
    //删除用户权限
    public function uedel($id)
    {
        $res = DB::table('user_has_permissions')->where('id', '=', $id)->delete();

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
