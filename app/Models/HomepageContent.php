<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model
{
    public $fillable = [
        'name',
        'content'
    ];
}
