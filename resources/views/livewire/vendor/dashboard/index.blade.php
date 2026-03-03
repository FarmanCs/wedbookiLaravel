<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-zinc-950 dark:to-zinc-900">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Welcome Card - Full Width -->
        <div class="mb-8 animate-fade-in">
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
                                <p class="text-green-100 text-lg leading-relaxed mb-8">
                                    {{ $vendor->about ?: 'No description provided yet.' }}
                                </p>
                                
                                <div class="flex gap-4 flex-wrap">
                                   <!-- Boost Business Modal -->
@if($showBoostModal)
    <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800 animate-scale-up">
            <!-- Header -->
            <div class="bg-gradient-to-r from-amber-500 to-orange-600 dark:from-amber-700 dark:to-orange-800 px-6 py-6 flex items-center justify-between border-b border-amber-600/50 dark:border-amber-900/50 shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                        <flux:icon.rocket-launch class="w-6 h-6 text-white" />
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Boost Your Business</h2>
                    </div>
                </div>
                <button wire:click="closeBoostModal" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                    <flux:icon.x-mark class="w-6 h-6" />
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Business to Boost</label>
                    <select wire:model="boostBusinessId" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">Choose a business</option>
                        @foreach($boostBusinesses as $business)
                            <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-lg p-4">
                    <p class="text-sm text-amber-800 dark:text-amber-200 flex items-center gap-2">
                        <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                        Boosting your business makes it appear more prominently in search results and increases visibility.
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 shadow-lg">
                <button wire:click="closeBoostModal" class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600">Cancel</button>
                <button wire:click="confirmBoost" class="px-6 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-semibold shadow-md flex items-center gap-2">
                    <flux:icon.check class="w-5 h-5" /> Confirm Boost
                </button>
            </div>
        </div>
    </div>
@endif
                                    <button wire:click="openProfileModal" class="border-2 border-white text-white px-8 py-3 rounded-xl font-semibold hover:bg-white hover:bg-opacity-10 transition-all flex items-center gap-2 group">
                                        <flux:icon.pencil-square class="w-5 h-5 group-hover:scale-110 transition-transform" />
                                        Edit Profile
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Right Side - Avatar -->
                            <div class="hidden lg:flex justify-center">
                                <div class="w-40 h-40 rounded-full bg-white bg-opacity-20 backdrop-blur-sm flex items-center justify-center text-7xl font-bold text-white border-4 border-white border-opacity-30 shadow-2xl hover:scale-105 transition-transform duration-300">
                                    {{ $vendor->initials() }}
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming Events Countdown (if exists) -->
                        @if(!empty($upcomingEvents))
                            <div class="mt-8 pt-8 border-t border-white/20">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ count($upcomingEvents) > 3 ? '3' : count($upcomingEvents) }} gap-4">
                                    @foreach($upcomingEvents as $event)
                                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all">
                                            <div class="flex items-start justify-between mb-3">
                                                <div>
                                                    <p class="text-xs text-green-100 font-semibold uppercase tracking-wider">Upcoming Event</p>
                                                    <h3 class="text-white font-bold text-sm mt-1">{{ $event['host_name'] }}</h3>
                                                </div>
                                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-white/20 text-white text-xs font-bold">
                                                    <flux:icon.clock class="w-3.5 h-3.5" />
                                                    {{ $event['days_until'] }}d
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2 text-green-100 text-xs">
                                                <flux:icon.calendar class="w-3.5 h-3.5" />
                                                {{ \Carbon\Carbon::parse($event['event_date'])->format('d M Y') }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800/50 flex items-center gap-3 shadow-sm animate-slide-down">
                <flux:icon.check-circle class="w-6 h-6 text-green-600 dark:text-green-400 flex-shrink-0" />
                <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border border-red-200 dark:border-red-800/50 flex items-center gap-3 shadow-sm animate-slide-down">
                <flux:icon.x-circle class="w-6 h-6 text-red-600 dark:text-red-400 flex-shrink-0" />
                <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Top Stats Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
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
                        <x-heroicon-o-currency-dollar class="w-5 h-5 text-amber-500"/>
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
            
            <!-- Left Column - Recent Bookings -->
            <div class="lg:col-span-2 space-y-8 animate-fade-in" style="animation-delay: 0.2s;">
                
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
                                        <td class="px-6 py-4 font-mono text-gray-900 dark:text-white font-medium">{{ $booking['custom_id'] }}</td>
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
                        @if(empty($reviews))
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <p class="text-sm">No reviews yet. Great work will bring amazing reviews!</p>
                            </div>
                        @else
                            @foreach($reviews as $review)
                                <div class="p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 border border-gray-200 dark:border-zinc-700">
                                    <div class="flex gap-4 mb-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                            {{ substr($review['name'], 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $review['name'] }}</h4>
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
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $review['comment'] }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right Column - Quick Actions & More -->
            <div class="space-y-8 animate-fade-in" style="animation-delay: 0.3s;">
                
                <!-- Quick Actions -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <flux:icon.bolt class="w-5 h-5 text-amber-500" />
                        Quick Actions
                    </h2>

                    <div class="space-y-3">
                        <!-- Manage Businesses -->
                        <button wire:click="openBusinessModal" class="w-full flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all group border border-gray-200 dark:border-zinc-700 hover:border-indigo-300 dark:hover:border-indigo-700">
                            <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                                <flux:icon.building-office class="w-5 h-5 text-indigo-600 dark:text-indigo-400" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Manage Businesses</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Add or edit your businesses</p>
                            </div>
                            <flux:icon.arrow-right class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover:translate-x-1 transition-transform" />
                        </button>

                        <!-- Update Availability -->
                        <button wire:click="openAvailabilityModal" class="w-full flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all group border border-gray-200 dark:border-zinc-700 hover:border-green-300 dark:hover:border-green-700">
                            <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                                <flux:icon.calendar-days class="w-5 h-5 text-green-600 dark:text-green-400" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Update Availability</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Set your dates</p>
                            </div>
                            <flux:icon.arrow-right class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover:translate-x-1 transition-transform" />
                        </button>

                        <!-- Create Package -->
                        <button wire:click="openPackageModal" class="w-full flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all group border border-gray-200 dark:border-zinc-700 hover:border-blue-300 dark:hover:border-blue-700">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                                <flux:icon.cube class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Create Package</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Define packages</p>
                            </div>
                            <flux:icon.arrow-right class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover:translate-x-1 transition-transform" />
                        </button>

                        <!-- Message Clients -->
                        <button wire:click="openMessageModal" class="w-full flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-800/50 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all group border border-gray-200 dark:border-zinc-700 hover:border-purple-300 dark:hover:border-purple-700">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                                <flux:icon.chat-bubble-left class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white text-sm">Message Clients</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Respond to inquiries</p>
                            </div>
                            <flux:icon.arrow-right class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover:translate-x-1 transition-transform" />
                        </button>
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
                    <button class="w-full text-green-600 dark:text-green-400 text-sm font-semibold hover:underline flex items-center justify-center gap-1 py-2 transition-colors hover:text-green-700 dark:hover:text-green-300">
                        Purchase more credits
                        <flux:icon.arrow-right class="w-4 h-4" />
                    </button>
                </div>

                <!-- Rating Summary -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-6">Overall Rating</h3>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-gray-900 dark:text-white mb-2">{{ number_format($rating, 1) }}</div>
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

    <!-- ========== MODALS ========== -->

    <!-- Update Availability Modal -->
    @if($showAvailabilityModal)
        <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800 animate-scale-up">
                <!-- Header -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 dark:from-green-700 dark:to-green-800 px-6 py-6 flex items-center justify-between border-b border-green-600/50 dark:border-green-900/50 shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.calendar-days class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Update Availability</h2>
                        </div>
                    </div>
                    <button wire:click="closeAvailabilityModal" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Business</label>
                        <select wire:model="selectedBusiness" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Choose a business</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Slot Duration (minutes)</label>
                        <input type="number" wire:model="slotDuration" min="15" max="480" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="60" />
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 rounded-lg p-4">
                        <p class="text-sm text-green-800 dark:text-green-200 flex items-center gap-2">
                            <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                            Set your availability slot duration for bookings.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 shadow-lg">
                    <button wire:click="closeAvailabilityModal" class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600">Cancel</button>
                    <button wire:click="saveAvailability" class="px-6 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow-md flex items-center gap-2">
                        <flux:icon.check class="w-5 h-5" /> Save
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Create Package Modal -->
    @if($showPackageModal)
        <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
                <!-- Header -->
                <div class="sticky top-0 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 px-6 py-6 flex items-center justify-between border-b border-blue-600/50 dark:border-blue-900/50 shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.cube class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Create Package</h2>
                        </div>
                    </div>
                    <button wire:click="closePackageModal" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Business</label>
                        <select wire:model="selectedBusiness" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Choose a business</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Package Name</label>
                        <input type="text" wire:model="packageName" placeholder="e.g., Gold Package" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price (Rs)</label>
                        <input type="number" wire:model="packagePrice" placeholder="5000" min="0" step="100" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Discount (Rs) - Optional</label>
                        <input type="number" wire:model="packageDiscount" placeholder="0" min="0" step="100" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea wire:model="packageDescription" placeholder="Describe your package..." rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Features (comma separated)</label>
                        <textarea wire:model="packageFeatures" placeholder="Feature 1, Feature 2, Feature 3" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="isPopular" id="isPopular" class="w-5 h-5 rounded-lg border-gray-300 dark:border-zinc-700 text-blue-600 focus:ring-2 focus:ring-blue-500 cursor-pointer" />
                        <label for="isPopular" class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">Mark as Popular Package</label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 shadow-lg">
                    <button wire:click="closePackageModal" class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600">Cancel</button>
                    <button wire:click="savePackage" class="px-6 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md flex items-center gap-2">
                        <flux:icon.check class="w-5 h-5" /> Create
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Message Clients Modal -->
    @if($showMessageModal)
        <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800 animate-scale-up">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 dark:from-purple-700 dark:to-purple-800 px-6 py-6 flex items-center justify-between border-b border-purple-600/50 dark:border-purple-900/50 shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.chat-bubble-left class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Message Clients</h2>
                        </div>
                    </div>
                    <button wire:click="closeMessageModal" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                        <input type="text" wire:model="messageSubject" placeholder="Message subject..." class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Message</label>
                        <textarea wire:model="messageBody" placeholder="Your message here..." rows="5" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 resize-none"></textarea>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/50 rounded-lg p-4">
                        <p class="text-sm text-purple-800 dark:text-purple-200 flex items-center gap-2">
                            <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                            Your message will be sent to interested clients.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 shadow-lg">
                    <button wire:click="closeMessageModal" class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600">Cancel</button>
                    <button wire:click="sendMessage" class="px-6 py-2.5 rounded-lg bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow-md flex items-center gap-2">
                        <flux:icon.check class="w-5 h-5" /> Send
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Profile Modal -->
    @if($showProfileModal)
        <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
                <!-- Header -->
                <div class="sticky top-0 bg-gradient-to-r from-indigo-500 to-indigo-600 dark:from-indigo-700 dark:to-indigo-800 px-6 py-6 flex items-center justify-between border-b border-indigo-600/50 dark:border-indigo-900/50 shadow-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.user-circle class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-lg font-bold text-white">Edit Profile</h2>
                    </div>
                    <button wire:click="closeProfileModal" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                        <input type="text" wire:model="profile.full_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" wire:model="profile.email" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                        <input type="text" wire:model="profile.phone_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country Code</label>
                        <input type="text" wire:model="profile.country_code" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">About</label>
                        <textarea wire:model="profile.about" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Profile Image</label>
                        <input type="file" wire:model="profile_image" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @if($profile_image_preview)
                            <img src="{{ $profile_image_preview }}" class="mt-2 w-20 h-20 rounded-full object-cover">
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 shadow-lg">
                    <button wire:click="closeProfileModal" class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600">Cancel</button>
                    <button wire:click="saveProfile" class="px-6 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md flex items-center gap-2">
                        <flux:icon.check class="w-5 h-5" /> Save
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Manage Business Modal -->
@if($showBusinessModal)
    <div class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
            <!-- Header -->
            <div class="sticky top-0 bg-gradient-to-r from-indigo-500 to-indigo-600 dark:from-indigo-700 dark:to-indigo-800 px-6 py-6 flex items-center justify-between border-b border-indigo-600/50 dark:border-indigo-900/50 shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                        <flux:icon.building-office class="w-6 h-6 text-white" />
                    </div>
                    <h2 class="text-lg font-bold text-white">{{ isset($businessForm['id']) ? 'Edit' : 'Add' }} Business</h2>
                </div>
                <button wire:click="closeBusinessModal" class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                    <flux:icon.x-mark class="w-6 h-6" />
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Business Name</label>
                    <input type="text" wire:model="businessForm.company_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g., Grand Marquee" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                    <select wire:model="businessForm.category_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea wire:model="businessForm.business_desc" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none" placeholder="Describe your business..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Business Email</label>
                    <input type="email" wire:model="businessForm.business_email" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="contact@example.com" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Business Phone</label>
                    <input type="text" wire:model="businessForm.business_phone" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="+92 300 1234567" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Street Address</label>
                    <input type="text" wire:model="businessForm.street_address" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="123 Main St" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">City</label>
                    <input type="text" wire:model="businessForm.city" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Lahore" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                    <input type="text" wire:model="businessForm.country" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Pakistan" />
                </div>
            </div>

            <!-- Footer -->
            <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 shadow-lg">
                <button wire:click="closeBusinessModal" class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600">Cancel</button>
                <button wire:click="saveBusiness" class="px-6 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md flex items-center gap-2">
                    <flux:icon.check class="w-5 h-5" /> {{ isset($businessForm['id']) ? 'Update' : 'Create' }}
                </button>
            </div>
        </div>
    </div>
@endif  

    <!-- CSS for animations -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scale-up {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes slide-down {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-in-out forwards;
        }

        .animate-scale-up {
            animation: scale-up 0.3s ease-out forwards;
        }

        .animate-slide-down {
            animation: slide-down 0.3s ease-out forwards;
        }
    </style>

</div>