<div class="space-y-6">


    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- Total Vendors --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Vendors</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalVendors }}</p>
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                <span class="font-medium text-green-600 dark:text-green-400">{{ $confirmedVendors }} confirmed</span> ·
                18 categories
            </div>
        </div>

        {{-- Guests --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600 dark:text-emerald-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Guests</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $totalGuests }}</p>
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                <span class="font-medium text-green-600 dark:text-green-400">{{ $respondedGuests }} responded</span> ·
                {{ count($guestGroups) }} groups
            </div>
        </div>

        {{-- Budget --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-amber-100 dark:bg-amber-900/50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600 dark:text-amber-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Budget</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $budgetSpent }}</p>
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                of total {{ $budgetTotal }} ·
                {{ round(((float) filter_var($budgetSpent, FILTER_SANITIZE_NUMBER_INT) / max((float) filter_var($budgetTotal, FILTER_SANITIZE_NUMBER_INT), 1)) * 100) }}%
                used
            </div>
        </div>
    </div>

    {{-- Recent Bookings Table --}}
    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Bookings</h2>
            <a href="{{ route('host.bookings.index') }}"
                class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">View
                all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            #</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Booking ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Vendor</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Event Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Created</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900 dark:text-white">
                                {{ $booking['booking_id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $booking['vendor'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $booking['event_date'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $booking['created'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span @class([
                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' =>
                                        $booking['status'] === 'confirmed',
                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' =>
                                        $booking['status'] === 'accepted',
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' =>
                                        $booking['status'] === 'completed',
                                    'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' =>
                                        $booking['status'] === 'cancelled',
                                    'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' => !in_array(
                                        $booking['status'],
                                        ['confirmed', 'accepted', 'completed', 'cancelled']),
                                ])>
                                    {{ ucfirst($booking['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $booking['amount'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No
                                recent bookings</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Two column layout for booked vendors and guest groups --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Booked Vendors --}}
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Booked Vendors</h2>
                <a href="{{ route('host.vendors.index') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">View
                    all</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($bookedVendors as $vendor)
                    <div class="flex items-start p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-lg">
                            {{ substr($vendor['name'], 0, 1) }}
                        </div>
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $vendor['name'] }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $vendor['category'] }}</p>
                            <div class="flex items-center mt-1 text-xs">
                                <span @class([
                                    'w-2 h-2 rounded-full mr-1',
                                    'bg-green-500' => $vendor['status'] === 'confirmed',
                                    'bg-yellow-500' => $vendor['status'] === 'accepted',
                                    'bg-blue-500' => $vendor['status'] === 'completed',
                                ])></span>
                                <span
                                    class="text-gray-600 dark:text-gray-300 capitalize">{{ $vendor['status'] }}</span>
                                <span class="mx-1 text-gray-400">•</span>
                                <span class="text-gray-500 dark:text-gray-400">{{ $vendor['date'] }}</span>
                            </div>
                        </div>
                        <div class="text-xs font-semibold text-gray-900 dark:text-white">
                            Rs {{ number_format($vendor['amount'], 0) }}
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-2">No booked vendors yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Guest Groups & Recent Activity --}}
        <div class="space-y-6">
            {{-- Guest Groups --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Guest Groups</h2>
                <ul class="space-y-2">
                    @forelse($guestGroups as $group)
                        <li
                            class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700 last:border-0">
                            <span class="text-sm text-gray-900 dark:text-white">{{ $group['name'] }}</span>
                            <span
                                class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-1 rounded-full">{{ $group['count'] }}
                                guests</span>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500 dark:text-gray-400">No guest groups created.</li>
                    @endforelse
                </ul>
                <a href="{{ route('host.guests.index') }}"
                    class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Manage
                    guests →</a>
            </div>

            {{-- Recent Activity --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h2>
                <div class="flow-root">
                    <ul class="-mb-2">
                        @forelse($recentActivity as $activity)
                            <li class="py-2 flex items-start space-x-3">
                                <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-indigo-400"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity['action'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['time'] }}</p>
                                </div>
                            </li>
                        @empty
                            <li class="text-sm text-gray-500 dark:text-gray-400">No recent activity.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Vendor Categories quick overview (inspired by first screenshot) --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">My Vendors</h2>
            <span class="text-sm text-gray-600 dark:text-gray-400">6 of 18 categories hired</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach (['Cakes & Bakes', 'Carts & Stalls', 'Catering', 'Décor', 'Entertainment', 'Photography', 'Venues', 'Transport'] as $category)
                <a href="#"
                    class="block p-3 bg-gray-50 dark:bg-gray-700/30 rounded-lg text-center hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition group">
                    <p
                        class="text-xs font-medium text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                        {{ $category }}</p>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Book Vendors</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
