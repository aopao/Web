<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MbtiPrimaryReport extends Model
{
    protected $table = 'mbti_primary_reports';

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
