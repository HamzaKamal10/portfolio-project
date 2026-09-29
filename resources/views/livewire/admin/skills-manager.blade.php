
<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold">إدارة المهارات</h1>
            <p class="text-sm text-slate-600">أضف مهاراتك ورتبها لتظهر في سيرتك الذاتية.</p>
        </div>
        <button type="button" wire:click="create" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
            إضافة مهارة
        </button>
    </div>

    @if (session('success'))
        <div class="rounded-lg bg-emerald-50 p-3 text-emerald-700">{{ session('success') }}</div>
    @endif

    @if ($showForm)
        <form wire:submit="save" class="space-y-5 rounded-xl bg-white p-4 shadow sm:p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold">{{ $editingId ? 'تعديل المهارة' : 'إضافة مهارة' }}</h2>
                <button type="button" wire:click="cancel" class="text-sm underline">إلغاء</button>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <label>
                    <span class="mb-1 block text-sm font-medium">المهارة بالعربية</span>
                    <input wire:model="name_ar" type="text" class="w-full rounded-lg border-slate-300">
                    @error('name_ar') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">Skill in English</span>
                    <input wire:model="name_en" type="text" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('name_en') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <label>
                    <span class="mb-1 block text-sm font-medium">التصنيف (اختياري)</span>
                    <input wire:model="category" type="text" placeholder="مثال: Frontend" dir="ltr" class="w-full rounded-lg border-slate-300">
                    @error('category') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">مستوى الإتقان % (اختياري)</span>
                    <input wire:model="proficiency" type="number" min="1" max="100" placeholder="مثال: 90" class="w-full rounded-lg border-slate-300">
                    @error('proficiency') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
                <label>
                    <span class="mb-1 block text-sm font-medium">الترتيب</span>
                    <input wire:model="sort_order" type="number" min="0" class="w-full rounded-lg border-slate-300">
                    @error('sort_order') <small class="text-red-600">{{ $message }}</small> @enderror
                </label>
            </div>

            <label class="inline-flex items-center gap-2">
                <input wire:model="is_visible" type="checkbox" class="rounded">
                <span>ظاهر للزوار</span>
            </label>

            <div class="flex gap-3">
                <button type="submit" class="rounded-lg bg-emerald-600 px-5 py-2 font-semibold text-white">حفظ</button>
                <button type="button" wire:click="cancel" class="rounded-lg border px-5 py-2">إلغاء</button>
            </div>
        </form>
    @endif

    <div class="overflow-hidden rounded-xl bg-white shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full text-right text-sm">
                <thead class="bg-slate-100">
                <tr>
                    <th class="px-4 py-3">المهارة</th>
                    <th class="px-4 py-3">التصنيف</th>
                    <th class="px-4 py-3">الإتقان</th>
                    <th class="px-4 py-3">الحالة</th>
                    <th class="px-4 py-3">الإجراءات</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse ($skills as $skill)
                    <tr>
                        <td class="px-4 py-3 font-semibold">{{ $skill->name_ar }} / {{ $skill->name_en }}</td>
                        <td class="px-4 py-3 text-slate-600" dir="ltr">{{ $skill->category ?: '—' }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $skill->proficiency ? $skill->proficiency . '%' : '—' }}</td>
                        <td class="px-4 py-3">
                            <button type="button" wire:click="toggleVisibility({{ $skill->id }})" class="rounded-full px-3 py-1 text-xs {{ $skill->is_visible ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $skill->is_visible ? 'ظاهر' : 'مخفي' }}
                            </button>
                        </td>
                        <td class="space-x-2 px-4 py-3 rtl:space-x-reverse">
                            <button type="button" wire:click="edit({{ $skill->id }})" class="text-blue-600 underline">تعديل</button>
                            <button type="button" wire:click="delete({{ $skill->id }})" wire:confirm="هل تريد حذف هذه المهارة؟" class="text-red-600 underline">حذف</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">لا توجد مهارات.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t p-4">
            {{ $skills->links() }}
        </div>
    </div>
</div>
