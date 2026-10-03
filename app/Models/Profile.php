<?php

namespace App\Models;

use App\Models\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, HasLocalization;

    protected $fillable = [
        'name_ar',
        'name_en',
        'headline_ar',
        'headline_en',
        'bio_ar',
        'bio_en',
        'email',
        'phone',
        'location_ar',
        'location_en',
        'avatar',
        'resume_file',
        'linkedin_url',
        'github_url',
        'website_url',
    ];
}
