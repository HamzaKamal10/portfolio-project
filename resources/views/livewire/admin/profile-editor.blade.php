<div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6">
    <div>
        <h1 class="text-2xl font-bold">الملف الشخصي</h1>
        <p class="text-sm text-slate-600">حدّث بيانات السيرة الذاتية والروابط والملفات.</p>
    </div>

    @if (session('success'))
        <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700" role="status">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-6 rounded-xl bg-white p-4 shadow sm:p-6">
        <section class="space-y-4" aria-labelledby="identity-heading">
            <h2 id="identity-heading" class="text-lg font-bold">البيانات الأساسية</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">الاسم بالعربية</span>
                    <input wire:model="name_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('name_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Name in English</span>
                    <input wire:model="name_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('name_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">المسمى الوظيفي بالعربية</span>
                    <input wire:model="headline_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('headline_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Headline in English</span>
                    <input wire:model="headline_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('headline_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>
        </section>

        <section class="space-y-4" aria-labelledby="bio-heading">
            <h2 id="bio-heading" class="text-lg font-bold">النبذة التعريفية</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">النبذة بالعربية</span>
                    <textarea wire:model="bio_ar" rows="7" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('bio_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Bio in English</span>
                    <textarea wire:model="bio_en" rows="7" dir="ltr" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('bio_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>
        </section>

        <section class="space-y-4" aria-labelledby="contact-heading">
            <h2 id="contact-heading" class="text-lg font-bold">بيانات التواصل</h2>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">البريد الإلكتروني</span>
                    <input wire:model="email" type="email" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('email') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">الهاتف - اختياري</span>
                    <input wire:model="phone" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('phone') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">الموقع بالعربية - اختياري</span>
                    <input wire:model="location_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('location_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Location in English - Optional</span>
                    <input wire:model="location_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('location_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <label>
                    <span class="mb-1 block text-sm font-medium">GitHub</span>
                    <input wire:model="github_url" type="url" dir="ltr" placeholder="https://github.com/..." class="w-full rounded-lg border-slate-300">
                    @error('github_url') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">LinkedIn</span>
                    <input wire:model="linkedin_url" type="url" dir="ltr" placeholder="https://linkedin.com/in/..." class="w-full rounded-lg border-slate-300">
                    @error('linkedin_url') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">موقع شخصي - اختياري</span>
                    <input wire:model="website_url" type="url" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('website_url') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>
        </section>

        <section class="space-y-4" aria-labelledby="files-heading">
            <h2 id="files-heading" class="text-lg font-bold">الصور والملفات</h2>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="space-y-3">
                    <label class="block">
                        <span class="mb-1 block text-sm font-medium">الصورة الشخصية</span>
                        <input wire:model="avatar" type="file" accept="image/jpeg,image/png,image/webp" class="w-full rounded-lg border-slate-300">
                        <small class="text-slate-500">JPG أو PNG أو WebP، حتى 2MB.</small>
                        @error('avatar') <small class="block text-red-600">{{ $message }}</small> @enderror
                    </label>

                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" alt="معاينة الصورة الشخصية" class="h-40 w-40 rounded-full object-cover">
                    @elseif ($existingAvatar)
                        <img src="{{ asset('storage/' . $existingAvatar) }}" alt="الصورة الشخصية الحالية" class="h-40 w-40 rounded-full object-cover">
                        <button type="button" wire:click="removeAvatar" wire:confirm="هل تريد حذف الصورة الشخصية؟" class="text-sm text-red-600 underline">حذف الصورة</button>
                    @endif
                </div>

                <div class="space-y-3">
                    <label class="block">
                        <span class="mb-1 block text-sm font-medium">السيرة الذاتية PDF</span>
                        <input wire:model="resume" type="file" accept="application/pdf" class="w-full rounded-lg border-slate-300">
                        <small class="text-slate-500">PDF فقط، حتى 5MB.</small>
                        @error('resume') <small class="block text-red-600">{{ $message }}</small> @enderror
                    </label>

                    @if ($resume)
                        <p class="text-sm text-emerald-700">تم اختيار ملف جديد: {{ $resume->getClientOriginalName() }}</p>
                    @elseif ($existingResume)
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ asset('storage/' . $existingResume) }}" target="_blank" rel="noopener noreferrer" class="text-sm underline">عرض السيرة الحالية</a>
                            <button type="button" wire:click="removeResume" wire:confirm="هل تريد حذف السيرة الذاتية؟" class="text-sm text-red-600 underline">حذف السيرة</button>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <div class="flex gap-3 border-t pt-5">
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white disabled:opacity-50">
                <span wire:loading.remove>حفظ التغييرات</span>
                <span wire:loading>جارٍ الحفظ...</span>
            </button>
        </div>
    </form>
</div>
