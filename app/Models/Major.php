<?php

namespace App\Models;

class Major extends Model
{
    protected $table = 'majors';

    protected $fillable = [
        'name',
        'code',
        'parent_id',
        'top_parent_id',
        'level',
        'ranking',
        'ranking_type',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];

    /**
     * 关联专业详细表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function majorDetail()
    {
        return $this->hasOne('App\Models\MajorDetail');
    }

    /**
     * 关联专业分类表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professionalParentCategory()
    {
        return $this->belongsTo('App\Models\ProfessionalCategory', 'parent_id');
    }

    /**
     * 关联顶级专业分类表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professionalTopCategory()
    {
        return $this->belongsTo('App\Models\ProfessionalCategory', 'top_parent_id');
    }
}
