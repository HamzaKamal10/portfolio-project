<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold">إدارة التعليم والدورات</h1>
            <p class="text-sm text-slate-600">أضف المؤهلات والدورات ورتبها.</p>
        </div>

        <button type="button"
                wire:click="create"
                class="rounded-lg bg-slate-900 px-4 py-2 font-semibold text-white hover:bg-slate-700">
            إضافة سجل
        </button>
    </div>

    @if (session('success'))
        <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700" role="status">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-xl bg-white p-4 shadow">
        <label class="block max-w-xl">
            <span class="mb-1 block text-sm font-medium">بحث</span>
            <input type="search"
                   wire:model.live.debounce.300ms="search"
                   placeholder="ابحث بالمؤسسة أو الدرجة..."
                   class="w-full rounded-lg border-slate-300">
        </label>
    </div>

    @if ($showForm)
        <form wire:submit="save" class="space-y-5 rounded-xl bg-white p-4 shadow sm:p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">
                    {{ $editingId ? 'تعديل السجل' : 'إضافة سجل' }}
                </h2>
                <button type="button" wire:click="cancel" class="text-sm underline">إلغاء</button>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">المؤسسة بالعربية</span>
                    <input wire:model="institution_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('institution_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Institution in English</span>
                    <input wire:model="institution_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('institution_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">الدرجة العلمية بالعربية</span>
                    <input wire:model="degree_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('degree_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Degree in English</span>
                    <input wire:model="degree_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('degree_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">الوصف بالعربية - اختياري</span>
                    <textarea wire:model="description_ar" rows="5" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('description_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Description in English - Optional</span>
                    <textarea wire:model="description_en" rows="5" dir="ltr" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('description_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-4">
                <label>
                    <span class="mb-1 block text-sm font-medium">تاريخ البدء</span>
                    <input wire:model="start_date" type="date" class="w-full rounded-lg border-slate-300">
                    @error('start_date') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">تاريخ الانتهاء</span>
                    <input wire:model="end_date" type="date" class="w-full rounded-lg border-slate-300">
                    @error('end_date') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">الترتيب</span>
                    <input wire:model="sort_order" type="number" min="0" class="w-full rounded-lg border-slate-300">
                    @error('sort_order') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">رابط الشهادة - اختياري</span>
                    <input wire:model="certificate_url" type="url" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('certificate_url') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <label class="inline-flex items-center gap-2">
                <input wire:model="is_visible" type="checkbox" class="rounded">
                <span>ظاهر للزوار</span>
            </label>

            <div class="flex gap-3">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white disabled:opacity-50">
                    <span wire:loading.remove>حفظ</span>
                    <span wire:loading>جارٍ الحفظ...</span>
                </button>
                <button type="button" wire:click="cancel" class="rounded-lg border px-5 py-2">إلغاء</button>
            </div>
        </form>
    @endif

    <div class="overflow-hidden rounded-xl bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3">المؤسسة</th>
                    <th class="px-4 py-3">الدرجة</th>
                    <th class="px-4 py-3">الفترة</th>
                    <th class="px-4 py-3">الحالة</th>
                    <th class="px-4 py-3">الإجراءات</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse ($educations as $education)
                    <tr wire:key="education-{{ $education->id }}">
                        <td class="px-4 py-3">
                            <div class="font-semibold">{{ $education->localized('institution') }}</div>
                            <div class="text-xs text-slate-500">{{ $education->institution_en }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $education->localized('degree') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $education->start_date?->format('Y-m-d') ?: '—' }}
                            —
                            {{ $education->end_date?->format('Y-m-d') ?: '—' }}
                        </td>
                        <td class="px-4 py-3">
                            <button type="button"
                                    wire:click="toggleVisibility({{ $education->id }})"
                                    class="rounded-full px-3 py-1 text-xs {{ $education->is_visible ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $education->is_visible ? 'ظاهر' : 'مخفي' }}
                            </button>
                        </td>
                        <td class="space-x-2 px-4 py-3 rtl:space-x-reverse">
                            <button type="button" wire:click="edit({{ $education->id }})" class="underline">تعديل</button>
                            <button type="button"
                                    wire:click="delete({{ $education->id }})"
                                    wire:confirm="هل تريد حذف هذا السجل؟"
                                    class="text-red-600 underline">
                                حذف
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">لا توجد سجلات.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $educations->links() }}
        </div>
    </div>
</div>
