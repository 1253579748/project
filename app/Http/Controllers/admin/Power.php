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
        return view('admin.Power.useradd');
    }

    //添加管理员角色
    public function usersub(Request $request)
    {
        $dd = DB::table('admin')->where('name', '=', $request->username)->first();
        if($dd){
            $data = [];
            $data['user_id'] = $dd->id;
            $data['role_id'] = $request->get('role_id', 3);

            $res = DB::table('user_has_roles')->insert($data);

            if ($res){
                return redirect('/admin/power/user');
            } else {
                echo("<script>alert('添加失败！');location='/admin/power/useradd'</script>");
            }
        } else {
            echo("<script>alert('用户名不存在哦！');location='/admin/power/useradd'</script>");
        }
    }
    //修改管理员角色页面
    public function adupdate()
     {
        //接收id
         $id = $_GET['id'];
         $re = DB::table('user_has_roles')->where('id',$id)->first();
         //查询数据后返回到显示页面
         return view('admin.Power.adupdate',['re'=>$re]);
     }
    //修改管理员角色
    public function adupda(Request $request)
    {
        $dat = [];
        $dat['id'] = $_POST['id'];
        $dat['role_id'] = $request->get('role_id', 3);

        $re = DB::table('user_has_roles')->where('id', '=', $dat['id'])->update($dat);
        if ($re){
            return redirect('/admin/power/user');
        } else {
            echo("<script>alert('内容没有变化，无需修改哦！');location='/admin/power/user'</script>");
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
        $re = DB::table('user_has_roles')->first();
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
        // dd($res);
        $re = DB::table('permissions')->where('id', '=', $res->permission_id)->first();

        return view('admin.Power.rpupde', ['res'=>$res, 're'=>$re]);
    }
    //修改角色权限
    public function rpup(Request $request)
    {
        $da = [];
        $da['name'] = $request->name;
        $da['controller'] = $request->controller;
        $da['action'] = $request->action;

        $tt = [];
        $tt['permission_id'] = $_POST['permission_id'];
        $re = DB::table('permissions')->where('id', '=', $tt['permission_id'])->update($da);

        if ($re){
            return redirect('/admin/power/rolpow');
        } else {
            echo("<script>alert('内容没有变化，无需修改哦！');location='/admin/power/rolpow'</script>");
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
        return view('admin.Power.ropo');
    }
    //添加角色权限
    public function roposub(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['controller'] = $request->controller;
        $data['action'] = $request->action;

        $res = DB::table('permissions')->insert($data);
        $rr = DB::table('permissions')
                ->where([
                    ['action', '=', $request->action],
                    ['controller', '=', $request->controller],
                ])->first();

        $dat = [];
        $dat['role_id'] = $request->get('role_id', 3);
        $dat['permission_id'] = $rr->id;

        $re = DB::table('role_has_permissions')->insert($dat);

        if ($re){
            return redirect('/admin/power/rolpow');
        } else {
            echo("<script>alert('添加失败！');location='/admin/power/ropo'</script>");
        }
    }
}
