<?php
/**
 * 登录模块触发事件
 * User: jason
 * Date: 2018/9/14
 * Time: 下午12:39
 */

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

use Jenssegers\Agent\Agent;

class LoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Model 用户模型
     */
    protected $model;

    /**
     * @var Model 用户模型
     */
    protected $member;

    /**
     * @var Agent Agent对象
     */
    protected $agent;

    /**
     * @var string IP地址
     */
    protected $ip;

    /**
     * @var int 登录时间戳
     */
    protected $timestamp;

    public function __construct($model, $member, $ip, $agent, $timestamp)
    {
        /* IP 地址 */
        $this->ip = $ip;
        /* 操作的模型 */
        $this->model = $model;
        /* 用户信息 */
        $this->member = $member;
        /* Agent信息 */
        $this->agent = $agent;
        /* 时间戳 */
        $this->timestamp = $timestamp;
    }

    /**
     * 获取传入的 Model 类型
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * 获取用户信息
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * 获取 IP 地址
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Agent信息
     *
     * @return \Jenssegers\Agent\Agent
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * 获取时间戳
     *
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-default');
    }
}