
<div>
    <!-- Header Section -->
    <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <div>
                <!-- Back Button -->
                <a href="{{ route('host.host-dashboard') }}"
                   class="inline-flex items-center text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 font-medium mb-2"
                   wire:navigate>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>

                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    WEDBOOKI VENDORS
                </h1>
            </div>


        </div>

        <p class="text-gray-600 dark:text-gray-300 text-lg">
            Find the best {{ strtolower($categoryName) }} services for your wedding
        </p>

        <!-- Results Count -->
        <div class="mt-4 flex items-center justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ count($vendors) }} RESULTS</span>
                <span class="mx-2">•</span>
                <span>Search results</span>
            </div>

            <!-- Sort Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        @click.away="open = false"
                        class="flex items-center space-x-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <span>Sort by: </span>
                    <span class="font-medium">
                        @if($sort === 'featured') Featured
                        @elseif($sort === 'price_low') Price: Low to High
                        @elseif($sort === 'price_high') Price: High to Low
                        @elseif($sort === 'rating') Highest Rated
                        @endif
                    </span>
                    <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-10"
                     style="display: none;">
                    <div class="py-1">
                        <button wire:click="$set('sort', 'featured')"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Featured
                        </button>
                        <button wire:click="$set('sort', 'rating')"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Highest Rated
                        </button>
                        <button wire:click="$set('sort', 'price_low')"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Price: Low to High
                        </button>
                        <button wire:click="$set('sort', 'price_high')"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Price: High to Low
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 sticky top-6">
                <!-- Category Filter -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Category
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="radio" id="cat-all" name="category" value="all"
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600"
                                   checked>
                            <label for="cat-all" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ $categoryName }}
                            </label>
                        </div>

                        <!-- Subcategories -->
                        @if(count($subcategories) > 0)
                            <div class="ml-6 space-y-2 mt-3">
                                @foreach(array_slice($subcategories, 0, 6) as $subcategory)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="sub-{{ Str::slug($subcategory) }}"
                                               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 dark:border-gray-600 rounded">
                                        <label for="sub-{{ Str::slug($subcategory) }}"
                                               class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $subcategory }}
                                        </label>
                                    </div>
                                @endforeach

                                @if(count($subcategories) > 6)
                                    <button class="text-purple-600 dark:text-purple-400 text-sm font-medium mt-2 hover:text-purple-800 dark:hover:text-purple-300">
                                        Show {{ count($subcategories) - 6 }} More
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Country Filter -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Country
                    </h3>
                    <div class="relative">
                        <select wire:model.live="country"
                                class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2.5">
                            <option value="all">All Countries</option>
                            <option value="uk">United Kingdom</option>
                            <option value="us">United States</option>
                            <option value="fr">France</option>
                            <option value="ie">Ireland</option>
                            <option value="au">Australia</option>
                            <option value="ca">Canada</option>
                        </select>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        Price Range
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">$100</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">$1000+</span>
                        </div>
                        <input type="range" min="100" max="1000" value="500"
                               class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer">
                    </div>
                </div>

            </div>
        </div>

        <!-- Vendor List -->
        <div class="lg:col-span-3">
            @if(count($vendors) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach($vendors as $vendor)
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200 dark:border-gray-700">
                            <!-- Vendor Image -->
                            <div class="h-56 overflow-hidden bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/20 dark:to-pink-900/20 relative">
                                <!-- You can replace with actual image -->
                                <div class="w-full h-full flex items-center justify-center">
                                    @if($category === 'car-rentals')
                                        <svg class="w-20 h-20 text-purple-300 dark:text-purple-700" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                        </svg>
                                    @endif
                                </div>
                                <!-- Save Button -->
                                <button class="absolute top-4 right-4 p-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-full hover:bg-white dark:hover:bg-gray-700 transition-colors">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Vendor Details -->
                            <div class="p-6">
                                <!-- Vendor Header -->
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                                            {{ $vendor['name'] }}
                                        </h3>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= floor($vendor['rating']) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
                                                         fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                @endfor
                                                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                                    {{ number_format($vendor['rating'], 1) }} ({{ $vendor['review_count'] }})
                                                </span>
                                            </div>
                                            <span class="text-gray-400">•</span>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $vendor['location'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                                    {{ $vendor['description'] }}
                                </p>

                                <!-- Features/Tags -->
                                <div class="mb-6">
                                    @foreach($vendor['features'] as $feature)
                                        <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-3 py-1.5 rounded-lg mr-2 mb-2">
                                            📍 {{ $feature }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Price and CTA -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Starting from</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                            {{ $vendor['currency'] }} {{ number_format($vendor['price'], 2) }}
                                        </p>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button class="px-5 py-2.5 border border-purple-600 text-purple-600 dark:text-purple-400 dark:border-purple-400 rounded-lg font-medium hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                                            View Details
                                        </button>
                                        <button class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
                                            Check Availability
                                        </button>
                                    </div>
                                </div>

                                <!-- Response Time -->
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 text-center">
                                    {{ $vendor['response_time'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button -->
                <div class="mt-8 text-center">
                    <button class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        Load More Vendors
                    </button>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No vendors found</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        No {{ strtolower($categoryName) }} services found for your selected filters.
                    </p>
                    <button class="mt-4 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
                        Clear Filters
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Filter Button -->
    <div class="lg:hidden fixed bottom-6 left-1/2 transform -translate-x-1/2">
        <button class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full font-medium shadow-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <span>Filter & Sort</span>
        </button>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>


