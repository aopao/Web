<?php

namespace App\Models;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = ['name', 'value', 'display_name', 'desc'];

    protected $hidden = ['desc'];
}
