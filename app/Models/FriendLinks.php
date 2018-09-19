<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendLinks extends Model
{
    protected $table = 'friend_links';

    protected $fillable = [
        'title',
        'thumb',
        'url',
        'type',
        'seat',
        'expire_date',
        'status',
    ];

    protected $hidden = [];
}
