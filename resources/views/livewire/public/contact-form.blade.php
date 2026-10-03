<div>
    @if ($sent)
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-6 text-center">
            <svg class="mx-auto mb-3 h-10 w-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="font-semibold text-emerald-800">{{ __('messages.message_sent') }}</p>
        </div>
    @else
        <form wire:submit="send" class="space-y-5 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            {{-- Name --}}
            <div>
                <label for="contact-name" class="mb-1 block text-sm font-medium text-slate-700">{{ __('messages.your_name') }}</label>
                <input wire:model="name" type="text" id="contact-name"
                       class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                       required>
                @error('name') <small class="mt-1 text-sm text-red-600">{{ $message }}</small> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="contact-email" class="mb-1 block text-sm font-medium text-slate-700">{{ __('messages.your_email') }}</label>
                <input wire:model="email" type="email" id="contact-email" dir="ltr"
                       class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                       required>
                @error('email') <small class="mt-1 text-sm text-red-600">{{ $message }}</small> @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="contact-message" class="mb-1 block text-sm font-medium text-slate-700">{{ __('messages.your_message') }}</label>
                <textarea wire:model="message" id="contact-message" rows="5"
                          class="w-full rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                          required></textarea>
                @error('message') <small class="mt-1 text-sm text-red-600">{{ $message }}</small> @enderror
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-500 disabled:opacity-50"
                    wire:loading.attr="disabled">
                <span wire:loading.remove>{{ __('messages.send_message') }}</span>
                <span wire:loading>
                    <svg class="mx-auto h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                </span>
            </button>
        </form>
    @endif
</div>
