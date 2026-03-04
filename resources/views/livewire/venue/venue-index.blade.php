<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-stone-900 dark:via-stone-800 dark:to-stone-900">
    <!-- Simple Header -->
    <div class="border-b border-slate-200 dark:border-stone-700 bg-white/80 dark:bg-stone-800/80 backdrop-blur-sm sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <flux:icon.sparkles class="w-8 h-8 text-emerald-600 dark:text-emerald-400" />
                <h1 class="text-2xl font-bold bg-gradient-to-r from-emerald-700 to-teal-700 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">
                    WEDBOOKI VENDORS
                </h1>
            </div>
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <flux:icon.magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" />
                    <input
                        type="text"
                        wire:model.live.debounce-300ms="search"
                        placeholder="Search venues..."
                        class="w-full pl-10 pr-4 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-full bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 focus:outline-none transition-colors"
                    />
                </div>
            </div>
            <div class="text-sm text-slate-600 dark:text-slate-300">
                {{ $venueCount }} venues available
            </div>
        </div>
    </div>

    <!-- Category Chips (from screenshot) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium text-slate-700 dark:text-slate-200 mr-2">Popular categories:</span>
            @php
                $categories = [
                    ['name' => 'Cakes And Bakes', 'icon' => 'cake'],
                    ['name' => 'Car Rentals', 'icon' => 'truck'],
                    ['name' => 'Carts And Stalls', 'icon' => 'shopping-cart'],
                    ['name' => 'Catering', 'icon' => 'building-restaurant'],
                    ['name' => 'Décor', 'icon' => 'sparkles'],
                    ['name' => 'Entertainment', 'icon' => 'musical-note'],
                ];
            @endphp
            @foreach($categories as $cat)
                <button
                    wire:click="$set('search', '{{ $cat['name'] }}')"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border-2 border-slate-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-700 dark:text-slate-200 hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all"
                >
                    <flux:icon.{{ $cat['icon'] }} class="w-4 h-4" />
                    <span class="text-sm font-medium">{{ $cat['name'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Main Content with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters (inspired by screenshot) -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 sticky top-28 max-h-[calc(100vh-140px)] overflow-y-auto border border-slate-100 dark:border-stone-700">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <flux:icon.funnel class="w-5 h-5 text-emerald-600" />
                        Filters
                    </h3>

                    <!-- Sub Category (Venue Type) -->
                    <div class="mb-8">
                        <h4 class="font-semibold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                            <flux:icon.building-library class="w-4 h-4 text-emerald-600" />
                            Sub Category
                        </h4>
                        <div class="space-y-3">
                            @foreach(['outdoor' => 'Outdoor', 'rooftop' => 'Rooftop', 'indoor' => 'Indoor', 'park' => 'Park'] as $value => $label)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input
                                        type="radio"
                                        name="venue_type"
                                        value="{{ $value }}"
                                        wire:model.live="venue_type"
                                        class="w-4 h-4 border-2 border-slate-300 dark:border-stone-600 text-emerald-600 focus:ring-emerald-500 cursor-pointer"
                                    />
                                    <span class="text-slate-700 dark:text-slate-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $label }}</span>
                                </label>
                            @endforeach
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input
                                    type="radio"
                                    name="venue_type"
                                    value=""
                                    wire:model.live="venue_type"
                                    class="w-4 h-4 border-2 border-slate-300 dark:border-stone-600 text-emerald-600 focus:ring-emerald-500 cursor-pointer"
                                />
                                <span class="text-slate-700 dark:text-slate-300 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">All Types</span>
                            </label>
                        </div>
                    </div>

                    <!-- Country -->
                    <div class="mb-8">
                        <h4 class="font-semibold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                            <flux:icon.map-pin class="w-4 h-4 text-emerald-600" />
                            Country
                        </h4>
                        <select wire:model.live="country" class="w-full px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 focus:outline-none">
                            <option value="">All Countries</option>
                            @foreach($countries as $countryOption)
                                <option value="{{ $countryOption }}">{{ $countryOption }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City (shown only when country selected) -->
                    @if(!empty($country))
                        <div class="mb-8">
                            <h4 class="font-semibold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                                <flux:icon.building-office class="w-4 h-4 text-emerald-600" />
                                City
                            </h4>
                            <select wire:model.live="city" class="w-full px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 focus:outline-none">
                                <option value="">All Cities</option>
                                @foreach($cities as $cityOption)
                                    <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- Date (placeholder from screenshot) -->
                    <div class="mb-8">
                        <h4 class="font-semibold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                            <flux:icon.calendar class="w-4 h-4 text-emerald-600" />
                            Date
                        </h4>
                        <input
                            type="date"
                            class="w-full px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 focus:outline-none"
                            placeholder="Select date"
                        />
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Check availability (demo)</p>
                    </div>

                    <!-- Capacity & Price (compact) -->
                    <div class="mb-8">
                        <h4 class="font-semibold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                            <flux:icon.users class="w-4 h-4 text-emerald-600" />
                            Guest Capacity
                        </h4>
                        <div class="flex gap-2">
                            <input
                                type="number"
                                wire:model.live.debounce-500ms="min_capacity"
                                placeholder="Min"
                                class="w-1/2 px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 text-sm"
                            />
                            <input
                                type="number"
                                wire:model.live.debounce-500ms="max_capacity"
                                placeholder="Max"
                                class="w-1/2 px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 text-sm"
                            />
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="font-semibold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                            <flux:icon.currency-dollar class="w-4 h-4 text-emerald-600" />
                            Price Range
                        </h4>
                        <div class="flex gap-2">
                            <input
                                type="number"
                                wire:model.live.debounce-500ms="min_price"
                                placeholder="Min $"
                                class="w-1/2 px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 text-sm"
                            />
                            <input
                                type="number"
                                wire:model.live.debounce-500ms="max_price"
                                placeholder="Max $"
                                class="w-1/2 px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 text-sm"
                            />
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <button
                        wire:click="resetFilters"
                        class="w-full py-3 px-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:shadow-lg text-white font-semibold rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <flux:icon.arrow-path class="w-4 h-4" />
                        Clear All Filters
                    </button>
                </div>
            </div>

            <!-- Results Area -->
            <div class="lg:col-span-3">
                <!-- Results Header with "O RESULTS" style -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                            <span class="text-emerald-700 dark:text-emerald-300 font-bold text-lg">{{ $venueCount }}</span>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">RESULTS</h2>
                    </div>
                    @if($venueCount > 0)
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-slate-600 dark:text-slate-400">Sort by:</span>
                            <select wire:model.live="sort_by" class="px-3 py-2 border-2 border-slate-200 dark:border-stone-600 rounded-lg bg-white dark:bg-stone-700 text-slate-900 dark:text-white focus:border-emerald-500 text-sm">
                                <option value="created_at">Newest</option>
                                <option value="price">Price: Low to High</option>
                                <option value="capacity">Capacity</option>
                                <option value="name">Name</option>
                            </select>
                        </div>
                    @endif
                </div>

                <!-- Search results text -->
                <p class="text-slate-500 dark:text-slate-400 mb-6">Search results</p>

                @if($venues->count() > 0)
                    <!-- Venue Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        @foreach($venues as $venue)
                            <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 group cursor-pointer transform hover:scale-[1.02] border border-slate-100 dark:border-stone-700">
                                <!-- Image -->
                                <div class="relative h-48 bg-gradient-to-br from-slate-200 to-slate-300 dark:from-stone-700 dark:to-stone-600">
                                    @if($venue->images && is_array($venue->images) && count($venue->images) > 0)
                                        <img src="{{ $venue->images[0] }}" alt="{{ $venue->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <flux:icon.photo class="w-12 h-12 text-slate-400" />
                                        </div>
                                    @endif
                                    <!-- Capacity badge -->
                                    <div class="absolute bottom-3 left-3 bg-black/60 text-white px-2 py-1 rounded-full text-xs flex items-center gap-1">
                                        <flux:icon.users class="w-3 h-3" />
                                        {{ $venue->capacity }} guests
                                    </div>
                                    <!-- Price badge -->
                                    <div class="absolute top-3 right-3 bg-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        ${{ number_format($venue->price, 0) }}
                                    </div>
                                </div>

                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2">{{ $venue->name }}</h3>
                                    <div class="flex items-start gap-1 text-slate-600 dark:text-slate-400 text-sm mb-3">
                                        <flux:icon.map-pin class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" />
                                        <span>{{ $venue->city }}, {{ $venue->country }}</span>
                                    </div>

                                    @if($venue->extra_services && is_array($venue->extra_services) && count($venue->extra_services) > 0)
                                        <div class="flex flex-wrap gap-1 mb-4">
                                            @foreach(array_slice($venue->extra_services, 0, 2) as $service)
                                                <span class="text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 px-2 py-1 rounded-full">{{ $service }}</span>
                                            @endforeach
                                            @if(count($venue->extra_services) > 2)
                                                <span class="text-xs bg-slate-100 dark:bg-stone-700 text-slate-600 dark:text-slate-400 px-2 py-1 rounded-full">+{{ count($venue->extra_services)-2 }}</span>
                                            @endif
                                        </div>
                                    @endif

                                    <a href="{{ auth('host')->check() ? route('host.venues.detail', $venue->id) : route('wedding-venues.detail', $venue->id) }}" class="inline-flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-medium text-sm hover:gap-3 transition-all">
                                        View Details <flux:icon.arrow-right class="w-4 h-4" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination / Show More -->
                    <div class="flex flex-col items-center gap-4">
                        {{ $venues->links('pagination::tailwind') }}
                        @if($venues->hasMorePages())
                            <button wire:click="loadMore" class="text-emerald-600 dark:text-emerald-400 font-medium hover:underline flex items-center gap-1">
                                Show 12 More <flux:icon.chevron-down class="w-4 h-4" />
                            </button>
                        @endif
                    </div>
                @else
                    <!-- Empty State (inspired by screenshot) -->
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-12 text-center border border-slate-100 dark:border-stone-700">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-slate-100 dark:bg-stone-700 flex items-center justify-center">
                            <flux:icon.magnifying-glass class="w-12 h-12 text-slate-400" />
                        </div>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-3">NO RESULTS FOUND</h3>
                        <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto mb-8">
                            It looks like there are no vendors matching your current criteria.<br>
                            Try adjusting your search filters or broadening your selection.
                        </p>
                        <button
                            wire:click="resetFilters"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold py-3 px-8 rounded-full hover:shadow-lg transition-all"
                        >
                            <flux:icon.arrow-path class="w-5 h-5" />
                            Clear All Filters
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>