<?php

namespace App\Livewire\Pub;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';
    public bool $sent = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function send(): void
    {
        $validated = $this->validate();

        // Log the contact message (in production, this could send an email)
        Log::info('Contact form submission', $validated);

        $this->reset(['name', 'email', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.public.contact-form');
    }
}
