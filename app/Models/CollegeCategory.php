<?php

namespace App\Models;

class CollegeCategory extends Model
{
    protected $table = 'college_categories';

    protected $fillable = ['category_name', 'category_description'];

    protected $hidden = ['category_description'];
}
