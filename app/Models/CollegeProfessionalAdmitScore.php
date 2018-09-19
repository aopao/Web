<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeProfessionalAdmitScore extends Model
{
    protected $table = 'college_professional_admit_scores';

    protected $fillable = [
        'college_id',
        'province_id', //录取省份 ID
        'year',
        'professional_id',
        'college_batch_id',
        'subject',
        'plan_number',
        'lowest_score',
        'lowest_rank',
        'lowest_line',
        'average_score',
        'average_rank',
        'average_line',
        'advantage',
        'explain',
    ];

    protected $hidden = [];
}
