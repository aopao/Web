<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    protected $table = "agents";

    protected $fillable = [
        'mobile',
        'password',
        'nickname',
        'email',
        'qq',
        'status',
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
