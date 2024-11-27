<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPenting extends Model
{
    public $fillable = [
        'location_name',
        'image_url',
        'description',
        'link_gmaps'
    ];
}
