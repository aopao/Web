<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentLoginLog extends Model
{
    protected $table = 'agent_login_logs';

    protected $fillable = [
        'agent_mobile',
        'ip',
        'platform',
        'device',
        'browser',
        'address',
        'created_at',
    ];
}
