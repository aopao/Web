<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['province_id', 'city_name', 'code'];

    protected $hidden = ['code'];

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
