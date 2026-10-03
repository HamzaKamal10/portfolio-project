<?php

namespace App\Livewire\Pub;

use App\Models\Project;
use Livewire\Component;

class ProjectFilter extends Component
{
    public string $search = '';
    public string $technology = '';

    public function updatedSearch(): void
    {
        // Livewire handles reactivity automatically
    }

    public function updatedTechnology(): void
    {
        // Livewire handles reactivity automatically
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->technology = '';
    }

    public function render()
    {
        $projects = Project::query()
            ->visible()
            ->ordered()
            ->when($this->search !== '', function ($query) {
                $term = trim($this->search);
                $query->where(function ($q) use ($term) {
                    $q->where('title_ar', 'like', "%{$term}%")
                      ->orWhere('title_en', 'like', "%{$term}%")
                      ->orWhere('description_ar', 'like', "%{$term}%")
                      ->orWhere('description_en', 'like', "%{$term}%");
                });
            })
            ->when($this->technology !== '', function ($query) {
                $query->whereJsonContains('technologies', $this->technology);
            })
            ->get();

        // Collect all unique technologies for filter dropdown
        $allTechnologies = Project::query()
            ->visible()
            ->pluck('technologies')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('livewire.public.project-filter', [
            'projects' => $projects,
            'allTechnologies' => $allTechnologies,
        ]);
    }
}
