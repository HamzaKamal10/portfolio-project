<x-layouts.portfolio
    :title="$title . ' — ' . __('messages.site_title')"
    :metaDescription="$description"
    :ogImage="$image"
>
    @php $locale = app()->getLocale(); @endphp

    <article class="py-14 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            {{-- Back Link --}}
            <a href="{{ route('projects.index', ['locale' => $locale]) }}"
               class="mb-8 inline-flex items-center gap-1 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                <svg class="h-4 w-4 {{ $locale === 'ar' ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                {{ __('messages.back_to_projects') }}
            </a>

            {{-- Project Image --}}
            @if ($project->image)
                <div class="mb-8 overflow-hidden rounded-xl shadow-lg">
                    <img src="{{ asset('storage/' . $project->image) }}"
                         alt="{{ $title }}"
                         class="h-auto w-full object-cover"
                         loading="eager">
                </div>
            @endif

            {{-- Title --}}
            <h1 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">{{ $title }}</h1>

            {{-- Technologies --}}
            @if ($project->technologies)
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($project->technologies as $tech)
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">{{ $tech }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Meta Info --}}
            <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-slate-500">
                @if ($project->completed_at)
                    <span>{{ __('messages.completed_at') }}: {{ $project->completed_at->format('M Y') }}</span>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex flex-wrap gap-3">
                @if ($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        {{ __('messages.live_demo') }}
                    </a>
                @endif
                @if ($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        {{ __('messages.view_source') }}
                    </a>
                @endif
            </div>

            {{-- Description --}}
            <div class="prose prose-slate mt-8 max-w-none">
                {!! nl2br(e($description)) !!}
            </div>
        </div>
    </article>
</x-layouts.portfolio>
