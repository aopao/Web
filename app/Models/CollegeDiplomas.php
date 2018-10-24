<?php

namespace App\Models;

class CollegeDiplomas extends Model
{
    protected $table = 'college_diplomas';

    protected $fillable = ['name', 'description'];

    protected $hidden = ['description'];
}
