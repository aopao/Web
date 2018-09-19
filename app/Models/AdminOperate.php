<?php

namespace App\Models;

class AdminOperate extends Model
{
    protected $table = 'admin_operates';

    protected $fillable = [
        'admin_id',
        'path',
        'method',
        'ip',
        'sql',
    ];
}
