<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = "admins";

    protected $fillable = [
        'mobile',
        'password',
        'nickname',
        'email',
        'qq',
        'status',
        'register_ip',
        'login_number',
        'last_login_ip',
        'last_login_time',
        'verify_token',
        'email_is_active',
    ];

    protected $hidden = [
        'password',
        'register_ip',
        'verify_token',
        'remember_token',
    ];

    /**
     * 密码加密
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
