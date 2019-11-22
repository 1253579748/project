<?php

namespace App\Http\Middleware;

use Closure;

class Load
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
        //判断是否登录，若登录则直接显示首页
        if ($request->session()->has('homeisLogin')) {
            return redirect('/home/index');
        }

        return $next($request);
    }
}
