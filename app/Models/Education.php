<?php

namespace App\Models;

use App\Models\Traits\HasLocalization;
use App\Models\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, HasLocalization, HasVisibility;

    protected $table = 'educations';

    protected $fillable = [
        'institution_ar',
        'institution_en',
        'degree_ar',
        'degree_en',
        'description_ar',
        'description_en',
        'start_date',
        'end_date',
        'certificate_url',
        'sort_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'sort_order' => 'integer',
            'is_visible' => 'boolean',
        ];
    }
}
