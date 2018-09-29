<?php

namespace App\Models;

class SerialNumberRecord extends Model
{
    protected $table = 'serial_number_records';

    protected $fillable = [
        'serial_number_id',
        'serial_number',
        'apesk_id',
        'username',
        'mobile',
        'agent_id',
        'student_id',
        'answers',
    ];
}
