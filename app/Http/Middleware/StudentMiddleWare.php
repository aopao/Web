<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

/**
 * 学生会员中心管理模块中间件
 *
 * @package App\Http\Middleware
 */
class StudentMiddleWare
{
    /**
     * @param          $request
     * @param \Closure $next
     * @param null     $guard
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, $guard)
    {

        if (! Auth::guard($guard)->check()) {
            return redirect(config('student.student_prefix').'/login');
        }

        return $next($request);
    }
}
