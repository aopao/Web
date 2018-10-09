<?php

namespace App\Models;

class SerialNumberRecord extends Model
{
    protected $table = 'serial_number_records';

    protected $fillable = [
        'serial_number_id',
        'serial_number',
        'assessment_type',
        'apesk_id',
        'username',
        'mobile',
        'answers',
    ];

    /**
     * 关联序列号模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serialNumberInfo()
    {
        return $this->belongsTo('App\Models\SerialNumber', 'serial_number_id');
    }

    /**
     * 关联学生模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'mobile', 'mobile');
    }
}
