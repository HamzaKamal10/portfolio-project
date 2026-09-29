@extends('layouts.guest')

@section('content')
    <section class="mx-auto max-w-6xl px-4 py-12">
        <h1 class="mb-8 text-3xl font-bold">{{ __('messages.projects') }}</h1>
        <livewire:public.project-filter />
    </section>
@endsection
