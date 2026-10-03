<div class="space-y-6">
    {{-- Search & Filter Controls --}}
    <div class="flex flex-col gap-3 sm:flex-row">
        <div class="relative flex-1">
            <svg class="pointer-events-none absolute start-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search"
                   type="search"
                   placeholder="{{ __('messages.search_projects') }}"
                   class="w-full rounded-lg border-slate-300 ps-10 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                   id="project-search">
        </div>

        <select wire:model.live="technology"
                class="rounded-lg border-slate-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                id="project-tech-filter">
            <option value="">{{ __('messages.filter_by_tech') }}</option>
            @foreach ($allTechnologies as $tech)
                <option value="{{ $tech }}">{{ $tech }}</option>
            @endforeach
        </select>

        @if ($search !== '' || $technology !== '')
            <button wire:click="clearFilters"
                    class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">
                ✕
            </button>
        @endif
    </div>

    {{-- Results --}}
    @if ($projects->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" wire:loading.class="opacity-50">
            @foreach ($projects as $project)
                <article class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">
                    @if ($project->image)
                        <a href="{{ route('projects.show', ['locale' => app()->getLocale(), 'project' => $project->slug]) }}">
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ asset('storage/' . $project->image) }}"
                                     alt="{{ $project->localized('title') }}"
                                     class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                     loading="lazy">
                            </div>
                        </a>
                    @endif
                    <div class="p-5">
                        <a href="{{ route('projects.show', ['locale' => app()->getLocale(), 'project' => $project->slug]) }}"
                           class="text-lg font-bold text-slate-900 hover:text-indigo-600">
                            {{ $project->localized('title') }}
                        </a>
                        <p class="mt-2 line-clamp-2 text-sm text-slate-600">{{ $project->localized('description') }}</p>

                        @if ($project->technologies)
                            <div class="mt-3 flex flex-wrap gap-1.5">
                                @foreach ($project->technologies as $tech)
                                    <span class="rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 flex flex-wrap gap-2">
                            @if ($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1 rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-indigo-500">
                                    {{ __('messages.live_demo') }}
                                </a>
                            @endif
                            @if ($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1 rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                    {{ __('messages.view_source') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="rounded-xl border border-slate-200 bg-white py-12 text-center">
            <p class="text-slate-500">{{ __('messages.no_projects') }}</p>
        </div>
    @endif
</div>
