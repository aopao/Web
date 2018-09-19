<?php

namespace App\Models;

class ProfessionalDetail extends Model
{
    protected $table = 'professional_details';

    protected $fillable = [
        'professional_id',
        'clicks',
        'awarded_degree',
        'job_direction',
        'graduation_student_num',
        'work_rate',
        'subject_rate',
        'gender_rate',
        'description',
    ];

    protected $hidden = [];
}
