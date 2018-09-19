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
        'avatar',
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
        'remember_token',
    ];
}
