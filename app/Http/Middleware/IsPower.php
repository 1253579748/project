<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class IsPower
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //获取控制器和操作方法的名字
        $action_full = $request->route()->getActionName();

        //去掉命名空间
        $action_full_arr = explode('\\', $action_full);
        $action_str = array_pop($action_full_arr);
        // dd($action_str);

        //通过session查id
        $user_id = session('userInfo.id');

        //保存用户拥有的所有权限
        $power_list = [];

        //1.通过用户查权限
        //查询当前用户拥有的权限
        $user_powers = DB::table('user_has_permissions')
                    ->where('user_id', '=', $user_id)
                    ->get();
        //遍历出所有的权限
        foreach ($user_powers as $power) {
            //通过用户拥有的权限表id去查询出具体权限
            $power_tmp = DB::table('permissions')
                        ->where('id', '=', $power->permission_id)
                        ->first();
            // dd($power_tmp->controller);
            if (!$power_tmp) {
                continue;
            }

            //将权限保存到数组
            $name_tmp = $power_tmp->controller.'@'.$power_tmp->action;
            // dd($name_tmp);
            $power_list[$name_tmp] = $name_tmp;
        }

        //2.通过角色查权限
        //查询当前用户的所有角色
        $user_roles = DB::table('user_has_roles')
                        ->where('user_id', '=', $user_id)
                        ->get();
        
        //通过角色id遍历拿到权限id
        foreach ($user_roles as $role) {
            $role_powers = DB::table('role_has_permissions')
                            ->where('role_id', '=', $role->role_id)
                            ->get();

            //通过权限id去查询权限详情
            foreach ($role_powers as $power) {
                //查询对应权限
                $power_tmp = DB::table('permissions')
                            ->where('id', '=', $power->permission_id)
                            ->first();

                //将权限保存到数组
                $name_tmp = $power_tmp->controller . '@' . $power_tmp->action;
                $power_list[$name_tmp] = $name_tmp;
            }
        }

        //判断用户是否拥有权限
        if (in_array($action_str, $power_list)) {
            return $next($request);
        } else {
            echo ("<script>alert('没有权限哦~');location='/admin/index/index'</script>");
            // return response('没有权限哦~');
        }
        
    }
}
