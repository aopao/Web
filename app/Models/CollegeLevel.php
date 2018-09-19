<?php

namespace App\Models;

class CollegeLevel extends Model
{
    protected $table = 'college_levels';

    protected $fillable = ['level_name', 'level_description'];

    protected $hidden = ['level_description'];
}
