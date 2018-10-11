<?php

namespace App\Models;

class MbtiPrimaryReport extends Model
{
    protected $table = 'mbti_primary_reports';

    protected $fillable = [
        'mobile',
        'serial_number',
        'mbti_name',
        'mbti_category_id',
        'e',
        'i',
        's',
        'n',
        't',
        'f',
        'j',
        'p',
    ];

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
