<?php
/**
 * 修改退出消除 session 的方法.
 * 原方法会导致前后台所有用户全部退出.
 * User: jason
 * Date: 2018/9/13
 * Time: 下午7:10
 */

namespace App\Traits;

use Illuminate\Http\Request;

trait AuthenticatesLogout
{
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return redirect('/');
    }
}