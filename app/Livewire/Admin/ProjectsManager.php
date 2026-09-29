<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProjectsManager extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $search = '';
    public string $status = 'all';
    public bool $showForm = false;
    public ?int $editingId = null;

    public string $title_ar = '';
    public string $title_en = '';
    public string $slug = '';
    public string $description_ar = '';
    public string $description_en = '';
    public ?string $project_url = null;
    public ?string $github_url = null;
    public string $technologiesInput = '';
    public ?string $completed_at = null;
    public int $sort_order = 0;
    public bool $is_featured = false;
    public bool $is_visible = true;
    public $image;
    public ?string $existingImage = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    protected function rules(): array
    {
        $slugRule = Rule::unique('projects', 'slug');
        if ($this->editingId) {
            $slugRule = $slugRule->ignore($this->editingId);
        }

        return [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', $slugRule],
            'description_ar' => ['required', 'string', 'max:10000'],
            'description_en' => ['required', 'string', 'max:10000'],
            'project_url' => ['nullable', 'url', 'max:2048'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'technologiesInput' => ['nullable', 'string', 'max:1000'],
            'completed_at' => ['nullable', 'date'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_featured' => ['boolean'],
            'is_visible' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search !== '', function ($query) {
                $query->where('title_ar', 'like', '%' . $this->search . '%')
                    ->orWhere('title_en', 'like', '%' . $this->search . '%');
            })
            ->when($this->status === 'visible', fn ($query) => $query->where('is_visible', true))
            ->when($this->status === 'hidden', fn ($query) => $query->where('is_visible', false))
            ->latest('updated_at')
            ->paginate(10);

        return view('livewire.admin.projects-manager', compact('projects'))
            ->layout('layouts.admin');
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $project = Project::query()->findOrFail($id);

        $this->editingId = $project->id;
        $this->title_ar = $project->title_ar;
        $this->title_en = $project->title_en;
        $this->slug = $project->slug;
        $this->description_ar = $project->description_ar;
        $this->description_en = $project->description_en;
        $this->project_url = $project->project_url;
        $this->github_url = $project->github_url;
        $this->technologiesInput = implode(', ', $project->technologies ?? []);
        $this->completed_at = $project->completed_at?->format('Y-m-d');
        $this->sort_order = $project->sort_order;
        $this->is_featured = $project->is_featured;
        $this->is_visible = $project->is_visible;
        $this->existingImage = $project->image;
        $this->image = null;
        $this->showForm = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $project = $this->editingId
            ? Project::query()->findOrFail($this->editingId)
            : new Project();

        $data = [
            'title_ar' => $validated['title_ar'],
            'title_en' => $validated['title_en'],
            'slug' => $validated['slug'],
            'description_ar' => $validated['description_ar'],
            'description_en' => $validated['description_en'],
            'project_url' => $validated['project_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'technologies' => $this->parseTechnologies($this->technologiesInput),
            'completed_at' => $validated['completed_at'] ?? null,
            'sort_order' => $validated['sort_order'],
            'is_featured' => (bool) $validated['is_featured'],
            'is_visible' => (bool) $validated['is_visible'],
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('projects', 'public');
        }

        $project->fill($data);
        $project->save();

        $this->resetForm();
        session()->flash('success', 'تم حفظ المشروع بنجاح.');
    }

    public function delete(int $id): void
    {
        Project::query()->findOrFail($id)->delete();
        session()->flash('success', 'تم حذف المشروع بنجاح.');
    }

    public function toggleVisibility(int $id): void
    {
        $project = Project::query()->findOrFail($id);
        $project->update(['is_visible' => ! $project->is_visible]);
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    private function parseTechnologies(?string $value): array
    {
        return collect(explode(',', (string) $value))
            ->map(fn (string $item) => trim($item))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function resetForm(): void
    {
        $this->reset([
            'editingId', 'title_ar', 'title_en', 'slug', 'description_ar', 'description_en',
            'project_url', 'github_url', 'technologiesInput', 'completed_at',
            'sort_order', 'is_featured', 'is_visible', 'image', 'existingImage',
        ]);
        $this->sort_order = 0;
        $this->is_featured = false;
        $this->is_visible = true;
        $this->showForm = false;
    }
}
