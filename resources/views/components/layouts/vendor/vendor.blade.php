<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Vendor Dashboard - Wedbooki' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased dark app-body">

<!-- Navbar -->
<nav class="app-navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="navbar-logo">
            <div class="w-10 h-10 rounded-lg bg-blue-600 dark:bg-blue-500 flex items-center justify-center">
                <span class="text-white font-bold text-lg">W</span>
            </div>
            <span class="text-xl font-bold text-zinc-900 dark:text-white hidden sm:inline">WEDBOOKI</span>
        </div>

        <!-- Nav Links -->
        <div class="navbar-nav">
            <a href="{{ route('vendor.dashboard') }}" class="navbar-item navbar-item-active">Venues</a>
            <a href="{{ route('vendor.vendors.index') }}" class="navbar-item">Vendors</a>
            <a href="#" class="navbar-item">Planning Tools</a>
        </div>

        <!-- Right Section -->
        <div class="navbar-actions">
            <!-- Search -->
            <div class="navbar-search hidden lg:block">
                <input type="text" placeholder='Try "Four Seasons"' class="navbar-search-input">
                <svg class="navbar-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Notifications -->
            <button class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded-lg transition">
                <svg class="w-6 h-6 text-zinc-700 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
            </button>

            <!-- Profile -->
            <div class="navbar-profile">
                <div class="navbar-profile-avatar">{{ substr(auth('vendor')->user()->full_name ?? 'A', 0, 1) }}</div>
                <div class="navbar-profile-dropdown">
                    <span class="navbar-profile-name">{{ substr(auth('vendor')->user()->full_name ?? 'Vendor', 0, 10) }}</span>
                    <svg class="navbar-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Tabs Navigation -->
<div class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-8 overflow-x-auto">
            <a href="{{ route('vendor.dashboard') }}" class="py-4 px-2 border-b-2 border-blue-600 dark:border-blue-500 text-blue-600 dark:text-blue-400 font-medium text-sm whitespace-nowrap transition">
                <svg class="w-5 h-5 mb-1 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"></path>
                </svg>
                Dashboard
            </a>
            <a href="#" class="py-4 px-2 border-b-2 border-transparent text-zinc-600 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium text-sm whitespace-nowrap transition">Calendar</a>
            <a href="#" class="py-4 px-2 border-b-2 border-transparent text-zinc-600 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium text-sm whitespace-nowrap transition">Messages</a>
            <a href="#" class="py-4 px-2 border-b-2 border-transparent text-zinc-600 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium text-sm whitespace-nowrap transition">Bookings</a>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="app-body">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{ $slot }}

    </div>
</main>

<!-- Footer -->
<footer class="bg-white dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-800 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-600 dark:bg-blue-500 flex items-center justify-center text-white font-bold">W</div>
                    <span class="font-bold text-zinc-900 dark:text-white">WEDBOOKI</span>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-zinc-900 dark:text-white mb-4">Policies</h3>
                <ul class="space-y-2 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Refund Policy</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-zinc-900 dark:text-white mb-4">Company</h3>
                <ul class="space-y-2 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">About Us</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Pricing</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-zinc-900 dark:text-white mb-4">Follow Us</h3>
                <div class="flex gap-4">
                    <a href="#" class="text-zinc-600 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-zinc-200 dark:border-zinc-800 pt-8 text-center text-zinc-500 dark:text-zinc-400 text-sm">
            <p>© 2025 Wedbooki. All rights reserved. Created & Managed by A Cube Creative Factory</p>
        </div>
    </div>
</footer>

@livewireScripts
</body>
</html>
