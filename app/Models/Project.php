<?php

namespace App\Models;

use App\Models\Traits\HasLocalization;
use App\Models\Traits\HasVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasLocalization, HasVisibility;

    protected $fillable = [
        'title_ar',
        'title_en',
        'slug',
        'description_ar',
        'description_en',
        'project_url',
        'github_url',
        'technologies',
        'completed_at',
        'sort_order',
        'is_featured',
        'is_visible',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'completed_at' => 'date',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
        ];
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
