<?php

namespace App\Models;

class MbtiSeniorIssue extends Model
{
    protected $table = 'mbti_senior_issues';

    protected $fillable = ['issue', 'answer1', 'answer2'];
}
