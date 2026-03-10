<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-fuchsia-950/20">
    <!-- Animated background gradient (subtle) -->
    <div class="fixed inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-fuchsia-100/30 via-transparent to-cyan-100/30 dark:from-fuchsia-950/30 dark:via-transparent dark:to-cyan-950/30 animate-gradient-slow"></div>
    
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 relative z-10">

        <!-- Welcome Card - Full Width with animated gradient border -->
        <div class="group relative animate-fade-in-up rounded-3xl bg-gradient-to-br from-fuchsia-600 via-purple-600 to-indigo-600 dark:from-fuchsia-950 dark:via-purple-950 dark:to-indigo-950 p-1 shadow-2xl hover:shadow-fuchsia-500/30 transition-all duration-500">
            <div class="relative overflow-hidden rounded-2xl bg-white/90 dark:bg-zinc-900/90 backdrop-blur-sm">
                <!-- Animated floating particles -->
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-fuchsia-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
                    <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
                    <div class="absolute bottom-0 left-1/2 w-64 h-64 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
                </div>

                <!-- Content -->
                <div class="relative px-8 lg:px-16 py-12 lg:py-16">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <!-- Left Side -->
                        <div class="text-gray-900 dark:text-white">
                            <p class="text-sm font-medium tracking-wider uppercase flex items-center gap-2 text-fuchsia-600 dark:text-fuchsia-400 mb-2">
                                <flux:icon.sparkles class="w-4 h-4 animate-pulse" />
                                Welcome back to WedbookI
                            </p>
                            <h1 class="text-5xl lg:text-6xl font-black mb-4 bg-gradient-to-r from-fuchsia-600 via-purple-600 to-indigo-600 dark:from-fuchsia-400 dark:via-purple-400 dark:to-indigo-400 bg-clip-text text-transparent">
                                {{ $vendor->full_name ?? 'Vendor' }}
                            </h1>
                            <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-8 max-w-xl bg-white/50 dark:bg-zinc-800/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-200 dark:border-zinc-700">
                                {{ $vendor->about ?: 'No description provided yet.' }}
                            </p>

                            <div class="flex gap-4 flex-wrap">
                                <button wire:click="openProfileModal"
                                    class="group/btn relative overflow-hidden rounded-xl bg-gradient-to-r from-fuchsia-500 to-purple-600 px-8 py-3 font-semibold text-white shadow-lg shadow-fuchsia-500/30 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-fuchsia-500/50 border border-white/20">
                                    <span class="relative z-10 flex items-center gap-2">
                                        <flux:icon.pencil-square class="w-5 h-5 transition-transform group-hover/btn:rotate-12" />
                                        Edit Profile
                                    </span>
                                    <span class="absolute inset-0 -z-0 translate-y-full bg-gradient-to-t from-white/30 to-transparent transition-transform duration-300 group-hover/btn:translate-y-0"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Side - Avatar with rotating ring -->
                        <div class="hidden lg:flex justify-center">
                            <div class="relative">
                                <div class="absolute inset-0 animate-spin-slow rounded-full bg-gradient-to-r from-fuchsia-500 via-purple-500 to-cyan-500"></div>
                                <div class="relative w-44 h-44 rounded-full bg-white dark:bg-zinc-800 p-1 shadow-2xl">
                                    <div class="w-full h-full rounded-full bg-gradient-to-br from-fuchsia-100 to-purple-100 dark:from-fuchsia-900 dark:to-purple-900 flex items-center justify-center text-7xl font-bold text-fuchsia-600 dark:text-fuchsia-300 border-4 border-white dark:border-zinc-800 shadow-inner">
                                        {{ $vendor->initials() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Events Countdown (if exists) -->
                    @if(!empty($upcomingEvents))
                        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-zinc-800">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(count($upcomingEvents), 3) }} gap-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="group/event bg-gradient-to-br from-fuchsia-50 to-cyan-50 dark:from-fuchsia-950/30 dark:to-cyan-950/30 backdrop-blur-lg rounded-2xl p-5 border border-fuchsia-200 dark:border-fuchsia-800/50 hover:border-fuchsia-400 hover:shadow-xl hover:shadow-fuchsia-200/50 dark:hover:shadow-fuchsia-900/30 transition-all duration-300 hover:scale-[1.02]">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <p class="text-xs text-fuchsia-600 dark:text-fuchsia-400 font-semibold uppercase tracking-wider flex items-center gap-1">
                                                    <flux:icon.calendar class="w-3 h-3" />
                                                    Upcoming
                                                </p>
                                                <h3 class="text-gray-900 dark:text-white font-bold text-base mt-1">{{ $event['host_name'] }}</h3>
                                            </div>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-fuchsia-100 dark:bg-fuchsia-900/50 text-fuchsia-700 dark:text-fuchsia-300 text-xs font-bold border border-fuchsia-200 dark:border-fuchsia-700">
                                                <flux:icon.clock class="w-3.5 h-3.5" />
                                                {{ $event['days_until'] }}d
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400 text-xs">
                                            <flux:icon.calendar-days class="w-3.5 h-3.5" />
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

        <!-- Flash Messages with modern styling -->
        @if(session('success'))
            <div class="mb-4 p-5 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/50 dark:to-teal-950/50 border border-emerald-200 dark:border-emerald-800/50 flex items-center gap-4 shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                    <flux:icon.check-circle class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                </div>
                <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200 flex-1">{{ session('success') }}</p>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800">
                    <flux:icon.x-mark class="w-5 h-5" />
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-5 rounded-2xl bg-gradient-to-r from-rose-50 to-pink-50 dark:from-rose-950/50 dark:to-pink-950/50 border border-rose-200 dark:border-rose-800/50 flex items-center gap-4 shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-900/50 flex items-center justify-center">
                    <flux:icon.x-circle class="w-6 h-6 text-rose-600 dark:text-rose-400" />
                </div>
                <p class="text-sm font-semibold text-rose-800 dark:text-rose-200 flex-1">{{ session('error') }}</p>
                <button onclick="this.parentElement.remove()" class="text-rose-600 dark:text-rose-400 hover:text-rose-800">
                    <flux:icon.x-mark class="w-5 h-5" />
                </button>
            </div>
        @endif

        <!-- Top Stats Row - Smaller cards with thin border on hover -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 animate-fade-in-up" style="animation-delay: 0.1s;">
            <!-- Page Visitors -->
            <div class="group/stat relative overflow-hidden rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 p-[2px] shadow-md transition-all duration-300 hover:shadow-lg hover:shadow-pink-500/30">
                <div class="relative rounded-lg bg-white dark:bg-zinc-900 p-4 h-full">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pink-200/30 dark:bg-pink-500/20 rounded-full blur-2xl group-hover/stat:scale-150 transition-transform"></div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center shadow-md group-hover/stat:scale-110 transition-transform">
                            <flux:icon.eye class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-[10px] font-semibold text-pink-600 dark:text-pink-400 bg-pink-100 dark:bg-pink-950/50 px-2 py-0.5 rounded-full border border-pink-200 dark:border-pink-800">+12%</span>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-0.5">Page Visitors</p>
                    <p class="text-xl font-black text-gray-900 dark:text-white">{{ $pageVisitors }}</p>
                </div>
                <!-- Thin border on hover -->
                <div class="absolute inset-0 rounded-xl border-2 border-transparent group-hover/stat:border-pink-400 dark:group-hover/stat:border-pink-600 pointer-events-none transition-all duration-200"></div>
            </div>

            <!-- Total Bookings -->
            <div class="group/stat relative overflow-hidden rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 p-[2px] shadow-md transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/30">
                <div class="relative rounded-lg bg-white dark:bg-zinc-900 p-4 h-full">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-amber-200/30 dark:bg-amber-500/20 rounded-full blur-2xl group-hover/stat:scale-150 transition-transform"></div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-md group-hover/stat:scale-110 transition-transform">
                            <flux:icon.document-text class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-100 dark:bg-amber-950/50 px-2 py-0.5 rounded-full border border-amber-200 dark:border-amber-800">+8%</span>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-0.5">Total Bookings</p>
                    <p class="text-xl font-black text-gray-900 dark:text-white">{{ $totalBookings }}</p>
                </div>
                <div class="absolute inset-0 rounded-xl border-2 border-transparent group-hover/stat:border-amber-400 dark:group-hover/stat:border-amber-600 pointer-events-none transition-all duration-200"></div>
            </div>

            <!-- Total Revenue -->
            <div class="group/stat relative overflow-hidden rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 p-[2px] shadow-md transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/30">
                <div class="relative rounded-lg bg-white dark:bg-zinc-900 p-4 h-full">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-200/30 dark:bg-emerald-500/20 rounded-full blur-2xl group-hover/stat:scale-150 transition-transform"></div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-md group-hover/stat:scale-110 transition-transform">
                            <flux:icon.banknotes class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-950/50 px-2 py-0.5 rounded-full border border-emerald-200 dark:border-emerald-800">+5%</span>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-0.5">Total Revenue</p>
                    <p class="text-lg font-black text-gray-900 dark:text-white">Rs {{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="absolute inset-0 rounded-xl border-2 border-transparent group-hover/stat:border-emerald-400 dark:group-hover/stat:border-emerald-600 pointer-events-none transition-all duration-200"></div>
            </div>

            <!-- Social Clicks -->
            <div class="group/stat relative overflow-hidden rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 p-[2px] shadow-md transition-all duration-300 hover:shadow-lg hover:shadow-purple-500/30">
                <div class="relative rounded-lg bg-white dark:bg-zinc-900 p-4 h-full">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-200/30 dark:bg-purple-500/20 rounded-full blur-2xl group-hover/stat:scale-150 transition-transform"></div>
                    <div class="flex items-center justify-between mb-2">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center shadow-md group-hover/stat:scale-110 transition-transform">
                            <flux:icon.share class="w-4 h-4 text-white" />
                        </div>
                        <span class="text-[10px] font-semibold text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-950/50 px-2 py-0.5 rounded-full border border-purple-200 dark:border-purple-800">+23%</span>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-0.5">Social Clicks</p>
                    <p class="text-xl font-black text-gray-900 dark:text-white">{{ $socialClicks }}</p>
                </div>
                <div class="absolute inset-0 rounded-xl border-2 border-transparent group-hover/stat:border-purple-400 dark:group-hover/stat:border-purple-600 pointer-events-none transition-all duration-200"></div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column - Recent Bookings & Reviews -->
            <div class="lg:col-span-2 space-y-8 animate-fade-in-up" style="animation-delay: 0.2s;">

                <!-- Recent Bookings - modern card with gradient table and hover effects -->
                <div class="rounded-2xl bg-white dark:bg-zinc-900 shadow-xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-zinc-800 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 dark:from-green-950/30 dark:via-emerald-950/30 dark:to-teal-950/30">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center shadow-md">
                                    <flux:icon.document-text class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Recent Bookings</h2>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Your latest booking requests</p>
                                </div>
                            </div>
                            <a href="{{ route('vendor.bookings') }}" class="group/link text-green-600 dark:text-green-400 text-sm font-semibold flex items-center gap-1 hover:gap-2 transition-all">
                                View All
                                <flux:icon.arrow-right class="w-4 h-4 transition-transform group-hover/link:translate-x-1" />
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-zinc-800/70">
                                <tr>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">ID</th>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Created</th>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                    <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Amount</th>
                                    <th class="px-6 py-4 text-center font-semibold text-gray-700 dark:text-gray-300">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                                @forelse($recentBookings as $booking)
                                    <tr class="group/row hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 dark:hover:from-green-950/30 dark:hover:to-emerald-950/30 transition-all">
                                        <td class="px-6 py-4 font-mono font-medium text-gray-900 dark:text-white">{{ $booking['custom_id'] }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $booking['created'] }}</td>
                                        <td class="px-6 py-4">
                                            @if($booking['status_color'] === 'green')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-medium border border-green-200 dark:border-green-800/50">
                                                    <span class="w-2 h-2 rounded-full bg-green-600 animate-pulse"></span>
                                                    {{ $booking['status'] }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-medium border border-red-200 dark:border-red-800/50">
                                                    <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                                    {{ $booking['status'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $booking['amount'] }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <button class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-zinc-700 hover:shadow-sm transition-all">
                                                <flux:icon.ellipsis-vertical class="w-5 h-5" />
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            <flux:icon.inbox class="w-12 h-12 mx-auto mb-3 opacity-50" />
                                            <p class="text-sm">No bookings yet. Start by creating your first booking!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Latest Reviews - modern card with gradient reviews -->
                <div class="rounded-2xl bg-white dark:bg-zinc-900 shadow-xl border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-md">
                            <flux:icon.star class="w-5 h-5 text-white" />
                        </div>
                        Latest Reviews
                    </h2>

                    <div class="space-y-4">
                        @if(empty($reviews))
                            <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                                <flux:icon.chat-bubble-bottom-center-text class="w-16 h-16 mx-auto mb-3 opacity-30" />
                                <p class="text-sm">No reviews yet. Great work will bring amazing reviews!</p>
                            </div>
                        @else
                            @foreach($reviews as $review)
                                <div class="group/review p-5 rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-950/20 dark:to-orange-950/20 border border-amber-200 dark:border-amber-800/30 hover:border-amber-400 hover:shadow-xl hover:shadow-amber-200/50 dark:hover:shadow-amber-900/30 transition-all hover:scale-[1.02]">
                                    <div class="flex gap-4">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-md flex-shrink-0">
                                            {{ substr($review['name'], 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $review['name'] }}</h4>
                                            <div class="flex gap-1 my-2">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $review['rating'])
                                                        <flux:icon.star class="w-4 h-4 text-amber-400 fill-current" />
                                                    @else
                                                        <flux:icon.star class="w-4 h-4 text-gray-300 dark:text-gray-600" />
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">“{{ $review['comment'] }}”</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Quick Actions & More -->
            <div class="space-y-8 animate-fade-in-up" style="animation-delay: 0.3s;">

                <!-- Quick Actions - modern vibrant buttons with gradient borders -->
                <div class="rounded-2xl bg-white dark:bg-zinc-900 shadow-xl border border-gray-200 dark:border-zinc-800 p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-yellow-500 flex items-center justify-center shadow-md">
                            <flux:icon.bolt class="w-5 h-5 text-white" />
                        </div>
                        Quick Actions
                    </h2>

                    <div class="space-y-3">
                        <!-- Manage Businesses -->
                        <button wire:click="openBusinessModal" class="group/action w-full flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-950/30 dark:to-blue-950/30 border border-indigo-200 dark:border-indigo-800/50 hover:border-indigo-400 hover:shadow-lg hover:shadow-indigo-200/50 dark:hover:shadow-indigo-900/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center shadow-md group-hover/action:scale-110 transition-transform">
                                <flux:icon.building-office class="w-6 h-6 text-white" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Manage Businesses</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Add or edit your businesses</p>
                            </div>
                            <flux:icon.arrow-right class="w-5 h-5 text-indigo-500 group-hover/action:translate-x-1 transition-transform" />
                        </button>

                        <!-- Update Availability -->
                        <button wire:click="openAvailabilityModal" class="group/action w-full flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/30 dark:to-teal-950/30 border border-emerald-200 dark:border-emerald-800/50 hover:border-emerald-400 hover:shadow-lg hover:shadow-emerald-200/50 dark:hover:shadow-emerald-900/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-md group-hover/action:scale-110 transition-transform">
                                <flux:icon.calendar-days class="w-6 h-6 text-white" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Update Availability</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Set your dates</p>
                            </div>
                            <flux:icon.arrow-right class="w-5 h-5 text-emerald-500 group-hover/action:translate-x-1 transition-transform" />
                        </button>

                        <!-- Create Package -->
                        <button wire:click="openPackageModal" class="group/action w-full flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-950/30 dark:to-cyan-950/30 border border-blue-200 dark:border-blue-800/50 hover:border-blue-400 hover:shadow-lg hover:shadow-blue-200/50 dark:hover:shadow-blue-900/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center shadow-md group-hover/action:scale-110 transition-transform">
                                <flux:icon.cube class="w-6 h-6 text-white" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Create Package</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Define packages</p>
                            </div>
                            <flux:icon.arrow-right class="w-5 h-5 text-blue-500 group-hover/action:translate-x-1 transition-transform" />
                        </button>

                        <!-- Message Clients -->
                        <button wire:click="openMessageModal" class="group/action w-full flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-950/30 dark:to-pink-950/30 border border-purple-200 dark:border-purple-800/50 hover:border-purple-400 hover:shadow-lg hover:shadow-purple-200/50 dark:hover:shadow-purple-900/30 transition-all duration-300">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-md group-hover/action:scale-110 transition-transform">
                                <flux:icon.chat-bubble-left class="w-6 h-6 text-white" />
                            </div>
                            <div class="text-left flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Message Clients</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Respond to inquiries</p>
                            </div>
                            <flux:icon.arrow-right class="w-5 h-5 text-purple-500 group-hover/action:translate-x-1 transition-transform" />
                        </button>
                    </div>
                </div>

                <!-- Credits Card - modern gradient with animated shine -->
                <div class="group/credits relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 via-orange-500 to-rose-500 p-6 shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/credits:translate-x-full transition-transform duration-1000"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-black/10 rounded-full blur-2xl"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-white text-lg">Available Credits</h3>
                            <div class="w-10 h-10 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                                <flux:icon.gift class="w-5 h-5 text-white" />
                            </div>
                        </div>
                        <div class="mb-6">
                            <p class="text-5xl font-black text-white">{{ number_format($credits, 0) }}</p>
                            <p class="text-amber-100 text-sm mt-1 opacity-90">Credits available to use</p>
                        </div>
                        <button class="w-full py-3 px-4 rounded-xl bg-white/20 backdrop-blur-sm text-white font-semibold border border-white/30 hover:bg-white/30 transition-all flex items-center justify-center gap-2 group/btn">
                            Purchase more credits
                            <flux:icon.arrow-right class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" />
                        </button>
                    </div>
                </div>

                <!-- Rating Summary - modern card with gradient text -->
                <div class="rounded-2xl bg-white dark:bg-zinc-900 shadow-xl border border-gray-200 dark:border-zinc-800 p-6 text-center">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-6">Overall Rating</h3>
                    <div class="relative inline-block">
                        <div class="text-6xl font-black bg-gradient-to-br from-amber-500 to-orange-600 bg-clip-text text-transparent">{{ number_format($rating, 1) }}</div>
                        <div class="absolute -top-2 -right-4 w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center text-xs font-bold text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800">5</div>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 mb-4">Out of 5 ({{ $ratingCount }} {{ Str::plural('review', $ratingCount) }})</p>
                    <div class="flex justify-center gap-1">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < floor($rating))
                                <flux:icon.star class="w-6 h-6 text-amber-400 fill-current" />
                            @elseif($i < $rating)
                                <flux:icon.star class="w-6 h-6 text-amber-300 fill-current" />
                            @else
                                <flux:icon.star class="w-6 h-6 text-gray-300 dark:text-gray-600" />
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== MODALS ========== (Enhanced with modern gradients and effects) -->

    <!-- Update Availability Modal -->
    @if($showAvailabilityModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 animate-scale-up overflow-hidden">
                <!-- Header with gradient -->
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 dark:from-green-700 dark:to-emerald-800 px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.calendar-days class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">Update Availability</h2>
                    </div>
                    <button wire:click="closeAvailabilityModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Business</label>
                        <select wire:model="selectedBusiness" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                            <option value="">Choose a business</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Slot Duration (minutes)</label>
                        <input type="number" wire:model="slotDuration" min="15" max="480" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="60" />
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 rounded-xl p-4">
                        <p class="text-sm text-green-800 dark:text-green-200 flex items-center gap-2">
                            <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                            Set your availability slot duration for bookings.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button wire:click="closeAvailabilityModal" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                    <button wire:click="saveAvailability" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold shadow-md flex items-center gap-2 transition">
                        <flux:icon.check class="w-5 h-5" /> Save
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Create Package Modal -->
    @if($showPackageModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
                <!-- Header -->
                <div class="sticky top-0 bg-gradient-to-r from-blue-500 to-cyan-600 dark:from-blue-700 dark:to-cyan-800 px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.cube class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">Create Package</h2>
                    </div>
                    <button wire:click="closePackageModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Business</label>
                        <select wire:model="selectedBusiness" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                            <option value="">Choose a business</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Package Name</label>
                        <input type="text" wire:model="packageName" placeholder="e.g., Gold Package" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price (Rs)</label>
                            <input type="number" wire:model="packagePrice" placeholder="5000" min="0" step="100" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Discount (Rs)</label>
                            <input type="number" wire:model="packageDiscount" placeholder="0" min="0" step="100" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea wire:model="packageDescription" placeholder="Describe your package..." rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Features (comma separated)</label>
                        <textarea wire:model="packageFeatures" placeholder="Feature 1, Feature 2, Feature 3" rows="2" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="isPopular" id="isPopular" class="w-5 h-5 rounded-lg border-gray-300 dark:border-zinc-700 text-blue-600 focus:ring-2 focus:ring-blue-500 cursor-pointer" />
                        <label for="isPopular" class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">Mark as Popular Package</label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button wire:click="closePackageModal" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                    <button wire:click="savePackage" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold shadow-md flex items-center gap-2 transition">
                        <flux:icon.check class="w-5 h-5" /> Create
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Message Clients Modal -->
    @if($showMessageModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 animate-scale-up">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 dark:from-purple-700 dark:to-pink-800 px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.chat-bubble-left class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">Message Clients</h2>
                    </div>
                    <button wire:click="closeMessageModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                        <input type="text" wire:model="messageSubject" placeholder="Message subject..." class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Message</label>
                        <textarea wire:model="messageBody" placeholder="Your message here..." rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 resize-none"></textarea>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/50 rounded-xl p-4">
                        <p class="text-sm text-purple-800 dark:text-purple-200 flex items-center gap-2">
                            <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                            Your message will be sent to interested clients.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button wire:click="closeMessageModal" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                    <button wire:click="sendMessage" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold shadow-md flex items-center gap-2 transition">
                        <flux:icon.check class="w-5 h-5" /> Send
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Profile Modal -->
    @if($showProfileModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
                <!-- Header -->
                <div class="sticky top-0 bg-gradient-to-r from-indigo-500 to-purple-600 dark:from-indigo-700 dark:to-purple-800 px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.user-circle class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">Edit Profile</h2>
                    </div>
                    <button wire:click="closeProfileModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                        <input type="text" wire:model="profile.full_name" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" wire:model="profile.email" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                            <input type="text" wire:model="profile.phone_no" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country Code</label>
                            <input type="text" wire:model="profile.country_code" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">About</label>
                        <textarea wire:model="profile.about" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Profile Image</label>
                        <input type="file" wire:model="profile_image" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @if($profile_image_preview)
                            <img src="{{ $profile_image_preview }}" class="mt-3 w-20 h-20 rounded-full object-cover border-2 border-indigo-300 shadow-md">
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button wire:click="closeProfileModal" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                    <button wire:click="saveProfile" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold shadow-md flex items-center gap-2 transition">
                        <flux:icon.check class="w-5 h-5" /> Save
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Manage Business Modal -->
    @if($showBusinessModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
                <!-- Header -->
                <div class="sticky top-0 bg-gradient-to-r from-indigo-500 to-blue-600 dark:from-indigo-700 dark:to-blue-800 px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.building-office class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">{{ isset($businessForm['id']) ? 'Edit' : 'Add' }} Business</h2>
                    </div>
                    <button wire:click="closeBusinessModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Business Name</label>
                        <input type="text" wire:model="businessForm.company_name" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" placeholder="e.g., Grand Marquee" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                        <select wire:model="businessForm.category_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea wire:model="businessForm.business_desc" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 resize-none" placeholder="Describe your business..."></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Business Email</label>
                            <input type="email" wire:model="businessForm.business_email" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" placeholder="contact@example.com" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Business Phone</label>
                            <input type="text" wire:model="businessForm.business_phone" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" placeholder="+92 300 1234567" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Street Address</label>
                        <input type="text" wire:model="businessForm.street_address" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" placeholder="123 Main St" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">City</label>
                            <input type="text" wire:model="businessForm.city" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" placeholder="Lahore" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                            <input type="text" wire:model="businessForm.country" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" placeholder="Pakistan" />
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button wire:click="closeBusinessModal" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                    <button wire:click="saveBusiness" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold shadow-md flex items-center gap-2 transition">
                        <flux:icon.check class="w-5 h-5" /> {{ isset($businessForm['id']) ? 'Update' : 'Create' }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Boost Business Modal (if needed) -->
    @if($showBoostModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 animate-scale-up">
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 dark:from-amber-700 dark:to-orange-800 px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.rocket-launch class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">Boost Your Business</h2>
                    </div>
                    <button wire:click="closeBoostModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Business to Boost</label>
                        <select wire:model="boostBusinessId" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500">
                            <option value="">Choose a business</option>
                            @foreach($boostBusinesses as $business)
                                <option value="{{ $business['id'] }}">{{ $business['business_name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-xl p-4">
                        <p class="text-sm text-amber-800 dark:text-amber-200 flex items-center gap-2">
                            <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                            Boosting your business makes it appear more prominently in search results and increases visibility.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button wire:click="closeBoostModal" class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                    <button wire:click="confirmBoost" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold shadow-md flex items-center gap-2 transition">
                        <flux:icon.check class="w-5 h-5" /> Confirm Boost
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- CSS for enhanced animations -->
    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
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
        @keyframes ping-slow {
            75%, 100% { transform: scale(1.3); opacity: 0; }
        }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        @keyframes gradient-slow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }
        .animate-scale-up {
            animation: scale-up 0.3s ease-out forwards;
        }
        .animate-slide-down {
            animation: slide-down 0.3s ease-out forwards;
        }
        .animate-ping-slow {
            animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animate-gradient-slow {
            animation: gradient-slow 8s ease-in-out infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        .animate-spin-slow {
            animation: spin 6s linear infinite;
        }
    </style>
</div>