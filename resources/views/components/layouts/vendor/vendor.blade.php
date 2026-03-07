<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" x-data="{
    darkMode: localStorage.getItem('darkMode') === 'true' ? true : false,
    toggleDark() { this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode); },
    init() { if (this.darkMode) document.documentElement.classList.add('dark'); }
}" x-init="init();
$watch('darkMode', val => document.documentElement.classList.toggle('dark', val))">

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
</head>

<body class="h-full bg-gray-50 dark:bg-stone-900 text-gray-900 dark:text-gray-100 antialiased">
    <div class="min-h-full flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white dark:bg-stone-950 border-b border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Left: Brand & Navigation -->
                    <div class="flex items-center space-x-8">
                        <div class="flex-shrink-0">
                            <a href="{{ route('vendor.dashboard') }}"
                                class="text-2xl font-bold text-primary-600 dark:text-primary-400">WEDBOOKI</a>
                        </div>
                        <div class="hidden md:flex space-x-6">
                            <a href="{{ route('wedding-venues.index') }}"
                                                class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">
                                             VENUES
                                                        </a>
                            <a href="{{ route('wedding-vendors.index') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">VENDORS</a>
                            <a href="{{ route('wedding-planner') }}"
                                class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 text-sm font-medium">PLANNING
                                TOOLS</a>
                        </div>
                    </div>

                    <!-- Right: Search, Currency, Dark Mode -->
                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="relative hidden md:block">
                            <x-heroicon-s-magnifying-glass
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                            <input type="text" placeholder="Try 'Four Seasons' in Venues"
                                class="pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:ring-primary-500 focus:border-primary-500 w-64">
                        </div>
                        <!-- Currency -->
                        <div class="flex items-center space-x-1 text-sm text-gray-700 dark:text-gray-300">
                            <span>PK (PKR)</span>
                            <x-heroicon-s-chevron-down class="w-4 h-4" />
                        </div>
                        <!-- Dark Mode Toggle -->
                        <button @click="toggleDark()"
                            class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <x-heroicon-s-moon class="w-5 h-5" x-show="!darkMode" />
                            <x-heroicon-s-sun class="w-5 h-5" x-show="darkMode" x-cloak />
                        </button>
                        <!-- Mobile menu button (optional) -->
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sub-navigation (Dashboard, Calendar, Messages, etc.) -->
        <div class="dark:bg-stone-800  dark:border-gray-700 mb-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
               <div class="flex space-x-6 overflow-x-auto py-3 text-sm font-medium">
    <a href="{{ route('vendor.dashboard') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.dashboard') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Dashboard</a>
    <a href="{{ route('vendor.calendar') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.calendar') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Calendar</a>
    <a href="{{ route('vendor.messages') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.messages') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Messages</a>
    <a href="{{ route('vendor.storefront') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.storefront') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Storefront</a>
    <a href="{{ route('vendor.payments') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.payments') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Payments</a>
    <a href="{{ route('vendor.reviews') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.reviews') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Reviews</a>
    <a href="{{ route('vendor.bookings') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.bookings') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Bookings</a>
    <!-- FIXED: Changed from route('vendor.business') to route('vendor.business.index') -->
    <a href="{{ route('vendor.business.index') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.business*') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Business</a>
    <!-- New Packages link -->
    <a href="{{ route('vendor.packages') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.packages') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Packages</a>
    <a href="{{ route('vendor.analytics') }}"
        class="whitespace-nowrap px-1 py-2 {{ request()->routeIs('vendor.analytics') ? 'text-primary-600 border-b-2 border-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400' }}">Analytics</a>
</div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-green-800 border-t border-gray-200 dark:border-gray-700 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                    <!-- App Column -->
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">GET THE WEDBOOKI APP</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Plan your event wherever and whenever you want
                            on the Wedbooki app.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="flex items-center bg-black text-white px-4 py-2 rounded-lg">
                                <x-heroicon-s-computer-desktop class="w-5 h-5 mr-2" />
                                Google Play
                            </a>
                            <a href="#" class="flex items-center bg-black text-white px-4 py-2 rounded-lg">
                                <x-heroicon-s-device-phone-mobile class="w-5 h-5 mr-2" />
                                App Store
                            </a>
                        </div>
                    </div>
                    <!-- Policies -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            POLICIES & TERMS</h4>
                        <ul class="space-y-2">
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Account Deletion</a>
                            </li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Help &
                                    Support</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Privacy Policy</a>
                            </li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Refund
                                    Policy</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Terms
                                    of Service</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Vendor
                                    Agreement</a></li>
                        </ul>
                    </div>
                    <!-- Company -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            THE COMPANY</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">About
                                    us</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">FAQ's</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Pricing</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Vendors</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Venues</a></li>
                        </ul>
                    </div>
                    <!-- Planning Tools -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            PLANNING TOOLS</h4>
                        <ul class="space-y-2">
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Budget</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Checklist</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Guest list</a></li>
                            <li><a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-primary-600">Vendor manager</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                    © 2026 Wedbooki. All rights reserved. Created & Managed by A Cube Creative Factory
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>