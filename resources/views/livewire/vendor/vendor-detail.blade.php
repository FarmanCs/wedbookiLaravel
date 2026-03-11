@push('styles')
    <style>
        /* ==================== CUSTOM ANIMATIONS ==================== */
        @keyframes gradient-shift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes float-subtle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-16px);
            }
        }

        @keyframes glow-pulse {

            0%,
            100% {
                box-shadow: 0 0 30px rgba(236, 72, 153, 0.4), 0 0 60px rgba(236, 72, 153, 0.2);
            }

            50% {
                box-shadow: 0 0 50px rgba(236, 72, 153, 0.6), 0 0 100px rgba(236, 72, 153, 0.3);
            }
        }

        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-up {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.85);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes bounce-light {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shimmer-effect {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes gradient-flow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes pulse-ring {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(236, 72, 153, 0);
            }
        }

        @keyframes rotate-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes text-shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        /* ==================== ANIMATION UTILITIES ==================== */
        .animate-gradient-shift {
            background-size: 200% 200%;
            animation: gradient-shift 15s ease infinite;
        }

        .animate-float {
            animation: float-subtle 8s ease-in-out infinite;
        }

        .animate-float-delay-1 {
            animation: float-subtle 10s ease-in-out infinite;
            animation-delay: 1s;
        }

        .animate-float-delay-2 {
            animation: float-subtle 12s ease-in-out infinite;
            animation-delay: 2s;
        }

        .animate-glow-pulse {
            animation: glow-pulse 3s ease-in-out infinite;
        }

        .animate-slide-left {
            animation: slide-in-left 0.8s ease-out forwards;
        }

        .animate-slide-up {
            animation: slide-in-up 0.8s ease-out forwards;
        }

        .animate-scale-in {
            animation: scale-in 0.6s ease-out forwards;
        }

        .animate-bounce-light {
            animation: bounce-light 3s ease-in-out infinite;
        }

        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            background-size: 1000px 100%;
            animation: shimmer-effect 2s infinite;
        }

        .animate-gradient-flow {
            background-size: 200% 200%;
            animation: gradient-flow 8s ease infinite;
        }

        .animate-pulse-ring {
            animation: pulse-ring 2s infinite;
        }

        .animate-rotate-slow {
            animation: rotate-slow 20s linear infinite;
        }

        .animate-text-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            background-size: 1000px 100%;
            animation: text-shimmer 2.5s infinite;
        }

        /* Stagger animations */
        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }

        .delay-600 {
            animation-delay: 600ms;
        }

        /* ==================== GLASS MORPHISM ==================== */
        .glass-dark {
            background: rgba(248, 250, 252, 0.08);
            backdrop-filter: blur(30px);
            border: 1.5px solid rgba(248, 250, 252, 0.2);
        }

        .dark .glass-dark {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(35px);
            border: 1.5px solid rgba(248, 250, 252, 0.08);
        }

        .glass-light {
            background: rgba(248, 250, 252, 0.1);
            backdrop-filter: blur(25px);
            border: 1.5px solid rgba(248, 250, 252, 0.25);
        }

        .dark .glass-light {
            background: rgba(248, 250, 252, 0.04);
            backdrop-filter: blur(25px);
            border: 1.5px solid rgba(248, 250, 252, 0.06);
        }

        /* ==================== GLOW EFFECTS ==================== */
        .glow-pink {
            box-shadow: 0 0 30px rgba(236, 72, 153, 0.4), 0 0 60px rgba(236, 72, 153, 0.2);
        }

        .dark .glow-pink {
            box-shadow: 0 0 30px rgba(236, 72, 153, 0.3), 0 0 60px rgba(236, 72, 153, 0.15);
        }

        .glow-pink-lg {
            box-shadow: 0 0 50px rgba(236, 72, 153, 0.5), 0 0 100px rgba(236, 72, 153, 0.3), 0 0 150px rgba(236, 72, 153, 0.15);
        }

        .dark .glow-pink-lg {
            box-shadow: 0 0 50px rgba(236, 72, 153, 0.4), 0 0 100px rgba(236, 72, 153, 0.2), 0 0 150px rgba(236, 72, 153, 0.1);
        }

        .glow-cyan {
            box-shadow: 0 0 30px rgba(6, 182, 212, 0.4), 0 0 60px rgba(6, 182, 212, 0.2);
        }

        .glow-purple {
            box-shadow: 0 0 30px rgba(168, 85, 247, 0.4), 0 0 60px rgba(168, 85, 247, 0.2);
        }

        .glow-amber {
            box-shadow: 0 0 30px rgba(245, 158, 11, 0.4), 0 0 60px rgba(245, 158, 11, 0.2);
        }

        /* ==================== FEATURED GALLERY ==================== */
        .gallery-main {
            grid-column: span 2;
            height: 400px;
        }

        .gallery-side {
            height: 190px;
        }

        @media (max-width: 1024px) {
            .gallery-main {
                grid-column: span 2;
                height: 320px;
            }

            .gallery-side {
                height: 150px;
            }
        }

        @media (max-width: 768px) {
            .gallery-main {
                grid-column: span 2;
                height: 250px;
            }

            .gallery-side {
                height: 120px;
            }
        }

        @media (max-width: 640px) {
            .gallery-main {
                grid-column: span 1;
                height: 250px;
            }

            .gallery-side {
                height: 150px;
            }
        }

        /* ==================== SMOOTH TRANSITIONS ==================== */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1024px) {
            .contact-card {
                position: relative !important;
                margin-top: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 450px !important;
            }
        }

        @media (max-width: 640px) {
            .hero-section {
                min-height: 380px !important;
            }
        }
    </style>
@endpush

<div
    class="min-h-screen bg-white dark:bg-gradient-to-br dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 text-slate-900 dark:text-slate-50 transition-colors duration-300">

    @if ($business)
        <!-- ==================== HERO SECTION ==================== -->
        <section
            class="hero-section relative min-h-[500px] overflow-hidden bg-gradient-to-br from-white via-blue-50 to-indigo-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
            <!-- Animated Background Blobs -->
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-pink-500 via-rose-400 to-pink-300 rounded-full blur-3xl opacity-20 dark:opacity-30 animate-float">
            </div>
            <div
                class="absolute -bottom-32 -left-32 w-96 h-96 bg-gradient-to-br from-cyan-500 via-blue-400 to-cyan-300 rounded-full blur-3xl opacity-15 dark:opacity-25 animate-float-delay-1">
            </div>
            <div
                class="absolute top-1/3 right-1/3 w-72 h-72 bg-gradient-to-br from-purple-500 via-violet-400 to-purple-300 rounded-full blur-3xl opacity-10 dark:opacity-20 animate-float-delay-2">
            </div>

            <!-- Animated Gradient Overlay -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-pink-500/5 via-purple-500/5 to-cyan-500/5 dark:from-pink-600/20 dark:via-purple-600/15 dark:to-cyan-600/20 animate-gradient-shift opacity-100">
            </div>

            <!-- Cover Image -->
            @if ($business->cover_image)
                <img src="{{ Storage::url($business->cover_image) }}" alt="{{ $business->company_name }}"
                    class="absolute inset-0 w-full h-full object-cover opacity-10 dark:opacity-8 mix-blend-overlay">
            @endif

            <!-- Navigation Bar -->
            <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-6">
                <div class="flex items-center justify-between">
                    <a href="{{ route('wedding-vendors.index') }}"
                        class="group glass-light px-4 py-2 rounded-xl flex items-center gap-2 text-slate-700 dark:text-white font-semibold hover:bg-gradient-to-r hover:from-pink-500/20 hover:to-cyan-500/20 dark:hover:from-pink-600/30 dark:hover:to-cyan-600/30 hover:border-pink-400/60 dark:hover:border-pink-400/50 hover:scale-105 hover:-translate-y-1 shadow-md dark:shadow-lg dark:shadow-slate-900/50">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Back</span>
                    </a>

                    @if ($business->is_featured)
                        <div
                            class="animate-glow-pulse bg-gradient-to-r from-amber-400 via-orange-400 to-pink-500 px-6 py-2.5 rounded-full text-slate-900 font-bold text-sm flex items-center gap-2.5 shadow-lg dark:shadow-amber-900/60 hover:scale-110 hover:-translate-y-1">
                            <svg class="w-5 h-5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span>Featured</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 flex pb-8 min-h-[400px]">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 w-full">
                    <!-- Profile Card -->
                    <div class="lg:col-span-2 animate-slide-up delay-100">
                        <div
                            class="glass-dark rounded-3xl p-6 lg:p-10 bg-gradient-to-br from-white/80 via-white/60 to-blue-50/60 dark:from-slate-900/70 dark:via-slate-800/60 dark:to-blue-900/50 border-2 border-pink-400/30 dark:border-pink-500/40 hover:border-pink-500/60 dark:hover:border-pink-400/70 hover:shadow-2xl dark:hover:shadow-pink-900/40 hover:glow-pink">
                            <div class="flex flex-col sm:flex-row items-start gap-6 lg:gap-8">
                                <!-- Profile Image -->
                                <div class="relative flex-shrink-0 group w-full sm:w-auto">
                                    <div
                                        class="absolute -inset-6 bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 rounded-3xl blur-2xl opacity-0 group-hover:opacity-60 dark:group-hover:opacity-50 transition-all duration-700">
                                    </div>
                                    <div
                                        class="absolute -inset-3 bg-gradient-to-r from-pink-400 to-cyan-400 rounded-2xl blur-lg opacity-0 group-hover:opacity-40 dark:group-hover:opacity-30 transition-all duration-700">
                                    </div>

                                    @if ($business->profile_image)
                                        <img src="{{ Storage::url($business->profile_image) }}"
                                            alt="{{ $business->company_name }}"
                                            class="relative w-40 h-40 sm:w-36 sm:h-36 rounded-2xl object-cover border-3 border-pink-400/60 dark:border-pink-500/50 glow-pink-lg group-hover:scale-110 shadow-2xl dark:shadow-pink-900/40 group-hover:shadow-2xl">
                                    @else
                                        <div
                                            class="relative w-40 h-40 sm:w-36 sm:h-36 rounded-2xl bg-gradient-to-br from-pink-500 via-purple-500 via-blue-500 to-cyan-500 flex items-center justify-center text-5xl font-black text-white glow-pink-lg group-hover:scale-110 border-3 border-pink-400/60 dark:border-pink-500/50 shadow-2xl dark:shadow-pink-900/40">
                                            {{ $initials }}
                                        </div>
                                    @endif

                                    <div
                                        class="absolute -bottom-2 -right-2 w-7 h-7 bg-gradient-to-r from-emerald-400 to-green-500 rounded-full border-4 border-white dark:border-slate-950 shadow-lg shadow-emerald-500/60 dark:shadow-emerald-600/40 animate-pulse-ring">
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="flex-1 w-full">
                                    <h1
                                        class="text-5xl sm:text-6xl font-black text-slate-900 dark:text-white mb-4 bg-gradient-to-r from-pink-600 via-purple-600 to-cyan-600 dark:from-pink-300 dark:via-purple-300 dark:to-cyan-300 bg-clip-text text-transparent animate-text-shimmer">
                                        {{ $business->company_name }}
                                    </h1>

                                    <!-- Info Badges -->
                                    <div class="flex flex-wrap gap-3 mb-6">
                                        <!-- Rating -->
                                        <div
                                            class="glass-light px-4 py-2.5 rounded-xl bg-gradient-to-r from-pink-100/70 to-pink-100/50 dark:from-pink-600/20 dark:to-pink-600/15 border-2 border-pink-300/70 dark:border-pink-400/50 hover:scale-110 hover:shadow-lg dark:hover:shadow-pink-900/30">
                                            <div
                                                class="flex items-center gap-2.5 text-pink-700 dark:text-pink-300 text-sm font-bold">
                                                <div class="flex gap-1">
                                                    @foreach ($starArray as $star)
                                                        <svg class="w-4 h-4 {{ $star['filled'] ? 'fill-amber-500 dark:fill-amber-400 text-amber-500 dark:text-amber-400' : 'text-gray-400 dark:text-gray-600' }}"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endforeach
                                                </div>
                                                <span>{{ number_format($averageRating, 1) }}</span>
                                                <span class="text-xs opacity-75">({{ $reviewsCount }})</span>
                                            </div>
                                        </div>

                                        <!-- Location -->
                                        <div
                                            class="glass-light px-4 py-2.5 rounded-xl bg-gradient-to-r from-cyan-100/70 to-cyan-100/50 dark:from-cyan-600/20 dark:to-cyan-600/15 border-2 border-cyan-300/70 dark:border-cyan-400/50 hover:scale-110 hover:shadow-lg dark:hover:shadow-cyan-900/30">
                                            <div
                                                class="flex items-center gap-2.5 text-cyan-700 dark:text-cyan-300 font-semibold text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                {{ $business->city ?? 'N/A' }},
                                                {{ substr($business->country ?? 'N/A', 0, 3) }}
                                            </div>
                                        </div>

                                        @if ($business->category)
                                            <div
                                                class="glass-light px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-100/70 to-amber-100/50 dark:from-amber-600/20 dark:to-amber-600/15 border-2 border-amber-300/70 dark:border-amber-400/50 hover:scale-110 hover:shadow-lg dark:hover:shadow-amber-900/30">
                                                <div
                                                    class="flex items-center gap-2.5 text-amber-700 dark:text-amber-300 font-semibold text-sm">
                                                    {{ $business->category->type }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Stats -->
                                    <div class="grid grid-cols-3 gap-4">
                                        <div
                                            class="group glass-light hover:bg-gradient-to-br hover:from-cyan-100/70 hover:to-blue-100/60 dark:hover:from-cyan-600/30 dark:hover:to-blue-600/30 rounded-xl p-4 cursor-pointer border-2 border-cyan-300/50 dark:border-cyan-500/30 hover:scale-110 hover:-translate-y-2 hover:shadow-lg dark:shadow-cyan-900/20">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 dark:from-cyan-600 dark:to-blue-700 rounded-lg flex items-center justify-center mb-2 group-hover:scale-125 shadow-lg dark:shadow-cyan-900/40">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1 font-bold">
                                                Experience</p>
                                            <p class="text-2xl font-black text-slate-900 dark:text-white">
                                                {{ $business->vendor->years_of_experience ?? 0 }}<span
                                                    class="text-xs">y</span></p>
                                        </div>

                                        <div
                                            class="group glass-light hover:bg-gradient-to-br hover:from-amber-100/70 hover:to-orange-100/60 dark:hover:from-amber-600/30 dark:hover:to-orange-600/30 rounded-xl p-4 cursor-pointer border-2 border-amber-300/50 dark:border-amber-500/30 hover:scale-110 hover:-translate-y-2 hover:shadow-lg dark:shadow-amber-900/20">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 dark:from-amber-600 dark:to-orange-700 rounded-lg flex items-center justify-center mb-2 group-hover:scale-125 shadow-lg dark:shadow-amber-900/40">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1 font-bold">Packages
                                            </p>
                                            <p class="text-2xl font-black text-slate-900 dark:text-white">
                                                {{ count($packages) }}</p>
                                        </div>

                                        <div
                                            class="group glass-light hover:bg-gradient-to-br hover:from-pink-100/70 hover:to-rose-100/60 dark:hover:from-pink-600/30 dark:hover:to-rose-600/30 rounded-xl p-4 cursor-pointer border-2 border-pink-300/50 dark:border-pink-500/30 hover:scale-110 hover:-translate-y-2 hover:shadow-lg dark:shadow-pink-900/20">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 dark:from-pink-600 dark:to-rose-700 rounded-lg flex items-center justify-center mb-2 group-hover:scale-125 shadow-lg dark:shadow-pink-900/40">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </div>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1 font-bold">Happy
                                                Clients</p>
                                            <p class="text-2xl font-black text-slate-900 dark:text-white">
                                                {{ $business->vendor->happy_clients ?? 0 }}<span
                                                    class="text-xs">+</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price Card -->
                    <div class="lg:col-span-1 animate-slide-left delay-200">
                        <div
                            class="glass-dark rounded-3xl p-8 bg-gradient-to-br from-pink-100/60 via-purple-100/40 to-cyan-100/60 dark:from-pink-600/20 dark:via-purple-600/15 dark:to-cyan-600/20 border-2 border-pink-400/40 dark:border-pink-500/50 hover:border-pink-500/80 dark:hover:border-pink-400/80 hover:shadow-2xl dark:hover:shadow-pink-900/50 hover:glow-pink-lg">
                            <p
                                class="text-gray-600 dark:text-gray-400 text-xs font-black mb-3 tracking-widest uppercase">
                                Starting From</p>

                            @if ($startingPrice)
                                <div class="mb-8">
                                    <div
                                        class="text-5xl lg:text-6xl font-black bg-gradient-to-r from-pink-600 via-purple-600 to-rose-600 dark:from-pink-300 dark:via-purple-300 dark:to-rose-300 bg-clip-text text-transparent">
                                        Rs {{ number_format($startingPrice, 0) }}
                                    </div>
                                </div>
                            @else
                                <div class="text-4xl lg:text-5xl font-black text-slate-900 dark:text-white mb-8">On
                                    Request</div>
                            @endif

                            <button
                                onclick="document.getElementById('gallery-section').scrollIntoView({behavior: 'smooth'})"
                                class="w-full group relative overflow-hidden bg-gradient-to-r from-pink-600 via-rose-600 to-pink-600 hover:from-pink-700 hover:via-rose-700 hover:to-pink-700 dark:from-pink-600 dark:via-rose-600 dark:to-pink-600 dark:hover:from-pink-700 dark:hover:via-rose-700 dark:hover:to-pink-700 text-white font-black py-4 lg:py-5 px-6 rounded-xl lg:rounded-2xl mb-4 flex items-center justify-center gap-2.5 glow-pink hover:glow-pink-lg border-2 border-pink-500/60 dark:border-pink-500/50 hover:border-pink-400/90 dark:hover:border-pink-400/80 hover:scale-105 hover:-translate-y-1 active:scale-95 shadow-xl dark:shadow-pink-900/40 text-sm lg:text-base font-bold">
                                <svg class="w-6 h-6 group-hover:scale-125 group-hover:rotate-12" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Check Availability
                            </button>

                            <div class="flex gap-3">
                                <button
                                    class="flex-1 group glass-light hover:bg-red-100/50 dark:hover:bg-red-600/30 rounded-lg py-3 font-bold text-red-700 dark:text-red-300 flex items-center justify-center gap-2 border-2 border-red-300/60 dark:border-red-500/40 hover:scale-105 hover:-translate-y-1 hover:shadow-md dark:shadow-red-900/10 text-xs lg:text-sm">
                                    <svg class="w-5 h-5 group-hover:scale-125" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="hidden sm:inline">Save</span>
                                </button>
                                <button
                                    class="flex-1 group glass-light hover:bg-purple-100/50 dark:hover:bg-purple-600/30 rounded-lg py-3 font-bold text-purple-700 dark:text-purple-300 flex items-center justify-center gap-2 border-2 border-purple-300/60 dark:border-purple-500/40 hover:scale-105 hover:-translate-y-1 hover:shadow-md dark:shadow-purple-900/10 text-xs lg:text-sm">
                                    <svg class="w-5 h-5 group-hover:scale-125" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span class="hidden sm:inline">Share</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== MAIN CONTENT ==================== -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 -mt-16 relative z-30">
            <!-- About & Contact Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 mb-16 lg:mb-20">
                <!-- About Card -->
                <div
                    class="lg:col-span-2 glass-dark rounded-3xl p-8 lg:p-10 animate-scale-in delay-200 bg-gradient-to-br from-white/70 via-white/50 to-blue-50/60 dark:from-slate-900/70 dark:via-slate-800/60 dark:to-blue-900/50 border-2 border-pink-400/30 dark:border-pink-500/40 hover:border-pink-500/60 dark:hover:border-pink-400/70 hover:shadow-2xl dark:hover:shadow-pink-900/40 hover:glow-pink">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-2 h-12 bg-gradient-to-b from-pink-500 via-purple-500 to-cyan-500 dark:from-pink-400 dark:via-purple-400 dark:to-cyan-400 rounded-full shadow-lg dark:shadow-pink-900/40">
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white">About</h2>
                    </div>

                    <p
                        class="text-slate-700 dark:text-slate-300 leading-relaxed text-sm lg:text-base mb-7 font-medium">
                        {{ $business->business_desc ?? 'No description available' }}
                    </p>

                    @if (count($features) > 0)
                        <div>
                            <h3
                                class="text-lg lg:text-xl font-black text-slate-900 dark:text-white mb-5 flex items-center gap-2">
                                ✨ Key Features
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($features as $feature)
                                    <div
                                        class="group glass-light hover:bg-gradient-to-r hover:from-emerald-100/70 hover:to-green-100/60 dark:hover:from-emerald-600/30 dark:hover:to-green-600/30 rounded-xl p-4 flex items-start gap-3 border-2 border-emerald-300/50 dark:border-emerald-500/30 hover:scale-105 hover:-translate-y-2 cursor-pointer hover:shadow-lg dark:shadow-emerald-900/10">
                                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5 group-hover:scale-125"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span
                                            class="text-slate-700 dark:text-slate-300 font-bold text-sm lg:text-base">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Contact Card -->
                <div
                    class="glass-dark rounded-3xl p-8 bg-gradient-to-br from-pink-100/60 via-purple-100/40 to-cyan-100/60 dark:from-pink-600/25 dark:via-purple-600/20 dark:to-cyan-600/25 border-2 border-pink-400/40 dark:border-pink-500/50 sticky top-20 animate-slide-left delay-300 glow-pink-lg shadow-2xl dark:shadow-pink-900/40 lg:hover:shadow-3xl hover:border-pink-500/80 dark:hover:border-pink-400/80">
                    <h3
                        class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                        <svg class="w-7 h-7 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Get in Touch
                    </h3>

                    <div class="space-y-3 mb-7">
                        @if ($business->business_phone)
                            <a href="tel:{{ $business->business_phone }}"
                                class="group glass-light hover:bg-cyan-100/60 dark:hover:bg-cyan-600/40 rounded-xl p-4 flex items-center gap-3 text-slate-900 dark:text-white font-bold border-2 border-cyan-300/60 dark:border-cyan-500/40 hover:scale-105 hover:-translate-y-1 hover:shadow-lg dark:shadow-cyan-900/10">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 dark:from-cyan-600 dark:to-blue-700 rounded-xl flex items-center justify-center group-hover:scale-110 flex-shrink-0 shadow-lg dark:shadow-cyan-900/40">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-0.5">Call</p>
                                    <p class="text-sm font-semibold">{{ $business->business_phone }}</p>
                                </div>
                            </a>
                        @endif

                        @if ($business->business_email)
                            <a href="mailto:{{ $business->business_email }}"
                                class="group glass-light hover:bg-pink-100/60 dark:hover:bg-pink-600/40 rounded-xl p-4 flex items-center gap-3 text-slate-900 dark:text-white font-bold border-2 border-pink-300/60 dark:border-pink-500/40 hover:scale-105 hover:-translate-y-1 hover:shadow-lg dark:shadow-pink-900/10">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 dark:from-pink-600 dark:to-rose-700 rounded-xl flex items-center justify-center group-hover:scale-110 flex-shrink-0 shadow-lg dark:shadow-pink-900/40">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-0.5">Email</p>
                                    <p class="text-sm font-semibold truncate">{{ $business->business_email }}</p>
                                </div>
                            </a>
                        @endif

                        @if ($business->website)
                            <a href="{{ $business->website }}" target="_blank"
                                class="group glass-light hover:bg-amber-100/60 dark:hover:bg-amber-600/40 rounded-xl p-4 flex items-center gap-3 text-slate-900 dark:text-white font-bold border-2 border-amber-300/60 dark:border-amber-500/40 hover:scale-105 hover:-translate-y-1 hover:shadow-lg dark:shadow-amber-900/10">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 dark:from-amber-600 dark:to-orange-700 rounded-xl flex items-center justify-center group-hover:scale-110 flex-shrink-0 shadow-lg dark:shadow-amber-900/40">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-0.5">Website</p>
                                    <p class="text-sm font-semibold">Visit</p>
                                </div>
                            </a>
                        @endif
                    </div>

                    @if ($business->social_links)
                        <div class="pt-6 border-t-2 border-slate-300/30 dark:border-white/10">
                            <p class="text-gray-600 dark:text-gray-400 text-xs font-bold mb-4">Follow Us</p>
                            <div class="flex gap-3">
                                @if (isset($business->social_links['instagram']))
                                    <a href="{{ $business->social_links['instagram'] }}" target="_blank"
                                        class="w-11 h-11 glass-light hover:bg-pink-100/60 dark:hover:bg-pink-600/50 rounded-lg flex items-center justify-center text-pink-600 dark:text-pink-400 hover:text-pink-700 dark:hover:text-pink-300 hover:scale-125 border-2 border-pink-300/60 dark:border-pink-500/40 shadow-lg dark:shadow-pink-900/10 hover:shadow-md">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z" />
                                        </svg>
                                    </a>
                                @endif
                                @if (isset($business->social_links['facebook']))
                                    <a href="{{ $business->social_links['facebook'] }}" target="_blank"
                                        class="w-11 h-11 glass-light hover:bg-blue-100/60 dark:hover:bg-blue-600/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 hover:scale-125 border-2 border-blue-300/60 dark:border-blue-500/40 shadow-lg dark:shadow-blue-900/10 hover:shadow-md">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </a>
                                @endif
                                @if (isset($business->social_links['twitter']))
                                    <a href="{{ $business->social_links['twitter'] }}" target="_blank"
                                        class="w-11 h-11 glass-light hover:bg-cyan-100/60 dark:hover:bg-cyan-600/50 rounded-lg flex items-center justify-center text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 hover:scale-125 border-2 border-cyan-300/60 dark:border-cyan-500/40 shadow-lg dark:shadow-cyan-900/10 hover:shadow-md">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417a9.867 9.867 0 01-6.102 2.104c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                        </svg>
                                    </a>
                                @endif
                                @if (isset($business->social_links['youtube']))
                                    <a href="{{ $business->social_links['youtube'] }}" target="_blank"
                                        class="w-11 h-11 glass-light hover:bg-red-100/60 dark:hover:bg-red-600/50 rounded-lg flex items-center justify-center text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 hover:scale-125 border-2 border-red-300/60 dark:border-red-500/40 shadow-lg dark:shadow-red-900/10 hover:shadow-md">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ==================== FEATURED GALLERY SECTION ==================== -->
            @if (count($portfolioImages) > 0)
                <div id="gallery-section" class="mb-16 lg:mb-20 scroll-mt-20">
                    <div class="flex items-center gap-3 lg:gap-4 mb-8">
                        <div
                            class="w-2 h-12 bg-gradient-to-b from-pink-500 via-purple-500 to-cyan-500 dark:from-pink-400 dark:via-purple-400 dark:to-cyan-400 rounded-full shadow-lg dark:shadow-pink-900/40">
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white">Gallery</h2>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
                        @foreach ($portfolioImages as $index => $image)
                            @if ($index === 0)
                                <div
                                    class="group relative col-span-2 h-96 lg:h-96 rounded-2xl overflow-hidden cursor-pointer animate-scale-in border-2 border-pink-400/40 dark:border-pink-500/40 hover:border-pink-500/80 dark:hover:border-pink-400/80 hover:shadow-2xl dark:shadow-pink-900/30 hover:glow-pink">
                                    <img src="{{ is_string($image) ? Storage::url($image) : $image['url'] ?? '' }}"
                                        alt="Featured"
                                        class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700 dark:brightness-95 group-hover:dark:brightness-105">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-6">
                                        <button
                                            class="glass-light hover:bg-gradient-to-r hover:from-pink-600/60 hover:to-cyan-600/60 dark:hover:from-pink-600/70 dark:hover:to-cyan-600/70 rounded-full p-5 text-white group-hover:scale-125 border-2 border-pink-500/60 dark:border-pink-500/50 shadow-2xl dark:shadow-pink-900/40">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @elseif ($index === 1 || $index === 2)
                                <div class="group relative h-48 lg:h-48 rounded-2xl overflow-hidden cursor-pointer animate-scale-in border-2 border-pink-400/40 dark:border-pink-500/40 hover:border-pink-500/80 dark:hover:border-pink-400/80 hover:shadow-xl dark:shadow-pink-900/30 hover:glow-pink"
                                    style="animation-delay: {{ $index * 100 }}ms">
                                    <img src="{{ is_string($image) ? Storage::url($image) : $image['url'] ?? '' }}"
                                        alt="Gallery"
                                        class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700 dark:brightness-95 group-hover:dark:brightness-105">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <button
                                            class="glass-light hover:bg-gradient-to-r hover:from-pink-600/60 hover:to-cyan-600/60 dark:hover:from-pink-600/70 dark:hover:to-cyan-600/70 rounded-full p-4 text-white group-hover:scale-125 border-2 border-pink-500/60 dark:border-pink-500/50 shadow-2xl dark:shadow-pink-900/40">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="group relative h-48 lg:h-48 rounded-2xl overflow-hidden cursor-pointer animate-scale-in border-2 border-pink-400/40 dark:border-pink-500/40 hover:border-pink-500/80 dark:hover:border-pink-400/80 hover:shadow-xl dark:shadow-pink-900/30 hover:glow-pink"
                                    style="animation-delay: {{ $index * 100 }}ms">
                                    <img src="{{ is_string($image) ? Storage::url($image) : $image['url'] ?? '' }}"
                                        alt="Gallery"
                                        class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700 dark:brightness-95 group-hover:dark:brightness-105">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <button
                                            class="glass-light hover:bg-gradient-to-r hover:from-pink-600/60 hover:to-cyan-600/60 dark:hover:from-pink-600/70 dark:hover:to-cyan-600/70 rounded-full p-4 text-white group-hover:scale-125 border-2 border-pink-500/60 dark:border-pink-500/50 shadow-2xl dark:shadow-pink-900/40">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ==================== PACKAGES SECTION ==================== -->
            @if (count($packages) > 0)
                <div class="mb-16 lg:mb-20">
                    <div class="flex items-center gap-3 lg:gap-4 mb-8">
                        <div
                            class="w-2 h-12 bg-gradient-to-b from-pink-500 via-purple-500 to-cyan-500 dark:from-pink-400 dark:via-purple-400 dark:to-cyan-400 rounded-full shadow-lg dark:shadow-pink-900/40">
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white">Packages</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                        @foreach ($packages as $index => $package)
                            <div class="group relative animate-scale-in"
                                style="animation-delay: {{ $index * 100 }}ms">
                                <div
                                    class="absolute -inset-1.5 bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 dark:from-pink-400 dark:via-purple-400 dark:to-cyan-400 rounded-3xl blur-2xl opacity-0 group-hover:opacity-60 dark:group-hover:opacity-50 transition-all duration-500">
                                </div>

                                <div
                                    class="relative glass-dark rounded-3xl p-7 lg:p-10 h-full flex flex-col bg-gradient-to-br from-white/70 via-white/50 to-blue-50/60 dark:from-pink-600/20 dark:via-purple-600/15 dark:to-cyan-600/20 border-2 border-pink-400/40 dark:border-pink-500/50 group-hover:border-pink-500/80 dark:group-hover:border-pink-400/80 overflow-hidden group-hover:shadow-3xl group-hover:scale-105 group-hover:-translate-y-3 dark:shadow-pink-900/30 hover:-skew-y-1">
                                    @if ($package['isPopular'])
                                        <div
                                            class="absolute top-0 right-0 bg-gradient-to-r from-amber-500 via-orange-500 to-pink-500 text-white px-5 py-3 rounded-bl-2xl font-black text-xs flex items-center gap-2 shadow-xl dark:shadow-amber-900/50">
                                            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            Most Popular
                                        </div>
                                    @endif

                                    <h3 class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white mb-2">
                                        {{ $package['name'] }}</h3>
                                    @if ($package['description'])
                                        <p
                                            class="text-slate-700 dark:text-slate-400 text-xs lg:text-sm mb-6 font-medium">
                                            {{ $package['description'] }}</p>
                                    @endif

                                    <div class="mb-7 lg:mb-10">
                                        <div
                                            class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-pink-600 via-purple-600 to-rose-600 dark:from-pink-300 dark:via-purple-300 dark:to-rose-300 bg-clip-text text-transparent">
                                            Rs {{ number_format($package['price'], 0) }}
                                        </div>
                                        @if ($package['discount'])
                                            <span
                                                class="text-xs text-gray-500 dark:text-gray-500 line-through font-bold mt-1">
                                                Rs {{ number_format($package['originalPrice'], 0) }}
                                            </span>
                                        @endif
                                        @if ($package['discountPercentage'])
                                            <div
                                                class="mt-3 inline-block px-4 py-2 bg-gradient-to-r from-emerald-100/70 to-green-100/60 dark:from-emerald-600/40 dark:to-green-600/40 border-2 border-emerald-300/60 dark:border-emerald-500/50 rounded-xl hover:scale-110">
                                                <span
                                                    class="text-xs font-black text-emerald-700 dark:text-emerald-300">
                                                    🎉 Save {{ number_format($package['discountPercentage'], 0) }}%
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    @if (count($package['features']) > 0)
                                        <div class="mb-7 lg:mb-10 flex-grow">
                                            <h4
                                                class="text-xs lg:text-sm font-black text-slate-900 dark:text-white mb-4 uppercase tracking-wide">
                                                What's Included</h4>
                                            <div class="space-y-3">
                                                @foreach ($package['features'] as $feature)
                                                    <div class="flex items-start gap-3 group/item">
                                                        <div
                                                            class="w-6 h-6 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 dark:from-emerald-600 dark:to-green-700 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover/item:scale-125 shadow-lg dark:shadow-emerald-900/40">
                                                            <svg class="w-4 h-4 text-white" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="3" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                        <span
                                                            class="text-slate-700 dark:text-slate-300 font-bold text-xs lg:text-sm leading-tight">{{ $feature }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <button
                                        class="w-full group/btn relative overflow-hidden bg-gradient-to-r from-pink-600 via-rose-600 to-pink-600 hover:from-pink-700 hover:via-rose-700 hover:to-pink-700 dark:from-pink-600 dark:via-rose-600 dark:to-pink-600 dark:hover:from-pink-700 dark:hover:via-rose-700 dark:hover:to-pink-700 text-white font-black py-4 px-6 rounded-xl flex items-center justify-center gap-2.5 glow-pink hover:glow-pink-lg border-2 border-pink-500/60 dark:border-pink-500/50 hover:border-pink-400/90 dark:hover:border-pink-400/80 hover:scale-110 hover:-translate-y-1 active:scale-95 shadow-xl dark:shadow-pink-900/40 text-sm animate-shimmer">
                                        <svg class="w-6 h-6 group-hover/btn:scale-125" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ==================== FINAL CTA ==================== -->
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-600 via-purple-600 to-cyan-600 dark:from-pink-700 dark:via-purple-700 dark:to-cyan-700 p-12 lg:p-20 glow-pink-lg shadow-3xl mb-8 hover:glow-pink-lg hover:scale-105 hover:-translate-y-1">
                <div
                    class="absolute -top-40 -right-40 w-80 h-80 bg-white/20 dark:bg-white/10 rounded-full blur-3xl animate-float">
                </div>
                <div
                    class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/15 dark:bg-white/5 rounded-full blur-3xl animate-float-delay-1">
                </div>

                <div class="relative z-10 text-center max-w-3xl mx-auto">
                    <h2 class="text-4xl lg:text-5xl font-black text-white mb-5">Ready to Book?</h2>
                    <p class="text-lg lg:text-xl text-white/95 mb-10 font-semibold">
                        Don't miss out! Connect with {{ $business->company_name }} and create unforgettable memories.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-5 justify-center">
                        <a href="tel:{{ $business->business_phone ?? '#' }}"
                            class="group bg-white hover:bg-gray-100 text-slate-900 font-black py-5 px-10 rounded-xl flex items-center justify-center gap-3 transition-all hover:scale-110 hover:-translate-y-1 active:scale-95 shadow-2xl border-3 border-white/70 dark:border-white/50 text-base lg:text-lg">
                            <svg class="w-6 h-6 group-hover:scale-125" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>Call Now</span>
                        </a>
                        <button
                            class="border-3 border-white text-white hover:bg-white/20 dark:hover:bg-white/10 font-black py-5 px-10 rounded-xl flex items-center justify-center gap-3 transition-all hover:scale-110 hover:-translate-y-1 active:scale-95 shadow-2xl text-base lg:text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <span>Message</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="min-h-screen flex items-center justify-center py-12 px-4">
            <div class="text-center max-w-md">
                <div
                    class="w-40 h-40 mx-auto mb-8 bg-gradient-to-br from-pink-600 via-purple-600 to-cyan-600 dark:from-pink-700 dark:via-purple-700 dark:to-cyan-700 rounded-3xl flex items-center justify-center text-white text-8xl animate-bounce-light glow-pink-lg shadow-3xl dark:shadow-pink-900/50">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-3">Not Found</h3>
                <p class="text-slate-700 dark:text-slate-400 mb-8 font-semibold text-lg">Vendor doesn't exist or has
                    been removed.</p>
                <a href="{{ route('wedding-vendors.index') }}"
                    class="group relative overflow-hidden bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-700 hover:to-rose-700 dark:from-pink-600 dark:to-rose-600 dark:hover:from-pink-700 dark:hover:to-rose-700 text-white font-black py-5 px-10 rounded-xl flex items-center justify-center gap-2.5 mx-auto glow-pink hover:glow-pink-lg border-2 border-pink-500/60 dark:border-pink-500/50 hover:border-pink-400/90 dark:hover:border-pink-400/80 hover:scale-110 hover:-translate-y-1 active:scale-95 shadow-xl dark:shadow-pink-900/40 w-full sm:w-auto">
                    <svg class="w-6 h-6 group-hover:-translate-x-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Vendors
                </a>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
