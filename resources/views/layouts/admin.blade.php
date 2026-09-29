<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - Portfolio</title>
    <meta name="robots" content="noindex,nofollow">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
<div class="min-h-screen lg:flex">
    <aside class="w-full border-b bg-slate-900 text-white lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-e">
        <div class="flex items-center justify-between p-5 lg:block">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-black">
                Portfolio Admin
            </a>

            <details class="relative lg:hidden">
                <summary class="cursor-pointer list-none rounded-lg border border-slate-700 px-3 py-2 text-sm">
                    القائمة
                </summary>
                @include('layouts.partials.admin-navigation')
            </details>
        </div>

        <div class="hidden lg:block">
            @include('layouts.partials.admin-navigation')
        </div>
    </aside>

    <div class="min-w-0 flex-1">
        <header class="flex items-center justify-between border-b bg-white px-4 py-4 sm:px-6">
            <div>
                <p class="text-sm text-slate-500">مرحبًا</p>
                <p class="font-semibold">{{ auth()->user()->name }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-lg border px-3 py-2 text-sm hover:bg-slate-50">
                    تسجيل الخروج
                </button>
            </form>
        </header>

        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
