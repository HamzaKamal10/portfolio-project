<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold">إدارة المشاريع</h1>
            <p class="text-sm text-slate-600">إضافة وتعديل ونشر مشاريع Portfolio.</p>
        </div>
        <button type="button" wire:click="create" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
            مشروع جديد
        </button>
    </div>

    @if (session('success'))
        <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700">{{ session('success') }}</div>
    @endif

    <div class="grid gap-3 rounded-xl bg-white p-4 shadow sm:grid-cols-2">
        <label class="block">
            <span class="mb-1 block text-sm font-medium">بحث</span>
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="ابحث بالعنوان..." class="w-full rounded-lg border-slate-300">
        </label>
        <label class="block">
            <span class="mb-1 block text-sm font-medium">الحالة</span>
            <select wire:model.live="status" class="w-full rounded-lg border-slate-300">
                <option value="all">الكل</option>
                <option value="visible">منشور</option>
                <option value="hidden">مخفي</option>
            </select>
        </label>
    </div>

    @if ($showForm)
        <form wire:submit="save" class="space-y-5 rounded-xl bg-white p-4 shadow sm:p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">{{ $editingId ? 'تعديل المشروع' : 'إضافة مشروع' }}</h2>
                <button type="button" wire:click="cancel" class="text-sm underline">إلغاء</button>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">العنوان بالعربية</span>
                    <input wire:model="title_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('title_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">Title in English</span>
                    <input wire:model="title_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('title_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <label>
                <span class="mb-1 block text-sm font-medium">Slug (الرابط الدائم)</span>
                <input wire:model="slug" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                @error('slug') <small class="text-red-600">{{ $message }}</small> @enderror
            </label>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">الوصف بالعربية</span>
                    <textarea wire:model="description_ar" rows="4" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('description_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">Description in English</span>
                    <textarea wire:model="description_en" rows="4" dir="ltr" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('description_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <label>
                <span class="mb-1 block text-sm font-medium">التقنيات (مفصولة بفاصلة)</span>
                <input wire:model="technologiesInput" type="text" placeholder="Laravel, Tailwind, Livewire" dir="ltr" class="w-full rounded-lg border-slate-300">
                @error('technologiesInput') <small class="text-red-600">{{ $message }}</small> @enderror
            </label>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">رابط المشروع</span>
                    <input wire:model="project_url" type="url" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('project_url') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">رابط GitHub</span>
                    <input wire:model="github_url" type="url" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('github_url') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <label>
                    <span class="mb-1 block text-sm font-medium">تاريخ الإنجاز</span>
                    <input wire:model="completed_at" type="date" class="w-full rounded-lg border-slate-300">
                    @error('completed_at') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">الترتيب</span>
                    <input wire:model="sort_order" type="number" class="w-full rounded-lg border-slate-300">
                    @error('sort_order') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">صورة المشروع</span>
                    <input wire:model="image" type="file" accept="image/*" class="w-full rounded-lg border-slate-300">
                    @error('image') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="h-32 rounded-lg object-cover">
            @elseif ($existingImage)
                <img src="{{ asset('storage/' . $existingImage) }}" class="h-32 rounded-lg object-cover">
            @endif

            <div class="flex flex-wrap gap-5">
                <label class="inline-flex items-center gap-2"><input wire:model="is_featured" type="checkbox" class="rounded"><span>مشروع مميز</span></label>
                <label class="inline-flex items-center gap-2"><input wire:model="is_visible" type="checkbox" class="rounded"><span>منشور للزوار</span></label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white">حفظ</button>
                <button type="button" wire:click="cancel" class="rounded-lg border px-5 py-2">إلغاء</button>
            </div>
        </form>
    @endif

    <div class="overflow-hidden rounded-xl bg-white shadow">
        <table class="min-w-full text-right text-sm">
            <thead class="bg-slate-100">
            <tr>
                <th class="px-4 py-3">المشروع</th>
                <th class="px-4 py-3">الحالة</th>
                <th class="px-4 py-3">الإجراءات</th>
            </tr>
            </thead>
            <tbody class="divide-y">
            @foreach ($projects as $project)
                <tr>
                    <td class="px-4 py-3">
                        <div class="font-semibold">{{ $project->title_ar }} / {{ $project->title_en }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <button wire:click="toggleVisibility({{ $project->id }})" class="rounded-full px-3 py-1 text-xs {{ $project->is_visible ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ $project->is_visible ? 'منشور' : 'مخفي' }}
                        </button>
                    </td>
                    <td class="space-x-2 px-4 py-3 rtl:space-x-reverse">
                        <button wire:click="edit({{ $project->id }})" class="underline text-blue-600">تعديل</button>
                        <button wire:click="delete({{ $project->id }})" class="text-red-600 underline">حذف</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="p-4 border-t">{{ $projects->links() }}</div>
    </div>
</div>
