<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentProvince extends Model
{
    protected $table = 'agent_provinces';

    protected $fillable = [
        'agent_id',
        'province_id',
    ];
}
