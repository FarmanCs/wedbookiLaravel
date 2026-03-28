<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-900">

    <!-- Hero / Welcome with Countdown -->
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
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <!-- Welcome Section with Button -->
            <div class="flex items-center justify-between flex-wrap gap-4 mb-8">
                <div>
                    <h1
                        class="text-4xl sm:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 dark:from-blue-400 dark:via-purple-400 dark:to-pink-400 mb-2">
                        Welcome back, {{ Auth::guard('host')->user()->full_name ?? 'Host' }}!
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 flex items-center gap-2">
                        <span>🎊</span>
                        @if ($weddingDate)
                            <span>Your big day is {{ \Carbon\Carbon::parse($weddingDate)->format('F d, Y') }}</span>
                        @else
                            <span>Set your wedding date to start planning</span>
                        @endif
                    </p>
                </div>
                <button wire:click="openDateModal"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ $weddingDate ? 'Change Date' : 'Set Date' }}
                </button>
            </div>

            <!-- Live Countdown Section -->
            @if ($weddingDate)
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-slate-800/50 dark:to-slate-800/30 rounded-xl border border-blue-200 dark:border-slate-700 p-6"
                    x-data="countdownTimer('{{ $weddingDate }}')">
                    <p class="text-center text-sm font-semibold text-slate-600 dark:text-slate-300 mb-4">⏰ TIME UNTIL
                        YOUR BIG DAY</p>
                    <div class="flex justify-center gap-3 md:gap-6 flex-wrap">
                        <!-- Days -->
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 rounded-xl p-4 min-w-[80px] shadow-md">
                                <div class="text-3xl md:text-4xl font-bold text-white"
                                    x-text="String(days).padStart(2, '0')">00</div>
                                <div class="text-xs font-semibold text-blue-100 mt-1 uppercase">Days</div>
                            </div>
                        </div>
                        <!-- Hours -->
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 rounded-xl p-4 min-w-[80px] shadow-md">
                                <div class="text-3xl md:text-4xl font-bold text-white"
                                    x-text="String(hours).padStart(2, '0')">00</div>
                                <div class="text-xs font-semibold text-blue-100 mt-1 uppercase">Hours</div>
                            </div>
                        </div>
                        <!-- Minutes -->
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 rounded-xl p-4 min-w-[80px] shadow-md">
                                <div class="text-3xl md:text-4xl font-bold text-white"
                                    x-text="String(minutes).padStart(2, '0')">00</div>
                                <div class="text-xs font-semibold text-blue-100 mt-1 uppercase">Minutes</div>
                            </div>
                        </div>
                        <!-- Seconds -->
                        <div class="text-center">
                            <div
                                class="bg-gradient-to-br from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 rounded-xl p-4 min-w-[80px] shadow-md">
                                <div class="text-3xl md:text-4xl font-bold text-white"
                                    x-text="String(seconds).padStart(2, '0')">00</div>
                                <div class="text-xs font-semibold text-blue-100 mt-1 uppercase">Seconds</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Statistics Cards (Vendors, Tasks, Guests) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Vendors Card -->
            <div
                class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">VENDORS</h3>
                    <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-900 dark:text-white">
                    {{ $vendorCategories['hiredCount'] }}<span
                        class="text-lg text-slate-500 dark:text-slate-400">/{{ $vendorCategories['totalCount'] }}</span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <div class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full"
                            style="width: {{ ($vendorCategories['hiredCount'] / max($vendorCategories['totalCount'], 1)) * 100 }}%">
                        </div>
                    </div>
                    <span
                        class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ round(($vendorCategories['hiredCount'] / max($vendorCategories['totalCount'], 1)) * 100) }}%</span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">{{ $vendorCategories['hiredCount'] }} of
                    {{ $vendorCategories['totalCount'] }} categories hired</p>
            </div>

            <!-- Tasks Card -->
            <div
                class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">TASKS</h3>
                    <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ $doneTasks }}<span
                        class="text-lg text-slate-500 dark:text-slate-400">/{{ $totalTasks }}</span></div>
                <div class="mt-2 flex items-center gap-2">
                    <div class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-amber-500 to-orange-500 rounded-full"
                            style="width: {{ ($doneTasks / max($totalTasks, 1)) * 100 }}%"></div>
                    </div>
                    <span
                        class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ round(($doneTasks / max($totalTasks, 1)) * 100) }}%</span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">{{ $doneTasks }} of {{ $totalTasks }}
                    tasks completed</p>
            </div>

            <!-- Guests Card -->
            <div
                class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400">GUESTS</h3>
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ $respondedGuests }}<span
                        class="text-lg text-slate-500 dark:text-slate-400">/{{ $totalGuests }}</span></div>
                <div class="mt-2 flex items-center gap-2">
                    <div class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full"
                            style="width: {{ ($respondedGuests / max($totalGuests, 1)) * 100 }}%"></div>
                    </div>
                    <span
                        class="text-sm font-medium text-slate-600 dark:text-slate-400">{{ round(($respondedGuests / max($totalGuests, 1)) * 100) }}%</span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">{{ $respondedGuests }} of
                    {{ $totalGuests }} guests responded</p>
            </div>
        </div>
    </div>

    <!-- Main Grid (Vendors + Bookings / Checklist + Budget) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: My Vendors + My Bookings (2 cols wide) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- My Vendors Card -->
                <div
                    class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div
                        class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V6.5">
                                    </path>
                                </svg> MY VENDORS
                            </h2>
                            <span class="text-sm text-blue-100">{{ $vendorCategories['hiredCount'] }} of
                                {{ $vendorCategories['totalCount'] }} categories hired</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach (array_slice($vendorCategories['all'], 0, 12) as $category)
                                <div
                                    class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700/30 rounded-lg">
                                    <span
                                        class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $category }}</span>
                                    @if (in_array($category, $vendorCategories['hired']))
                                        <span
                                            class="text-xs px-2 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">Hired</span>
                                    @else
                                        <a href="{{ route('wedding-vendors.index', ['category' => $category]) }}"
                                            class="text-xs px-2 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 transition">Book
                                            Vendors</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- My Bookings Card -->
                <div
                    class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div
                        class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd"></path>
                                </svg> MY BOOKINGS
                            </h2>
                            <a href="{{ route('host.bookings.index') }}"
                                class="text-sm text-white/80 hover:text-white">View All →</a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead
                                class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">BOOKING ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">VENDOR</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">EVENT DATE</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">CREATED</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">STATUS</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">AMOUNT</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase">ACTIVE</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach ($recentBookings as $index => $booking)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                        <td class="px-4 py-4 text-sm">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 text-sm font-mono text-slate-600 dark:text-slate-400">
                                            {{ $booking['booking_id'] }}</td>
                                        <td class="px-4 py-4 text-sm font-medium text-slate-900 dark:text-white">
                                            {{ $booking['vendor'] }}</td>
                                        <td class="px-4 py-4 text-sm">{{ $booking['event_date'] }}</td>
                                        <td class="px-4 py-4 text-sm">{{ $booking['created'] }}</td>
                                        <td class="px-4 py-4 text-sm">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$booking['status']]['badge'] ?? 'bg-slate-200 dark:bg-slate-700' }} {{ $statusColors[$booking['status']]['text'] ?? 'text-slate-700 dark:text-slate-300' }}">
                                                {{ ucfirst($booking['status']) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-sm font-semibold">
                                            {{ number_format($booking['amount'], 0) }}</td>
                                        <td class="px-4 py-4 text-sm"><a href="#"
                                                class="text-blue-600 dark:text-blue-400 hover:underline">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Check List + Budget -->
            <div class="space-y-6">
                <!-- Check List Card -->
                <div
                    class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div
                        class="bg-gradient-to-r from-amber-600 to-orange-600 dark:from-amber-700 dark:to-orange-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg> CHECK LIST
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-3 gap-3 mb-6 text-center">
                            <div class="p-3 bg-slate-100 dark:bg-slate-700/30 rounded-lg">
                                <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                                    {{ $doneTasks }}</div>
                                <div class="text-xs uppercase text-slate-500">Done</div>
                            </div>
                            <div class="p-3 bg-slate-100 dark:bg-slate-700/30 rounded-lg">
                                <div class="text-2xl font-bold text-amber-600 dark:text-amber-400">
                                    {{ $totalTasks - $doneTasks }}</div>
                                <div class="text-xs uppercase text-slate-500">To Do</div>
                            </div>
                            <div class="p-3 bg-slate-100 dark:bg-slate-700/30 rounded-lg">
                                <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $overdueTasks }}
                                </div>
                                <div class="text-xs uppercase text-slate-500">Overdue</div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @foreach ($checklistTasks as $task)
                                <div
                                    class="flex items-start gap-3 p-3 border-l-4 border-blue-500 bg-slate-50 dark:bg-slate-700/30 rounded-r-lg">
                                    <input type="checkbox"
                                        class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">
                                            {{ $task['title'] }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ $task['description'] }}</p>
                                        <p class="text-xs text-red-500 mt-1">Due: {{ $task['due'] }} •
                                            {{ $task['type'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pt-2"><a href="{{ route('host.checklists.index') }}"
                                    class="text-sm text-blue-600 hover:underline">+ Add new Task</a></div>
                        </div>
                    </div>
                </div>

                <!-- Budget Card -->
                <div
                    class="bg-white dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div
                        class="bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-700 dark:to-pink-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg> BUDGET
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Total Amount</p>
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $budgetTotal }}</p>
                            <div class="flex justify-between text-sm mt-2">
                                <span class="text-slate-600 dark:text-slate-400">Paid: {{ $budgetSpent }}</span>
                                <span
                                    class="text-emerald-600 dark:text-emerald-400">{{ floor((floatval(str_replace(',', '', str_replace('PKR ', '', $budgetSpent))) / floatval(str_replace(',', '', str_replace('PKR ', '', $budgetTotal)))) * 100) }}%</span>
                            </div>
                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2 mt-2">
                                <div class="bg-emerald-500 h-2 rounded-full"
                                    style="width: {{ (floatval(str_replace(',', '', str_replace('PKR ', '', $budgetSpent))) / floatval(str_replace(',', '', str_replace('PKR ', '', $budgetTotal)))) * 100 }}%">
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 mt-2">Remaining to be paid: PKR
                                {{ number_format(floatval(str_replace(',', '', str_replace('PKR ', '', $budgetTotal))) - floatval(str_replace(',', '', str_replace('PKR ', '', $budgetSpent))), 0) }}
                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-700 dark:text-slate-300 mb-3">Expense Breakdown</h4>
                            <div class="space-y-2 max-h-60 overflow-y-auto pr-2">
                                @forelse($expenseBreakdown as $category => $amount)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-600 dark:text-slate-400">{{ $category }}</span>
                                        <span class="font-medium text-slate-900 dark:text-white">PKR
                                            {{ number_format($amount, 0) }}</span>
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-400">No expenses yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Picker Modal with Min Date Constraint -->
    @if ($showDateModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            x-data="datePickerModal('{{ $weddingDate ?? '' }}')" x-show="$wire.showDateModal" x-cloak>
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl max-w-md w-full p-6" @click.stop>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Set Your Wedding Date</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Choose the day you'll celebrate your special
                    occasion. (Must be today or in the future)</p>
                <input type="date" x-model="date" :min="todayDate"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" />
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">Minimum date: <span
                        x-text="formatDate(todayDate)"></span></p>
                <div class="flex justify-end gap-3 mt-6">
                    <button @click="$wire.closeDateModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">Cancel</button>
                    <button @click="validateAndSet()"
                        class="px-4 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Save
                        Date</button>
                </div>
            </div>
        </div>
    @endif

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

        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Alpine.js Scripts for Countdown and Date Picker -->
    <script>
        document.addEventListener('alpine:init', () => {
            // Countdown Timer
            window.countdownTimer = (weddingDate) => ({
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,
                init() {
                    this.updateCountdown();
                    setInterval(() => this.updateCountdown(), 1000);
                },
                updateCountdown() {
                    const now = new Date();
                    const eventDate = new Date(weddingDate);

                    if (eventDate <= now) {
                        this.days = 0;
                        this.hours = 0;
                        this.minutes = 0;
                        this.seconds = 0;
                        return;
                    }

                    const diff = eventDate - now;
                    this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    this.hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                    this.minutes = Math.floor((diff / (1000 * 60)) % 60);
                    this.seconds = Math.floor((diff / 1000) % 60);
                }
            });

            // Date Picker Modal
            window.datePickerModal = (currentDate) => ({
                date: currentDate,
                todayDate: new Date().toISOString().split('T')[0],
                init() {
                    if (!this.date) {
                        this.date = this.todayDate;
                    }
                },
                formatDate(dateStr) {
                    const date = new Date(dateStr + 'T00:00:00');
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                },
                validateAndSet() {
                    const selectedDate = new Date(this.date + 'T00:00:00');
                    const today = new Date(this.todayDate + 'T00:00:00');

                    if (selectedDate < today) {
                        alert('Please select a date that is today or in the future.');
                        return;
                    }

                    window.Livewire.dispatch('call', {
                        method: 'setWeddingDate',
                        params: [this.date]
                    });
                }
            });
        });
    </script>
</div>
