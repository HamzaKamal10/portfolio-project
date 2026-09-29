<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold">إدارة الخبرات</h1>
            <p class="text-sm text-slate-600">أضف خبراتك ورتبها وأدر ظهورها للزوار.</p>
        </div>

        <button type="button"
                wire:click="create"
                class="rounded-lg bg-slate-900 px-4 py-2 font-semibold text-white hover:bg-slate-700">
            إضافة خبرة
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
                   placeholder="ابحث بالشركة أو المنصب..."
                   class="w-full rounded-lg border-slate-300">
        </label>
    </div>

    @if ($showForm)
        <form wire:submit="save" class="space-y-5 rounded-xl bg-white p-4 shadow sm:p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">
                    {{ $editingId ? 'تعديل الخبرة' : 'إضافة خبرة' }}
                </h2>
                <button type="button" wire:click="cancel" class="text-sm underline">إلغاء</button>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">اسم الشركة بالعربية</span>
                    <input wire:model="company_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('company_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Company name in English</span>
                    <input wire:model="company_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('company_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">المنصب بالعربية</span>
                    <input wire:model="position_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('position_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Position in English</span>
                    <input wire:model="position_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('position_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">الوصف بالعربية</span>
                    <textarea wire:model="description_ar" rows="6" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('description_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">Description in English</span>
                    <textarea wire:model="description_en" rows="6" dir="ltr" class="w-full rounded-lg border-slate-300"></textarea>
                    @error('description_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <label>
                    <span class="mb-1 block text-sm font-medium">تاريخ البدء</span>
                    <input wire:model="start_date" type="date" class="w-full rounded-lg border-slate-300">
                    @error('start_date') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">تاريخ الانتهاء</span>
                    <input wire:model="end_date"
                           type="date"
                           @disabled($is_current)
                           class="w-full rounded-lg border-slate-300 disabled:bg-slate-100">
                    @error('end_date') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>

                <label>
                    <span class="mb-1 block text-sm font-medium">الترتيب</span>
                    <input wire:model="sort_order" type="number" min="0" class="w-full rounded-lg border-slate-300">
                    @error('sort_order') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="flex flex-wrap gap-5">
                <label class="inline-flex items-center gap-2">
                    <input wire:model.live="is_current" type="checkbox" class="rounded">
                    <span>مستمر حتى الآن</span>
                </label>

                <label class="inline-flex items-center gap-2">
                    <input wire:model="is_visible" type="checkbox" class="rounded">
                    <span>ظاهر للزوار</span>
                </label>
            </div>

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
                    <th class="px-4 py-3">الشركة</th>
                    <th class="px-4 py-3">المنصب</th>
                    <th class="px-4 py-3">الفترة</th>
                    <th class="px-4 py-3">الحالة</th>
                    <th class="px-4 py-3">الإجراءات</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse ($experiences as $experience)
                    <tr wire:key="experience-{{ $experience->id }}">
                        <td class="px-4 py-3">
                            <div class="font-semibold">{{ $experience->localized('company') }}</div>
                            <div class="text-xs text-slate-500">{{ $experience->company_en }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $experience->localized('position') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ $experience->start_date?->format('Y-m-d') }}
                            —
                            {{ $experience->is_current ? 'حتى الآن' : $experience->end_date?->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-3">
                            <button type="button"
                                    wire:click="toggleVisibility({{ $experience->id }})"
                                    class="rounded-full px-3 py-1 text-xs {{ $experience->is_visible ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $experience->is_visible ? 'ظاهر' : 'مخفي' }}
                            </button>
                        </td>
                        <td class="space-x-2 px-4 py-3 rtl:space-x-reverse">
                            <button type="button" wire:click="edit({{ $experience->id }})" class="underline">تعديل</button>
                            <button type="button"
                                    wire:click="delete({{ $experience->id }})"
                                    wire:confirm="هل تريد حذف هذه الخبرة؟"
                                    class="text-red-600 underline">
                                حذف
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">لا توجد خبرات.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t p-4">
            {{ $experiences->links() }}
        </div>
    </div>
</div>
