<?php

namespace App\Models;

class SerialNumber extends Model
{
    protected $table = 'serial_numbers';

    protected $fillable = ['number', 'is_senior', 'is_invalid', 'parent'];
}
