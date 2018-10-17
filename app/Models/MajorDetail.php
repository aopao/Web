<?php

namespace App\Models;

class MajorDetail extends Model
{
    protected $table = 'major_details';

    protected $fillable = [
        'major_id',
        'clicks',
        'awarded_degree',
        'job_direction',
        'graduation_student_num',
        'work_rate',
        'subject_art_rate',
        'subject_math_rate',
        'gender_male_rate',
        'gender_female_rate',
        'description',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];

    protected $casts = [
        'work_rate' => 'Array',
        'subject_rate' => 'Array',
        'gender_rate' => 'Array',
    ];
}
