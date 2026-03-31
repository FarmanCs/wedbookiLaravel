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

                    {{-- Left: Logo + Vendor Badge --}}
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <a href="{{ route('vendor.dashboard') }}"
                                class="text-2xl font-bold text-primary-600 dark:text-primary-400">WEDBOOKI</a>
                        </div>
                        <span
                            class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 border border-primary-200 dark:border-primary-700">
                            Vendor Portal
                        </span>
                    </div>

                    {{-- Right: Vendor info + dark mode --}}
                    <div class="flex items-center space-x-3">

                        {{-- Notifications placeholder --}}
                        <button
                            class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <x-heroicon-s-bell class="w-5 h-5" />
                            {{-- Uncomment when you have notifications:
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full"></span>
                            --}}
                        </button>

                        {{-- Dark mode toggle --}}
                        <button @click="toggleDark()"
                            class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                            <x-heroicon-s-moon class="w-5 h-5" x-show="!darkMode" />
                            <x-heroicon-s-sun class="w-5 h-5" x-show="darkMode" x-cloak />
                        </button>

                        {{-- Vendor avatar / name dropdown --}}
                        @auth('vendor')
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" @click.outside="open = false"
                                    class="flex items-center space-x-2 pl-2 pr-3 py-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <div
                                        class="w-7 h-7 rounded-full bg-primary-600 dark:bg-primary-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ auth('vendor')->user()->initials() }}
                                    </div>
                                    <span
                                        class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300 max-w-[120px] truncate">
                                        {{ auth('vendor')->user()->full_name }}
                                    </span>
                                    <x-heroicon-s-chevron-down class="w-3.5 h-3.5 text-gray-400" />
                                </button>

                                <div x-show="open" x-cloak x-transition
                                    class="absolute right-0 mt-1 w-48 bg-white dark:bg-stone-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg py-1 z-50">
                                    <div class="px-3 py-2 border-b border-gray-100 dark:border-gray-800">
                                        <p class="text-xs font-semibold text-gray-900 dark:text-gray-100 truncate">
                                            {{ auth('vendor')->user()->full_name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                            {{ auth('vendor')->user()->email }}</p>
                                    </div>
                                    <a href="{{ route('vendor.profile') }}"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-user-circle class="w-4 h-4 text-gray-400" />
                                        My Profile
                                    </a>
                                    <a href="{{ route('vendor.storefront') }}"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-building-storefront class="w-4 h-4 text-gray-400" />
                                        My Storefront
                                    </a>
                                    <a href="{{ route('vendor.business.index') }}"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-briefcase class="w-4 h-4 text-gray-400" />
                                        My Businesses
                                    </a>
                                    <a href="{{ route('vendor.credits') }}"
                                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                        <x-heroicon-s-currency-dollar class="w-4 h-4 text-gray-400" />
                                        Credits
                                    </a>
                                    <div class="border-t border-gray-100 dark:border-gray-800 mt-1 pt-1">
                                        <form method="POST" action="{{ route('vendor.logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center gap-2 w-full px-3 py-2 text-sm text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors">
                                                <x-heroicon-s-arrow-right-on-rectangle class="w-4 h-4" />
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

        <!-- Sub-navigation -->
        <div class="bg-white dark:bg-stone-950 border-b border-gray-200 dark:border-gray-700 mb-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-1 overflow-x-auto py-2 text-sm font-medium scrollbar-hide">
                    <a href="{{ route('vendor.dashboard') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.dashboard') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('vendor.calendar') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.calendar') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Calendar
                    </a>
                    <a href="{{ route('vendor.messages') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.messages') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Messages
                    </a>
                    <a href="{{ route('vendor.storefront') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.storefront') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Storefront
                    </a>
                    <a href="{{ route('vendor.payments') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.payments') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Payments
                    </a>
                    <a href="{{ route('vendor.reviews') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.reviews') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Reviews
                    </a>
                    <a href="{{ route('vendor.bookings') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.bookings') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Bookings
                    </a>
                    <a href="{{ route('vendor.business.index') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.business*') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Business
                    </a>
                    <a href="{{ route('vendor.packages') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.packages') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Packages
                    </a>
                    <a href="{{ route('vendor.analytics') }}"
                        class="whitespace-nowrap px-3 py-2 rounded-lg {{ request()->routeIs('vendor.analytics') ? 'bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        Analytics
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="mt-12" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #1e3a5f 100%);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Top footer strip --}}
                <div class="py-8 flex flex-col md:flex-row items-center justify-between gap-6">

                    {{-- Brand --}}
                    <div class="flex items-center gap-3">
                        <span class="text-xl font-extrabold tracking-tight text-white">WEDBOOKI</span>
                        <span class="text-xs px-2.5 py-0.5 rounded-full font-semibold border"
                            style="background: rgba(165,180,252,0.12); border-color: rgba(165,180,252,0.30); color: #c7d2fe;">
                            Vendor Portal
                        </span>
                    </div>

                    {{-- Links --}}
                    <div class="flex flex-wrap justify-center gap-x-7 gap-y-2 text-sm"
                        style="color: rgba(199,210,254,0.75);">
                        <a href="#" class="transition-colors hover:text-white flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Help & Support
                        </a>
                        <a href="#" class="transition-colors hover:text-white flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Privacy Policy
                        </a>
                        <a href="#" class="transition-colors hover:text-white flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Vendor Agreement
                        </a>
                        <a href="#" class="transition-colors hover:text-white flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Terms of Service
                        </a>
                    </div>

                    {{-- Sign out quick action --}}
                    @auth('vendor')
                        <form method="POST" action="{{ route('vendor.logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
                                style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: rgba(199,210,254,0.85);"
                                onmouseover="this.style.background='rgba(255,255,255,0.14)'"
                                onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign out
                            </button>
                        </form>
                    @endauth
                </div>

                {{-- Divider --}}
                <div style="border-top: 1px solid rgba(165,180,252,0.15);"></div>

                {{-- Bottom strip --}}
                <div class="py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                    <p class="text-xs" style="color: rgba(199,210,254,0.45);">
                        © {{ date('Y') }} Wedbooki. All rights reserved. Created & Managed by A Cube Creative
                        Factory
                    </p>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs" style="color: rgba(199,210,254,0.45);">All systems operational</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')

    {{-- ═══════════════════════════════════════════════
         AMBIENT BACKGROUND EFFECT
         ▸ NO cursor changes — OS default cursor kept
         ▸ Idle  → twinkling stars + slow drifting orbs
         ▸ Moving → soft coloured smoke near the cursor
         ▸ canvas pointer-events:none — never blocks UI
    ═══════════════════════════════════════════════ --}}
    <canvas id="vd-fx-canvas" aria-hidden="true"></canvas>

    <style>
        /* Purely decorative overlay — zero impact on cursor or pointer behaviour */
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
        (function() {
            'use strict';

            const canvas = document.getElementById('vd-fx-canvas');
            const ctx = canvas.getContext('2d');

            /* ── resize ── */
            function resize() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', () => {
                resize();
                rebuildOrbs();
            });

            /* ═══════════════════════════════
               COLOUR TABLES
            ═══════════════════════════════ */
            const SMOKE_PALETTES = [
                ['#c084fc', '#a855f7', '#e879f9'],
                ['#38bdf8', '#22d3ee', '#67e8f9'],
                ['#f472b6', '#fb7185', '#fda4af'],
                ['#34d399', '#6ee7b7', '#5eead4'],
                ['#fbbf24', '#fb923c', '#fde68a'],
                ['#818cf8', '#6366f1', '#a78bfa'],
            ];

            const STAR_COLORS = [
                '#c084fc', '#a78bfa', '#818cf8', '#6366f1',
                '#38bdf8', '#67e8f9', '#5eead4', '#2dd4bf',
                '#f472b6', '#fda4af', '#fbbf24', '#fde68a',
                '#ffffff', '#e0e7ff', '#ddd6fe', '#bfdbfe',
            ];

            const ORB_COLORS = [
                '#a855f7', '#818cf8', '#38bdf8',
                '#34d399', '#f472b6', '#fbbf24', '#e879f9',
            ];

            let palIdx = 0,
                palTimer = 0;

            function rgba(hex, a) {
                const r = parseInt(hex.slice(1, 3), 16);
                const g = parseInt(hex.slice(3, 5), 16);
                const b = parseInt(hex.slice(5, 7), 16);
                return `rgba(${r},${g},${b},${Math.max(0, +a.toFixed(3))})`;
            }
            const rand = (a, b) => a + Math.random() * (b - a);

            const mouse = {
                x: -999,
                y: -999
            };
            const vel = {
                x: 0,
                y: 0
            };
            let lx = 0,
                ly = 0;
            let moving = false;
            let moveTimer = null;
            const IDLE_MS = 140;

            const smoke = [];

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
                    const a = this.life * 0.14;
                    const g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r);
                    g.addColorStop(0, rgba(this.c, a));
                    g.addColorStop(0.5, rgba(this.c, a * 0.4));
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

            const STAR_N = 70;
            const stars = [];

            class Star {
                constructor(boot) {
                    this.boot = boot;
                    this.reset();
                }
                reset() {
                    this.x = rand(10, canvas.width - 10);
                    this.y = rand(10, canvas.height - 10);
                    this.c = STAR_COLORS[Math.floor(Math.random() * STAR_COLORS.length)];
                    this.maxA = rand(0.28, 0.55);
                    this.dot = rand(0.7, 2.0);
                    this.cross = Math.random() < 0.28;
                    this.arm = this.dot * rand(3.0, 6.5);
                    this.phase = this.boot ? Math.floor(Math.random() * 3) : 0;
                    this.a = (this.boot && this.phase > 0) ? this.maxA * rand(0.3, 1) : 0;
                    this.fi = rand(0.006, 0.015);
                    this.fo = rand(0.005, 0.012);
                    this.holdN = Math.floor(rand(60, 200));
                    this.held = this.boot ? Math.floor(Math.random() * this.holdN) : 0;
                    this.dx = rand(-0.07, 0.07);
                    this.dy = rand(-0.06, 0.06);
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
                draw(scale) {
                    const a = this.a * scale;
                    if (a < 0.01) return;
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
                        ctx.lineWidth = 0.65;
                        ctx.globalAlpha = a * 0.7;
                        ctx.beginPath();
                        ctx.moveTo(this.x - L, this.y);
                        ctx.lineTo(this.x + L, this.y);
                        ctx.moveTo(this.x, this.y - L);
                        ctx.lineTo(this.x, this.y + L);
                        ctx.stroke();
                        const d = L * 0.55;
                        ctx.globalAlpha = a * 0.3;
                        ctx.lineWidth = 0.45;
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

            for (let i = 0; i < STAR_N; i++) stars.push(new Star(true));

            const ORB_N = 7;
            const orbs = [];

            class FloatOrb {
                constructor() {
                    this.init();
                }
                init() {
                    this.x = rand(0, canvas.width);
                    this.y = rand(0, canvas.height);
                    this.r = rand(50, 110);
                    this.c = ORB_COLORS[Math.floor(Math.random() * ORB_COLORS.length)];
                    this.vx = rand(-0.16, 0.16);
                    this.vy = rand(-0.12, 0.12);
                    this.a = 0;
                    this.tA = rand(0.04, 0.08);
                    this.spd = rand(0.006, 0.012);
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
                        this.a -= this.spd * 0.6;
                        if (this.a <= 0) this.init();
                    }
                }
                draw(scale) {
                    const a = this.a * scale;
                    if (a < 0.003) return;
                    const g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r);
                    g.addColorStop(0, rgba(this.c, a));
                    g.addColorStop(0.55, rgba(this.c, a * 0.3));
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

            function rebuildOrbs() {
                orbs.length = 0;
                for (let i = 0; i < ORB_N; i++) orbs.push(new FloatOrb());
            }
            rebuildOrbs();

            const flecks = [];

            class Fleck {
                constructor(x, y, c) {
                    this.x = x;
                    this.y = y;
                    this.vx = rand(-3.5, 3.5);
                    this.vy = rand(-3.5, 3.5) - 1.2;
                    this.c = c;
                    this.r = rand(1.2, 2.8);
                    this.a = 1.0;
                    this.d = rand(0.04, 0.07);
                }
                step() {
                    this.x += this.vx;
                    this.vx *= 0.96;
                    this.y += this.vy;
                    this.vy += 0.09;
                    this.a -= this.d;
                    this.r *= 0.97;
                }
                draw() {
                    if (this.a <= 0 || this.r < 0.2) return;
                    ctx.save();
                    ctx.globalAlpha = Math.max(0, this.a * 0.7);
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
                    return this.a <= 0 || this.r < 0.2;
                }
            }

            function spawnSmoke() {
                const pal = SMOKE_PALETTES[palIdx % SMOKE_PALETTES.length];
                const speed = Math.sqrt(vel.x ** 2 + vel.y ** 2);
                const n = Math.min(Math.floor(speed * 0.28) + 1, 5);
                for (let i = 0; i < n; i++) smoke.push(new SmokePuff(mouse.x, mouse.y, vel.x, vel.y, pal));
                if (speed > 7 && Math.random() < 0.45) {
                    const c = pal[Math.floor(Math.random() * pal.length)];
                    const k = 1 + Math.floor(Math.random() * 3);
                    for (let i = 0; i < k; i++) flecks.push(new Fleck(mouse.x, mouse.y, c));
                }
            }

            let idleScale = 1.0;

            function loop() {
                requestAnimationFrame(loop);
                palTimer++;
                if (palTimer > 55) {
                    palIdx++;
                    palTimer = 0;
                }
                const target = moving ? 0.0 : 1.0;
                idleScale += (target - idleScale) * 0.05;
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
