<div class="min-h-screen relative overflow-hidden">
    <!-- Ambient Background – Light / Dark adaptive -->
    <div
        class="fixed inset-0 bg-gradient-to-br from-neutral-50 via-white to-neutral-100 dark:from-stone-950 dark:via-stone-900 dark:to-stone-950 -z-50">
    </div>

    <!-- Animated Gradient Orbs – softer in light mode, richer in dark -->
    <div class="fixed inset-0 -z-40 overflow-hidden">
        <div
            class="absolute -top-1/2 -right-1/2 w-[800px] h-[800px] bg-gradient-to-br from-cyan-200/40 to-blue-200/30 dark:from-cyan-500/20 dark:to-blue-600/15 rounded-full blur-3xl animate-pulse">
        </div>
        <div class="absolute -bottom-1/2 -left-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-violet-200/40 to-purple-200/30 dark:from-violet-500/20 dark:to-purple-600/15 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 3s"></div>
        <div class="absolute top-1/3 left-1/2 w-[500px] h-[500px] bg-gradient-to-br from-emerald-200/30 to-cyan-200/30 dark:from-emerald-500/15 dark:to-cyan-600/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 6s"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <!-- Premium Header -->
        <div class="mb-12 max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-cyan-400 via-blue-400 to-violet-400 dark:from-cyan-500 dark:via-blue-500 dark:to-violet-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-all duration-300">
                            </div>
                            <div
                                class="relative p-4 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-2xl border border-cyan-300/50 dark:border-cyan-500/30 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5"
                                    class="w-8 h-8 text-cyan-600 dark:text-cyan-300">
                                    <rect x="3" y="3" width="18" height="18" rx="2.5"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                    <path d="M21 14.5l-5.5-5.5L6 17"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1
                                class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-cyan-600 via-blue-600 to-violet-600 dark:from-cyan-300 dark:via-blue-300 dark:to-violet-300 bg-clip-text text-transparent">
                                My Businesses
                            </h1>
                            <p class="text-sm lg:text-base text-neutral-600 dark:text-neutral-400 mt-1">
                                Manage your portfolio and grow your revenue
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Create Button – refined with softer light mode -->
                <a href="{{ route('vendor.business.create') }}"
                    class="relative inline-flex items-center gap-3 px-8 py-4 rounded-2xl hover:scale-105 transition-transform duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 via-teal-400/30 to-cyan-400/30 dark:from-emerald-500/20 dark:via-teal-500/20 dark:to-cyan-500/20 rounded-2xl blur-xl opacity-40 hover:opacity-60 transition-all duration-300">
                    </div>
                    <div
                        class="relative flex items-center gap-3 px-8 py-4 rounded-2xl bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl border border-emerald-300/50 dark:border-emerald-500/30 hover:border-emerald-400 dark:hover:border-emerald-500/50 transition-all duration-300 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" class="w-5 h-5 text-emerald-600 dark:text-emerald-300">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span
                            class="text-emerald-700 dark:text-emerald-300 font-semibold hover:text-emerald-600 dark:hover:text-emerald-200 transition-colors">Add
                            Business</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Delete Success Message (unchanged) -->
        @if ($showDeleteSuccess)
            <div class="fixed top-6 right-6 max-w-sm z-50" x-data="{ show: true }" x-show="show"
                x-init="setTimeout(() => show = false, 4000)" x-transition:enter="transition ease-out duration-300"
                x-transition:leave="transition ease-in duration-200">
                <div class="relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-400/30 dark:from-emerald-500/20 dark:to-teal-500/20 blur-xl hover:from-emerald-400/40 dark:hover:from-emerald-500/30 transition-all duration-300">
                    </div>
                    <div
                        class="relative backdrop-blur-xl bg-white/80 dark:bg-stone-800/80 border border-emerald-300/50 dark:border-emerald-500/30 p-6 rounded-2xl shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="relative flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 dark:from-emerald-500 dark:to-teal-500 rounded-full blur-lg opacity-50">
                                </div>
                                <div
                                    class="relative h-10 w-10 rounded-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500 text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" class="w-5 h-5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-emerald-700 dark:text-emerald-300">Business Deleted</h3>
                                <p class="text-sm text-emerald-600/70 dark:text-emerald-400/80 mt-1">
                                    "{{ $deletedBusinessName }}" has been removed from your portfolio.</p>
                            </div>
                            <button @click="show = false"
                                class="text-emerald-500/50 hover:text-emerald-600 dark:text-emerald-400/50 dark:hover:text-emerald-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="w-5 h-5">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($businesses->isEmpty())
            <!-- Empty State (updated) -->
            <div class="max-w-2xl mx-auto">
                <div class="relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-3xl border border-neutral-200 dark:border-white/10">
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-white/40 to-transparent dark:from-white/5 rounded-3xl opacity-0 hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div class="relative p-12 lg:p-16 text-center">
                        <div class="relative inline-block mb-8">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-teal-400 dark:from-emerald-500 dark:to-teal-500 rounded-3xl blur-2xl opacity-30 hover:opacity-50 transition-all duration-300">
                            </div>
                            <div
                                class="relative p-8 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-3xl border border-emerald-300/50 dark:border-emerald-500/30 hover:border-emerald-400 dark:hover:border-emerald-500/50 transition-all duration-300 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5"
                                    class="w-16 h-16 text-emerald-600 dark:text-emerald-300">
                                    <rect x="3" y="3" width="18" height="18" rx="2.5"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                    <path d="M21 14.5l-5.5-5.5L6 17"></path>
                                </svg>
                            </div>
                        </div>

                        <h2
                            class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-300 dark:to-teal-300 bg-clip-text text-transparent mb-4">
                            No Businesses Yet
                        </h2>
                        <p class="text-neutral-600 dark:text-neutral-400 text-lg mb-8 max-w-md mx-auto">
                            Create your first business profile to start managing services and accepting bookings
                        </p>

                        <a href="{{ route('vendor.business.create') }}"
                            class="relative inline-flex hover:scale-105 transition-transform duration-300">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 via-teal-400/30 to-cyan-400/30 dark:from-emerald-500/20 dark:via-teal-500/20 dark:to-cyan-500/20 rounded-2xl blur-xl opacity-40 hover:opacity-60 transition-all duration-300">
                            </div>
                            <div
                                class="relative inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl border border-emerald-300/50 dark:border-emerald-500/30 hover:border-emerald-400 dark:hover:border-emerald-500/50 transition-all duration-300 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2"
                                    class="w-5 h-5 text-emerald-600 dark:text-emerald-300">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span
                                    class="text-emerald-700 dark:text-emerald-300 font-semibold hover:text-emerald-600 dark:hover:text-emerald-200 transition-colors">Create
                                    First Business</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Businesses Grid (cards updated) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto">
                @foreach ($businesses as $business)
                    <div class="relative h-full">
                        <!-- Card Glow (appears on hover) -->
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-br from-cyan-400/30 via-blue-400/30 to-violet-400/30 dark:from-cyan-500/20 dark:via-blue-500/20 dark:to-violet-500/20 rounded-2xl opacity-0 hover:opacity-100 blur-xl transition-all duration-500 -z-10">
                        </div>

                        <!-- Card Container -->
                        <div
                            class="relative h-full flex flex-col overflow-hidden rounded-2xl border border-neutral-200 dark:border-white/10 hover:border-cyan-300 dark:hover:border-cyan-500/50 transition-all duration-300 backdrop-blur-xl bg-white/70 dark:bg-stone-800/70 shadow-lg hover:shadow-xl">

                            <!-- Cover Section -->
                            <div
                                class="relative h-35 overflow-hidden bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-600/20 dark:to-blue-600/20">
                                @if ($business->cover_image)
                                    <img src="{{ asset('storage/' . $business->cover_image) }}" alt="Cover"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-cyan-200/50 to-blue-200/50 dark:from-cyan-600/30 dark:to-blue-600/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5"
                                            class="w-12 h-12 text-cyan-500/40 dark:text-cyan-300/30">
                                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor">
                                            </circle>
                                            <path d="M21 15l-5-5L5 21"></path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent dark:from-stone-950 dark:via-transparent">
                                </div>

                                <!-- Rating Badge -->
                                <div
                                    class="absolute top-4 right-4 backdrop-blur-xl bg-white/80 dark:bg-stone-900/80 border border-neutral-200 dark:border-white/10 rounded-xl px-3.5 py-2 shadow-xl">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="w-4 h-4 text-amber-500">
                                            <polygon
                                                points="12 2 15.09 10.26 24 10.27 17.18 16.93 20.27 25.19 12 19.54 3.73 25.19 6.82 16.93 0 10.27 8.91 10.26 12 2">
                                            </polygon>
                                        </svg>
                                        <span class="font-bold text-neutral-800 dark:text-slate-100 text-xs">
                                            {{ number_format($business->reviews_avg_points ?? 0, 1) }}
                                        </span>
                                        <span class="text-xs text-neutral-500 dark:text-neutral-400">
                                            ({{ $business->reviews_count ?? 0 }})
                                        </span>
                                    </div>
                                </div>

                                <!-- Profile Image -->
                                <div class="absolute -bottom-6 left-6 z-20">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-br from-cyan-400 via-blue-400 to-violet-400 dark:from-cyan-500 dark:via-blue-500 dark:to-violet-500 rounded-2xl blur-xl opacity-40 hover:opacity-60 transition-all duration-300">
                                        </div>
                                        <div
                                            class="relative w-28 h-28 rounded-2xl border-4 border-white dark:border-stone-900 overflow-hidden bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-600/50 dark:to-blue-600/50 flex items-center justify-center text-3xl font-bold text-neutral-800 dark:text-neutral-50 shadow-2xl">
                                            @if ($business->profile_image)
                                                <img src="{{ asset('storage/' . $business->profile_image) }}"
                                                    alt="{{ $business->company_name }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <span
                                                    class="text-cyan-600 dark:text-cyan-200">{{ substr($business->company_name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="flex-1 flex flex-col p-6 pt-12">
                                <h3
                                    class="text-xl font-bold text-neutral-800 dark:text-slate-100 hover:text-cyan-600 dark:hover:text-cyan-300 transition-colors duration-300 mb-3 line-clamp-1">
                                    {{ $business->company_name }}
                                </h3>

                                <!-- Category Tags -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-cyan-100 to-blue-100 dark:from-cyan-500/20 dark:to-blue-500/20 border border-cyan-300/50 dark:border-cyan-500/30 text-cyan-700 dark:text-cyan-300 text-xs font-semibold rounded-full backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5" class="w-3 h-3">
                                            <rect x="3" y="3" width="8" height="8"></rect>
                                            <rect x="13" y="3" width="8" height="8"></rect>
                                            <rect x="3" y="13" width="8" height="8"></rect>
                                            <rect x="13" y="13" width="8" height="8"></rect>
                                        </svg>
                                        {{ $business->category?->type ?? 'General' }}
                                    </span>
                                    @if ($business->subCategory)
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-neutral-100 dark:bg-white/5 border border-neutral-200 dark:border-white/10 text-neutral-600 dark:text-neutral-400 text-xs font-semibold rounded-full backdrop-blur-sm">
                                            {{ $business->subCategory->type }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Stats Grid -->
                                <div
                                    class="grid grid-cols-3 gap-3 mb-5 py-3 bg-neutral-100/50 dark:bg-white/5 rounded-xl px-3 border border-neutral-200 dark:border-white/5 backdrop-blur-sm">
                                    <div class="text-center">
                                        <div
                                            class="flex items-center justify-center mb-1 opacity-60 hover:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-4 h-4 text-cyan-600 dark:text-cyan-400">
                                                <rect x="3" y="3" width="18" height="18" rx="2">
                                                </rect>
                                            </svg>
                                        </div>
                                        <div
                                            class="text-base font-bold text-cyan-700 dark:text-cyan-300 hover:text-cyan-600 dark:hover:text-cyan-200 transition-colors">
                                            {{ $business->packages_count ?? 0 }}
                                        </div>
                                        <div
                                            class="text-xs text-neutral-500 dark:text-neutral-500 hover:text-neutral-700 dark:hover:text-neutral-400 transition-colors">
                                            Packages</div>
                                    </div>
                                    <div class="text-center border-l border-r border-neutral-200 dark:border-white/5">
                                        <div
                                            class="flex items-center justify-center mb-1 opacity-60 hover:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-4 h-4 text-purple-600 dark:text-purple-400">
                                                <rect x="3" y="4" width="18" height="18" rx="2">
                                                </rect>
                                                <path d="M16 2v4M8 2v4"></path>
                                            </svg>
                                        </div>
                                        <div
                                            class="text-base font-bold text-purple-700 dark:text-purple-300 hover:text-purple-600 dark:hover:text-purple-200 transition-colors">
                                            {{ $business->bookings_count ?? 0 }}
                                        </div>
                                        <div
                                            class="text-xs text-neutral-500 dark:text-neutral-500 hover:text-neutral-700 dark:hover:text-neutral-400 transition-colors">
                                            Bookings</div>
                                    </div>
                                    <div class="text-center">
                                        <div
                                            class="flex items-center justify-center mb-1 opacity-60 hover:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-4 h-4 text-amber-500">
                                                <polygon
                                                    points="12 2 15.09 10.26 24 10.27 17.18 16.93 20.27 25.19 12 19.54 3.73 25.19 6.82 16.93 0 10.27 8.91 10.26 12 2">
                                                </polygon>
                                            </svg>
                                        </div>
                                        <div
                                            class="text-base font-bold text-amber-700 dark:text-amber-300 hover:text-amber-600 dark:hover:text-amber-200 transition-colors">
                                            {{ $business->reviews_count ?? 0 }}
                                        </div>
                                        <div
                                            class="text-xs text-neutral-500 dark:text-neutral-500 hover:text-neutral-700 dark:hover:text-neutral-400 transition-colors">
                                            Reviews</div>
                                    </div>
                                </div>

                                <!-- Description -->
                                @if ($business->business_desc)
                                    <p
                                        class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-300 transition-colors line-clamp-2 mb-4">
                                        {{ $business->business_desc }}
                                    </p>
                                @endif

                                <!-- Contact Info -->
                                <div class="space-y-2 mb-5 text-xs">
                                    @if ($business->business_email)
                                        <div
                                            class="flex items-center gap-2 text-neutral-500 dark:text-neutral-500 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-3.5 h-3.5 text-cyan-500/60 dark:text-cyan-400/60 flex-shrink-0 group-hover/item:text-cyan-600 dark:group-hover/item:text-cyan-400 transition-colors">
                                                <rect x="2" y="4" width="20" height="16" rx="2">
                                                </rect>
                                                <path d="m22 6-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 6"></path>
                                            </svg>
                                            <span class="truncate">{{ $business->business_email }}</span>
                                        </div>
                                    @endif
                                    @if ($business->business_phone)
                                        <div
                                            class="flex items-center gap-2 text-neutral-500 dark:text-neutral-500 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-3.5 h-3.5 text-emerald-500/60 dark:text-emerald-400/60 flex-shrink-0 group-hover/item:text-emerald-600 dark:group-hover/item:text-emerald-400 transition-colors">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                </path>
                                            </svg>
                                            <span>{{ $business->business_phone }}</span>
                                        </div>
                                    @endif
                                    @if ($business->city)
                                        <div
                                            class="flex items-center gap-2 text-neutral-500 dark:text-neutral-500 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-3.5 h-3.5 text-violet-500/60 dark:text-violet-400/60 flex-shrink-0 group-hover/item:text-violet-600 dark:group-hover/item:text-violet-400 transition-colors">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <span>{{ $business->city }}@if ($business->country)
                                                    , {{ $business->country }}
                                                @endif
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Divider -->
                                <div
                                    class="h-px bg-gradient-to-r from-transparent via-neutral-300 to-transparent dark:via-white/10 my-4">
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3 mt-auto">
                                    <a href="{{ route('vendor.business.edit', $business->id) }}"
                                        class="flex-1 relative hover:scale-105 transition-transform duration-300">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-cyan-400/30 to-blue-400/30 dark:from-cyan-500/20 dark:to-blue-500/20 rounded-xl opacity-0 hover:opacity-100 blur-lg transition-all duration-300">
                                        </div>
                                        <div
                                            class="relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-100 dark:bg-cyan-600/20 border border-cyan-300/50 dark:border-cyan-500/30 hover:border-cyan-400 dark:hover:border-cyan-500/50 text-cyan-700 dark:text-cyan-300 hover:text-cyan-800 dark:hover:text-cyan-200 font-medium transition-all duration-300 backdrop-blur-sm text-sm shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-4 h-4">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>
                                    <button type="button" wire:click="delete({{ $business->id }})"
                                        wire:confirm="Are you sure? This cannot be undone."
                                        class="flex-1 relative hover:scale-105 transition-transform duration-300">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-rose-400/30 to-red-400/30 dark:from-rose-500/20 dark:to-red-500/20 rounded-xl opacity-0 hover:opacity-100 blur-lg transition-all duration-300">
                                        </div>
                                        <div
                                            class="relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-100 dark:bg-rose-600/20 border border-rose-300/50 dark:border-rose-500/30 hover:border-rose-400 dark:hover:border-rose-500/50 text-rose-700 dark:text-rose-300 hover:text-rose-800 dark:hover:text-rose-200 font-medium transition-all duration-300 backdrop-blur-sm text-sm shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                class="w-4 h-4">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                            Delete
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
