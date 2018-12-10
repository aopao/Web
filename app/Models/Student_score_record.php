<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student_score_record extends Model
{
    protected $fillable = ['score', 'note', 'student_id'];
}
