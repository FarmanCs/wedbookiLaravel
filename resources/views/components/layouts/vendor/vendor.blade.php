<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Wedbooki') }} - Vendor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- ── Prevent FOUC: apply dark class synchronously before first paint ── --}}
    <script>
        (function() {
            var stored = localStorage.getItem('vendorDarkMode');
            // stored === null   → follow system (no override)
            // stored === 'true' → forced dark
            // stored === 'false'→ forced light
            var useDark = stored === null ?
                window.matchMedia('(prefers-color-scheme: dark)').matches :
                stored === 'true';
            if (useDark) document.documentElement.classList.add('dark');
        })();
    </script>
</head>

<body class="h-full bg-gray-50 dark:bg-stone-900 text-gray-900 dark:text-gray-100 antialiased">
    <div class="min-h-full flex flex-col" x-data="vendorTheme()" x-init="init()">

        {{-- ══════════════════════════════════════════
         NAVBAR
    ══════════════════════════════════════════ --}}
        <nav
            class="bg-white dark:bg-stone-950 border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    {{-- Left: Logo + badge --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('vendor.dashboard') }}"
                            class="text-2xl font-bold text-primary-600 dark:text-primary-400 tracking-tight">
                            WEDBOOKI
                        </a>
                        <span
                            class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold
                                 bg-primary-100 text-primary-700 border border-primary-200
                                 dark:bg-primary-900/40 dark:text-primary-300 dark:border-primary-700/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary-500 dark:bg-primary-400"></span>
                            Vendor Portal
                        </span>
                    </div>

                    {{-- Right --}}
                    <div class="flex items-center gap-1">

                        {{-- Notifications --}}
                        <button
                            class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100
                                   dark:text-gray-400 dark:hover:bg-gray-800 transition-colors">
                            <x-heroicon-s-bell class="w-5 h-5" />
                            {{-- Uncomment when notifications exist:
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white dark:ring-stone-950"></span>
                        --}}
                        </button>

                        {{-- ── Theme picker: Light / Dark / System ── --}}
                        <div class="relative" x-data="{ modeOpen: false }">
                            <button @click="modeOpen = !modeOpen" @click.outside="modeOpen = false"
                                class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition-colors"
                                :title="mode === 'system' ? 'Theme: System' : mode === 'dark' ? 'Theme: Dark' :
                                    'Theme: Light'">
                                {{-- Sun icon (light) --}}
                                <svg x-show="mode === 'light'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{-- Moon icon (dark) --}}
                                <svg x-show="mode === 'dark'" x-cloak class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                </svg>
                                {{-- Monitor icon (system) --}}
                                <svg x-show="mode === 'system'" x-cloak class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            {{-- Dropdown --}}
                            <div x-show="modeOpen" x-cloak x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-1 w-36 bg-white dark:bg-stone-900
                                   border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg py-1 z-50">
                                @foreach ([['val' => 'light', 'label' => 'Light', 'icon' => 'sun'], ['val' => 'dark', 'label' => 'Dark', 'icon' => 'moon'], ['val' => 'system', 'label' => 'System', 'icon' => 'monitor']] as $opt)
                                    <button @click="setMode('{{ $opt['val'] }}'); modeOpen = false"
                                        class="flex items-center gap-2.5 w-full px-3 py-2 text-sm transition-colors"
                                        :class="mode === '{{ $opt['val'] }}'
                                            ?
                                            'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 font-semibold' :
                                            'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800'">
                                        @if ($opt['icon'] === 'sun')
                                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @elseif ($opt['icon'] === 'moon')
                                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        {{ $opt['label'] }}
                                        <svg x-show="mode === '{{ $opt['val'] }}'"
                                            class="w-3.5 h-3.5 ml-auto flex-shrink-0 text-primary-600 dark:text-primary-400"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Vendor avatar dropdown --}}
                        @auth('vendor')
                            <div class="relative ml-1" x-data="{ open: false }">
                                <button @click="open = !open" @click.outside="open = false"
                                    class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-lg
                                       hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                    <div
                                        class="w-7 h-7 rounded-full bg-primary-600 dark:bg-primary-500
                                            flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ auth('vendor')->user()->initials() }}
                                    </div>
                                    <span
                                        class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300 max-w-[120px] truncate">
                                        {{ auth('vendor')->user()->full_name }}
                                    </span>
                                    <x-heroicon-s-chevron-down class="w-3.5 h-3.5 text-gray-400" />
                                </button>

                                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-1 w-52 bg-white dark:bg-stone-900
                                       border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg py-1 z-50">
                                    {{-- Header --}}
                                    <div class="px-3 py-2.5 border-b border-gray-100 dark:border-gray-800">
                                        <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">
                                            {{ auth('vendor')->user()->full_name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">
                                            {{ auth('vendor')->user()->email }}
                                        </p>
                                    </div>

                                    <a href="{{ route('vendor.profile') }}"
                                        class="flex items-center gap-2.5 px-3 py-2 text-sm text-gray-700 dark:text-gray-300
                                           hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-user-circle class="w-4 h-4 text-gray-400 flex-shrink-0" />
                                        My Profile
                                    </a>
                                    <a href="{{ route('vendor.storefront') }}"
                                        class="flex items-center gap-2.5 px-3 py-2 text-sm text-gray-700 dark:text-gray-300
                                           hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-building-storefront class="w-4 h-4 text-gray-400 flex-shrink-0" />
                                        My Storefront
                                    </a>
                                    <a href="{{ route('vendor.business.index') }}"
                                        class="flex items-center gap-2.5 px-3 py-2 text-sm text-gray-700 dark:text-gray-300
                                           hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-briefcase class="w-4 h-4 text-gray-400 flex-shrink-0" />
                                        My Businesses
                                    </a>
                                    <a href="{{ route('vendor.credits') }}"
                                        class="flex items-center gap-2.5 px-3 py-2 text-sm text-gray-700 dark:text-gray-300
                                           hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-currency-dollar class="w-4 h-4 text-gray-400 flex-shrink-0" />
                                        Credits
                                    </a>

                                    <div class="border-t border-gray-100 dark:border-gray-800 mt-1 pt-1">
                                        <form method="POST" action="{{ route('vendor.logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-2.5 w-full px-3 py-2 text-sm
                                                   text-rose-600 dark:text-rose-400
                                                   hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors">
                                                <x-heroicon-s-arrow-right-on-rectangle class="w-4 h-4 flex-shrink-0" />
                                                Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </nav>

        {{-- ══════════════════════════════════════════
         SUB-NAVIGATION
    ══════════════════════════════════════════ --}}
        <div class="bg-white dark:bg-stone-950 border-b border-gray-200 dark:border-gray-700 mb-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex gap-0.5 overflow-x-auto py-2 scrollbar-hide">
                    @php
                        $navItems = [
                            ['route' => 'vendor.dashboard', 'label' => 'Dashboard', 'match' => 'vendor.dashboard'],
                            ['route' => 'vendor.calendar', 'label' => 'Calendar', 'match' => 'vendor.calendar'],
                            ['route' => 'vendor.messages', 'label' => 'Messages', 'match' => 'vendor.messages'],
                            ['route' => 'vendor.storefront', 'label' => 'Storefront', 'match' => 'vendor.storefront'],
                            ['route' => 'vendor.payments', 'label' => 'Payments', 'match' => 'vendor.payments'],
                            ['route' => 'vendor.reviews', 'label' => 'Reviews', 'match' => 'vendor.reviews'],
                            ['route' => 'vendor.bookings', 'label' => 'Bookings', 'match' => 'vendor.bookings'],
                            ['route' => 'vendor.business.index', 'label' => 'Business', 'match' => 'vendor.business*'],
                            ['route' => 'vendor.packages', 'label' => 'Packages', 'match' => 'vendor.packages'],
                            ['route' => 'vendor.analytics', 'label' => 'Analytics', 'match' => 'vendor.analytics'],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="whitespace-nowrap px-3 py-2 rounded-lg text-sm font-medium transition-colors
                               {{ request()->routeIs($item['match'])
                                   ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400'
                                   : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════
         MAIN CONTENT
    ══════════════════════════════════════════ --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- ══════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════ --}}
        <footer class="mt-12 relative overflow-hidden"
            style="background: linear-gradient(135deg, #1e1b4b 0%, #2d2a6e 38%, #1a3a5c 70%, #0f2744 100%);">

            {{-- Decorative ambient orbs --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
                <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full"
                    style="background: radial-gradient(circle, rgba(129,140,248,0.14), transparent 65%)"></div>
                <div class="absolute -bottom-24 right-0 w-80 h-80 rounded-full"
                    style="background: radial-gradient(circle, rgba(99,102,241,0.12), transparent 65%)"></div>
                <div class="absolute top-0 right-1/3 w-48 h-48 rounded-full"
                    style="background: radial-gradient(circle, rgba(56,189,248,0.07), transparent 65%)"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- ── Main footer content ── --}}
                <div class="py-8 grid grid-cols-1 sm:grid-cols-3 gap-8 items-start"
                    style="border-bottom: 1px solid rgba(165,180,252,0.14);">

                    {{-- Col 1: Brand + tagline --}}
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="text-xl font-extrabold tracking-tight text-white">WEDBOOKI</span>
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold"
                                style="background: rgba(165,180,252,0.12); border: 1px solid rgba(165,180,252,0.28); color: #c7d2fe;">
                                Vendor Portal
                            </span>
                        </div>
                        <p class="text-xs leading-relaxed" style="color: rgba(199,210,254,0.48); max-width: 210px;">
                            Manage your wedding business, bookings, and clients — all in one place.
                        </p>
                        {{-- Status dot --}}
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
                            <span class="text-xs" style="color: rgba(167,243,208,0.6);">All systems operational</span>
                        </div>
                    </div>

                    {{-- Col 2: Links --}}
                    <div class="flex flex-col gap-2 sm:items-center">
                        <p class="text-xs font-semibold uppercase tracking-widest mb-1"
                            style="color: rgba(165,180,252,0.45);">Legal & Support</p>
                        <nav class="flex flex-col gap-1.5">
                            @foreach ([['label' => 'Help & Support', 'icon' => 'support'], ['label' => 'Privacy Policy', 'icon' => 'shield'], ['label' => 'Vendor Agreement', 'icon' => 'doc'], ['label' => 'Terms of Service', 'icon' => 'book']] as $link)
                                <a href="#"
                                    class="flex items-center gap-2 text-sm transition-all duration-150 group"
                                    style="color: rgba(199,210,254,0.65);"
                                    onmouseover="this.style.color='#ffffff'; this.style.paddingLeft='4px'"
                                    onmouseout="this.style.color='rgba(199,210,254,0.65)'; this.style.paddingLeft='0px'">
                                    @if ($link['icon'] === 'support')
                                        <svg class="w-3.5 h-3.5 flex-shrink-0 opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    @elseif($link['icon'] === 'shield')
                                        <svg class="w-3.5 h-3.5 flex-shrink-0 opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    @elseif($link['icon'] === 'doc')
                                        <svg class="w-3.5 h-3.5 flex-shrink-0 opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 flex-shrink-0 opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    @endif
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    {{-- Col 3: Signed in as + sign out --}}
                    <div class="flex flex-col gap-3 sm:items-end">
                        @auth('vendor')
                            <p class="text-xs font-semibold uppercase tracking-widest"
                                style="color: rgba(165,180,252,0.45);">Signed in as</p>

                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center
                                        text-xs font-bold text-indigo-200"
                                    style="background: rgba(99,102,241,0.25); border: 1px solid rgba(165,180,252,0.25);">
                                    {{ auth('vendor')->user()->initials() }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-white leading-tight truncate max-w-[170px]">
                                        {{ auth('vendor')->user()->full_name }}
                                    </p>
                                    <p class="text-xs truncate max-w-[170px]" style="color: rgba(199,210,254,0.45);">
                                        {{ auth('vendor')->user()->email }}
                                    </p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('vendor.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-sm font-medium transition-all"
                                    style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.22); color: #fca5a5;"
                                    onmouseover="this.style.background='rgba(239,68,68,0.18)'; this.style.borderColor='rgba(239,68,68,0.4)'"
                                    onmouseout="this.style.background='rgba(239,68,68,0.1)'; this.style.borderColor='rgba(239,68,68,0.22)'">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>

                {{-- ── Bottom strip ── --}}
                <div class="py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                    <p class="text-xs text-center sm:text-left" style="color: rgba(199,210,254,0.30);">
                        © {{ date('Y') }} Wedbooki. All rights reserved. Created & Managed by A Cube Creative
                        Factory
                    </p>
                    <p class="text-xs" style="color: rgba(199,210,254,0.25);">
                        Vendor Portal v1.0
                    </p>
                </div>

            </div>
        </footer>

    </div><!-- end x-data wrapper -->

    @stack('scripts')

    {{-- ═══════════════════════════════════════════════
     AMBIENT BACKGROUND EFFECT
     canvas pointer-events:none — never blocks UI
═══════════════════════════════════════════════ --}}
    <canvas id="vd-fx-canvas" aria-hidden="true"></canvas>

    <style>
        #vd-fx-canvas {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 900;
            width: 100vw;
            height: 100vh;
            background: transparent;
        }
    </style>

    <script>
        // ── Alpine component: vendor theme ─────────────────────────────────────────
        function vendorTheme() {
            return {
                // 'light' | 'dark' | 'system'
                mode: (function() {
                    var s = localStorage.getItem('vendorDarkMode');
                    if (s === null) return 'system';
                    return s === 'true' ? 'dark' : 'light';
                })(),

                _mq: null,
                _mqHandler: null,

                init() {
                    // Apply the stored / system preference on mount
                    this._applyMode(this.mode);

                    // Listen for OS-level changes — only acts when mode === 'system'
                    this._mq = window.matchMedia('(prefers-color-scheme: dark)');
                    this._mqHandler = () => {
                        if (this.mode === 'system') {
                            this._applyDark(this._mq.matches);
                        }
                    };
                    this._mq.addEventListener('change', this._mqHandler);
                },

                setMode(newMode) {
                    this.mode = newMode;
                    if (newMode === 'system') {
                        localStorage.removeItem('vendorDarkMode'); // clear override → follow OS
                        this._applyDark(this._mq.matches);
                    } else {
                        localStorage.setItem('vendorDarkMode', newMode === 'dark' ? 'true' : 'false');
                        this._applyDark(newMode === 'dark');
                    }
                },

                _applyMode(mode) {
                    if (mode === 'system') {
                        this._applyDark(window.matchMedia('(prefers-color-scheme: dark)').matches);
                    } else {
                        this._applyDark(mode === 'dark');
                    }
                },

                _applyDark(isDark) {
                    document.documentElement.classList.toggle('dark', isDark);
                },
            };
        }
    </script>

    <script>
        // ── Ambient canvas FX ───────────────────────────────────────────────────────
        (function() {
            'use strict';

            const canvas = document.getElementById('vd-fx-canvas');
            const ctx = canvas.getContext('2d');

            function resize() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', () => {
                resize();
                rebuildOrbs();
            });

            const SMOKE_PALETTES = [
                ['#c084fc', '#a855f7', '#e879f9'],
                ['#38bdf8', '#22d3ee', '#67e8f9'],
                ['#f472b6', '#fb7185', '#fda4af'],
                ['#34d399', '#6ee7b7', '#5eead4'],
                ['#fbbf24', '#fb923c', '#fde68a'],
                ['#818cf8', '#6366f1', '#a78bfa'],
            ];
            const STAR_COLORS = ['#c084fc', '#a78bfa', '#818cf8', '#6366f1', '#38bdf8', '#67e8f9', '#5eead4', '#2dd4bf',
                '#f472b6', '#fda4af', '#fbbf24', '#fde68a', '#ffffff', '#e0e7ff', '#ddd6fe', '#bfdbfe'
            ];
            const ORB_COLORS = ['#a855f7', '#818cf8', '#38bdf8', '#34d399', '#f472b6', '#fbbf24', '#e879f9'];

            let palIdx = 0,
                palTimer = 0;
            const rgba = (hex, a) => {
                const r = parseInt(hex.slice(1, 3), 16),
                    g = parseInt(hex.slice(3, 5), 16),
                    b = parseInt(hex.slice(5, 7), 16);
                return `rgba(${r},${g},${b},${Math.max(0,+a.toFixed(3))})`;
            };
            const rand = (a, b) => a + Math.random() * (b - a);

            const mouse = {
                    x: -999,
                    y: -999
                },
                vel = {
                    x: 0,
                    y: 0
                };
            let lx = 0,
                ly = 0,
                moving = false,
                moveTimer = null;
            const IDLE_MS = 140;
            const smoke = [],
                flecks = [],
                stars = [],
                orbs = [];

            class SmokePuff {
                constructor(x, y, vx, vy, pal) {
                    this.x = x + rand(-9, 9);
                    this.y = y + rand(-9, 9);
                    this.vx = vx * 0.15 + rand(-1.1, 1.1);
                    this.vy = vy * 0.15 + rand(-1.3, 0.6) - 0.4;
                    this.c = pal[Math.floor(Math.random() * pal.length)];
                    this.r = rand(10, 26);
                    this.grow = rand(1.010, 1.025);
                    this.life = 1.0;
                    this.decay = rand(0.014, 0.024);
                }
                step() {
                    this.x += this.vx;
                    this.vx *= 0.968;
                    this.y += this.vy;
                    this.vy *= 0.968;
                    this.vy -= 0.016;
                    this.r *= this.grow;
                    this.life -= this.decay;
                }
                draw() {
                    if (this.life <= 0) return;
                    const a = this.life * 0.14,
                        g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r);
                    g.addColorStop(0, rgba(this.c, a));
                    g.addColorStop(.5, rgba(this.c, a * .4));
                    g.addColorStop(1, rgba(this.c, 0));
                    ctx.save();
                    ctx.globalCompositeOperation = 'source-over';
                    ctx.fillStyle = g;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
                get dead() {
                    return this.life <= 0 || this.r < 0.5;
                }
            }
            class Star {
                constructor(boot) {
                    this.boot = boot;
                    this.reset();
                }
                reset() {
                    this.x = rand(10, canvas.width - 10);
                    this.y = rand(10, canvas.height - 10);
                    this.c = STAR_COLORS[Math.floor(Math.random() * STAR_COLORS.length)];
                    this.maxA = rand(.28, .55);
                    this.dot = rand(.7, 2);
                    this.cross = Math.random() < .28;
                    this.arm = this.dot * rand(3, 6.5);
                    this.phase = this.boot ? Math.floor(Math.random() * 3) : 0;
                    this.a = (this.boot && this.phase > 0) ? this.maxA * rand(.3, 1) : 0;
                    this.fi = rand(.006, .015);
                    this.fo = rand(.005, .012);
                    this.holdN = Math.floor(rand(60, 200));
                    this.held = this.boot ? Math.floor(Math.random() * this.holdN) : 0;
                    this.dx = rand(-.07, .07);
                    this.dy = rand(-.06, .06);
                    this.boot = false;
                }
                step() {
                    this.x += this.dx;
                    this.y += this.dy;
                    if (this.phase === 0) {
                        this.a += this.fi;
                        if (this.a >= this.maxA) {
                            this.a = this.maxA;
                            this.phase = 1;
                        }
                    } else if (this.phase === 1) {
                        if (++this.held >= this.holdN) this.phase = 2;
                    } else {
                        this.a -= this.fo;
                        if (this.a <= 0) this.reset();
                    }
                }
                draw(s) {
                    const a = this.a * s;
                    if (a < .01) return;
                    ctx.save();
                    ctx.globalAlpha = a;
                    ctx.globalCompositeOperation = 'source-over';
                    ctx.fillStyle = this.c;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.dot, 0, Math.PI * 2);
                    ctx.fill();
                    if (this.cross) {
                        const L = this.arm;
                        ctx.strokeStyle = this.c;
                        ctx.lineWidth = .65;
                        ctx.globalAlpha = a * .7;
                        ctx.beginPath();
                        ctx.moveTo(this.x - L, this.y);
                        ctx.lineTo(this.x + L, this.y);
                        ctx.moveTo(this.x, this.y - L);
                        ctx.lineTo(this.x, this.y + L);
                        ctx.stroke();
                        const d = L * .55;
                        ctx.globalAlpha = a * .3;
                        ctx.lineWidth = .45;
                        ctx.beginPath();
                        ctx.moveTo(this.x - d, this.y - d);
                        ctx.lineTo(this.x + d, this.y + d);
                        ctx.moveTo(this.x + d, this.y - d);
                        ctx.lineTo(this.x - d, this.y + d);
                        ctx.stroke();
                    }
                    ctx.restore();
                }
            }
            class FloatOrb {
                constructor() {
                    this.init();
                }
                init() {
                    this.x = rand(0, canvas.width);
                    this.y = rand(0, canvas.height);
                    this.r = rand(50, 110);
                    this.c = ORB_COLORS[Math.floor(Math.random() * ORB_COLORS.length)];
                    this.vx = rand(-.16, .16);
                    this.vy = rand(-.12, .12);
                    this.a = 0;
                    this.tA = rand(.04, .08);
                    this.spd = rand(.006, .012);
                    this.phase = 0;
                    this.life = Math.floor(rand(350, 750));
                    this.lived = 0;
                }
                step() {
                    if (this.phase === 0) {
                        this.a += this.spd;
                        if (this.a >= this.tA) {
                            this.a = this.tA;
                            this.phase = 1;
                        }
                    } else if (this.phase === 1) {
                        this.x += this.vx;
                        this.y += this.vy;
                        if (++this.lived >= this.life) this.phase = 2;
                    } else {
                        this.a -= this.spd * .6;
                        if (this.a <= 0) this.init();
                    }
                }
                draw(s) {
                    const a = this.a * s;
                    if (a < .003) return;
                    const g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r);
                    g.addColorStop(0, rgba(this.c, a));
                    g.addColorStop(.55, rgba(this.c, a * .3));
                    g.addColorStop(1, rgba(this.c, 0));
                    ctx.save();
                    ctx.globalCompositeOperation = 'source-over';
                    ctx.fillStyle = g;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
            }
            class Fleck {
                constructor(x, y, c) {
                    this.x = x;
                    this.y = y;
                    this.vx = rand(-3.5, 3.5);
                    this.vy = rand(-3.5, 3.5) - 1.2;
                    this.c = c;
                    this.r = rand(1.2, 2.8);
                    this.a = 1;
                    this.d = rand(.04, .07);
                }
                step() {
                    this.x += this.vx;
                    this.vx *= .96;
                    this.y += this.vy;
                    this.vy += .09;
                    this.a -= this.d;
                    this.r *= .97;
                }
                draw() {
                    if (this.a <= 0 || this.r < .2) return;
                    ctx.save();
                    ctx.globalAlpha = Math.max(0, this.a * .7);
                    ctx.globalCompositeOperation = 'source-over';
                    ctx.fillStyle = this.c;
                    ctx.shadowColor = this.c;
                    ctx.shadowBlur = 6;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
                get dead() {
                    return this.a <= 0 || this.r < .2;
                }
            }

            for (let i = 0; i < 70; i++) stars.push(new Star(true));

            function rebuildOrbs() {
                orbs.length = 0;
                for (let i = 0; i < 7; i++) orbs.push(new FloatOrb());
            }
            rebuildOrbs();

            function spawnSmoke() {
                const pal = SMOKE_PALETTES[palIdx % SMOKE_PALETTES.length];
                const speed = Math.sqrt(vel.x ** 2 + vel.y ** 2);
                const n = Math.min(Math.floor(speed * .28) + 1, 5);
                for (let i = 0; i < n; i++) smoke.push(new SmokePuff(mouse.x, mouse.y, vel.x, vel.y, pal));
                if (speed > 7 && Math.random() < .45) {
                    const c = pal[Math.floor(Math.random() * pal.length)];
                    for (let i = 0, k = 1 + Math.floor(Math.random() * 3); i < k; i++) flecks.push(new Fleck(mouse.x,
                        mouse.y, c));
                }
            }

            let idleScale = 1;

            function loop() {
                requestAnimationFrame(loop);
                palTimer++;
                if (palTimer > 55) {
                    palIdx++;
                    palTimer = 0;
                }
                const target = moving ? 0 : 1;
                idleScale += (target - idleScale) * .05;
                if (moving) spawnSmoke();
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                for (const o of orbs) {
                    o.step();
                    o.draw(idleScale);
                }
                for (const s of stars) {
                    s.step();
                    s.draw(idleScale);
                }
                for (let i = smoke.length - 1; i >= 0; i--) {
                    smoke[i].step();
                    smoke[i].draw();
                    if (smoke[i].dead) smoke.splice(i, 1);
                }
                for (let i = flecks.length - 1; i >= 0; i--) {
                    flecks[i].step();
                    flecks[i].draw();
                    if (flecks[i].dead) flecks.splice(i, 1);
                }
            }
            loop();

            document.addEventListener('mousemove', e => {
                vel.x = (e.clientX - lx) * 1;
                vel.y = (e.clientY - ly) * 1;
                lx = mouse.x = e.clientX;
                ly = mouse.y = e.clientY;
                moving = true;
                clearTimeout(moveTimer);
                moveTimer = setTimeout(() => {
                    moving = false;
                }, IDLE_MS);
            });
        })();
    </script>

</body>

</html>
