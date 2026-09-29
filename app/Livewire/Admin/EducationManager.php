<?php

namespace App\Livewire\Admin;

use App\Models\Education;
use Livewire\Component;
use Livewire\WithPagination;

class EducationManager extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showForm = false;
    public ?int $editingId = null;

    public string $institution_ar = '';
    public string $institution_en = '';
    public string $degree_ar = '';
    public string $degree_en = '';
    public string $description_ar = '';
    public string $description_en = '';
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $certificate_url = null;
    public int $sort_order = 0;
    public bool $is_visible = true;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    protected function rules(): array
    {
        return [
            'institution_ar' => ['required', 'string', 'max:255'],
            'institution_en' => ['required', 'string', 'max:255'],
            'degree_ar' => ['required', 'string', 'max:255'],
            'degree_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string', 'max:10000'],
            'description_en' => ['nullable', 'string', 'max:10000'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'certificate_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_visible' => ['boolean'],
        ];
    }

    public function render()
    {
        $educations = Education::query()
            ->when($this->search !== '', function ($query): void {
                $term = trim($this->search);

                $query->where(function ($query) use ($term): void {
                    $query->where('institution_ar', 'like', "%{$term}%")
                        ->orWhere('institution_en', 'like', "%{$term}%")
                        ->orWhere('degree_ar', 'like', "%{$term}%")
                        ->orWhere('degree_en', 'like', "%{$term}%");
                });
            })
            ->orderByDesc('end_date')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('livewire.admin.education-manager', compact('educations'))
            ->layout('layouts.admin');
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $education = Education::query()->findOrFail($id);

        $this->editingId = $education->id;
        $this->institution_ar = $education->institution_ar;
        $this->institution_en = $education->institution_en;
        $this->degree_ar = $education->degree_ar;
        $this->degree_en = $education->degree_en;
        $this->description_ar = $education->description_ar ?? '';
        $this->description_en = $education->description_en ?? '';
        $this->start_date = $education->start_date?->format('Y-m-d');
        $this->end_date = $education->end_date?->format('Y-m-d');
        $this->certificate_url = $education->certificate_url;
        $this->sort_order = $education->sort_order;
        $this->is_visible = $education->is_visible;
        $this->showForm = true;
    }

    public function save(): void
    {
        $validated = $this->validate();

        $education = $this->editingId
            ? Education::query()->findOrFail($this->editingId)
            : new Education();

        $education->fill($validated);
        $education->save();

        $this->resetForm();
        session()->flash('success', 'تم حفظ التعليم أو الدورة بنجاح.');
    }

    public function delete(int $id): void
    {
        Education::query()->findOrFail($id)->delete();
        session()->flash('success', 'تم حذف السجل بنجاح.');
    }

    public function toggleVisibility(int $id): void
    {
        $education = Education::query()->findOrFail($id);
        $education->update(['is_visible' => ! $education->is_visible]);
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'editingId',
            'institution_ar',
            'institution_en',
            'degree_ar',
            'degree_en',
            'description_ar',
            'description_en',
            'start_date',
            'end_date',
            'certificate_url',
            'sort_order',
            'is_visible',
        ]);

        $this->sort_order = 0;
        $this->is_visible = true;
        $this->showForm = false;
        $this->resetValidation();
    }
}
