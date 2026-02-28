<div class="min-h-screen bg-gray-50 dark:bg-zinc-950">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Welcome Card - Full Width -->
        <div class="mb-8">
            <div class="bg-gradient-to-br from-green-500 via-green-600 to-green-700 dark:from-stone-950 dark:via-stone-950 dark:to-gray-950 rounded-3xl shadow-xl overflow-hidden">
                <div class="relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mt-48"></div>
                        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mb-48"></div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative px-8 lg:px-16 py-12 lg:py-16">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                            <!-- Left Side -->
                            <div class="text-white">
                                <p class="text-sm font-medium text-green-100 mb-2">Welcome back to WedbookI</p>
                                <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $vendor->full_name ?? 'Vendor' }}</h1>
                                <p class="text-green-100 text-lg leading-relaxed mb-8">Track your bookings, manage availability, and grow your wedding business with ease. Your dashboard shows everything you need to succeed.</p>
                                
                                <div class="flex gap-4 flex-wrap">
                                    <button class="bg-white text-green-600 px-8 py-3 rounded-xl font-semibold hover:bg-green-50 transition-all hover:shadow-lg flex items-center gap-2">
                                        <flux:icon.rocket-launch class="w-5 h-5" />
                                        Boost Profile
                                    </button>
                                    <button class="border-2 border-white text-white px-8 py-3 rounded-xl font-semibold hover:bg-white hover:bg-opacity-10 transition-all flex items-center gap-2">
                                        <flux:icon.pencil-square class="w-5 h-5" />
                                        Edit Profile
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Right Side - Avatar -->
                            <div class="hidden lg:flex justify-center">
                                <div class="w-40 h-40 rounded-full bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center text-7xl font-bold text-white border-4 border-white border-opacity-30 shadow-2xl">
                                    {{ $vendor->initials() ?? 'V' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Stats Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Page Visitors -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-4 shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-md hover:border-pink-500 transition-all duration-300 cursor-pointer group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <flux:icon.eye class="w-5 h-5 text-pink-500" />
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-gray-600 dark:text-gray-400">Page Visitors</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pageVisitors }}</p>
                </div>
            </div>

            <!-- Total Bookings -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-4 shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-md hover:border-amber-500 transition-all duration-300 cursor-pointer group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <flux:icon.calendar class="w-5 h-5 text-amber-500" />
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-gray-600 dark:text-gray-400">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalBookings }}</p>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-4 shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-md hover:border-green-500 transition-all duration-300 cursor-pointer group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <flux:icon.banknotes class="w-5 h-5 text-green-500" />
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-gray-600 dark:text-gray-400">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rs {{ number_format($totalRevenue, 2) }}</p>
                </div>
            </div>

            <!-- Social Clicks -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl p-4 shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-md hover:border-purple-500 transition-all duration-300 cursor-pointer group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <flux:icon.share class="w-5 h-5 text-purple-500" />
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-xs text-gray-600 dark:text-gray-400">Social Clicks</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $socialClicks }}</p>
                </div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column - Recent Bookings & Reviews -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Recent Bookings -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-zinc-800">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                    <flux:icon.document-text class="w-5 h-5 text-green-600 dark:text-green-400" />
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Recent Bookings</h2>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Your latest booking requests</p>
                                </div>
                            </div>
                            <a href="{{ route('vendor.bookings') }}" class="text-green-600 dark:text-green-400 text-sm font-semibold hover:underline flex items-center gap-1">
                                View All
                                <flux:icon.arrow-right class="w-4 h-4" />
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-zinc-800/50">
                                <tr class="border-b border-gray-200 dark:border-zinc-800">
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">ID</th>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Created</th>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Amount</th>
                                    <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                                @forelse($recentBookings as $booking)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                                        <td class="px-6 py-4 font-mono text-gray-900 dark:text-white font-medium">{{ $booking['id'] }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $booking['created'] }}</td>
                                        <td class="px-6 py-4">
                                            @if($booking['status_color'] === 'green')
                                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-medium">
                                                    <span class="w-2 h-2 rounded-full bg-green-600"></span>
                                                    {{ $booking['status'] }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-medium">
                                                    <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                                    {{ $booking['status'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $booking['amount'] }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <button class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                                                <flux:icon.ellipsis-vertical class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            No bookings yet. Start by creating your first booking!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Latest Reviews -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                            <flux:icon.star class="w-5 h-5 text-amber-500" />
                        </div>
                        Latest Reviews
                    </h2>

                    <div class="space-y-4">
                        @forelse($reviews as $review)
                            <div class="p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 border border-gray-200 dark:border-zinc-700 hover:border-gray-300 dark:hover:border-zinc-600 transition-colors">
                                <div class="flex gap-4 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $review['avatar_color'] }} flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ substr($review['name'], 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $review['name'] }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $review['date'] }}</p>
                                        </div>
                                        <div class="flex gap-1 mt-2">
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < $review['rating'])
                                                    <flux:icon.star class="w-3 h-3 text-amber-400 fill-current" />
                                                @else
                                                    <flux:icon.star class="w-3 h-3 text-gray-300 dark:text-gray-600" />
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ $review['comment'] }}</p>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <p class="text-sm">No reviews yet. Great work will bring amazing reviews!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right Column - Quick Actions & More -->
            <div class="space-y-8">
                
                <!-- Quick Actions -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <flux:icon.bolt class="w-5 h-5 text-amber-500" />
                        Quick Actions
                    </h2>

                    <div class="space-y-3">
                        @php
                            $actions = [
                                ['icon' => 'calendar-days', 'title' => 'Update Availability', 'subtitle' => 'Set your dates', 'color' => 'green'],
                                ['icon' => 'cube', 'title' => 'Create Package', 'subtitle' => 'Define packages', 'color' => 'blue'],
                                ['icon' => 'chat-bubble-left', 'title' => 'Message Clients', 'subtitle' => 'Respond to inquiries', 'color' => 'purple'],
                            ];
                        @endphp

                        @foreach($actions as $action)
                            <button class="w-full flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-gray-100 dark:hover:bg-zinc-700 transition-all group border border-gray-200 dark:border-zinc-700 hover:border-{{ $action['color'] }}-300">
                                <div class="w-10 h-10 rounded-lg bg-{{ $action['color'] }}-100 dark:bg-{{ $action['color'] }}-900/30 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                                    @if($action['icon'] === 'calendar-days')
                                        <flux:icon.calendar-days class="w-5 h-5 text-{{ $action['color'] }}-600 dark:text-{{ $action['color'] }}-400" />
                                    @elseif($action['icon'] === 'cube')
                                        <flux:icon.cube class="w-5 h-5 text-{{ $action['color'] }}-600 dark:text-{{ $action['color'] }}-400" />
                                    @elseif($action['icon'] === 'chat-bubble-left')
                                        <flux:icon.chat-bubble-left class="w-5 h-5 text-{{ $action['color'] }}-600 dark:text-{{ $action['color'] }}-400" />
                                    @endif
                                </div>
                                <div class="text-left flex-1">
                                    <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $action['title'] }}</h4>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $action['subtitle'] }}</p>
                                </div>
                                <flux:icon.arrow-right class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover:translate-x-1 transition-transform" />
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Credits Card -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-900 dark:text-white">Available Credits</h3>
                        <flux:icon.gift class="w-5 h-5 text-amber-500" />
                    </div>
                    <div class="mb-4">
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">{{ number_format($credits, 0) }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Credits available to use</p>
                    </div>
                    <button class="w-full text-green-600 dark:text-green-400 text-sm font-semibold hover:underline flex items-center justify-center gap-1 py-2">
                        Purchase more credits
                        <flux:icon.arrow-right class="w-4 h-4" />
                    </button>
                </div>

                <!-- Rating Summary -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-6">Overall Rating</h3>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-gray-900 dark:text-white mb-2">{{ $rating }}</div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Out of 5 ({{ $ratingCount }} {{ Str::plural('review', $ratingCount) }})</p>
                        <div class="flex justify-center gap-2">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($rating))
                                    <flux:icon.star class="w-5 h-5 text-amber-400 fill-current" />
                                @elseif($i < $rating)
                                    <flux:icon.star class="w-5 h-5 text-amber-300 fill-current" />
                                @else
                                    <flux:icon.star class="w-5 h-5 text-gray-300 dark:text-gray-600" />
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>