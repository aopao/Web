<?php

namespace App\Models;

class CollegeDiplomas extends Model
{
    protected $table = 'college_diplomas';

    protected $fillable = ['diplomas_name', 'diplomas_description'];

    protected $hidden = ['diplomas_description'];
}
