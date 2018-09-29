<?php

namespace App\Models;

class SerialNumberLog extends Model
{
    protected $table = 'serial_number_logs';

    protected $fillable = ['serial_number_id', 'mobile', 'agent_id', 'student_id'];
}
