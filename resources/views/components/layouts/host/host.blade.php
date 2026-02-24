<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="app-body">

<!-- Navbar (unchanged) -->
<nav class="app-navbar navbar-blur" id="mainNavbar"
     x-data="{ mobileMenuOpen: false, profileMenuOpen: false, notificationsOpen: false }">
    <div class="navbar-container">

        <!-- Logo -->
        <a href="{{ route('host.host-dashboard') }}" class="navbar-logo">
            <x-app-logo/>
        </a>

        <!-- Desktop Navigation Items -->
        <div class="hidden lg:flex navbar-nav">
            <a href="{{ route('host.host-dashboard') }}"
               class="navbar-item {{ request()->routeIs('host.host-dashboard') ? 'navbar-item-active' : '' }}"
               wire:navigate>Home</a>
            <a href="{{ route('host.vendors.index') }}"
               class="navbar-item {{ request()->routeIs('host.vendors.*') ? 'navbar-item-active' : '' }}"
               wire:navigate>Vendors</a>
            <a href="{{ route('host.venues.index') }}"
               class="navbar-item {{ request()->routeIs('host.venues.*') ? 'navbar-item-active' : '' }}"
               wire:navigate>Venues</a>
        </div>

        <!-- Right Section: Search & Profile -->
        <div class="navbar-actions">

            <!-- Desktop Search Bar -->
            <div class="hidden lg:block navbar-search">
                <svg class="navbar-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder='Try "Four Seasons"' wire:model.debounce.300ms="search"
                       class="navbar-search-input"/>
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button @click="notificationsOpen = !notificationsOpen" @click.away="notificationsOpen = false"
                        class="relative p-2 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Notifications Dropdown (unchanged) -->
                <div x-show="notificationsOpen" x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-xl z-50"
                     style="display: none;">
                    <!-- ... notification items ... -->
                </div>
            </div>

            <!-- Heart Icon -->
            <button
                class="hidden lg:block p-2 text-zinc-600 dark:text-zinc-400 hover:text-pink-600 dark:hover:text-pink-400 transition-colors rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>

            <!-- User Profile with Dropdown (unchanged) -->
            <div class="relative">
                <button @click="profileMenuOpen = !profileMenuOpen" @click.away="profileMenuOpen = false"
                        class="navbar-profile">
                    <div class="navbar-profile-avatar">{{ auth()->user()->initials() }}</div>
                    <div class="navbar-profile-dropdown">
                        <span class="navbar-profile-name">{{ auth()->user()->full_name }}</span>
                        <svg class="navbar-dropdown-icon" :class="{ 'rotate-180': profileMenuOpen }" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>

                <!-- Profile Dropdown Menu (unchanged) -->
                <div x-show="profileMenuOpen" x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="navbar-profile-menu absolute right-0" style="display: none;">
                    <!-- ... profile items ... -->
                </div>
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden navbar-mobile-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" style="display: none;"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu (unchanged) -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900"
         style="display: none;">
        <!-- ... mobile menu items ... -->
    </div>
</nav>

<!-- Page Content with Sidebar -->
<main class="px-4 sm:px-6 lg:px-8 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar (from the second snippet) -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                <h2 class="text-lg font-semibold mb-4">My Event</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('host.vendors.index') }}"
                           class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition">
                            <x-heroicon-o-building-office class="w-5 h-5 text-emerald-600"/>
                            Vendor Manager
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition">
                            <x-heroicon-o-calendar class="w-5 h-5 text-emerald-600"/>
                            My Bookings
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition">
                            <x-heroicon-o-users class="w-5 h-5 text-emerald-600"/>
                            Guest List
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-600"/>
                            Check List
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition">
                            <x-heroicon-o-chat-bubble-left-ellipsis class="w-5 h-5 text-emerald-600"/>
                            Messages
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center gap-3 px-3 py-2 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition">
                            <x-heroicon-o-currency-dollar class="w-5 h-5 text-emerald-600"/>
                            Budget
                        </a>
                    </li>
                </ul>

                <!-- Categories -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Categories</h3>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Marquees
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Music
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Photography and Videography
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Wedding Wardrobe
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area (injected by child views) -->
        <div class="lg:col-span-3">
            {{ $slot }}
        </div>
    </div>
</main>

<!-- Footer (unchanged) -->
<footer class="mt-16 bg-emerald-900 dark:bg-emerald-950 text-white">
    <!-- ... footer content ... -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <!-- ... -->
    </div>
</footer>

<!-- Scroll Effect Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    });
</script>

@fluxScripts
</body>
</html>
