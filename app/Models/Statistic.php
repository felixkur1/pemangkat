<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $fillable = [
        'category',
        'label',
        'jumlah'
    ];
}
