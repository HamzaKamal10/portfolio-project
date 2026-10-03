<x-layouts.admin>
@php
    $counts = [
        ['label' => 'المشاريع', 'count' => \App\Models\Project::count(), 'route' => 'admin.projects', 'color' => 'indigo'],
        ['label' => 'المهارات', 'count' => \App\Models\Skill::count(), 'route' => 'admin.skills', 'color' => 'emerald'],
        ['label' => 'الخبرات', 'count' => \App\Models\Experience::count(), 'route' => 'admin.experience', 'color' => 'amber'],
        ['label' => 'التعليم والدورات', 'count' => \App\Models\Education::count(), 'route' => 'admin.education', 'color' => 'purple'],
    ];
@endphp

<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6">
    <h1 class="text-2xl font-bold">لوحة التحكم</h1>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($counts as $item)
            <a href="{{ route($item['route']) }}"
               class="rounded-xl border bg-white p-5 shadow-sm transition hover:shadow-md">
                <p class="text-sm font-medium text-slate-500">{{ $item['label'] }}</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $item['count'] }}</p>
            </a>
        @endforeach
    </div>

    @if (! \App\Models\Profile::exists())
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-800">
            <p class="font-semibold">⚠️ لم يتم إعداد الملف الشخصي بعد.</p>
            <a href="{{ route('admin.profile') }}" class="mt-1 inline-block text-sm underline">إعداد الملف الشخصي الآن →</a>
        </div>
    @endif
</div>
</x-layouts.admin>
