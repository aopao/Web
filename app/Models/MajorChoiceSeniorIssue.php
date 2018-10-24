<?php

namespace App\Models;

class MajorChoiceSeniorIssue extends Model
{
    protected $table = 'major_choice_senior_issues';

    protected $fillable = [
        'issue',
        'answer1_tip',
        'answer1_value',
        'answer2_tip',
        'answer2_value',
        'answer3_tip',
        'answer3_value',
        'answer4_tip',
        'answer4_value',
    ];
}
