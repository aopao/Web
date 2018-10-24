<?php

namespace App\Models;

class MajorChoiceSeniorReport extends Model
{
    protected $table = 'major_choice_senior_reports';

    protected $fillable = [
        'mobile',
        'username',
        'serial_number',
        'mbti_name',
        'mbti_category_id',
        'mbti_e',
        'mbti_i',
        'mbti_s',
        'mbti_n',
        'mbti_t',
        'mbti_f',
        'mbti_j',
        'mbti_p',
        'holland_name',
        'holland_r',
        'holland_i',
        'holland_a',
        'holland_s',
        'holland_e',
        'holland_c',
        'subject_ratio',
        'answer',
    ];

    protected $casts = [
        'subject_ratio' => 'Array',
        'answer' => 'Array',
    ];

    public function getAnswerAttribute()
    {
        return json_decode($this->attributes['answer'], true);
    }

    /**
     * 关联序列号使用记录模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serialNumberRecord()
    {
        return $this->belongsTo('App\Models\SerialNumberRecord', 'serial_number', 'serial_number');
    }

    /**
     * 关联序列号使用记录模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function MbtiCategory()
    {
        return $this->belongsTo('App\Models\MbtiCategory');
    }
}
