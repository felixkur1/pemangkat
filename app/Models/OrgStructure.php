<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgStructure extends Model
{
    public $fillable = [
        'employee_id',
        'group_id',
        'position'
    ];

    public function group()
    {
        return $this->belongsTo(OrgGroup::class, 'group_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
