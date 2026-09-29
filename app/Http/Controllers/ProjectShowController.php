<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectShowController extends Controller
{
    public function __invoke(string $locale, Project $project)
    {
        abort_unless($project->is_visible, 404);

        return view('projects.show', [
            'project' => $project,
            'title' => $project->localized('title'),
            'description' => $project->localized('description'),
            'image' => $project->image
                ? asset('storage/' . $project->image)
                : asset('images/og-image.jpg'),
        ]);
    }
}
