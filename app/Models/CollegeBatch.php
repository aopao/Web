<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeBatch extends Model
{
    protected $table = 'college_batchs';

    protected $fillable = ['college_id', 'batch_name', 'year', 'description'];

    protected $hidden = ['description'];
}
