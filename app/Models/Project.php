<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title_ar', 'title_en', 
        'description_ar', 'description_en', 
        'image', 'url', 'github_url'
    ];
}