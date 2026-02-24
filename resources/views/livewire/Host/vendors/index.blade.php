<div class="max-w-7xl mx-auto">
    <!-- Header with search and actions -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-purple-600 bg-clip-text text-transparent">
                My Vendors
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                You've hired <span class="font-semibold text-emerald-600 dark:text-emerald-500">6</span> of <span class="font-semibold">18</span> categories
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Search bar -->
            <div class="relative">
                <!-- Magnifying glass icon (inline SVG) -->
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Search vendors..."
                       class="pl-10 pr-4 py-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none transition w-full sm:w-64" />
            </div>

            <!-- Tabs (Hired / Favourites) -->
            <div class="flex bg-gray-100 dark:bg-gray-800 p-1 rounded-xl">
                <button class="px-4 py-2 text-sm font-medium rounded-lg bg-white dark:bg-gray-900 shadow-sm text-gray-900 dark:text-white">
                    Hired
                </button>
                <button class="px-4 py-2 text-sm font-medium rounded-lg text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-700">
                    Favourites
                </button>
            </div>

            <!-- Add vendor button -->
            <button class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-colors">
                <!-- Plus icon (inline SVG) -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add Vendor</span>
            </button>
        </div>
    </div>

    <!-- Categories grid -->
    <div class="space-y-6">
        @php
            $categories = [
                [
                    'name' => 'Cakes & Bakes',
                    'icon' => 'heart',
                    'hired' => 0,
                    'total' => 3,
                    'vendors' => [],
                ],
                [
                    'name' => 'Prestige Drive UK',
                    'icon' => 'truck',
                    'hired' => 1,
                    'total' => 2,
                    'vendors' => [
                        ['name' => 'Prestige Cars', 'hired' => 1, 'total' => 2, 'status' => 'hired'],
                    ],
                ],
                [
                    'name' => 'Carts & Stalls',
                    'icon' => 'shopping-cart',
                    'hired' => 0,
                    'total' => 4,
                    'vendors' => [],
                ],
                [
                    'name' => 'Catering',
                    'icon' => 'fire',
                    'hired' => 0,
                    'total' => 5,
                    'vendors' => [],
                ],
                [
                    'name' => 'Décor',
                    'icon' => 'sparkles',
                    'hired' => 2,
                    'total' => 4,
                    'vendors' => [
                        ['name' => 'Bloom & Petal', 'hired' => 1, 'total' => 1, 'status' => 'hired'],
                        ['name' => 'Elegant Settings', 'hired' => 1, 'total' => 2, 'status' => 'hired'],
                    ],
                ],
            ];

            // Map icon keys to inline SVG paths
            $icons = [
                'heart' => '<svg class="w-6 h-6 text-emerald-700 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>',
                'truck' => '<svg class="w-6 h-6 text-emerald-700 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" /></svg>',
                'shopping-cart' => '<svg class="w-6 h-6 text-emerald-700 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',
                'fire' => '<svg class="w-6 h-6 text-emerald-700 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" /></svg>',
                'sparkles' => '<svg class="w-6 h-6 text-emerald-700 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>',
                'building-office' => '<svg class="w-6 h-6 text-emerald-700 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
            ];
        @endphp

        @foreach ($categories as $category)
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <!-- Category header with progress -->
                <div class="p-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <!-- Icon -->
                            <div class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl">
                                {!! $icons[$category['icon']] ?? $icons['building-office'] !!}
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold">{{ $category['name'] }}</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $category['hired'] }} of {{ $category['total'] }} vendors hired
                                </p>
                            </div>
                        </div>
                        <button class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 dark:text-emerald-500 hover:underline">
                            <!-- Plus circle icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Book More
                        </button>
                    </div>

                    <!-- Progress bar -->
                    @if ($category['total'] > 0)
                        <div class="mt-4 h-2 w-full bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-purple-500 rounded-full transition-all duration-500"
                                 style="width: {{ ($category['hired'] / $category['total']) * 100 }}%"></div>
                        </div>
                    @endif
                </div>

                <!-- Hired vendors list (if any) -->
                @if (!empty($category['vendors']))
                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach ($category['vendors'] as $vendor)
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center text-emerald-700 dark:text-emerald-400 font-semibold">
                                        {{ substr($vendor['name'], 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $vendor['name'] }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $vendor['hired'] }} of {{ $vendor['total'] }} services booked
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 text-xs bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full">Hired</span>
                                    <button class="text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-500 transition-colors">
                                        <!-- Ellipsis vertical icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty state for category -->
                    <div class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-3">
                            <!-- Building storefront icon -->
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">No vendors hired yet</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Browse vendors to get started</p>
                        <button class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl transition-colors">
                            <!-- Magnifying glass icon -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse {{ $category['name'] }}
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
