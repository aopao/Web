<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = "students";

    protected $fillable = [
        'mobile',
        'password',
        'nickname',
        'email',
        'qq',
        'status',
        'register_ip',
        'verify_token',
        'email_is_active',
    ];

    protected $hidden = [
        'password',
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
