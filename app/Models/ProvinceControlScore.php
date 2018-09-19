<?php

namespace App\Models;

class ProvinceControlScore extends Model
{
    protected $table = 'province_control_scores';

    protected $fillable = ['province_id', 'year', 'batch', 'subject', 'score'];

    protected $hidden = [];

    /**
     * 关联省份 ID
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
