<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeProfessional extends Model
{
    protected $table = 'college_professionals';

    protected $fillable = ['college_professional_name', 'is_important', 'description'];

    protected $hidden = ['description'];
}
