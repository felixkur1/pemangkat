<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'views',
        'thumbnail',
        'type',
        'content',
        'published_at',
        'highlighted',
    ];
}
