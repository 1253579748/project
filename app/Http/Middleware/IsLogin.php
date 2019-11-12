<?php

namespace App\Http\Middleware;

use Closure;

class IsLogin
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
        //验证用户是否登录，如果没有登录则跳到登录页面
        $status = $request->session()->has('isLogin');
        
        if ($status) {
            //已登录,执行下一步
            return $next($request);
        } else {
            //重定向到登录页
            return redirect('/Admin/login');
        }
    }
}
