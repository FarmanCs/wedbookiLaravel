<div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Page Visitors -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-800 hover:shadow-md hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">2,458</div>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">Page Visitors</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-800 hover:shadow-md hover:border-yellow-500 dark:hover:border-yellow-400 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">48</div>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">Total Bookings</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-800 hover:shadow-md hover:border-green-500 dark:hover:border-green-400 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2">₨450,250</div>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">Total Revenue</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Social Clicks -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-800 hover:shadow-md hover:border-purple-500 dark:hover:border-purple-400 transition-all duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">1,235</div>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm">Social Clicks</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Section: Recent Bookings & Reviews (2 columns) -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Recent Bookings Table -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Recent Bookings</h2>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm mt-1">Your latest booking requests</p>
                        </div>
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition text-sm font-medium flex items-center gap-1">
                            View All →
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                            <tr class="border-b border-zinc-200 dark:border-zinc-800">
                                <th class="text-left py-3 px-4 text-zinc-600 dark:text-zinc-400 font-semibold">ID</th>
                                <th class="text-left py-3 px-4 text-zinc-600 dark:text-zinc-400 font-semibold">Event Date</th>
                                <th class="text-left py-3 px-4 text-zinc-600 dark:text-zinc-400 font-semibold">Created</th>
                                <th class="text-left py-3 px-4 text-zinc-600 dark:text-zinc-400 font-semibold">Package</th>
                                <th class="text-left py-3 px-4 text-zinc-600 dark:text-zinc-400 font-semibold">Status</th>
                                <th class="text-left py-3 px-4 text-zinc-600 dark:text-zinc-400 font-semibold">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                                <td class="py-4 px-4 font-medium text-zinc-900 dark:text-white">#BK-2024-001</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Mar 15, 2025</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Dec 10, 2024</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Premium</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">Confirmed</span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-green-600 dark:text-green-400">₨85,000</td>
                            </tr>
                            <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                                <td class="py-4 px-4 font-medium text-zinc-900 dark:text-white">#BK-2024-002</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Apr 02, 2025</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Dec 08, 2024</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Gold</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">Pending</span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-yellow-600 dark:text-yellow-400">₨62,500</td>
                            </tr>
                            <tr class="border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                                <td class="py-4 px-4 font-medium text-zinc-900 dark:text-white">#BK-2024-003</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">May 20, 2025</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Dec 05, 2024</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Premium</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">Confirmed</span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-green-600 dark:text-green-400">₨95,000</td>
                            </tr>
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                                <td class="py-4 px-4 font-medium text-zinc-900 dark:text-white">#BK-2024-004</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Feb 28, 2025</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Dec 02, 2024</td>
                                <td class="py-4 px-4 text-zinc-600 dark:text-zinc-400">Standard</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800">Cancelled</span>
                                </td>
                                <td class="py-4 px-4 font-semibold text-red-600 dark:text-red-400">₨45,000</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Latest Reviews -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Latest Reviews</h2>
                                <p class="text-zinc-600 dark:text-zinc-400 text-sm mt-1">What your clients are saying</p>
                            </div>
                        </div>
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition text-sm font-medium">View All →</a>
                    </div>

                    <div class="space-y-6">
                        <!-- Review 1 -->
                        <div class="flex gap-4 pb-6 border-b border-zinc-200 dark:border-zinc-800">
                            <div class="w-12 h-12 rounded-full bg-blue-600 dark:bg-blue-500 flex-shrink-0 flex items-center justify-center text-white font-bold">S</div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">Sarah Ahmed</h3>
                                        <p class="text-zinc-500 dark:text-zinc-500 text-xs">2 days ago</p>
                                    </div>
                                    <div class="flex gap-1">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-zinc-700 dark:text-zinc-300 text-sm">Absolutely fantastic service! The team was professional and attentive throughout the entire event. Highly recommended!</p>
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="flex gap-4 pb-6 border-b border-zinc-200 dark:border-zinc-800">
                            <div class="w-12 h-12 rounded-full bg-orange-600 dark:bg-orange-500 flex-shrink-0 flex items-center justify-center text-white font-bold">M</div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">Mohammad Hassan</h3>
                                        <p class="text-zinc-500 dark:text-zinc-500 text-xs">5 days ago</p>
                                    </div>
                                    <div class="flex gap-1">
                                        @for($i = 0; $i < 4; $i++)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        <svg class="w-4 h-4 text-zinc-300 dark:text-zinc-700" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-zinc-700 dark:text-zinc-300 text-sm">Great experience! Everything was perfectly organized. Would definitely book again for future events.</p>
                            </div>
                        </div>

                        <!-- Review 3 -->
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-600 dark:bg-purple-500 flex-shrink-0 flex items-center justify-center text-white font-bold">F</div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-white">Fatima Khan</h3>
                                        <p class="text-zinc-500 dark:text-zinc-500 text-xs">1 week ago</p>
                                    </div>
                                    <div class="flex gap-1">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-zinc-700 dark:text-zinc-300 text-sm">Outstanding work! The attention to detail was remarkable. Thank you for making our day so special!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Sidebar (1 column) -->
        <div class="space-y-6">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-14 h-14 rounded-lg bg-blue-600 dark:bg-blue-500 flex items-center justify-center text-white font-bold text-xl">{{ substr(auth('vendor')->user()->full_name ?? 'A', 0, 1) }}</div>
                    <div>
                        <p class="text-zinc-500 dark:text-zinc-400 text-xs">Welcome back</p>
                        <h3 class="text-lg font-bold text-zinc-900 dark:text-white">{{ auth('vendor')->user()->full_name ?? 'Vendor' }}</h3>
                    </div>
                </div>

                <button class="w-full bg-blue-600 dark:bg-blue-600 hover:bg-blue-700 dark:hover:bg-blue-700 text-white font-medium px-4 py-3 rounded-lg mb-3 flex items-center justify-center gap-2 transition-all duration-200 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Boost Profile
                </button>

                <button class="w-full bg-orange-600 dark:bg-orange-600 hover:bg-orange-700 dark:hover:bg-orange-700 text-white font-medium px-4 py-3 rounded-lg flex items-center justify-center gap-2 transition-all duration-200 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Draft Profile
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-6">
                <h3 class="font-bold text-zinc-900 dark:text-white mb-4">Quick Actions</h3>

                <div class="space-y-3">
                    <a href="#" class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg transition group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-zinc-900 dark:text-white text-sm">Update Availability</p>
                                <p class="text-zinc-600 dark:text-zinc-400 text-xs">Set your available dates</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-zinc-400 dark:text-zinc-600 group-hover:text-zinc-600 dark:group-hover:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg transition group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-zinc-900 dark:text-white text-sm">Create Package</p>
                                <p class="text-zinc-600 dark:text-zinc-400 text-xs">Define new service packages</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-zinc-400 dark:text-zinc-600 group-hover:text-zinc-600 dark:group-hover:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="#" class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg transition group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-zinc-900 dark:text-white text-sm">Message Clients</p>
                                <p class="text-zinc-600 dark:text-zinc-400 text-xs">Respond to inquiries</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-zinc-400 dark:text-zinc-600 group-hover:text-zinc-600 dark:group-hover:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Credits Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl shadow-sm border border-blue-200 dark:border-blue-800/50 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-600 dark:bg-blue-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">₨250</div>
                </div>
                <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-4">Available Credits</p>
                <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition text-sm font-medium flex items-center gap-1">
                    Purchase credits →
                </a>
            </div>

        </div>

    </div>
</div>
