<?php

namespace App\Models;

class CollegeDetail extends Model
{
    protected $table = 'college_details';

    protected $fillable = [
        'college_id',
        'college_code',
        'since',
        'web',
        'full_view',
        'doctor_number',
        'postgraduate_number',
        'membership',
        'telephone',
        'email',
        'all_clicks',
        'month_clicks',
        'week_clicks',
        'student_rank',
        'life_rank',
        'work_rank',
        'address',
        'old_college_name',
        'description',
        'charge_standard',
        'job_prospect',
    ];

    protected $hidden = [];
}
