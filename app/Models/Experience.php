<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company_ar', 'company_en', 
        'position_ar', 'position_en', 
        'start_date', 'end_date', 
        'description_ar', 'description_en'
    ];

    // 
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}