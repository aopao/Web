<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //登录成功之后!
        //根据传入的 $guard 参数来判断进入哪个地址
        if (Auth::guard($guard)->check()) {
            $url = null;
            switch ($guard) {
                case 'admin':
                    $url = config('admin.admin_prefix').'/dashboard';
                    break;
                case 'agent':
                    $url = config('agent.agent_prefix').'/dashboard';
                    break;
                case 'student':
                    $url = '/student';
                    break;
            }

            return redirect($url);
        }

        return $next($request);
    }
}
