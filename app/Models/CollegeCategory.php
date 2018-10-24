<?php

namespace App\Models;

class CollegeCategory extends Model
{
    protected $table = 'college_categories';

    protected $fillable = ['name', 'description'];

    protected $hidden = ['description'];
}
