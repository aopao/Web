<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLoginLog extends Model
{
    protected $table = 'student_login_logs';

    protected $fillable = [
        'student_mobile',
        'ip',
        'platform',
        'device',
        'browser',
        'address',
        'created_at',
    ];
}
