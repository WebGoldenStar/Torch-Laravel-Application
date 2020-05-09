<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $hidden = [
        'remember_token',
    ];

    protected $fillable = [
        'title', 'content', 'poster_url'
    ];
}
