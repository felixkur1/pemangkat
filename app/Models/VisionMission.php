<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    public $fillable = [
        'type',
        'value',
    ];

    public function scopeVision($query) {
        return $query->where('type', 'visi');
    }

    public function scopeMissions($query) {
        return $query->where('type', 'misi');
    }
}
