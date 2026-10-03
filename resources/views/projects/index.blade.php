<x-layouts.portfolio
    :title="__('messages.projects_title')"
    :metaDescription="__('messages.projects_description')"
>
    <section class="py-14 sm:py-20" aria-labelledby="all-projects-heading">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <h1 id="all-projects-heading" class="mb-8 text-3xl font-bold text-slate-900">
                {{ __('messages.all_projects') }}
            </h1>
            <livewire:pub.project-filter />
        </div>
    </section>
</x-layouts.portfolio>
