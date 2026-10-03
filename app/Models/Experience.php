<?php

namespace App\Models;

use App\Models\Traits\HasLocalization;
use App\Models\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory, HasLocalization, HasVisibility;

    protected $fillable = [
        'company_ar',
        'company_en',
        'position_ar',
        'position_en',
        'description_ar',
        'description_en',
        'start_date',
        'end_date',
        'is_current',
        'sort_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
            'sort_order' => 'integer',
            'is_visible' => 'boolean',
        ];
    }
}
