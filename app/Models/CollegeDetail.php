<?php

namespace App\Models;

class CollegeDetail extends Model
{
    protected $table = 'college_details';

    protected $fillable = [
        'college_id',
        'college_code',
        'web',
        'full_view',
        'membership',
        'telephone',
        'email',
        'address',
        'old_college_name',
        'description',
        'charge_standard',
        'job_prospect',
    ];

    protected $hidden = [];
}
