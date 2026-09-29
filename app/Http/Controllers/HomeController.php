<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'profile' => Profile::query()->firstOrFail(),
            'skills' => Skill::query()->visible()->ordered()->get(),
            'experiences' => Experience::query()->visible()->ordered()->get(),
            'educations' => Education::query()->visible()->ordered()->get(),
            'projects' => Project::query()->visible()->featured()->ordered()->get(),
        ]);
    }
}
