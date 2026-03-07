<div class="bg-gradient-to-b from-gray-50 to-white dark:from-stone-950 dark:to-zinc-950 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 dark:from-amber-400 dark:to-orange-400 mb-8">
            Wedding Vendors
        </h1>

        @forelse($groupedBusinesses as $categoryName => $businesses)
            @if($businesses->count())
                <!-- Category Header -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                        <flux:icon name="folder" class="w-6 h-6 text-amber-500" />
                        {{ $categoryName }}
                    </h2>
                    <a href="#" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:underline inline-flex items-center gap-1">
                        View all
                        <flux:icon name="arrow-right" class="w-4 h-4" />
                    </a>
                </div>

                <!-- Carousel Container -->
                <div class="relative mb-12 group" 
                     x-data="{
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
                             this.canScrollRight = container.scrollLeft < (container.scrollWidth - container.clientWidth);
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
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full p-3 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 disabled:opacity-30 hover:scale-110 border border-gray-200 dark:border-gray-700"
                            :disabled="!canScrollLeft">
                        <flux:icon name="chevron-left" class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    </button>

                    <!-- Right Scroll Button -->
                    <button @click="scroll(1)" 
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full p-3 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300 disabled:opacity-30 hover:scale-110 border border-gray-200 dark:border-gray-700"
                            :disabled="!canScrollRight">
                        <flux:icon name="chevron-right" class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    </button>

                    <!-- Scrollable Cards (scrollbar hidden) -->
                    <div x-ref="container" 
                         @scroll="updateScrollState"
                         class="flex overflow-x-hidden space-x-5 pb-6 scrollbar-hide scroll-smooth snap-x snap-mandatory">
                        @foreach($businesses as $business)
                            <div class="flex-none w-72 snap-start">
                                <!-- Card with consistent height -->
                                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 hover:border-amber-500 dark:hover:border-amber-600 group/card flex flex-col h-full">
                                    <!-- Business Image -->
                                    <div class="h-40 bg-gradient-to-br from-zinc-100 to-gray-100 dark:from-gray-700 dark:to-stone-950 relative flex-shrink-0">
                                        @if($business->profile_image)
                                            <img src="{{ Storage::url($business->profile_image) }}" 
                                                 alt="{{ $business->company_name }}" 
                                                 class="w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-5xl font-bold text-amber-300 dark:text-amber-400">
                                                {{ $business->initials }}
                                            </div>
                                        @endif
                                        @if($business->is_featured)
                                            <div class="absolute top-2 right-2 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full flex items-center gap-1">
                                                <flux:icon name="star" class="w-3 h-3" />
                                                Featured
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content -->
                                    <div class="p-5 flex flex-col flex-grow">
                                        <!-- Rating & Location -->
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            <div class="flex items-center mr-2">
                                                <flux:icon name="star" class="w-4 h-4 text-yellow-400" />
                                                <span class="ml-1 font-medium">{{ number_format($business->avg_rating, 1) }}</span>
                                                <span class="mx-1">•</span>
                                                <span>{{ $business->reviews_count }} {{ Str::plural('review', $business->reviews_count) }}</span>
                                            </div>
                                            <span class="truncate flex items-center gap-1">
                                                <flux:icon name="map-pin" class="w-3 h-3 text-gray-400 dark:text-gray-500" />
                                                {{ $business->city ?? '' }}, {{ $business->country ?? '' }}
                                            </span>
                                        </div>

                                        <!-- Business Name -->
                                        <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2 truncate">
                                            {{ $business->company_name }}
                                        </h3>

                                        <!-- Description -->
                                        <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 mb-3 min-h-[2.5rem]">
                                            {{ Str::limit($business->business_desc, 80) }}
                                        </p>

                                        <!-- Features -->
                                        @if(!empty($business->features))
                                            <div class="space-y-1 mb-4">
                                                @foreach(array_slice($business->features, 0, 3) as $feature)
                                                    <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                                        <flux:icon name="check-circle" class="w-4 h-4 text-green-500 dark:text-green-400 mr-2 flex-shrink-0" />
                                                        <span class="truncate">{{ $feature }}</span>
                                                    </div>
                                                @endforeach
                                                @if(count($business->features) > 3)
                                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                                                        <flux:icon name="plus-circle" class="w-4 h-4" />
                                                        {{ count($business->features) - 3 }} more
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <!-- Placeholder to maintain spacing -->
                                            <div class="mb-4"></div>
                                        @endif

                                        <!-- Price & CTA -->
                                        <div class="flex items-center justify-between mt-auto">
                                            <div>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">Starting from</span>
                                                <div class="font-bold text-amber-600 dark:text-amber-400 text-lg">
                                                    @if($business->starting_price)
                                                        Rs {{ number_format($business->starting_price, 2) }}
                                                    @else
                                                        <span class="text-sm">Price on request</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Flux Button with custom warm colors -->
                                            <flux:button href="#" 
                                                         size="sm" 
                                                         class="!bg-gray-200 hover:!bg-pink-700 dark:!bg-gray-700 dark:hover:!bg-gray-600 !text-white !border-none"
                                                         icon="arrow-right" 
                                                         icon-position="right">
                                                Check Availability
                                            </flux:button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center py-12">
                <flux:icon name="building-storefront" class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500" />
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No vendors found</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Please check back later.</p>
            </div>
        @endforelse
    </div>
</div>