<?php

namespace App\Models;

class Professional extends Model
{
    protected $table = 'professionals';

    protected $fillable = [
        'professional_name',
        'professional_code',
        'parent_id',
        'top_parent_id',
        'professional_level',
        'ranking',
        'ranking_type',
    ];

    protected $hidden = [];

    /**
     * 关联专业详情表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function professionalDetail()
    {
        return $this->hasOne('App\Models\ProfessionalDetail');
    }
}
