<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Welcome Card -->
        <div class="lg:col-span-2 bg-gradient-to-br from-gray-500 to-stone-700 dark:from-stone-700 dark:to-stone-950 rounded-2xl p-8 text-white shadow-xl animate-fade-in-up py-3">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-4xl font-bold mb-2">Welcome back</h2>
                    <p class="text-green-100 text-lg">ALI ZAHID</p>
                    <p class="text-green-50 text-sm mt-4">Track your bookings, manage availability, and grow your business</p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-3xl font-bold">
                    A
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button class="bg-white text-green-700 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors shadow-lg flex items-center gap-2">
                    <flux:icon.rocket-launch class="w-5 h-5" />
                    Boost Profile
                </button>
                <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-800 transition-colors flex items-center gap-2">
                    <flux:icon.pencil-square class="w-5 h-5" />
                    Edit Profile
                </button>
            </div>
        </div>

        <!-- Credits Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl p-6 shadow-lg border border-gray-200 dark:border-zinc-700 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-gray-900 dark:text-white">Available Credits</h3>
                <flux:icon.gift class="w-6 h-6 text-amber-500" />
            </div>
            <div class="text-5xl font-bold text-gray-900 dark:text-white mb-2">1020</div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Credits available to use</p>
            <a href="#" class="text-green-600 dark:text-green-400 text-sm font-semibold hover:underline flex items-center gap-1">
                Purchase more credits
                <flux:icon.arrow-right class="w-4 h-4" />
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Page Visitors -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-zinc-700 card-hover animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center">
                    <flux:icon.eye class="w-6 h-6 text-pink-500" />
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Page Visitors</p>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">3</div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-zinc-700 card-hover animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                    <flux:icon.calendar class="w-6 h-6 text-amber-500" />
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Total Bookings</p>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">3</div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-zinc-700 card-hover animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                    <flux:icon.banknotes class="w-6 h-6 text-green-500" />
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Total Revenue</p>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">Rs 637,868.7</div>
            </div>
        </div>

        <!-- Social Clicks -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-zinc-700 card-hover animate-fade-in-up" style="animation-delay: 0.5s;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <flux:icon.share class="w-6 h-6 text-purple-500" />
                </div>
            </div>
            <div class="space-y-1">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Social Clicks</p>
                <div class="text-3xl font-bold text-gray-900 dark:text-white">0</div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Section -->
    <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 overflow-hidden animate-fade-in-up" style="animation-delay: 0.6s;">
        <div class="p-6 sm:p-8 border-b border-gray-200 dark:border-zinc-700">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <flux:icon.document-text class="w-6 h-6 text-green-600 dark:text-green-400" />
                        Recent Bookings
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Your latest booking requests</p>
                </div>
                <a href="#" class="text-green-600 dark:text-green-400 font-semibold text-sm hover:underline flex items-center gap-1">
                    View All
                    <flux:icon.arrow-right class="w-4 h-4" />
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-zinc-900/50">
                    <tr class="border-b border-gray-200 dark:border-zinc-700">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Event Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Package</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-mono text-gray-900 dark:text-white">#WB-B40071</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">N/A</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">27 Aug 2025</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">—</td>
                        <td class="px-6 py-4"><span class="badge-confirmed">Confirmed</span></td>
                        <td class="px-6 py-4 text-sm font-semibold text-green-600 dark:text-green-400">Rs 48,443,338.75</td>
                        <td class="px-6 py-4 text-center">
                            <button class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-600 rounded-lg transition-colors">
                                <flux:icon.ellipsis-vertical class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                            </button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-mono text-gray-900 dark:text-white">#WB-B40068</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">N/A</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">27 Aug 2025</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">—</td>
                        <td class="px-6 py-4"><span class="badge-confirmed">Confirmed</span></td>
                        <td class="px-6 py-4 text-sm font-semibold text-green-600 dark:text-green-400">Rs 293,487,464.70</td>
                        <td class="px-6 py-4 text-center">
                            <button class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-600 rounded-lg transition-colors">
                                <flux:icon.ellipsis-vertical class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                            </button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-mono text-gray-900 dark:text-white">#WB-B40069</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">N/A</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">27 Aug 2025</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">—</td>
                        <td class="px-6 py-4"><span class="badge-cancelled">Cancelled</span></td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-400">Rs 294,618,437.58</td>
                        <td class="px-6 py-4 text-center">
                            <button class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-600 rounded-lg transition-colors">
                                <flux:icon.ellipsis-vertical class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Latest Reviews Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Review Summary -->
        <div class="lg:col-span-1 bg-white dark:bg-zinc-800 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 p-6 sm:p-8 animate-fade-in-up" style="animation-delay: 0.7s;">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                <flux:icon.star class="w-6 h-6 text-amber-500" />
                Latest Reviews
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm mb-6">What your clients are saying</p>

            <div class="space-y-6">
                <div>
                    <div class="text-5xl font-bold text-gray-900 dark:text-white">4.5</div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Out of 5</p>
                    <div class="flex gap-1 mt-2">
                        @for($i = 0; $i < 5; $i++)
                            <flux:icon.star class="w-5 h-5 text-amber-400 fill-current" />
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews List -->
        <div class="lg:col-span-2 space-y-4 animate-fade-in-up" style="animation-delay: 0.8s;">
            <!-- Review 1 -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-zinc-700">
                <div class="flex gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg">
                        H
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900 dark:text-white">Hanzala Khalid</h4>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">8 Sept 2025</p>
                    </div>
                </div>
                <div class="flex gap-1 mb-3">
                    @for($i = 0; $i < 4; $i++)
                        <flux:icon.star class="w-4 h-4 text-amber-400 fill-current" />
                    @endfor
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-sm">The vendor is nice! will book again for second wedding</p>
            </div>

            <!-- Review 2 -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-md border border-gray-200 dark:border-zinc-700">
                <div class="flex gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center text-white font-bold text-lg">
                        A
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900 dark:text-white">Ali Zahi</h4>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">3 Sept 2025</p>
                    </div>
                </div>
                <div class="flex gap-1 mb-3">
                    @for($i = 0; $i < 5; $i++)
                        <flux:icon.star class="w-4 h-4 text-amber-400 fill-current" />
                    @endfor
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-sm">From start to finish, the service was nothing short of impeccable, surpassing all expectations in every possible way...</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 p-6 sm:p-8 animate-fade-in-up" style="animation-delay: 0.9s;">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
            <flux:icon.bolt class="w-6 h-6 text-amber-500" />
            Quick Actions
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <button class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-600 transition-colors text-left group">
                <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <flux:icon.calendar-days class="w-6 h-6 text-green-600 dark:text-green-400" />
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Update Availability</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Set your available dates</p>
                </div>
            </button>

            <button class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-600 transition-colors text-left group">
                <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <flux:icon.cube class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Create Package</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Define new service packages</p>
                </div>
            </button>

            <button class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-zinc-700 hover:bg-gray-100 dark:hover:bg-zinc-600 transition-colors text-left group">
                <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <flux:icon.chat-bubble-left class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Message Clients</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Respond to inquiries</p>
                </div>
            </button>
        </div>
    </div>
</div>