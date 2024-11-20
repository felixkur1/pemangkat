<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicDocument extends Model
{
    public $fillable = [
        'title',
        'year',
        'description',
        'type',
        'document_url'
    ];

    public function getIconPathAttribute()
    {
        $icons = [
            'application/pdf' => 'pdf-icon.png',
            'application/msword' => 'docx-icon.png',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx-icon.png',
            'application/vnd.ms-excel' => 'xlsx-icon.png',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx-icon.png',
        ];

        return asset('icons/' . ($icons[$this->type] ?? 'default-icon.png'));
    }

}
