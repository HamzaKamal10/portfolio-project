<?php

namespace App\Livewire\Admin;

use App\Models\Experience;
use Livewire\Component;
use Livewire\WithPagination;

class ExperienceManager extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showForm = false;
    public ?int $editingId = null;

    public string $company_ar = '';
    public string $company_en = '';
    public string $position_ar = '';
    public string $position_en = '';
    public string $description_ar = '';
    public string $description_en = '';
    public string $start_date = '';
    public ?string $end_date = null;
    public bool $is_current = false;
    public int $sort_order = 0;
    public bool $is_visible = true;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedIsCurrent(bool $value): void
    {
        if ($value) {
            $this->end_date = null;
        }
    }

    protected function rules(): array
    {
        return [
            'company_ar' => ['required', 'string', 'max:255'],
            'company_en' => ['required', 'string', 'max:255'],
            'position_ar' => ['required', 'string', 'max:255'],
            'position_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['required', 'string', 'max:10000'],
            'description_en' => ['required', 'string', 'max:10000'],
            'start_date' => ['required', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
                'required_unless:is_current,true',
            ],
            'is_current' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_visible' => ['boolean'],
        ];
    }

    public function render()
    {
        $experiences = Experience::query()
            ->when($this->search !== '', function ($query): void {
                $term = trim($this->search);

                $query->where(function ($query) use ($term): void {
                    $query->where('company_ar', 'like', "%{$term}%")
                        ->orWhere('company_en', 'like', "%{$term}%")
                        ->orWhere('position_ar', 'like', "%{$term}%")
                        ->orWhere('position_en', 'like', "%{$term}%");
                });
            })
            ->orderByDesc('is_current')
            ->orderByDesc('start_date')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('livewire.admin.experience-manager', compact('experiences'))
            ->layout('layouts.admin');
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $experience = Experience::query()->findOrFail($id);

        $this->editingId = $experience->id;
        $this->company_ar = $experience->company_ar;
        $this->company_en = $experience->company_en;
        $this->position_ar = $experience->position_ar;
        $this->position_en = $experience->position_en;
        $this->description_ar = $experience->description_ar;
        $this->description_en = $experience->description_en;
        $this->start_date = $experience->start_date?->format('Y-m-d') ?? '';
        $this->end_date = $experience->end_date?->format('Y-m-d');
        $this->is_current = $experience->is_current;
        $this->sort_order = $experience->sort_order;
        $this->is_visible = $experience->is_visible;
        $this->showForm = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $experience = $this->editingId
            ? Experience::query()->findOrFail($this->editingId)
            : new Experience();

        $experience->fill([
            'company_ar' => $validated['company_ar'],
            'company_en' => $validated['company_en'],
            'position_ar' => $validated['position_ar'],
            'position_en' => $validated['position_en'],
            'description_ar' => $validated['description_ar'],
            'description_en' => $validated['description_en'],
            'start_date' => $validated['start_date'],
            'end_date' => $this->is_current ? null : ($validated['end_date'] ?? null),
            'is_current' => (bool) $validated['is_current'],
            'sort_order' => $validated['sort_order'],
            'is_visible' => (bool) $validated['is_visible'],
        ]);

        $experience->save();

        $this->resetForm();
        session()->flash('success', 'تم حفظ الخبرة بنجاح.');
    }

    public function delete(int $id): void
    {
        Experience::query()->findOrFail($id)->delete();
        session()->flash('success', 'تم حذف الخبرة بنجاح.');
    }

    public function toggleVisibility(int $id): void
    {
        $experience = Experience::query()->findOrFail($id);
        $experience->update(['is_visible' => ! $experience->is_visible]);
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'editingId',
            'company_ar',
            'company_en',
            'position_ar',
            'position_en',
            'description_ar',
            'description_en',
            'start_date',
            'end_date',
            'is_current',
            'sort_order',
            'is_visible',
        ]);

        $this->sort_order = 0;
        $this->is_current = false;
        $this->is_visible = true;
        $this->showForm = false;
        $this->resetValidation();
    }
}
