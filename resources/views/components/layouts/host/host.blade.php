{{-- resources/views/components/layouts/host/host.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Host Dashboard' }} | Wedbooki</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased min-h-screen flex flex-col">
    <div x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches);
    if (darkMode) document.documentElement.classList.add('dark');
    else document.documentElement.classList.remove('dark');
    $watch('darkMode', val => {
        if (val) { document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark'); } else { document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light'); }
    })" class="flex-1 flex flex-col">
        {{-- Top Navigation Bar --}}
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Left: Brand & Navigation --}}
                    <div class="flex items-center space-x-8">
                        <div class="flex-shrink-0">
                            <a href="{{ route('host.host-dashboard') }}"
                                class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">WEDBOOKI</a>
                        </div>
                        <div class="hidden md:flex space-x-6">
                            <a href="{{ route('wedding-venues.index') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm font-medium">
                                VENUES
                            </a>
                            <a href="{{ route('wedding-vendors.index') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm font-medium">
                                VENDORS
                            </a>
                            <a href="{{ route('wedding-planner') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm font-medium">
                                PLANNING TOOLS
                            </a>
                        </div>
                    </div>

                    {{-- Right: Search, Currency, Dark Mode, Profile --}}
                    <div class="flex items-center space-x-4">
                        {{-- Search --}}
                        <div class="relative hidden md:block">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" placeholder="Try 'Four Seasons' in Venues"
                                class="pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 w-64">
                        </div>

                        {{-- Currency --}}
                        <div class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300">
                            <span>PK (PKR)</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        {{-- Dark Mode Toggle --}}
                        <button @click="darkMode = !darkMode"
                            class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>

                        {{-- Profile --}}
                        <div class="flex items-center space-x-2">
                            <div
                                class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-800 dark:text-indigo-200 font-semibold">
                                {{ substr(auth()->guard('host')->user()->name ?? 'H', 0, 1) }}
                            </div>
                            <span class="hidden md:inline text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ auth()->guard('host')->user()->name ?? 'Host' }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    {{-- Mobile menu button (optional) --}}
                    <button
                        class="md:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-4 lg:p-6 bg-gray-50 dark:bg-gray-900">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-6">
            <div class="max-w-7xl mx-auto">
                <div
                    class="flex flex-col md:flex-row items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center space-x-4">
                        <span class="font-semibold text-gray-700 dark:text-gray-300">GET THE WEDBOOKI APP</span>
                        <span>Plan your event wherever and whenever you want on the Wedbooki app.</span>
                    </div>
                    <div class="flex space-x-6 mt-2 md:mt-0">
                        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400">Policies & Terms</a>
                        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400">The Company</a>
                        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400">Planning Tools</a>
                    </div>
                </div>
                <div class="text-center mt-4 text-xs text-gray-400">
                    © 2026 Wedbooki. All rights reserved. Created & Managed by A Cube Creative Factory
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
