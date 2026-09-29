<nav class="space-y-1 p-4" aria-label="قائمة الإدارة">
    @php
        $links = [
            ['label' => 'لوحة التحكم', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard')],
            ['label' => 'الملف الشخصي', 'route' => 'admin.profile', 'active' => request()->routeIs('admin.profile')],
            ['label' => 'المشاريع', 'route' => 'admin.projects', 'active' => request()->routeIs('admin.projects')],
            ['label' => 'المهارات', 'route' => 'admin.skills', 'active' => request()->routeIs('admin.skills')],
            ['label' => 'الخبرات', 'route' => 'admin.experience', 'active' => request()->routeIs('admin.experience')],
            ['label' => 'التعليم والدورات', 'route' => 'admin.education', 'active' => request()->routeIs('admin.education')],
        ];
    @endphp

    @foreach ($links as $link)
        <a href="{{ route($link['route']) }}"
            @class([
                'block rounded-lg px-3 py-2 text-sm font-medium transition',
                'bg-white/15 text-white' => $link['active'],
                'text-slate-300 hover:bg-white/10 hover:text-white' => ! $link['active'],
            ])>
            {{ $link['label'] }}
        </a>
    @endforeach

    <div class="my-4 border-t border-slate-700"></div>

    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
       target="_blank"
       rel="noopener noreferrer"
       class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white">
        عرض الموقع
    </a>
</nav>
