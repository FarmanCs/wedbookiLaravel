<div
    class="min-h-screen bg-white dark:bg-gradient-to-br dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 transition-colors duration-300">

    @if ($business)
        <!-- ==================== HERO SECTION ==================== -->
        <section
            class="relative min-h-[600px] overflow-hidden bg-gradient-to-br from-white via-blue-50 to-indigo-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-pink-500 via-rose-400 to-pink-300 rounded-full blur-3xl opacity-20 dark:opacity-30 animate-float">
            </div>
            <div
                class="absolute -bottom-32 -left-32 w-96 h-96 bg-gradient-to-br from-cyan-500 via-blue-400 to-cyan-300 rounded-full blur-3xl opacity-15 dark:opacity-25 animate-float-delay-1">
            </div>
            <div
                class="absolute top-1/3 right-1/3 w-72 h-72 bg-gradient-to-br from-purple-500 via-violet-400 to-purple-300 rounded-full blur-3xl opacity-10 dark:opacity-20 animate-float-delay-2">
            </div>

            <div class="relative z-20 container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <a href="{{ route('wedding-vendors.index') }}"
                        class="group glass-light px-4 py-2 rounded-xl flex items-center gap-2 text-slate-700 dark:text-white font-semibold hover:bg-gradient-to-r hover:from-pink-500/20 hover:to-cyan-500/20 transition-all hover:scale-105 hover:-translate-y-1 shadow-md">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Back</span>
                    </a>
                    @if ($business->is_featured)
                        <div
                            class="animate-glow-pulse bg-gradient-to-r from-amber-400 via-orange-400 to-pink-500 px-6 py-2.5 rounded-full text-slate-900 font-bold text-sm flex items-center gap-2.5 shadow-lg">
                            <svg class="w-5 h-5 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span>Featured Vendor</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Profile card -->
                    <div class="lg:col-span-2">
                        <div
                            class="relative group rounded-3xl p-8 lg:p-12 bg-gradient-to-br from-white/90 via-white/70 to-blue-50/70 dark:from-slate-900/80 dark:via-slate-800/70 dark:to-blue-900/60 backdrop-blur-sm border border-pink-400/30 hover:border-pink-500/60 transition-all duration-500 shadow-2xl hover:shadow-pink-500/20">
                            <div
                                class="absolute inset-0 rounded-3xl bg-gradient-to-br from-pink-500/5 via-transparent to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            <div class="relative flex flex-col sm:flex-row items-start gap-8">
                                <div class="relative flex-shrink-0 group/image">
                                    <div
                                        class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 opacity-0 group-hover/image:opacity-100 blur-md transition-all duration-500">
                                    </div>
                                    @if ($business->profile_image)
                                        <img src="{{ Storage::url($business->profile_image) }}"
                                            alt="{{ $business->company_name }}"
                                            class="relative w-40 h-40 rounded-2xl object-cover border-4 border-pink-400/60 dark:border-pink-500/50 group-hover/image:scale-110 transition-all duration-500 shadow-xl">
                                    @else
                                        <div
                                            class="relative w-40 h-40 rounded-2xl bg-gradient-to-br from-pink-500 via-purple-500 to-cyan-500 flex items-center justify-center text-5xl font-black text-white group-hover/image:scale-110 transition-all duration-500 shadow-xl">
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <div
                                        class="absolute -bottom-2 -right-2 w-7 h-7 bg-gradient-to-r from-emerald-400 to-green-500 rounded-full border-4 border-white dark:border-slate-950 shadow-lg animate-pulse">
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <h1
                                        class="text-5xl sm:text-6xl font-black text-slate-900 dark:text-white mb-4 bg-gradient-to-r from-pink-600 via-purple-600 to-cyan-600 dark:from-pink-300 dark:via-purple-300 dark:to-cyan-300 bg-clip-text text-transparent animate-gradient-x">
                                        {{ $business->company_name }}
                                    </h1>

                                    <div class="flex flex-wrap gap-3 mb-8">
                                        <div
                                            class="glass-light px-4 py-2.5 rounded-xl bg-gradient-to-r from-pink-100/70 to-pink-100/50 dark:from-pink-600/20 dark:to-pink-600/15 border border-pink-300/70 hover:border-pink-400/80 transition-all">
                                            <div
                                                class="flex items-center gap-2.5 text-pink-700 dark:text-pink-300 text-sm font-bold">
                                                <div class="flex gap-1">
                                                    @foreach ($starArray as $star)
                                                        <svg class="w-4 h-4 {{ $star['filled'] ? 'fill-amber-500 text-amber-500' : 'text-gray-400 dark:text-gray-600' }}"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endforeach
                                                </div>
                                                <span class="font-bold">{{ number_format($averageRating, 1) }}</span>
                                                <span class="text-xs opacity-75">({{ $reviewsCount }} reviews)</span>
                                            </div>
                                        </div>

                                        <div
                                            class="glass-light px-4 py-2.5 rounded-xl bg-gradient-to-r from-cyan-100/70 to-cyan-100/50 dark:from-cyan-600/20 dark:to-cyan-600/15 border border-cyan-300/70 hover:border-cyan-400/80 transition-all">
                                            <div
                                                class="flex items-center gap-2.5 text-cyan-700 dark:text-cyan-300 font-semibold text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                </svg>
                                                <span>{{ $business->city ?? 'N/A' }},
                                                    {{ $business->country ?? 'N/A' }}</span>
                                            </div>
                                        </div>

                                        @if ($business->category)
                                            <div
                                                class="glass-light px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-100/70 to-amber-100/50 dark:from-amber-600/20 dark:to-amber-600/15 border border-amber-300/70 hover:border-amber-400/80 transition-all">
                                                <div
                                                    class="flex items-center gap-2.5 text-amber-700 dark:text-amber-300 font-semibold text-sm">
                                                    <span>{{ $business->category->type }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <div
                                            class="group/stats glass-light hover:bg-gradient-to-br hover:from-cyan-100/70 hover:to-blue-100/60 dark:hover:from-cyan-600/30 dark:hover:to-blue-600/30 rounded-xl p-4 border border-cyan-300/50 hover:border-cyan-500/70 transition-all duration-300 hover:scale-110 hover:-translate-y-2 cursor-default h-28 flex flex-col justify-between">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center mb-2 shadow-lg group-hover/stats:rotate-3 transition-transform duration-300">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-1">
                                                    Experience</p>
                                                <p class="text-2xl font-black text-slate-900 dark:text-white">
                                                    {{ $business->vendor->years_of_experience ?? 0 }}<span
                                                        class="text-xs">y</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="group/stats glass-light hover:bg-gradient-to-br hover:from-amber-100/70 hover:to-orange-100/60 dark:hover:from-amber-600/30 dark:hover:to-orange-600/30 rounded-xl p-4 border border-amber-300/50 hover:border-amber-500/70 transition-all duration-300 hover:scale-110 hover:-translate-y-2 cursor-default h-28 flex flex-col justify-between">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center mb-2 shadow-lg group-hover/stats:rotate-3 transition-transform duration-300">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-1">
                                                    Packages</p>
                                                <p class="text-2xl font-black text-slate-900 dark:text-white">
                                                    {{ count($packages) }}</p>
                                            </div>
                                        </div>

                                        <div
                                            class="group/stats glass-light hover:bg-gradient-to-br hover:from-pink-100/70 hover:to-rose-100/60 dark:hover:from-pink-600/30 dark:hover:to-rose-600/30 rounded-xl p-4 border border-pink-300/50 hover:border-pink-500/70 transition-all duration-300 hover:scale-110 hover:-translate-y-2 cursor-default h-28 flex flex-col justify-between">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center mb-2 shadow-lg group-hover/stats:rotate-3 transition-transform duration-300">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-1">Happy
                                                    Clients</p>
                                                <p class="text-2xl font-black text-slate-900 dark:text-white">
                                                    {{ $business->vendor->happy_clients ?? 0 }}<span
                                                        class="text-xs">+</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price card -->
                    <div class="lg:col-span-1">
                        <div
                            class="sticky top-20 glass-dark rounded-3xl p-8 bg-gradient-to-br from-pink-100/60 via-purple-100/40 to-cyan-100/60 dark:from-pink-600/20 dark:via-purple-600/15 dark:to-cyan-600/20 border-2 border-pink-400/40 shadow-2xl">
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
                                onclick="document.getElementById('packages-section').scrollIntoView({behavior: 'smooth'})"
                                class="w-full group relative overflow-hidden bg-gradient-to-r from-pink-600 via-rose-600 to-pink-600 hover:from-pink-700 hover:via-rose-700 hover:to-pink-700 text-white font-black py-4 lg:py-5 px-6 rounded-xl mb-4 flex items-center justify-center gap-2.5 transition-all hover:scale-105 hover:-translate-y-1 active:scale-95 shadow-xl">
                                <svg class="w-6 h-6 group-hover:scale-125 group-hover:rotate-12 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Check Availability
                            </button>

                            <div class="flex gap-3">
                                <button
                                    class="flex-1 glass-light hover:bg-red-100/50 dark:hover:bg-red-600/30 rounded-lg py-3 font-bold text-red-700 dark:text-red-300 flex items-center justify-center gap-2 border-2 border-red-300/60 transition-all hover:scale-105 hover:-translate-y-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="hidden sm:inline">Save</span>
                                </button>
                                <button
                                    class="flex-1 glass-light hover:bg-purple-100/50 dark:hover:bg-purple-600/30 rounded-lg py-3 font-bold text-purple-700 dark:text-purple-300 flex items-center justify-center gap-2 border-2 border-purple-300/60 transition-all hover:scale-105 hover:-translate-y-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 -mt-8 relative z-30">


            {{-- <livewire:booking.booking-modal :businessId="$business->id" wire:key="booking-modal-{{ $business->id }}" /> --}}
            <livewire:booking.booking-modal />
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left column: tabs -->
                <div class="lg:col-span-2 space-y-12">
                    <div x-data="{ activeTab: 'about' }" class="w-full">
                        <!-- Tabs Navigation -->
                        <div
                            class="flex flex-wrap gap-2 border-b-2 border-gray-200 dark:border-gray-700 mb-8 overflow-x-auto">
                            <button @click="activeTab = 'about'"
                                :class="{ 'border-pink-500 text-pink-600 dark:text-pink-400 bg-pink-50/50 dark:bg-pink-900/20': activeTab === 'about', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'about' }"
                                class="py-3 px-5 font-bold text-sm sm:text-base border-b-2 transition-colors rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    About
                                </span>
                            </button>
                            <button @click="activeTab = 'packages'"
                                :class="{ 'border-pink-500 text-pink-600 dark:text-pink-400 bg-pink-50/50 dark:bg-pink-900/20': activeTab === 'packages', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'packages' }"
                                class="py-3 px-5 font-bold text-sm sm:text-base border-b-2 transition-colors rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    Packages ({{ count($packages) }})
                                </span>
                            </button>
                            <button @click="activeTab = 'services'"
                                :class="{ 'border-pink-500 text-pink-600 dark:text-pink-400 bg-pink-50/50 dark:bg-pink-900/20': activeTab === 'services', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'services' }"
                                class="py-3 px-5 font-bold text-sm sm:text-base border-b-2 transition-colors rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Services ({{ count($services) }})
                                </span>
                            </button>
                            <button @click="activeTab = 'faqs'"
                                :class="{ 'border-pink-500 text-pink-600 dark:text-pink-400 bg-pink-50/50 dark:bg-pink-900/20': activeTab === 'faqs', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'faqs' }"
                                class="py-3 px-5 font-bold text-sm sm:text-base border-b-2 transition-colors rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    FAQs ({{ count($faqs) }})
                                </span>
                            </button>
                            <button @click="activeTab = 'reviews'"
                                :class="{ 'border-pink-500 text-pink-600 dark:text-pink-400 bg-pink-50/50 dark:bg-pink-900/20': activeTab === 'reviews', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'reviews' }"
                                class="py-3 px-5 font-bold text-sm sm:text-base border-b-2 transition-colors rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    Reviews
                                </span>
                            </button>
                            <button @click="activeTab = 'gallery'"
                                :class="{ 'border-pink-500 text-pink-600 dark:text-pink-400 bg-pink-50/50 dark:bg-pink-900/20': activeTab === 'gallery', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'gallery' }"
                                class="py-3 px-5 font-bold text-sm sm:text-base border-b-2 transition-colors rounded-t-lg">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Gallery
                                </span>
                            </button>
                        </div>

                        <!-- Tab: About -->
                        <div x-show="activeTab === 'about'" x-transition.opacity.duration.300ms>
                            <div
                                class="glass-dark rounded-3xl p-8 lg:p-10 bg-gradient-to-br from-white/70 via-white/50 to-blue-50/60 dark:from-slate-900/70 dark:via-slate-800/60 dark:to-blue-900/50 border-2 border-pink-400/30 shadow-xl">
                                <p
                                    class="text-slate-700 dark:text-slate-300 leading-relaxed text-base mb-8 font-medium">
                                    {{ $business->business_desc ?? 'No description available' }}
                                </p>
                                @if (count($features) > 0)
                                    <div>
                                        <h3
                                            class="text-xl lg:text-2xl font-black text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                                            <span class="text-2xl">✨</span> Key Features
                                        </h3>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach ($features as $feature)
                                                <div
                                                    class="glass-light hover:bg-gradient-to-r hover:from-emerald-100/70 hover:to-green-100/60 dark:hover:from-emerald-600/30 dark:hover:to-green-600/30 rounded-xl p-4 flex items-start gap-3 border-2 border-emerald-300/50 transition-all hover:scale-105 hover:-translate-y-2">
                                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span
                                                        class="text-slate-700 dark:text-slate-300 font-bold text-sm">{{ $feature }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Tab: Packages -->
                        <div x-show="activeTab === 'packages'" x-transition.opacity.duration.300ms
                            id="packages-section">
                            @if (count($packages) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    @foreach ($packages as $package)
                                        <div class="group relative h-full">
                                            <div
                                                class="absolute -inset-0.5 bg-gradient-to-r from-pink-500 via-purple-500 to-cyan-500 rounded-2xl blur-md opacity-0 group-hover:opacity-70 transition duration-500">
                                            </div>
                                            <div
                                                class="relative glass-dark rounded-2xl p-5 h-full flex flex-col bg-white/80 dark:bg-slate-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 group-hover:border-pink-400/70 transition-all duration-300 shadow-lg hover:shadow-2xl hover:-translate-y-1">
                                                @if ($package['isPopular'])
                                                    <div
                                                        class="absolute top-0 right-0 bg-gradient-to-r from-amber-500 to-orange-500 text-white px-3 py-1.5 rounded-bl-xl font-black text-[11px] flex items-center gap-1.5 shadow-lg z-10">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <span>POPULAR</span>
                                                    </div>
                                                @endif

                                                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-1">
                                                    {{ $package['name'] }}
                                                </h3>
                                                @if ($package['description'])
                                                    <p
                                                        class="text-slate-700 dark:text-slate-400 text-xs mb-4 line-clamp-2">
                                                        {{ $package['description'] }}
                                                    </p>
                                                @endif

                                                <div class="mb-4">
                                                    <div class="flex items-baseline gap-1.5 flex-wrap mb-2">
                                                        <span
                                                            class="text-2xl font-black bg-gradient-to-r from-pink-600 via-purple-600 to-rose-600 dark:from-pink-300 dark:via-purple-300 dark:to-rose-300 bg-clip-text text-transparent">
                                                            Rs {{ number_format($package['price'], 0) }}
                                                        </span>
                                                        @if ($package['discount'])
                                                            <span class="text-xs text-gray-500 line-through">Rs
                                                                {{ number_format($package['originalPrice'], 0) }}</span>
                                                        @endif
                                                    </div>
                                                    @if ($package['discountPercentage'])
                                                        <div
                                                            class="inline-block px-2.5 py-1 bg-gradient-to-r from-emerald-100/70 to-green-100/60 dark:from-emerald-600/40 dark:to-green-600/40 border border-emerald-300/60 rounded-lg">
                                                            <span
                                                                class="text-[11px] font-black text-emerald-700 dark:text-emerald-300">
                                                                🎉 Save
                                                                {{ number_format($package['discountPercentage'], 0) }}%
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if (count($package['features']) > 0)
                                                    <div class="mb-4 flex-grow">
                                                        <h4
                                                            class="text-[11px] font-black text-slate-900 dark:text-white mb-2 uppercase tracking-wider opacity-75">
                                                            ✓ WHAT'S INCLUDED
                                                        </h4>
                                                        <div class="space-y-1.5">
                                                            @foreach ($package['features'] as $feature)
                                                                <div class="flex items-start gap-2">
                                                                    <div
                                                                        class="w-4 h-4 rounded-md bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                                                                        <svg class="w-2.5 h-2.5 text-white"
                                                                            fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd"
                                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </div>
                                                                    <span
                                                                        class="text-slate-700 dark:text-slate-300 font-medium text-xs">{{ $feature }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif


                                                <button wire:click="openBookingModal('package', {{ $package['id'] }})"
                                                    class="w-full group/btn hover:cursor-pointer relative overflow-hidden bg-gradient-to-r from-pink-600 via-rose-600 to-pink-600 hover:from-pink-700 hover:via-rose-700 hover:to-pink-700 text-white font-bold py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition-all hover:scale-105 active:scale-95 shadow-md text-sm">
                                                    <svg class="w-4 h-4 group-hover/btn:scale-125 transition-transform"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                    Book Now
                                                </button>
                                                {{-- <button wire:click="openBookingModal"
                                                    class="w-full group/btn hover:cursor-pointer relative overflow-hidden bg-gradient-to-r from-pink-600 via-rose-600 to-pink-600 hover:from-pink-700 hover:via-rose-700 hover:to-pink-700 text-white font-bold py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition-all hover:scale-105 active:scale-95 shadow-md text-sm">
                                                    <svg class="w-4 h-4 group-hover/btn:scale-125 transition-transform"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                    Book Now
                                                </button> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="glass-dark rounded-3xl p-12 text-center bg-gradient-to-br from-white/70 to-blue-50/60 dark:from-slate-900/70 dark:to-blue-900/50 border-2 border-pink-400/30">
                                    <p class="text-gray-600 dark:text-gray-400 font-semibold">No packages available at
                                        the moment.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Tab: Services -->
                        <div x-show="activeTab === 'services'" x-transition.opacity.duration.300ms>
                            @if (count($services) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    @foreach ($services as $service)
                                        <div class="group relative h-full">
                                            <div
                                                class="absolute -inset-0.5 bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-500 rounded-2xl blur-md opacity-0 group-hover:opacity-60 transition duration-500">
                                            </div>
                                            <div
                                                class="relative glass-dark rounded-2xl p-5 h-full flex flex-col bg-white/80 dark:bg-slate-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 group-hover:border-cyan-400/70 transition-all duration-300 shadow-lg hover:shadow-2xl hover:-translate-y-1">
                                                @if ($service['img'])
                                                    <div class="w-full h-32 rounded-xl overflow-hidden mb-3 shadow-md">
                                                        <img src="{{ Storage::url($service['img']) }}"
                                                            alt="{{ $service['name'] }}"
                                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                    </div>
                                                @endif
                                                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-1">
                                                    {{ $service['name'] }}
                                                </h3>
                                                @if ($service['description'])
                                                    <p
                                                        class="text-slate-700 dark:text-slate-400 text-xs mb-4 line-clamp-2 flex-grow">
                                                        {{ $service['description'] }}
                                                    </p>
                                                @endif
                                                <div
                                                    class="mt-auto pt-3 border-t border-gray-200 dark:border-gray-700">
                                                    <div
                                                        class="text-xl font-black text-cyan-600 dark:text-cyan-400 mb-3">
                                                        Rs {{ number_format($service['price'], 0) }}
                                                    </div>
                                                    <button
                                                        wire:click="openBookingModal('service', {{ $service['id'] }})"
                                                        class="w-full hover:cursor-pointer bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white font-bold py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition-all hover:scale-105 active:scale-95 shadow-md text-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5"
                                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                        </svg>
                                                        Book Now
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="glass-dark rounded-3xl p-12 text-center bg-gradient-to-br from-white/70 to-cyan-50/60 dark:from-slate-900/70 dark:to-blue-900/50 border-2 border-cyan-400/30">
                                    <p class="text-gray-600 dark:text-gray-400 font-semibold">No additional services
                                        listed.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Tab: FAQs -->
                        <div x-show="activeTab === 'faqs'" x-transition.opacity.duration.300ms>
                            @if (count($faqs) > 0)
                                <div class="space-y-4">
                                    @foreach ($faqs as $index => $faq)
                                        <div x-data="{ open: false }"
                                            class="glass-dark rounded-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700 hover:border-pink-400 dark:hover:border-pink-500 transition-all shadow-lg">
                                            <button @click="open = !open"
                                                class="w-full text-left flex justify-between items-center p-6">
                                                <span class="font-black text-slate-900 dark:text-white text-lg">
                                                    {{ is_array($faq) ? $faq['question'] ?? 'Question' : $faq }}
                                                </span>
                                                <svg :class="open ? 'rotate-180' : ''"
                                                    class="w-5 h-5 text-pink-500 transition-transform flex-shrink-0"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            <div x-show="open"
                                                class="px-6 pb-6 text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                                                {{ is_array($faq) ? $faq['answer'] ?? 'Answer not available' : 'Answer not available' }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="glass-dark rounded-3xl p-12 text-center bg-gradient-to-br from-white/70 to-blue-50/60 dark:from-slate-900/70 dark:to-blue-900/50 border-2 border-pink-400/30">
                                    <p class="text-gray-600 dark:text-gray-400 font-semibold">No FAQs available.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Tab: Reviews -->
                        <div x-show="activeTab === 'reviews'" x-transition.opacity.duration.300ms>
                            @if ($reviewsCount > 0)
                                <div>
                                    <div
                                        class="glass-dark rounded-3xl p-8 bg-gradient-to-br from-white/70 via-white/50 to-blue-50/60 dark:from-slate-900/70 dark:via-slate-800/60 dark:to-blue-900/50 border-2 border-pink-400/30 mb-8 shadow-xl">
                                        <div class="flex items-center gap-6 mb-8">
                                            <div class="text-6xl font-black text-slate-900 dark:text-white">
                                                {{ number_format($averageRating, 1) }}
                                            </div>
                                            <div>
                                                <div class="flex gap-1 mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-6 h-6 {{ $i <= round($averageRating) ? 'text-amber-400 fill-amber-400' : 'text-gray-300 dark:text-gray-600' }}"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold">
                                                    Based on <strong>{{ $reviewsCount }}</strong> verified reviews
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        @foreach ($reviews as $review)
                                            <div
                                                class="glass-dark rounded-2xl p-6 border-2 border-gray-200 dark:border-gray-700 hover:border-pink-400 dark:hover:border-pink-500 transition-all shadow-lg">
                                                <div class="flex items-start gap-4 mb-4">
                                                    @if ($review['reviewerImage'])
                                                        <img src="{{ Storage::url($review['reviewerImage']) }}"
                                                            class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                                    @else
                                                        <div
                                                            class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center text-white font-black flex-shrink-0">
                                                            {{ substr($review['reviewerName'], 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div class="flex-1">
                                                        <div class="flex items-center justify-between mb-2">
                                                            <p class="font-black text-slate-900 dark:text-white">
                                                                {{ $review['reviewerName'] }}</p>
                                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                                {{ $review['createdAt']->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                        <div class="flex gap-1">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <svg class="w-4 h-4 {{ $i <= $review['rating'] ? 'text-amber-400 fill-amber-400' : 'text-gray-300 dark:text-gray-600' }}"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                                                    {{ $review['comment'] }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div
                                    class="glass-dark rounded-3xl p-12 text-center bg-gradient-to-br from-white/70 to-blue-50/60 dark:from-slate-900/70 dark:to-blue-900/50 border-2 border-pink-400/30">
                                    <p class="text-gray-600 dark:text-gray-400 font-semibold mb-4">No reviews yet. Be
                                        the first!</p>
                                </div>
                            @endif
                        </div>

                        <!-- Tab: Gallery -->
                        <div x-show="activeTab === 'gallery'" x-transition.opacity.duration.300ms>
                            @if (count($portfolioImages) > 0)
                                <div
                                    class="glass-dark rounded-3xl p-8 bg-gradient-to-br from-white/70 to-blue-50/60 dark:from-slate-900/70 dark:to-blue-900/50 border-2 border-pink-400/30 shadow-xl">
                                    <h3
                                        class="text-2xl font-black text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                                        <span class="text-3xl">📸</span> Portfolio Gallery
                                    </h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                                        @foreach ($portfolioImages as $image)
                                            <div
                                                class="group relative aspect-square rounded-2xl overflow-hidden cursor-pointer border-2 border-pink-400/30 hover:border-pink-500 transition-all shadow-lg">
                                                <img src="{{ is_string($image) ? Storage::url($image) : (isset($image['url']) ? Storage::url($image['url']) : '') }}"
                                                    alt="Gallery image"
                                                    class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-500">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-start p-4">
                                                    <div class="glass-light rounded-full p-3">
                                                        <svg class="w-6 h-6 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div
                                    class="glass-dark rounded-3xl p-12 text-center bg-gradient-to-br from-white/70 to-blue-50/60 dark:from-slate-900/70 dark:to-blue-900/50 border-2 border-pink-400/30">
                                    <p class="text-gray-600 dark:text-gray-400 font-semibold">No gallery images
                                        available.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right column: Contact Card -->
                <div class="lg:col-span-1">
                    <div class="sticky top-20 space-y-6">
                        <div
                            class="glass-dark rounded-3xl p-8 bg-gradient-to-br from-pink-100/60 via-purple-100/40 to-cyan-100/60 dark:from-pink-600/25 dark:via-purple-600/20 dark:to-cyan-600/25 border-2 border-pink-400/40 shadow-2xl">
                            <h3
                                class="text-2xl font-black text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                                <svg class="w-7 h-7 text-pink-600 dark:text-pink-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Get in Touch
                            </h3>

                            <div class="space-y-3 mb-8">
                                @if ($business->business_phone)
                                    <a href="tel:{{ $business->business_phone }}"
                                        class="glass-light hover:bg-cyan-100/60 dark:hover:bg-cyan-600/40 rounded-xl p-4 flex items-center gap-3 border-2 border-cyan-300/60 transition-all hover:scale-105 hover:-translate-y-1 group">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-0.5">Call
                                            </p>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                {{ $business->business_phone }}</p>
                                        </div>
                                    </a>
                                @endif

                                @if ($business->business_email)
                                    <a href="mailto:{{ $business->business_email }}"
                                        class="glass-light hover:bg-pink-100/60 dark:hover:bg-pink-600/40 rounded-xl p-4 flex items-center gap-3 border-2 border-pink-300/60 transition-all hover:scale-105 hover:-translate-y-1 group">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-0.5">Email
                                            </p>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">
                                                {{ $business->business_email }}</p>
                                        </div>
                                    </a>
                                @endif

                                @if ($business->website)
                                    <a href="{{ $business->website }}" target="_blank"
                                        class="glass-light hover:bg-amber-100/60 dark:hover:bg-amber-600/40 rounded-xl p-4 flex items-center gap-3 border-2 border-amber-300/60 transition-all hover:scale-105 hover:-translate-y-1 group">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 font-bold mb-0.5">
                                                Website</p>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Visit Site
                                            </p>
                                        </div>
                                    </a>
                                @endif
                            </div>

                            @if ($business->social_links && is_array($business->social_links))
                                <div class="pt-6 border-t-2 border-slate-300/30 dark:border-white/10">
                                    <p class="text-gray-600 dark:text-gray-400 text-xs font-bold mb-4">Follow Us</p>
                                    <div class="flex gap-3">
                                        @if (isset($business->social_links['instagram']))
                                            <a href="{{ $business->social_links['instagram'] }}" target="_blank"
                                                class="w-11 h-11 glass-light hover:bg-pink-100/60 dark:hover:bg-pink-600/50 rounded-lg flex items-center justify-center text-pink-600 dark:text-pink-400 hover:scale-125 transition-all border-2 border-pink-300/60">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if (isset($business->social_links['facebook']))
                                            <a href="{{ $business->social_links['facebook'] }}" target="_blank"
                                                class="w-11 h-11 glass-light hover:bg-blue-100/60 dark:hover:bg-blue-600/50 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 hover:scale-125 transition-all border-2 border-blue-300/60">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if (isset($business->social_links['twitter']))
                                            <a href="{{ $business->social_links['twitter'] }}" target="_blank"
                                                class="w-11 h-11 glass-light hover:bg-cyan-100/60 dark:hover:bg-cyan-600/50 rounded-lg flex items-center justify-center text-cyan-600 dark:text-cyan-400 hover:scale-125 transition-all border-2 border-cyan-300/60">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.104c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-600 via-purple-600 to-cyan-600 dark:from-pink-700 dark:via-purple-700 dark:to-cyan-700 p-12 lg:p-20 mt-16 text-center shadow-2xl">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/20 rounded-full blur-3xl animate-float">
                </div>
                <div
                    class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/15 rounded-full blur-3xl animate-float-delay-1">
                </div>
                <div class="relative z-10">
                    <h2 class="text-4xl lg:text-5xl font-black text-white mb-5">Ready to Collaborate?</h2>
                    <p class="text-lg lg:text-xl text-white/95 mb-10 font-semibold max-w-2xl mx-auto">
                        Get in touch with {{ $business->company_name }} today and let's create something amazing
                        together.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-5 justify-center">
                        <a href="tel:{{ $business->business_phone ?? '#' }}"
                            class="bg-white hover:bg-gray-100 text-slate-900 font-black py-5 px-10 rounded-xl flex items-center justify-center gap-3 transition-all hover:scale-110 active:scale-95 shadow-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Call Now
                        </a>
                        <button
                            class="border-3 border-white text-white hover:bg-white/20 font-black py-5 px-10 rounded-xl flex items-center justify-center gap-3 transition-all hover:scale-110 active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Email
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="min-h-screen flex items-center justify-center py-12 px-4">
            <div class="text-center max-w-md">
                <div
                    class="w-40 h-40 mx-auto mb-8 bg-gradient-to-br from-pink-600 via-purple-600 to-cyan-600 rounded-3xl flex items-center justify-center text-white shadow-2xl">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-3">Vendor Not Found</h3>
                <p class="text-slate-700 dark:text-slate-400 mb-8 font-semibold text-lg">This vendor doesn't exist or
                    has been removed.</p>
                <a href="{{ route('wedding-vendors.index') }}"
                    class="inline-block bg-gradient-to-r from-pink-600 to-rose-600 text-white font-black py-5 px-10 rounded-xl hover:scale-105 transition-all shadow-lg">
                    Back to Vendors
                </a>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <style>
        @keyframes float-subtle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-16px);
            }
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

        .glass-dark {
            background: rgba(248, 250, 252, 0.08);
            backdrop-filter: blur(30px);
        }

        .dark .glass-dark {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(35px);
        }

        .glass-light {
            background: rgba(248, 250, 252, 0.1);
            backdrop-filter: blur(25px);
        }

        .dark .glass-light {
            background: rgba(248, 250, 252, 0.04);
            backdrop-filter: blur(25px);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
