<?php

namespace App\Http\Controllers\Student;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    // 登录成功跳转地址
    protected $redirectTo = null;

    /**
     * 默认使用  admin  标签验证
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
        $this->redirectTo = config('student.student_prefix').'/dashboard';
    }

    /**
     * 后台管理员登录界面视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('student.login.show');
    }

    /**
     * 重写退出方法
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->forget($this->guard()->getName());
        $request->session()->regenerate();

        return redirect(config('student.student_prefix').'/login');
    }

    /**
     * 重写 guard 方法
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('student');
    }

    /**
     * 更改验证字段
     *
     * @return string
     */
    public function username()
    {
        return 'mobile';
    }
}
