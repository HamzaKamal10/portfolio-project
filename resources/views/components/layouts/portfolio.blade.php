<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>{{ $title ?? __('messages.site_title') }}</title>
    <meta name="description" content="{{ $metaDescription ?? __('messages.site_description') }}">
    <meta name="author" content="{{ $authorName ?? '' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? __('messages.site_title') }}">
    <meta property="og:description" content="{{ $metaDescription ?? __('messages.site_description') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">
    <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_SA' : 'en_US' }}">
    <meta property="og:site_name" content="{{ __('messages.site_title') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? __('messages.site_title') }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? __('messages.site_description') }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">

    {{-- Alternate Languages --}}
    <link rel="alternate" hreflang="ar" href="{{ route('home', ['locale' => 'ar']) }}">
    <link rel="alternate" hreflang="en" href="{{ route('home', ['locale' => 'en']) }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased {{ app()->getLocale() === 'ar' ? 'font-cairo' : 'font-inter' }}">

    {{-- Top Navigation --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/80 backdrop-blur-lg" role="banner">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6" aria-label="{{ __('messages.home') }}">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="text-lg font-bold text-slate-900 transition hover:text-indigo-600">
                {{ $authorName ?? __('messages.site_title') }}
            </a>

            <div class="flex items-center gap-4 sm:gap-6">
                {{-- Desktop Nav Links --}}
                <div class="hidden items-center gap-5 text-sm font-medium sm:flex">
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#about" class="text-slate-600 transition hover:text-indigo-600">{{ __('messages.about') }}</a>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#skills" class="text-slate-600 transition hover:text-indigo-600">{{ __('messages.skills') }}</a>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#experience" class="text-slate-600 transition hover:text-indigo-600">{{ __('messages.experience') }}</a>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#education" class="text-slate-600 transition hover:text-indigo-600">{{ __('messages.education') }}</a>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#projects" class="text-slate-600 transition hover:text-indigo-600">{{ __('messages.projects') }}</a>
                    <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" class="text-slate-600 transition hover:text-indigo-600">{{ __('messages.contact') }}</a>
                </div>

                {{-- Language Switch --}}
                @php $otherLocale = app()->getLocale() === 'ar' ? 'en' : 'ar'; @endphp
                <a href="{{ route('language.switch', ['locale' => $otherLocale]) }}"
                   class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:border-indigo-300 hover:text-indigo-600"
                   aria-label="{{ $otherLocale === 'en' ? 'Switch to English' : 'التبديل للعربية' }}">
                    {{ $otherLocale === 'en' ? 'EN' : 'ع' }}
                </a>

                {{-- Mobile Menu Toggle --}}
                <button x-data x-on:click="$dispatch('toggle-mobile-menu')"
                        class="rounded-lg p-1.5 text-slate-600 hover:bg-slate-100 sm:hidden"
                        aria-label="Menu">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>

        {{-- Mobile Nav --}}
        <div x-data="{ open: false }" x-on:toggle-mobile-menu.window="open = !open" x-show="open" x-cloak
             x-transition class="border-t border-slate-200 bg-white px-4 py-3 sm:hidden">
            <div class="flex flex-col gap-2 text-sm font-medium">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#about" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">{{ __('messages.about') }}</a>
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#skills" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">{{ __('messages.skills') }}</a>
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#experience" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">{{ __('messages.experience') }}</a>
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#education" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">{{ __('messages.education') }}</a>
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#projects" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">{{ __('messages.projects') }}</a>
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}#contact" class="rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100" @click="open = false">{{ __('messages.contact') }}</a>
            </div>
        </div>
    </header>

    <main role="main">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 bg-white" role="contentinfo">
        <div class="mx-auto max-w-6xl px-4 py-8 text-center text-sm text-slate-500 sm:px-6">
            <p>&copy; {{ date('Y') }} {{ $authorName ?? '' }}. {{ app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
