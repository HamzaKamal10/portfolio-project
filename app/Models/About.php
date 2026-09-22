<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 
        'job_title_ar', 'job_title_en', 
        'description_ar', 'description_en', 
        'cv_link', 'image'
    ];
}