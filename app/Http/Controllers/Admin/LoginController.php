<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Events\LoginEvent;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends ApiController
{
    use AuthenticatesUsers;

    // 登录成功跳转地址
    protected $redirectTo = null;

    /**
     * 重写父类函数
     * LoginController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:admin')->except('logout');
        $this->redirectTo = config('admin.admin_prefix').'/dashboard';
    }

    /**
     * 后台管理员登录界面视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login.show');
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

    /**
     * 重写 guard 方法
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * 重写 Login 方法.增加登录记录
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($this->guard()->check()) {
                $data = [
                    "access_token" => $this->guard()->user()->mobile,
                    "redirect" => route('admin.dashboard'),
                ];
                event(new LoginEvent('Admin', $this->guard()->user(), $request->getClientIp(), new Agent(), time()));
                return $this->responseSuccess($data);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->setStatusCode(201)->responseErrors('账户或者密码错误!');
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

        return redirect(config('admin.admin_prefix').'/login');
    }
}
