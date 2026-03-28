<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="{
    darkMode: localStorage.getItem('darkMode') === 'true' ? true : false,
    toggleDark() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
    },
    init() { if (this.darkMode) document.documentElement.classList.add('dark'); }
}" x-init="init();
$watch('darkMode', val => document.documentElement.classList.toggle('dark', val))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Wedbooki') }} - Host Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-50 dark:bg-stone-900 text-gray-900 dark:text-gray-100 antialiased">
    <div class="min-h-full flex flex-col">
        <!-- Navbar (unchanged) -->
        <nav
            class="bg-white dark:bg-stone-950 border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-8">
                        <div class="flex-shrink-0">
                            <a href="{{ route('host.dashboard') }}"
                                class="text-2xl font-bold text-primary-600 dark:text-primary-400">WEDBOOKI</a>
                        </div>
                        <div class="hidden md:flex space-x-6">
                            <a href="{{ route('wedding-venues.index') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">VENUES</a>
                            <a href="{{ route('wedding-vendors.index') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">VENDORS</a>
                            <a href="{{ route('wedding-planner') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">PLANNING
                                TOOLS</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative hidden md:block">
                            <x-heroicon-s-magnifying-glass
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                            <input type="text" placeholder="Try 'Four Seasons' in Venues"
                                class="pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 w-64">
                        </div>
                        <div class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300">
                            <span>PK (PKR)</span>
                            <x-heroicon-s-chevron-down class="w-4 h-4" />
                        </div>
                        <button @click="toggleDark()"
                            class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <x-heroicon-s-moon class="w-5 h-5" x-show="!darkMode" />
                            <x-heroicon-s-sun class="w-5 h-5" x-show="darkMode" x-cloak />
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sub‑navigation (updated to match screenshots) -->
        <div
            class="bg-white/80 dark:bg-stone-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 sticky top-16 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-6 overflow-x-auto py-3 text-sm font-medium">
                    @php
                        $navItems = [
                            ['label' => 'My Event', 'route' => 'host.dashboard', 'icon' => 'calendar'],
                            ['label' => 'Vendor Manager', 'route' => 'host.vendors.index', 'icon' => 'briefcase'],
                            ['label' => 'My Bookings', 'route' => 'host.bookings.index', 'icon' => 'book-open'],
                            ['label' => 'Guest List', 'route' => 'host.guests.index', 'icon' => 'users'],
                            ['label' => 'Check List', 'route' => 'host.checklists.index', 'icon' => 'check-circle'],
                            ['label' => 'Messages', 'route' => 'host.messages', 'icon' => 'chat'],
                            ['label' => 'Budget', 'route' => 'host.budget', 'icon' => 'currency-dollar'],
                        ];
                    @endphp
                    @foreach ($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                            class="{{ request()->routeIs($item['route']) ? 'active-tab' : 'tab' }} flex items-center space-x-2">
                            @if ($item['icon'] == 'calendar')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            @elseif($item['icon'] == 'briefcase')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            @elseif($item['icon'] == 'book-open')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            @elseif($item['icon'] == 'users')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            @elseif($item['icon'] == 'check-circle')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($item['icon'] == 'chat')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                    </path>
                                </svg>
                            @elseif($item['icon'] == 'currency-dollar')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            @endif
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer (unchanged) -->
        <footer class="bg-white dark:bg-green-800 border-t border-gray-200 dark:border-gray-700 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">GET THE WEDBOOKI APP</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Plan your event wherever and whenever you want
                            on the Wedbooki app.</p>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="flex items-center bg-black text-white px-4 py-2 rounded-lg"><x-heroicon-s-computer-desktop
                                    class="w-5 h-5 mr-2" /> Google Play</a>
                            <a href="#"
                                class="flex items-center bg-black text-white px-4 py-2 rounded-lg"><x-heroicon-s-device-phone-mobile
                                    class="w-5 h-5 mr-2" /> App Store</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            POLICIES & TERMS</h4>
                        <ul class="space-y-2">...</ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            THE COMPANY</h4>
                        <ul class="space-y-2">...</ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            PLANNING TOOLS</h4>
                        <ul class="space-y-2">...</ul>
                    </div>
                </div>
                <div
                    class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                    © 2026 Wedbooki. All rights reserved. Created & Managed by A Cube Creative Factory</div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>
