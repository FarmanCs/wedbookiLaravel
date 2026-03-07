<div class="min-h-screen bg-gradient-to-br from-zinc-50 via-white to-zinc-100 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-950 transition-colors duration-500">
    <!-- ==================== HEADER ==================== -->
    <header class="sticky top-0 z-40 border-b border-zinc-200 dark:border-zinc-800 bg-white/95 dark:bg-zinc-900/95 backdrop-blur-2xl shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <!-- Logo -->
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="relative w-11 h-11 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 flex items-center justify-center shadow-lg group-hover:shadow-blue-500/40 dark:group-hover:shadow-blue-500/30 transition-all duration-300 transform group-hover:scale-110">
                        <x-heroicon-o-sparkles class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-black bg-gradient-to-r from-blue-700 to-cyan-700 dark:from-blue-400 dark:to-cyan-400 bg-clip-text text-transparent">WEDBOOKI</h1>
                        <p class="text-xs font-semibold text-blue-600 dark:text-blue-400">Premium Venues</p>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 max-w-md relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-zinc-400" />
                    </div>
                    <input
                        type="text"
                        wire:model.live.debounce-300ms="search"
                        placeholder="Search premium venues..."
                        class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all duration-200 font-medium"
                    />
                    <div class="absolute right-4 top-1/2 -translate-y-1/2">
                        <span class="inline-block px-2.5 py-0.5 text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 rounded-lg shadow-lg">{{ $venueCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ==================== CATEGORY CHIPS ==================== -->
    @if($categories->count())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="space-y-5">
                <div class="inline-block">
                    <span class="text-sm font-bold uppercase tracking-widest text-blue-700 dark:text-blue-400">Explore Categories</span>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    @foreach($categories as $cat)
                        <button
                            wire:click="$set('category', '{{ $cat->id }}')"
                            class="px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300 hover:scale-105 {{ $category == $cat->id ? 'bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 text-white shadow-lg shadow-blue-500/30' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 hover:border-blue-500 dark:hover:border-blue-400 hover:bg-zinc-200 dark:hover:bg-zinc-700' }}"
                        >
                            <span class="flex items-center gap-2">
                                @if($cat->image)
                                    <img src="{{ asset('images/extra/' . $cat->image) }}" alt="{{ $cat->type }}" class="w-4 h-4 rounded-full object-cover" onerror="this.style.display='none'" />
                                @else
                                    <x-heroicon-o-building-library class="w-4 h-4" />
                                @endif
                                {{ $cat->type }}
                            </span>
                        </button>
                    @endforeach
                    @if($category)
                        <button wire:click="$set('category', '')" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                            <x-heroicon-o-x-mark class="w-4 h-4" />
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- ==================== SIDEBAR FILTERS ==================== -->
            <div class="lg:col-span-1">
                <div class="sticky top-28 space-y-4">
                    <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg dark:shadow-xl dark:shadow-black/50 p-6 border border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-zinc-200 dark:border-zinc-700">
                            <div class="p-2 bg-gradient-to-br from-blue-100 to-cyan-100 dark:from-blue-900/30 dark:to-cyan-900/30 rounded-lg">
                                <x-heroicon-o-adjustments-horizontal class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                            </div>
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Filters</h3>
                        </div>

                        <div class="space-y-4">
                            <!-- Category Filter -->
                            <div>
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wide flex items-center gap-2">
                                    <x-heroicon-o-building-library class="w-4 h-4 text-blue-600 dark:text-blue-400" />
                                    Category
                                </label>
                                <select wire:model.live="category" class="w-full px-3 py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700 text-zinc-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all font-medium text-sm">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($category && $subcategories->count())
                                <div>
                                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wide flex items-center gap-2">
                                        <x-heroicon-o-list-bullet class="w-4 h-4 text-blue-600 dark:text-blue-400" />
                                        Subcategory
                                    </label>
                                    <select wire:model.live="subcategory" class="w-full px-3 py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700 text-zinc-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all font-medium text-sm">
                                        <option value="">All Subcategories</option>
                                        @foreach($subcategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Country Filter -->
                            <div>
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wide flex items-center gap-2">
                                    <x-heroicon-o-globe-alt class="w-4 h-4 text-blue-600 dark:text-blue-400" />
                                    Country
                                </label>
                                <select wire:model.live="country" class="w-full px-3 py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700 text-zinc-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all font-medium text-sm">
                                    <option value="">All Countries</option>
                                    @foreach($countries as $countryOption)
                                        <option value="{{ $countryOption }}">{{ $countryOption }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($country && $cities->count())
                                <div>
                                    <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wide flex items-center gap-2">
                                        <x-heroicon-o-building-office-2 class="w-4 h-4 text-blue-600 dark:text-blue-400" />
                                        City
                                    </label>
                                    <select wire:model.live="city" class="w-full px-3 py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700 text-zinc-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900/50 transition-all font-medium text-sm">
                                        <option value="">All Cities</option>
                                        @foreach($cities as $cityOption)
                                            <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Capacity Filter -->
                            <div class="bg-gradient-to-br from-sky-50 to-blue-50 dark:from-sky-950/30 dark:to-blue-950/30 rounded-lg p-2.5 border border-sky-200 dark:border-sky-900/40 shadow-sm hover:shadow-md transition-all duration-300">
                                <label class="block text-xs font-bold text-sky-900 dark:text-sky-300 mb-2 uppercase tracking-wider flex items-center gap-2">
                                    <x-heroicon-o-users class="w-3.5 h-3.5" />
                                    Capacity
                                </label>
                                <div class="flex gap-1.5 max-w-xs">
                                    <input type="number" wire:model.live.debounce-500ms="min_capacity" placeholder="Min" class="w-25 px-2 py-1 rounded text-xs border border-sky-300 dark:border-sky-800 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:border-sky-500 dark:focus:border-sky-400 focus:outline-none focus:ring-1.5 focus:ring-sky-300 dark:focus:ring-sky-900/50 transition-all font-semibold shadow-sm hover:shadow-md text-center" />
                                    <input type="number" wire:model.live.debounce-500ms="max_capacity" placeholder="Max" class="w-25 px-2 py-1 rounded text-xs border border-sky-300 dark:border-sky-800 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:border-sky-500 dark:focus:border-sky-400 focus:outline-none focus:ring-1.5 focus:ring-sky-300 dark:focus:ring-sky-900/50 transition-all font-semibold shadow-sm hover:shadow-md text-center" />
                                </div>
                            </div>

                            <!-- Price Filter -->
                            <div class="bg-gradient-to-br from-teal-50 to-green-50 dark:from-teal-950/30 dark:to-green-950/30 rounded-lg p-2.5 border border-teal-200 dark:border-teal-900/40 shadow-sm hover:shadow-md transition-all duration-300">
                                <label class="block text-xs font-bold text-teal-900 dark:text-teal-300 mb-2 uppercase tracking-wider flex items-center gap-2">
                                    <x-heroicon-o-currency-dollar class="w-3.5 h-3.5" />
                                    Price
                                </label>
                                <div class="flex gap-1.5 max-w-xs">
                                    <input type="number" wire:model.live.debounce-500ms="min_price" placeholder="Min" class="w-25 px-2 py-1 rounded text-xs border border-teal-300 dark:border-teal-800 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:border-teal-500 dark:focus:border-teal-400 focus:outline-none focus:ring-1.5 focus:ring-teal-300 dark:focus:ring-teal-900/50 transition-all font-semibold shadow-sm hover:shadow-md text-center" />
                                    <input type="number" wire:model.live.debounce-500ms="max_price" placeholder="Max" class="w-25 px-2 py-1 rounded text-xs border border-teal-300 dark:border-teal-800 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:border-teal-500 dark:focus:border-teal-400 focus:outline-none focus:ring-1.5 focus:ring-teal-300 dark:focus:ring-teal-900/50 transition-all font-semibold shadow-sm hover:shadow-md text-center" />
                                </div>
                            </div>
                        </div>

                        <!-- Reset Button -->
                        <button
                            wire:click="resetFilters"
                            class="w-full mt-6 py-2.5 px-4 bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 hover:from-blue-700 hover:to-cyan-700 dark:hover:from-blue-600 dark:hover:to-cyan-600 text-white font-bold rounded-lg transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:shadow-blue-500/40 dark:shadow-blue-500/20 transform hover:scale-105 active:scale-95 text-sm"
                        >
                            <x-heroicon-o-arrow-path class="w-4 h-4" />
                            Reset All
                        </button>
                    </div>
                </div>
            </div>

            <!-- ==================== RESULTS AREA ==================== -->
            <div class="lg:col-span-3">
                <!-- Results Header -->
                <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl blur-lg opacity-40"></div>
                            <div class="relative w-14 h-14 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 flex items-center justify-center shadow-lg text-white font-black text-xl">
                                {{ $venueCount }}
                            </div>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black text-zinc-900 dark:text-white">Results</h2>
                            <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 mt-1">Premium wedding venues</p>
                        </div>
                    </div>

                    @if($venueCount > 0)
                        <div class="flex items-center gap-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg px-4 py-2 border border-zinc-200 dark:border-zinc-700 shadow-sm hover:shadow-md transition-all">
                            <span class="text-xs font-bold text-zinc-600 dark:text-zinc-400 uppercase">Sort:</span>
                            <select wire:model.live="sort_by" class="bg-transparent text-sm font-semibold text-zinc-900 dark:text-white focus:outline-none">
                                <option value="created_at">Newest</option>
                                <option value="price">Price: Low to High</option>
                                <option value="capacity">Capacity</option>
                                <option value="name">Name A-Z</option>
                            </select>
                            <button wire:click="$set('sort_order', '{{ $sort_order === 'asc' ? 'desc' : 'asc' }}')" class="p-1.5 hover:bg-zinc-200 dark:hover:bg-zinc-700 rounded transition-colors">
                                <x-heroicon-o-chevron-up class="w-4 h-4 text-zinc-600 dark:text-zinc-400 {{ $sort_order === 'desc' ? 'rotate-180' : '' }}" />
                            </button>
                        </div>
                    @endif
                </div>

                @if($venues->count() > 0)
                    <!-- Venue Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        @foreach($venues as $venue)
                            <div class="group relative bg-white dark:bg-zinc-800 rounded-2xl shadow-md dark:shadow-lg dark:shadow-black/30 overflow-hidden hover:shadow-xl dark:hover:shadow-blue-900/30 transition-all duration-500 transform hover:-translate-y-1 border border-zinc-200 dark:border-zinc-700 hover:border-blue-300 dark:hover:border-blue-700 flex flex-col">
                                <!-- Image Container -->
                                <div class="relative h-56 bg-gradient-to-br from-zinc-200 to-zinc-300 dark:from-zinc-700 dark:to-zinc-600 overflow-hidden">
                                    @if($venue->images && is_array($venue->images) && count($venue->images) > 0)
                                        <img src="{{ asset('images/extra/' . basename($venue->images[0])) }}" alt="{{ $venue->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" onerror="this.src='{{ asset('images/extra/1.webp') }}'" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-zinc-300 dark:from-zinc-600 to-zinc-400 dark:to-zinc-700">
                                            <x-heroicon-o-photo class="w-16 h-16 text-zinc-400 dark:text-zinc-500" />
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                    <!-- Price Badge -->
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-emerald-500 to-teal-500 dark:from-emerald-500 dark:to-teal-500 text-white px-3 py-1.5 rounded-lg font-bold text-sm shadow-lg transform group-hover:scale-110 transition-transform flex items-center gap-1">
                                        <x-heroicon-o-currency-dollar class="w-4 h-4" />
                                        {{ number_format($venue->price, 0) }}
                                    </div>

                                    <!-- Capacity Badge -->
                                    <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                                        <x-heroicon-o-users class="w-4 h-4" />
                                        {{ $venue->capacity }}
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        {{ $venue->name }}
                                    </h3>

                                    <div class="flex items-center gap-2 text-zinc-600 dark:text-zinc-400 text-sm mb-4 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        <x-heroicon-o-map-pin class="w-4 h-4 flex-shrink-0 text-blue-600 dark:text-blue-400" />
                                        <span class="text-zinc-700 dark:text-zinc-300">{{ $venue->city }}, {{ $venue->country }}</span>
                                    </div>

                                    <!-- Services Tags -->
                                    @if($venue->extra_services && is_array($venue->extra_services) && count($venue->extra_services) > 0)
                                        <div class="flex flex-wrap gap-1.5 mb-4 mt-auto">
                                            @foreach(array_slice($venue->extra_services, 0, 2) as $service)
                                                <span class="inline-block text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-2 py-1 rounded font-semibold border border-blue-200 dark:border-blue-800">
                                                    {{ $service }}
                                                </span>
                                            @endforeach
                                            @if(count($venue->extra_services) > 2)
                                                <span class="inline-block text-xs bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-300 px-2 py-1 rounded font-semibold">
                                                    +{{ count($venue->extra_services) - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- CTA Button -->
                                    <a href="{{ auth('host')->check() ? route('host.venues.detail', $venue->id) : route('wedding-venues.detail', $venue->id) }}" class="inline-flex items-center justify-center gap-2 mt-4 w-full py-2.5 px-4 bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 hover:from-blue-700 hover:to-cyan-700 dark:hover:from-blue-600 dark:hover:to-cyan-600 text-white font-bold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95 text-sm">
                                        View Details
                                        <x-heroicon-o-arrow-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($venues->hasPages())
                        <div class="mt-8">
                            {{ $venues->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="bg-zinc-50 dark:bg-zinc-800 rounded-2xl shadow-lg p-16 text-center border-2 border-dashed border-zinc-300 dark:border-zinc-700">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <x-heroicon-o-magnifying-glass class="w-12 h-12 text-blue-600 dark:text-blue-400" />
                        </div>
                        <h3 class="text-3xl font-black text-zinc-900 dark:text-white mb-3">No Results Found</h3>
                        <p class="text-zinc-600 dark:text-zinc-400 max-w-md mx-auto mb-8 font-medium">
                            No venues match your current search criteria. Try adjusting your filters!
                        </p>
                        <button wire:click="resetFilters" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-600 dark:from-blue-500 dark:to-cyan-500 hover:from-blue-700 hover:to-cyan-700 dark:hover:from-blue-600 dark:hover:to-cyan-600 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95">
                            <x-heroicon-o-arrow-path class="w-5 h-5" />
                            Reset Filters
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>