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
        $profile = Profile::query()->first();

        if (! $profile) {
            abort(503, 'Portfolio is being set up. Please check back soon.');
        }

        return view('home', [
            'profile' => $profile,
            'skills' => Skill::query()->visible()->ordered()->get(),
            'experiences' => Experience::query()->visible()->ordered()->get(),
            'educations' => Education::query()->visible()->ordered()->get(),
            'projects' => Project::query()->visible()->featured()->ordered()->get(),
        ]);
    }
}
