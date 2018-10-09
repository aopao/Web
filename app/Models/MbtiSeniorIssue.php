<?php

namespace App\Models;

class MbtiSeniorIssue extends Model
{
    protected $table = 'mbti_senior_issues';

    protected $fillable = [
        'issue',
        'part',
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
