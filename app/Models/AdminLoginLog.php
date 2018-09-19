<?php

namespace App\Models;

class AdminLoginLog extends Model
{
    protected $table = 'admin_login_logs';

    protected $fillable = [
        'admin_mobile',
        'ip',
        'platform',
        'device',
        'browser',
        'address',
        'created_at',
    ];
}
