<?php

namespace App\Models;

class ProfessionalCategory extends Model
{
    protected $table = 'professional_categories';

    protected $fillable = [
        'professional_category_name',
        'professional_category_code',
        'parent_id',
        'description',
    ];

    protected $hidden = ['description'];
}
