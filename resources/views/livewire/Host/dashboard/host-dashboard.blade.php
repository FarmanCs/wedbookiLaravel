@php
    $statusColors = [
        'pending' => [
            'bg' => 'bg-amber-50 dark:bg-amber-900/20',
            'text' => 'text-amber-700 dark:text-amber-300',
            'badge' => 'bg-amber-100 dark:bg-amber-800',
        ],
        'confirmed' => [
            'bg' => 'bg-emerald-50 dark:bg-emerald-900/20',
            'text' => 'text-emerald-700 dark:text-emerald-300',
            'badge' => 'bg-emerald-100 dark:bg-emerald-800',
        ],
        'completed' => [
            'bg' => 'bg-blue-50 dark:bg-blue-900/20',
            'text' => 'text-blue-700 dark:text-blue-300',
            'badge' => 'bg-blue-100 dark:bg-blue-800',
        ],
        'cancelled' => [
            'bg' => 'bg-red-50 dark:bg-red-900/20',
            'text' => 'text-red-700 dark:text-red-300',
            'badge' => 'bg-red-100 dark:bg-red-800',
        ],
    ];
@endphp

<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-900">
    <!-- Hero Section -->
    <div
        class="relative overflow-hidden border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 backdrop-blur-sm">
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-40 -right-40 h-80 w-80 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 dark:opacity-5 animate-blob">
            </div>
            <div
                class="absolute -bottom-8 left-20 h-80 w-80 bg-gradient-to-br from-pink-400 to-rose-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 dark:opacity-5 animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="flex items-center justify-between">
                <div>
                    <h1
                        class="text-4xl sm:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 dark:from-blue-400 dark:via-purple-400 dark:to-pink-400 mb-2">
                        Welcome back, {{ Auth::guard('host')->user()->full_name ?? 'Host' }}!
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 flex items-center gap-2">
                        <span>🎊</span>
                        <span>{{ \Carbon\Carbon::parse(Auth::guard('host')->user()->wedding_date)->format('F d, Y') ?? 'Your special day awaits' }}</span>
                    </p>
                </div>
                <button wire:click="refresh"
                    class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Refresh
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Budget Stat -->
            <div
                class="group relative bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 dark:from-emerald-500/5 dark:to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Budget Allocated</h3>
                        <div class="p-2.5 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M8.16 5a.75.75 0 00-.5.97l1.848 5.482H5.5a.75.75 0 00-.729.972l.03.099c.039.118.118.234.216.323L9.23 18.39c.162.162.38.25.598.25.154 0 .309-.036.45-.11.572-.287.85-.900.728-1.517L7.327 11h4.973a.75.75 0 00.728-.972l-.03-.099a.75.75 0 00-.216-.323L10.77 1.61a.75.75 0 00-.598-.25c-.154 0-.309.036-.45.11-.572.287-.85.9-.728 1.517L12.673 9H7.7a.75.75 0 00-.54.2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ $budgetTotal }}</div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">{{ $budgetSpent }} spent</p>
                </div>
            </div>

            <!-- Vendors Stat -->
            <div
                class="group relative bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 dark:from-blue-500/5 dark:to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Vendors Booked</h3>
                        <div class="p-2.5 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-4v3m8-3v3m-8 2h11">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalVendors }}</div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2"><span
                            class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $confirmedVendors }}</span>
                        confirmed</p>
                </div>
            </div>

            <!-- Guests Stat -->
            <div
                class="group relative bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10 dark:from-purple-500/5 dark:to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Guest RSVPs</h3>
                        <div class="p-2.5 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ $respondedGuests }}<span
                            class="text-lg text-slate-500 dark:text-slate-400">/{{ $totalGuests }}</span></div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Guests responded</p>
                </div>
            </div>

            <!-- Guest Groups Stat -->
            <div
                class="group relative bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-rose-500/10 to-orange-500/10 dark:from-rose-500/5 dark:to-orange-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400">Guest Groups</h3>
                        <div class="p-2.5 bg-rose-100 dark:bg-rose-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-rose-600 dark:text-rose-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a4 4 0 00-4-4h-2.5a4 4 0 00-4 4v1h10.5z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ count($guestGroups) }}</div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Guest groups created</p>
                </div>
            </div>
        </div>

        <!-- Main Grid: Bookings + Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Recent Bookings -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div
                    class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700 px-6 py-4 sm:px-8 sm:py-5">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl sm:text-2xl font-bold text-white flex items-center gap-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Recent Bookings
                        </h2>
                        <a href="{{ route('vendor.bookings') }}"
                            class="text-sm font-medium text-blue-100 hover:text-white transition-colors">View All →</a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                            <tr>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                    Vendor</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                    Event Date</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @forelse($recentBookings as $booking)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                    <td class="px-4 sm:px-6 py-4 text-sm text-slate-900 dark:text-white font-medium">
                                        {{ $booking['vendor'] }}</td>
                                    <td class="px-4 sm:px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                        {{ $booking['event_date'] }}</td>
                                    <td class="px-4 sm:px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">
                                        {{ $booking['amount'] }}</td>
                                    <td class="px-4 sm:px-6 py-4 text-sm">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking['status']]['badge'] ?? 'bg-slate-200 dark:bg-slate-700' }} {{ $statusColors[$booking['status']]['text'] ?? 'text-slate-700 dark:text-slate-300' }}">
                                            {{ ucfirst($booking['status']) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4"></path>
                                            </svg>
                                            <span>No bookings yet. Start exploring vendors!</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div
                class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div
                    class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 px-6 py-4 sm:px-8 sm:py-5">
                    <h2 class="text-lg sm:text-xl font-bold text-white flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5m-11-4v3m8-3v3m-8 2h11">
                            </path>
                        </svg>
                        Activity Feed
                    </h2>
                </div>

                <div class="divide-y divide-slate-200 dark:divide-slate-700 max-h-96 overflow-y-auto">
                    @forelse($recentActivity as $activity)
                        <div
                            class="px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors border-l-4 border-emerald-500 dark:border-emerald-400">
                            <p class="text-sm text-slate-900 dark:text-white font-medium">{{ $activity['action'] }}
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $activity['time'] }}</p>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            <svg class="w-8 h-8 opacity-50 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm">No recent activity</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Booked Vendors Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">Your Confirmed Vendors
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Manage and view details of your booked
                        vendors</p>
                </div>
                <a href="{{ route('host.vendors.index') }}"
                    class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Browse Vendors
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($bookedVendors as $vendor)
                    <div
                        class="group relative bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4 z-10">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$vendor['status']]['badge'] ?? 'bg-slate-200 dark:bg-slate-700' }} {{ $statusColors[$vendor['status']]['text'] ?? 'text-slate-700 dark:text-slate-300' }}">
                                {{ ucfirst($vendor['status']) }}
                            </span>
                        </div>

                        <!-- Gradient Overlay on Hover -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-purple-600/10 dark:from-blue-600/5 dark:to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <div class="relative p-6">
                            <!-- Vendor Icon -->
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="p-3 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-2xl">🎯</span>
                            </div>

                            <!-- Content -->
                            <h3
                                class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $vendor['name'] }}</h3>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                    <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z">
                                        </path>
                                    </svg>
                                    <span class="font-medium">{{ $vendor['category'] ?? 'Uncategorized' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                    <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M8.16 5a.75.75 0 00-.5.97l1.848 5.482H5.5a.75.75 0 00-.729.972l.03.099c.039.118.118.234.216.323L9.23 18.39c.162.162.38.25.598.25.154 0 .309-.036.45-.11.572-.287.85-.900.728-1.517L7.327 11h4.973a.75.75 0 00.728-.972l-.03-.099a.75.75 0 00-.216-.323L10.77 1.61a.75.75 0 00-.598-.25c-.154 0-.309.036-.45.11-.572.287-.85.9-.728 1.517L12.673 9H7.7a.75.75 0 00-.54.2z">
                                        </path>
                                    </svg>
                                    <span
                                        class="font-bold text-slate-900 dark:text-white">{{ $vendor['amount'] ? 'Rs ' . number_format($vendor['amount'], 0) : 'TBD' }}</span>
                                </div>
                                @if ($vendor['date'])
                                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                                            </path>
                                        </svg>
                                        <span>{{ $vendor['date'] }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- CTA -->
                            <button
                                class="w-full mt-4 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-semibold transition-all duration-200 transform group-hover:scale-105">
                                View Details
                            </button>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-12 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <svg class="w-16 h-16 text-slate-300 dark:text-slate-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">No Vendors Booked Yet</h3>
                            <p class="text-slate-600 dark:text-slate-400 max-w-xs">Start your wedding planning journey
                                by exploring and booking vendors</p>
                            <a href="{{ route('wedding-vendors.index') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-200 mt-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5">
                                    </path>
                                </svg>
                                Explore Vendors
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Guest Groups Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white">Guest Management</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Organize and track your guest groups</p>
                </div>
                <a href="{{ route('vendor.bookings') }}"
                    class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-medium transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Manage Guests
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($guestGroups as $group)
                    <div
                        class="group bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="p-3 bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a4 4 0 00-4-4h-2.5a4 4 0 00-4 4v1h10.5z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="text-3xl font-bold text-slate-900 dark:text-white">{{ $group['count'] }}</span>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white mb-2">{{ $group['name'] }}</h3>
                        <button
                            class="w-full mt-4 px-3 py-2 text-sm bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-lg font-medium hover:bg-purple-200 dark:hover:bg-purple-900/50 transition-colors">
                            View Group
                        </button>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-12 text-center">
                        <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M13 10h.01M11 10h.01M9 10h.01M7 10h.01">
                            </path>
                        </svg>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">Create Your First Guest
                            Group</h3>
                        <p class="text-slate-600 dark:text-slate-400 mb-4">Organize guests by family, friends, or
                            colleagues</p>
                        <a href="{{ route('vendor.bookings') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-lg font-medium transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.5 1.5a8.5 8.5 0 100 17 8.5 8.5 0 000-17zM10 7a1 1 0 11-2 0 1 1 0 012 0zm3 1a1 1 0 100-2 1 1 0 000 2zm-6 0a1 1 0 100-2 1 1 0 000 2z">
                                </path>
                            </svg>
                            Create Guest Group
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Call-to-Action Section -->
        <div
            class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 dark:from-blue-700 dark:via-purple-700 dark:to-pink-700 rounded-2xl overflow-hidden">
            <div class="relative p-8 sm:p-12">
                <div class="absolute inset-0 opacity-20">
                    <div
                        class="absolute -top-40 -right-40 h-80 w-80 bg-white rounded-full mix-blend-multiply filter blur-3xl">
                    </div>
                </div>
                <div class="relative text-center text-white max-w-2xl mx-auto">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-4">Ready to Book More Vendors?</h2>
                    <p class="text-lg text-blue-100 mb-8">Explore our curated collection of wedding vendors and
                        services to make your special day perfect.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('wedding-vendors.index') }}"
                            class="px-8 py-4 bg-white text-blue-600 font-bold rounded-lg hover:bg-blue-50 transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5">
                                </path>
                            </svg>
                            Browse All Vendors
                        </a>
                        <a href="{{ route('wedding-planner') }}"
                            class="px-8 py-4 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                                </path>
                            </svg>
                            Planning Tools
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Animations -->
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Custom scrollbar for activity feed */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .dark .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #475569;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</div>
