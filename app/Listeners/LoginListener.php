<?php
/**
 * 登录监听模块
 * User: jason
 * Date: 2018/9/14
 * Time: 下午13:39
 */

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Models\AgentLoginLog;
use App\Models\StudentLoginLog;
use Zhuzhichao\IpLocationZh\Ip;
use App\Models\AdminLoginLog;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginListener implements ShouldQueue
{
    /**
     * 失败重试次数
     *
     * @var int
     */
    public $tries = 1;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\LoginEvent $loginEvent
     * @return void
     */
    public function handle(LoginEvent $loginEvent)
    {
        //获取事件中保存的信息
        $ip = $loginEvent->getIp();
        $model = $loginEvent->getModel();
        $member_id = $loginEvent->getMember()->mobile;
        $browser = $loginEvent->getAgent();

        //登录信息
        $login_info = [
            'ip' => $ip,
            'created_at' => $loginEvent->getTimestamp(),
        ];

        $address = Ip::find($ip);
        $login_info['address'] = implode(' ', $address);

        /* 设备名称 */
        $login_info['device'] = $browser->device();

        /* 浏览器 */
        $login_info['browser'] = $browser->browser();

        /* 操作系统 */
        $login_info['platform'] = $browser->platform();

        /*根据不同模型处理不同的方法*/
        switch ($model) {
            case 'Admin':
                /* 插入到数据库 */
                $login_info['admin_mobile'] = $member_id;
                AdminLoginLog::create($login_info);
                break;
            case 'Agent':
                /* 插入到数据库 */
                $login_info['agent_mobile'] = $member_id;
                AgentLoginLog::create($login_info);
                break;
            case 'Student':
                /* 插入到数据库 */
                $login_info['student_mobile'] = $member_id;
                StudentLoginLog::create($login_info);
                break;
        }
    }
}
