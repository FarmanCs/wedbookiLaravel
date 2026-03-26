<div class="bg-gradient-to-b from-gray-50 to-white dark:from-stone-950 dark:to-zinc-950 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1
            class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 dark:from-amber-400 dark:to-orange-400 mb-8">
            Wedding Vendors
        </h1>

        @forelse($groupedBusinesses as $categoryName => $businesses)
            @if ($businesses->count())
                <!-- Category Header -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                        {{ $categoryName }}
                    </h2>
                    <a href="#"
                        class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:underline inline-flex items-center gap-1 group">
                        View all
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Carousel Container -->
                <div class="relative mb-12 group" x-data="{
                    canScrollLeft: false,
                    canScrollRight: false,
                    init() {
                        this.$nextTick(() => {
                            this.updateScrollState();
                        });
                    },
                    updateScrollState() {
                        const container = this.$refs.container;
                        if (!container) return;
                        this.canScrollLeft = container.scrollLeft > 0;
                        this.canScrollRight = container.scrollLeft < (container.scrollWidth - container.clientWidth - 10);
                    },
                    scroll(direction) {
                        const container = this.$refs.container;
                        if (!container) return;
                        const cardWidth = container.querySelector('.snap-start')?.offsetWidth || 288;
                        const gap = 20; // matches space-x-5
                        const scrollAmount = cardWidth + gap;
                        container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
                        // Update scroll state after animation
                        setTimeout(() => this.updateScrollState(), 300);
                    }
                }">

                    <!-- Left Scroll Button -->
                    <button @click="scroll(-1)"
                        class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-full p-3 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 disabled:opacity-30 hover:scale-110 border border-gray-200 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-700"
                        :disabled="!canScrollLeft">
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Right Scroll Button -->
                    <button @click="scroll(1)"
                        class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-full p-3 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 disabled:opacity-30 hover:scale-110 border border-gray-200 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-700"
                        :disabled="!canScrollRight">
                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Scrollable Cards (scrollbar hidden) -->
                    <div x-ref="container" @scroll="updateScrollState"
                        class="flex overflow-x-hide space-x-5 pb-6 scrollbar-hide scroll-smooth snap-x snap-mandatory">
                        @foreach ($businesses as $business)
                            <a href="{{ $business->detail_url }}"
                                class="flex-none w-72 snap-start group/card hover:no-underline">
                                <!-- Card with consistent height -->
                                <div
                                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 hover:border-amber-500 dark:hover:border-amber-600 group-hover/card:scale-105 flex flex-col h-full">
                                    <!-- Business Image -->
                                    <div
                                        class="h-40 bg-gradient-to-br from-zinc-100 to-gray-100 dark:from-gray-700 dark:to-stone-950 relative flex-shrink-0 overflow-hidden">
                                        @if ($business->profile_image)
                                            <img src="{{ Storage::url($business->profile_image) }}"
                                                alt="{{ $business->company_name }}"
                                                class="w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-500">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-5xl font-bold text-amber-300 dark:text-amber-400 bg-gradient-to-br from-amber-200 to-orange-200 dark:from-amber-800 dark:to-orange-800">
                                                {{ $business->initials }}
                                            </div>
                                        @endif
                                        @if ($business->is_featured)
                                            <div
                                                class="absolute top-2 right-2 bg-gradient-to-r from-yellow-400 to-amber-400 dark:from-yellow-500 dark:to-amber-500 text-yellow-900 dark:text-gray-900 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-lg">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                Featured
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="p-5 flex flex-col flex-grow">
                                        <!-- Rating & Location -->
                                        <div class="flex flex-col gap-2 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                            <div class="flex items-center gap-1">
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= floor($business->avg_rating) ? 'text-yellow-400 fill-yellow-400' : 'text-gray-300 dark:text-gray-600 fill-gray-300 dark:fill-gray-600' }}"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span
                                                    class="font-medium">{{ number_format($business->avg_rating, 1) }}</span>
                                                <span class="mx-1">•</span>
                                                <span>{{ $business->reviews_count }}
                                                    {{ Str::plural('review', $business->reviews_count) }}</span>
                                            </div>
                                            <span class="truncate flex items-center gap-1 text-xs">
                                                <svg class="w-3 h-3 text-rose-500 flex-shrink-0" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.05 4.05a7 7 0 119.9 9.9L9.9 13.95a7 7 0 01-9.9-9.9zM9 11a2 2 0 110-4 2 2 0 010 4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $business->city ?? 'N/A' }}, {{ $business->country ?? 'N/A' }}
                                            </span>
                                        </div>

                                        <!-- Business Name -->
                                        <h3
                                            class="font-bold text-lg text-gray-900 dark:text-white mb-2 truncate group-hover/card:text-amber-600 dark:group-hover/card:text-amber-400 transition-colors">
                                            {{ $business->company_name }}
                                        </h3>

                                        <!-- Description -->
                                        <p
                                            class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 mb-3 min-h-[2.5rem]">
                                            {{ Str::limit($business->business_desc, 80) }}
                                        </p>

                                        <!-- Features -->
                                        @if (!empty($business->features))
                                            <div class="space-y-1 mb-4">
                                                @foreach (array_slice($business->features, 0, 3) as $feature)
                                                    <div
                                                        class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                                        <svg class="w-4 h-4 text-green-500 dark:text-green-400 mr-2 flex-shrink-0"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="truncate">{{ $feature }}</span>
                                                    </div>
                                                @endforeach
                                                @if (count($business->features) > 3)
                                                    <div
                                                        class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16v-2a6 6 0 100-12 6 6 0 000 12v2z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        {{ count($business->features) - 3 }} more
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <!-- Placeholder to maintain spacing -->
                                            <div class="mb-4"></div>
                                        @endif

                                        <!-- Price & CTA -->
                                        <div class="flex items-center justify-between mt-auto gap-3">
                                            <div>
                                                <span
                                                    class="text-xs text-gray-500 dark:text-gray-400 font-semibold">Starting
                                                    from</span>
                                                <div class="font-bold text-amber-600 dark:text-amber-400 text-lg">
                                                    @if ($business->starting_price)
                                                        Rs {{ number_format($business->starting_price, 0) }}
                                                    @else
                                                        <span class="text-xs">On request</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Button -->
                                            <button
                                                class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 dark:from-amber-600 dark:to-orange-600 dark:hover:from-amber-700 dark:hover:to-orange-700 text-white font-bold py-2 px-3 rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95 flex items-center gap-2 whitespace-nowrap text-sm"
                                                onclick="event.preventDefault(); event.stopPropagation(); Livewire.navigate('{{ $business->detail_url }}')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                                <span class="hidden sm:inline">View Details</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No vendors found</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Please check back later.</p>
            </div>
        @endforelse
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endpush
</div>
