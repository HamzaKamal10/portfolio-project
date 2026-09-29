<?php

namespace App\Livewire\Admin;

use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;

class SkillsManager extends Component
{
    use WithPagination;

    public $name_ar = '', $name_en = '', $category = '', $proficiency = null;
    public $sort_order = 0;
    public $is_visible = true;
    public $editingId = null;
    public $showForm = false;

    protected $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'category' => 'nullable|string|max:255',
        'proficiency' => 'nullable|integer|min:1|max:100',
        'sort_order' => 'required|integer|min:0',
        'is_visible' => 'boolean',
    ];

    public function render()
    {
        $skills = Skill::orderBy('sort_order')->paginate(10);
        return view('livewire.admin.skills-manager', compact('skills'))->layout('layouts.admin');
    }

    public function create()
    {
        $this->reset(['name_ar', 'name_en', 'category', 'proficiency', 'editingId']);
        $this->sort_order = 0;
        $this->is_visible = true;
        $this->showForm = true;
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $this->editingId = $skill->id;
        $this->name_ar = $skill->name_ar;
        $this->name_en = $skill->name_en;
        $this->category = $skill->category;
        $this->proficiency = $skill->proficiency;
        $this->sort_order = $skill->sort_order;
        $this->is_visible = $skill->is_visible;
        $this->showForm = true;
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->editingId) {
            Skill::findOrFail($this->editingId)->update($data);
        } else {
            Skill::create($data);
        }

        $this->showForm = false;
        session()->flash('success', 'تم حفظ المهارة بنجاح.');
    }

    public function delete($id)
    {
        Skill::findOrFail($id)->delete();
        session()->flash('success', 'تم حذف المهارة.');
    }

    public function toggleVisibility($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update(['is_visible' => !$skill->is_visible]);
    }
}
