<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Wedbooki') }} - Host Dashboard</title>

    {{-- ── FOUC Prevention: apply .dark synchronously before first paint ── --}}
    <script>
        (function() {
            var stored = localStorage.getItem('wb-theme');
            // null    → follow OS preference
            // 'dark'  → forced dark
            // 'light' → forced light
            var useDark = stored === null ?
                window.matchMedia('(prefers-color-scheme: dark)').matches :
                stored === 'dark';
            if (useDark) document.documentElement.classList.add('dark');
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap"
        rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* ── Design tokens ───────────────────────────────────────────────────── */
        :root {
            --wb-ivory: #faf7f2;
            --wb-cream: #f3ede3;
            --wb-rose: #c9856a;
            --wb-rose-light: #e8b4a0;
            --wb-rose-deep: #a8604a;
            --wb-gold: #c9a96e;
            --wb-gold-light: #e4cfa0;
            --wb-charcoal: #2c2825;
            --wb-text: #3d3530;
            --wb-muted: #8a7e76;
            --wb-border: rgba(201, 169, 110, 0.18);
            --wb-glass: rgba(250, 247, 242, 0.90);
            --wb-nav-h: 50px;
        }

        .dark {
            --wb-ivory: #18150f;
            --wb-cream: #201c16;
            --wb-rose: #d4967e;
            --wb-rose-light: #b87a62;
            --wb-rose-deep: #e8b4a0;
            --wb-gold: #c9a96e;
            --wb-gold-light: #a88a52;
            --wb-charcoal: #f0ebe4;
            --wb-text: #d8d0c7;
            --wb-muted: #7a6f67;
            --wb-border: rgba(201, 169, 110, 0.13);
            --wb-glass: rgba(24, 21, 15, 0.92);
        }

        /* ── Base ────────────────────────────────────────────────────────────── */
        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--wb-ivory);
            color: var(--wb-text);
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Grain overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.028;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 128px;
        }

        /* ── STICKY HEADER: single element that holds both nav rows ─────────── */
        .wb-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: var(--wb-glass);
            backdrop-filter: blur(22px) saturate(1.6);
            -webkit-backdrop-filter: blur(22px) saturate(1.6);
            border-bottom: 1px solid var(--wb-border);
            box-shadow: 0 1px 18px rgba(0, 0, 0, 0.05);
            transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .wb-header.wb-scrolled {
            box-shadow: 0 4px 40px rgba(0, 0, 0, 0.12);
        }

        /* ── Top nav row ─────────────────────────────────────────────────────── */
        .wb-topnav {
            height: var(--wb-nav-h);
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--wb-border);
        }

        .wb-topnav-inner {
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 0 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        /* Logo */
        .wb-logo {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            font-size: 1.22rem;
            letter-spacing: 0.13em;
            background: linear-gradient(130deg, var(--wb-rose) 0%, var(--wb-gold) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            flex-shrink: 0;
        }

        /* Main links */
        .wb-main-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .wb-nav-link {
            font-size: 0.66rem;
            font-weight: 500;
            letter-spacing: 0.11em;
            color: var(--wb-muted);
            text-decoration: none;
            position: relative;
            padding-bottom: 1px;
            transition: color 0.2s ease;
        }

        .wb-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            right: 50%;
            height: 1px;
            background: var(--wb-gold);
            transition: left 0.22s ease, right 0.22s ease;
        }

        .wb-nav-link:hover {
            color: var(--wb-gold);
        }

        .wb-nav-link:hover::after {
            left: 0;
            right: 0;
        }

        /* Controls cluster */
        .wb-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Search */
        .wb-search {
            position: relative;
        }

        .wb-search input {
            width: 178px;
            padding: 0.34rem 0.85rem 0.34rem 2rem;
            font-size: 0.72rem;
            font-family: 'DM Sans', sans-serif;
            background: var(--wb-cream);
            border: 1px solid var(--wb-border);
            border-radius: 999px;
            color: var(--wb-text);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, width 0.28s ease;
        }

        .wb-search input::placeholder {
            color: var(--wb-muted);
            font-size: 0.7rem;
        }

        .wb-search input:focus {
            width: 218px;
            border-color: var(--wb-gold);
            box-shadow: 0 0 0 3px rgba(201, 169, 110, 0.13);
        }

        .wb-search-ico {
            position: absolute;
            left: 0.65rem;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            color: var(--wb-muted);
            pointer-events: none;
        }

        /* Currency pill */
        .wb-currency {
            display: flex;
            align-items: center;
            gap: 0.18rem;
            font-size: 0.66rem;
            letter-spacing: 0.05em;
            color: var(--wb-muted);
            padding: 0.26rem 0.58rem;
            border-radius: 999px;
            border: 1px solid var(--wb-border);
            user-select: none;
        }

        /* ── Theme toggle button (icon only, opens dropdown) ─────────────────── */
        .wb-theme-wrap {
            position: relative;
        }

        .wb-theme-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid var(--wb-border);
            background: transparent;
            cursor: pointer;
            color: var(--wb-muted);
            transition: border-color 0.2s ease, color 0.2s ease, background 0.2s ease;
            flex-shrink: 0;
        }

        .wb-theme-btn:hover {
            border-color: var(--wb-gold);
            color: var(--wb-gold);
            background: rgba(201, 169, 110, 0.07);
        }

        .wb-theme-btn svg {
            width: 14px;
            height: 14px;
        }

        /* Dropdown */
        .wb-theme-drop {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 145px;
            background: var(--wb-ivory);
            border: 1px solid var(--wb-border);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.11), 0 2px 8px rgba(0, 0, 0, 0.06);
            padding: 0.28rem;
            overflow: hidden;
            transform-origin: top right;
            z-index: 60;
        }

        .wb-theme-opt {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            width: 100%;
            padding: 0.46rem 0.65rem;
            border-radius: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 0.72rem;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.02em;
            color: var(--wb-muted);
            transition: background 0.14s ease, color 0.14s ease;
            text-align: left;
            white-space: nowrap;
        }

        .wb-theme-opt svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        .wb-theme-opt .wb-check {
            width: 11px;
            height: 11px;
            margin-left: auto;
            flex-shrink: 0;
        }

        .wb-theme-opt:hover {
            background: var(--wb-cream);
            color: var(--wb-text);
        }

        .wb-theme-opt.wb-active {
            background: rgba(201, 169, 110, 0.10);
            color: var(--wb-rose);
            font-weight: 500;
        }

        /* ── Sub-nav row ─────────────────────────────────────────────────────── */
        .wb-subnav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.25rem;
            display: flex;
            gap: 1.6rem;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .wb-subnav-inner::-webkit-scrollbar {
            display: none;
        }

        .wb-tab {
            display: flex;
            align-items: center;
            gap: 0.33rem;
            padding: 0.58rem 0.05rem;
            font-size: 0.66rem;
            font-weight: 500;
            letter-spacing: 0.09em;
            color: var(--wb-muted);
            text-decoration: none;
            white-space: nowrap;
            border-bottom: 2px solid transparent;
            transition: color 0.17s ease, border-color 0.17s ease;
            flex-shrink: 0;
        }

        .wb-tab svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        .wb-tab:hover {
            color: var(--wb-rose);
        }

        .wb-tab.wb-active {
            color: var(--wb-rose);
            border-bottom-color: var(--wb-rose);
        }

        /* ── Footer ──────────────────────────────────────────────────────────── */
        .wb-footer {
            background: var(--wb-cream);
            border-top: 1px solid var(--wb-border);
            margin-top: 4rem;
            transition: background 0.3s ease;
        }

        .wb-footer-h {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            color: var(--wb-charcoal);
            margin-bottom: 0.85rem;
        }

        .wb-footer-link {
            font-size: 0.77rem;
            color: var(--wb-muted);
            text-decoration: none;
            display: block;
            margin-bottom: 0.42rem;
            transition: color 0.17s ease;
        }

        .wb-footer-link:hover {
            color: var(--wb-gold);
        }

        .wb-app-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.42rem;
            padding: 0.52rem 0.95rem;
            background: var(--wb-charcoal);
            color: var(--wb-ivory);
            border-radius: 9px;
            font-size: 0.74rem;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.18s ease, transform 0.18s ease;
        }

        .wb-app-btn:hover {
            opacity: 0.82;
            transform: translateY(-1px);
        }

        .wb-app-btn svg {
            width: 15px;
            height: 15px;
        }

        /* ── Scrollbar ───────────────────────────────────────────────────────── */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--wb-border);
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--wb-gold-light);
        }
    </style>

    {{-- Alpine component must be defined before x-data is evaluated --}}
    <script>
        function wbTheme() {
            return {
                mode: localStorage.getItem('wb-theme') || 'system',
                open: false,
                _mq: null,

                init() {
                    this._mq = window.matchMedia('(prefers-color-scheme: dark)');
                    // FOUC script already applied the correct class on load.
                    // Just maintain reactivity going forward.
                    this._mq.addEventListener('change', () => {
                        if (this.mode === 'system') this._applyDark(this._mq.matches);
                    });
                },

                setMode(m) {
                    this.mode = m;
                    this.open = false;
                    if (m === 'system') {
                        localStorage.removeItem('wb-theme');
                        this._applyDark(this._mq.matches);
                    } else {
                        localStorage.setItem('wb-theme', m);
                        this._applyDark(m === 'dark');
                    }
                },

                _applyDark(isDark) {
                    document.documentElement.classList.toggle('dark', isDark);
                },
            };
        }
    </script>
</head>

<body x-data="wbTheme()" x-init="init()" class="min-h-full flex flex-col">

    {{-- ════════════════ SINGLE STICKY HEADER (topnav + subnav) ════════════════ --}}
    <header class="wb-header" id="wb-header">

        {{-- ── Top navigation bar ──────────────────────────────────────────── --}}
        <nav class="wb-topnav" aria-label="Main navigation">
            <div class="wb-topnav-inner">

                {{-- Left: logo + links --}}
                <div style="display:flex;align-items:center;gap:1.75rem;">
                    <a href="{{ route('host.dashboard') }}" class="wb-logo">WEDBOOKI</a>
                    <div class="wb-main-links hidden md:flex">
                        <a href="{{ route('wedding-venues.index') }}" class="wb-nav-link">VENUES</a>
                        <a href="{{ route('wedding-vendors.index') }}" class="wb-nav-link">VENDORS</a>
                        <a href="{{ route('wedding-planner') }}" class="wb-nav-link">PLANNING TOOLS</a>
                    </div>
                </div>

                {{-- Right: search · currency · theme --}}
                <div class="wb-controls">

                    {{-- Search --}}
                    <div class="wb-search hidden md:block">
                        <svg class="wb-search-ico" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z" />
                        </svg>
                        <input type="text" placeholder="Search venues, vendors…">
                    </div>

                    {{-- Currency --}}
                    <div class="wb-currency">
                        <span>PK · PKR</span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:9px;height:9px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    {{-- Theme dropdown --}}
                    <div class="wb-theme-wrap">
                        <button class="wb-theme-btn" @click="open = !open" @keydown.escape.window="open = false"
                            :aria-label="'Theme: ' + mode">
                            {{-- Sun (light) --}}
                            <svg x-show="mode === 'light'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="4" stroke-width="2" />
                                <path stroke-linecap="round" stroke-width="2"
                                    d="M12 2v2M12 20v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M2 12h2M20 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                            </svg>
                            {{-- Moon (dark) --}}
                            <svg x-show="mode === 'dark'" x-cloak fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                            {{-- Monitor (system) --}}
                            <svg x-show="mode === 'system'" x-cloak fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        {{-- Dropdown panel --}}
                        <div x-show="open" x-cloak @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-140"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-90"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="wb-theme-drop">

                            @foreach ([['val' => 'light', 'label' => 'Light', 'icon' => 'sun'], ['val' => 'dark', 'label' => 'Dark', 'icon' => 'moon'], ['val' => 'system', 'label' => 'System', 'icon' => 'monitor']] as $opt)
                                <button @click="setMode('{{ $opt['val'] }}')" class="wb-theme-opt"
                                    :class="mode === '{{ $opt['val'] }}' ? 'wb-active' : ''">

                                    @if ($opt['icon'] === 'sun')
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @elseif($opt['icon'] === 'moon')
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                        </svg>
                                    @else
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif

                                    <span>{{ $opt['label'] }}</span>

                                    {{-- Active checkmark --}}
                                    <svg x-show="mode === '{{ $opt['val'] }}'" class="wb-check" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    {{-- /theme --}}

                </div>
            </div>
        </nav>
        {{-- /topnav --}}

        {{-- ── Sub-navigation (dashboard tabs) ────────────────────────────── --}}
        <div aria-label="Dashboard navigation">
            <div class="wb-subnav-inner">
                @php
                    $navItems = [
                        ['label' => 'My Event', 'route' => 'host.dashboard', 'icon' => 'calendar'],
                        ['label' => 'Vendor Manager', 'route' => 'host.vendors.index', 'icon' => 'briefcase'],
                        ['label' => 'My Bookings', 'route' => 'host.bookings.index', 'icon' => 'book-open'],
                        ['label' => 'Guest List', 'route' => 'host.guests.index', 'icon' => 'users'],
                        ['label' => 'Check List', 'route' => 'host.checklists.index', 'icon' => 'check'],
                        ['label' => 'Messages', 'route' => 'host.messages', 'icon' => 'chat'],
                        ['label' => 'Budget', 'route' => 'host.budget', 'icon' => 'dollar'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="wb-tab {{ request()->routeIs($item['route']) ? 'wb-active' : '' }}">

                        @if ($item['icon'] === 'calendar')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        @elseif($item['icon'] === 'briefcase')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        @elseif($item['icon'] === 'book-open')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        @elseif($item['icon'] === 'users')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17 20h5v-1a4 4 0 00-5-3.87M9 20H4v-1a4 4 0 015-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 11-6 0 3 3 0 016 0zM7 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        @elseif($item['icon'] === 'check')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif($item['icon'] === 'chat')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        @elseif($item['icon'] === 'dollar')
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif

                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        {{-- /subnav --}}

    </header>
    {{-- /sticky header --}}

    {{-- ═══════════════════════════ MAIN CONTENT ═══════════════════════════════ --}}
    <main class="flex-1" style="position:relative;z-index:1;">
        {{ $slot }}
    </main>

    {{-- ════════════════════════════ FOOTER ════════════════════════════════════ --}}
    <footer class="wb-footer">
        <div style="max-width:1280px;margin:0 auto;padding:3rem 1.25rem;">
            <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:2.5rem;">

                <div>
                    <a href="{{ route('host.dashboard') }}" class="wb-logo"
                        style="display:inline-block;margin-bottom:0.7rem;">WEDBOOKI</a>
                    <p
                        style="font-size:0.78rem;color:var(--wb-muted);line-height:1.7;max-width:255px;margin-bottom:1.1rem;">
                        Plan your event wherever and whenever — beautifully.
                    </p>
                    <div style="display:flex;gap:0.6rem;flex-wrap:wrap;">
                        <a href="#" class="wb-app-btn">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3.18 23.4A1.65 1.65 0 012 21.8V2.2A1.65 1.65 0 013.18.6l11.1 11.4-11.1 11.4zm13.3-7.7l-2.6-2.65 2.6-2.65 3.15 1.8a1.65 1.65 0 010 2.85l-3.15 1.65zm-1.4-1.35L4.3 23.1l9.78-5.75zm0-10.7L4.3.9l10.78 8.8-2.6 2.65.8-.8z" />
                            </svg>
                            Google Play
                        </a>
                        <a href="#" class="wb-app-btn">
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                            </svg>
                            App Store
                        </a>
                    </div>
                </div>

                <div>
                    <p class="wb-footer-h">POLICIES & TERMS</p>
                    <a href="#" class="wb-footer-link">Privacy Policy</a>
                    <a href="#" class="wb-footer-link">Terms of Service</a>
                    <a href="#" class="wb-footer-link">Cookie Policy</a>
                    <a href="#" class="wb-footer-link">Refund Policy</a>
                </div>

                <div>
                    <p class="wb-footer-h">THE COMPANY</p>
                    <a href="#" class="wb-footer-link">About Wedbooki</a>
                    <a href="#" class="wb-footer-link">Careers</a>
                    <a href="#" class="wb-footer-link">Press</a>
                    <a href="#" class="wb-footer-link">Contact Us</a>
                </div>

                <div>
                    <p class="wb-footer-h">PLANNING TOOLS</p>
                    <a href="#" class="wb-footer-link">Wedding Checklist</a>
                    <a href="#" class="wb-footer-link">Budget Calculator</a>
                    <a href="#" class="wb-footer-link">Guest Manager</a>
                    <a href="#" class="wb-footer-link">Seating Planner</a>
                </div>
            </div>

            <div
                style="border-top:1px solid var(--wb-border);margin-top:2.2rem;padding-top:1.2rem;
                        display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.5rem;">
                <span style="font-size:0.71rem;color:var(--wb-muted);">© 2026 Wedbooki. All rights reserved.</span>
                <span style="font-size:0.71rem;color:var(--wb-muted);">Created & Managed by A Cube Creative
                    Factory</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        // ── Scroll shadow on sticky header ────────────────────────────────────────
        (function() {
            const hdr = document.getElementById('wb-header');
            if (!hdr) return;
            const update = () => hdr.classList.toggle('wb-scrolled', window.scrollY > 6);
            window.addEventListener('scroll', update, {
                passive: true
            });
            update();
        })();
    </script>

    {{-- ════════════════════════════ REUSABLE CURSOR EFFECT ════════════════════ --}}
    <x-cursor-effect />

</body>

</html>
