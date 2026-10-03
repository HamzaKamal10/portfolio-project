<?php

namespace App\Models;

use App\Models\Traits\HasLocalization;
use App\Models\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory, HasLocalization, HasVisibility;

    protected $fillable = [
        'name_ar',
        'name_en',
        'category',
        'proficiency',
        'sort_order',
        'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'proficiency' => 'integer',
            'sort_order' => 'integer',
            'is_visible' => 'boolean',
        ];
    }
}
