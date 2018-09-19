<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeAdmitScore extends Model
{
    protected $table = 'college_admit_scores';

    protected $fillable = [
        'year',
        'college_id',
        'college_province_id',
        'admit_province_id',
        'admit_province_score',
        'subject',
        'college_batch_id',
        'min_score',
        'average_score',
        'max_score',
        'admit_num',
        'score_poor',
    ];

    protected $hidden = [];
}
