<?php

namespace App\Models;

class College extends Model
{
    protected $table = 'colleges';

    protected $fillable = [
        'college_name',
        'college_english_name',
        'college_rank',
        'province_id',
        'city_id',
        'college_level_id',
        'college_category_id',
        'is_belong_to_edu',
        'is_belong_to_center',
        'is_nation',
        'is_985',
        'is_211',
        'is_top_college',
    ];

    protected $hidden = [];

    /**
     * 关联大学详情表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CollegeDetail()
    {
        return $this->hasOne('App\Models\CollegeDetail');
    }

    /**
     * 关联大学所有批次
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CollegeBatch()
    {
        return $this->hasMany('App\Models\CollegeBatch');
    }

    /**
     * 关联大学类型
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function CollegeCategory()
    {
        return $this->belongsTo('App\Models\CollegeCategory');
    }

    /**
     * 关联大学层次
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function CollegeLevel()
    {
        return $this->belongsTo('App\Models\CollegeLevel');
    }

    /**
     * 关联大学所在省份
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
