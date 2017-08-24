<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts_likes extends Model
{
    protected $fillable = [
        'post_id', 'user_id',
    ];
}
