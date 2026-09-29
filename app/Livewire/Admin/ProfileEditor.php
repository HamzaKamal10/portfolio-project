<?php

namespace App\Livewire\Admin;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEditor extends Component
{
    use WithFileUploads;

    public ?Profile $profile = null;

    public string $name_ar = '';
    public string $name_en = '';
    public string $headline_ar = '';
    public string $headline_en = '';
    public string $bio_ar = '';
    public string $bio_en = '';
    public string $email = '';
    public ?string $phone = null;
    public ?string $location_ar = null;
    public ?string $location_en = null;
    public ?string $linkedin_url = null;
    public ?string $github_url = null;
    public ?string $website_url = null;

    public $avatar;
    public $resume;

    public ?string $existingAvatar = null;
    public ?string $existingResume = null;

    public function mount(): void
    {
        $this->profile = Profile::query()->first();

        if (! $this->profile) {
            return;
        }

        $this->name_ar = $this->profile->name_ar ?? '';
        $this->name_en = $this->profile->name_en ?? '';
        $this->headline_ar = $this->profile->headline_ar ?? '';
        $this->headline_en = $this->profile->headline_en ?? '';
        $this->bio_ar = $this->profile->bio_ar ?? '';
        $this->bio_en = $this->profile->bio_en ?? '';
        $this->email = $this->profile->email ?? '';
        $this->phone = $this->profile->phone;
        $this->location_ar = $this->profile->location_ar;
        $this->location_en = $this->profile->location_en;
        $this->linkedin_url = $this->profile->linkedin_url;
        $this->github_url = $this->profile->github_url;
        $this->website_url = $this->profile->website_url;
        $this->existingAvatar = $this->profile->avatar;
        $this->existingResume = $this->profile->resume_file;
    }

    protected function rules(): array
    {
        return [
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'headline_ar' => ['required', 'string', 'max:255'],
            'headline_en' => ['required', 'string', 'max:255'],
            'bio_ar' => ['required', 'string', 'max:10000'],
            'bio_en' => ['required', 'string', 'max:10000'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location_ar' => ['nullable', 'string', 'max:255'],
            'location_en' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:2048'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'resume' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $profile = $this->profile ?? new Profile();

        $profile->fill([
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'],
            'headline_ar' => $validated['headline_ar'],
            'headline_en' => $validated['headline_en'],
            'bio_ar' => $validated['bio_ar'],
            'bio_en' => $validated['bio_en'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'location_ar' => $validated['location_ar'] ?? null,
            'location_en' => $validated['location_en'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'website_url' => $validated['website_url'] ?? null,
        ]);

        if ($this->avatar) {
            $oldAvatar = $profile->avatar;
            $profile->avatar = $this->avatar->store('profile', 'public');

            if ($oldAvatar) {
                Storage::disk('public')->delete($oldAvatar);
            }
        }

        if ($this->resume) {
            $oldResume = $profile->resume_file;
            $profile->resume_file = $this->resume->store('resumes', 'public');

            if ($oldResume) {
                Storage::disk('public')->delete($oldResume);
            }
        }

        $profile->save();
        $this->profile = $profile->fresh();
        $this->existingAvatar = $profile->avatar;
        $this->existingResume = $profile->resume_file;
        $this->avatar = null;
        $this->resume = null;

        session()->flash('success', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function removeResume(): void
    {
        if (! $this->profile?->resume_file) {
            return;
        }

        Storage::disk('public')->delete($this->profile->resume_file);
        $this->profile->update(['resume_file' => null]);
        $this->profile->refresh();
        $this->existingResume = null;

        session()->flash('success', 'تم حذف السيرة الذاتية.');
    }

    public function removeAvatar(): void
    {
        if (! $this->profile?->avatar) {
            return;
        }

        Storage::disk('public')->delete($this->profile->avatar);
        $this->profile->update(['avatar' => null]);
        $this->profile->refresh();
        $this->existingAvatar = null;

        session()->flash('success', 'تم حذف الصورة الشخصية.');
    }

    public function render()
    {
        return view('livewire.admin.profile-editor')
            ->layout('layouts.admin');
    }
}
