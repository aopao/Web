<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest() || ! Auth::user()->isAdmin()) {
            return redirect('/', 301)->with('message', 'login');
        }

        return $next($request);
    }
}
