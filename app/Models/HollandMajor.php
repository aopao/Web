<?php

namespace App\Models;

class HollandMajor extends Model
{
    /**
     * 关联专业表模型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function majors()
    {
        return $this->belongsTo('App\Models\Major', 'major_id');
    }
}
