<x-layouts.portfolio
    :title="$profile->localized('name') . ' — ' . $profile->localized('headline')"
    :metaDescription="$profile->localized('bio')"
    :authorName="$profile->localized('name')"
    :ogImage="$profile->avatar ? asset('storage/' . $profile->avatar) : asset('images/og-image.jpg')"
>
    @php $locale = app()->getLocale(); @endphp

    {{-- ===== HERO SECTION ===== --}}
    <section id="about" class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 py-16 text-white sm:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center gap-8 lg:flex-row lg:gap-16">
                {{-- Avatar --}}
                @if ($profile->avatar)
                    <div class="shrink-0">
                        <img src="{{ asset('storage/' . $profile->avatar) }}"
                             alt="{{ $profile->localized('name') }}"
                             class="h-40 w-40 rounded-full border-4 border-white/20 object-cover shadow-2xl sm:h-52 sm:w-52"
                             loading="eager">
                    </div>
                @endif

                <div class="text-center lg:text-start">
                    <h1 class="text-3xl font-extrabold tracking-tight sm:text-5xl">
                        {{ $profile->localized('name') }}
                    </h1>
                    <p class="mt-3 text-lg font-medium text-indigo-300 sm:text-xl">
                        {{ $profile->localized('headline') }}
                    </p>
                    <p class="mt-4 max-w-2xl text-sm leading-relaxed text-slate-300 sm:text-base">
                        {{ $profile->localized('bio') }}
                    </p>

                    {{-- Contact & Social Links --}}
                    <div class="mt-6 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                        @if ($profile->email)
                            <a href="mailto:{{ $profile->email }}" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-white/20" aria-label="Email">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $profile->email }}
                            </a>
                        @endif
                        @if ($profile->github_url)
                            <a href="{{ $profile->github_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-white/20" aria-label="GitHub">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                                GitHub
                            </a>
                        @endif
                        @if ($profile->linkedin_url)
                            <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-white/20" aria-label="LinkedIn">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </a>
                        @endif
                        @if ($profile->resume_file)
                            <a href="{{ asset('storage/' . $profile->resume_file) }}" target="_blank" rel="noopener noreferrer" download
                               class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-500"
                               aria-label="{{ __('messages.download_resume_aria') }}">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                {{ __('messages.download_resume') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SKILLS SECTION ===== --}}
    @if ($skills->count())
    <section id="skills" class="py-14 sm:py-20" aria-labelledby="skills-heading">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h2 id="skills-heading" class="mb-10 text-center text-2xl font-bold text-slate-900 sm:text-3xl">
                {{ __('messages.skills') }}
            </h2>

            @php
                $grouped = $skills->groupBy('category');
            @endphp

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($grouped as $category => $categorySkills)
                    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                        @if ($category)
                            <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-indigo-600">{{ $category }}</h3>
                        @endif
                        <div class="space-y-3">
                            @foreach ($categorySkills as $skill)
                                <div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-medium text-slate-800">{{ $skill->localized('name') }}</span>
                                        @if ($skill->proficiency)
                                            <span class="text-xs text-slate-500">{{ $skill->proficiency }}%</span>
                                        @endif
                                    </div>
                                    @if ($skill->proficiency)
                                        <div class="mt-1.5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                                            <div class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-500"
                                                 style="width: {{ $skill->proficiency }}%"
                                                 role="progressbar" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== EXPERIENCE SECTION ===== --}}
    @if ($experiences->count())
    <section id="experience" class="bg-white py-14 sm:py-20" aria-labelledby="experience-heading">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <h2 id="experience-heading" class="mb-10 text-center text-2xl font-bold text-slate-900 sm:text-3xl">
                {{ __('messages.experience') }}
            </h2>

            <div class="relative space-y-8">
                {{-- Timeline line --}}
                <div class="absolute top-0 bottom-0 start-[7px] w-0.5 bg-indigo-100 sm:start-[11px]" aria-hidden="true"></div>

                @foreach ($experiences as $exp)
                    <article class="relative ps-8 sm:ps-12">
                        {{-- Timeline dot --}}
                        <div class="absolute start-0 top-1.5 h-3.5 w-3.5 rounded-full border-2 border-indigo-500 bg-white sm:h-5 sm:w-5 sm:start-0.5" aria-hidden="true"></div>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-5 transition hover:shadow-sm">
                            <div class="flex flex-col justify-between gap-1 sm:flex-row sm:items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $exp->localized('position') }}</h3>
                                    <p class="text-sm font-medium text-indigo-600">{{ $exp->localized('company') }}</p>
                                </div>
                                <time class="shrink-0 text-xs font-medium text-slate-500" dir="ltr">
                                    {{ $exp->start_date?->format('M Y') }}
                                    —
                                    {{ $exp->is_current ? __('messages.present') : $exp->end_date?->format('M Y') }}
                                </time>
                            </div>
                            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $exp->localized('description') }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== EDUCATION SECTION ===== --}}
    @if ($educations->count())
    <section id="education" class="py-14 sm:py-20" aria-labelledby="education-heading">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <h2 id="education-heading" class="mb-10 text-center text-2xl font-bold text-slate-900 sm:text-3xl">
                {{ __('messages.education') }}
            </h2>

            <div class="grid gap-5 sm:grid-cols-2">
                @foreach ($educations as $edu)
                    <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                        <h3 class="text-lg font-bold text-slate-900">{{ $edu->localized('degree') }}</h3>
                        <p class="text-sm font-medium text-indigo-600">{{ $edu->localized('institution') }}</p>
                        @if ($edu->start_date || $edu->end_date)
                            <time class="mt-1 block text-xs text-slate-500" dir="ltr">
                                {{ $edu->start_date?->format('Y') }}{{ $edu->end_date ? ' — ' . $edu->end_date->format('Y') : '' }}
                            </time>
                        @endif
                        @if ($edu->localized('description'))
                            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $edu->localized('description') }}</p>
                        @endif
                        @if ($edu->certificate_url)
                            <a href="{{ $edu->certificate_url }}" target="_blank" rel="noopener noreferrer"
                               class="mt-3 inline-flex items-center gap-1 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                {{ __('messages.certificate') }}
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ===== PROJECTS SECTION ===== --}}
    @if ($projects->count())
    <section id="projects" class="bg-white py-14 sm:py-20" aria-labelledby="projects-heading">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="mb-10 flex items-center justify-between">
                <h2 id="projects-heading" class="text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ __('messages.featured_projects') }}
                </h2>
                <a href="{{ route('projects.index', ['locale' => $locale]) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    {{ __('messages.all_projects') }} →
                </a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="group overflow-hidden rounded-xl border border-slate-200 bg-slate-50 shadow-sm transition hover:shadow-lg">
                        @if ($project->image)
                            <div class="aspect-video overflow-hidden">
                                <img src="{{ asset('storage/' . $project->image) }}"
                                     alt="{{ $project->localized('title') }}"
                                     class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                     loading="lazy">
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-slate-900">{{ $project->localized('title') }}</h3>
                            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-slate-600">{{ $project->localized('description') }}</p>

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
        </div>
    </section>
    @endif

    {{-- ===== CONTACT SECTION ===== --}}
    <section id="contact" class="py-14 sm:py-20" aria-labelledby="contact-heading">
        <div class="mx-auto max-w-2xl px-4 sm:px-6">
            <h2 id="contact-heading" class="mb-10 text-center text-2xl font-bold text-slate-900 sm:text-3xl">
                {{ __('messages.contact') }}
            </h2>
            <livewire:pub.contact-form />
        </div>
    </section>

</x-layouts.portfolio>
