<?php

namespace App\Http\Controllers\Agent;

use Auth;
use App\Events\LoginEvent;
use Jenssegers\Agent\Agent;
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
        $this->middleware('guest:agent')->except('logout');
        $this->redirectTo = config('agent.agent_prefix').'/dashboard';
    }

    /**
     * 后台管理员登录界面视图
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('agent.login.show');
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
            event(new LoginEvent('Agent', $this->guard()->user(), $request->getClientIp(), new Agent(), time()));

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
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

        return redirect(config('agent.agent_prefix').'/login');
    }

    /**
     * 重写 guard 方法
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('agent');
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
