<?php

namespace App\Models;

class MbtiPrimaryIssue extends Model
{
    protected $table = 'mbti_primary_issues';

    protected $fillable = ['issue', 'answer1', 'answer2'];
}
