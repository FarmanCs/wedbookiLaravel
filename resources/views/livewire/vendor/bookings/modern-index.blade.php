<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-blue-950">
    <!-- Animated Background -->
    <div
        class="fixed inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-100/30 via-transparent to-purple-100/30 dark:from-blue-950/30 dark:via-transparent dark:to-purple-950/30">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1
                        class="text-4xl font-black bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent flex items-center gap-3">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 flex items-center justify-center">
                            <x-heroicon-o-shopping-bag class="w-7 h-7 text-blue-600 dark:text-blue-400" />
                        </div>
                        My Purchases & Bookings
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">View and manage your credits, plans, and bookings
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div
                    class="mb-4 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 flex items-center gap-3">
                    <x-heroicon-s-check-circle class="w-6 h-6 text-green-600 dark:text-green-400" />
                    <p class="text-sm font-semibold text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-4 p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border border-red-200 dark:border-red-800 flex items-center gap-3">
                    <x-heroicon-s-x-circle class="w-6 h-6 text-red-600 dark:text-red-400" />
                    <p class="text-sm font-semibold text-red-800 dark:text-red-200">{{ session('error') }}</p>
                </div>
            @endif
        </div>

        <!-- Tab Navigation -->
        <div class="flex gap-2 mb-8">
            <button wire:click="switchTab('purchases')"
                class="px-6 py-3 rounded-xl font-semibold transition-all flex items-center gap-2
                {{ $activeTab === 'purchases'
                    ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg shadow-blue-600/30'
                    : 'bg-white dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700' }}">
                <x-heroicon-o-credit-card class="w-5 h-5" />
                Credits & Plans
                <span
                    class="ml-2 px-2 py-1 rounded-lg text-xs font-bold bg-white/20">{{ $purchases?->total() ?? 0 }}</span>
            </button>
            <button wire:click="switchTab('bookings')"
                class="px-6 py-3 rounded-xl font-semibold transition-all flex items-center gap-2
                {{ $activeTab === 'bookings'
                    ? 'bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-lg shadow-purple-600/30'
                    : 'bg-white dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700' }}">
                <x-heroicon-o-calendar-days class="w-5 h-5" />
                Bookings
                <span
                    class="ml-2 px-2 py-1 rounded-lg text-xs font-bold bg-white/20">{{ $bookings?->total() ?? 0 }}</span>
            </button>
        </div>

        <!-- Filters and Search -->
        <div
            class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <x-heroicon-o-magnifying-glass class="inline w-4 h-4 mr-2" />
                        Search
                    </label>
                    <input type="text" wire:model.live.debounce.300ms="searchQuery"
                        placeholder="Search by ID, business name, or host name..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        <x-heroicon-o-adjustments-horizontal class="inline w-4 h-4 mr-2" />
                        Status
                    </label>
                    <select wire:model.live="selectedStatus"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @if ($activeTab === 'purchases')
                            <option value="all">All Purchases</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        @else
                            <option value="all">All Bookings</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
                        @endif
                    </select>
                </div>
            </div>

            {{-- FIXED PURCHASES CARD SECTION --}}
            {{-- Replace the entire @if ($activeTab === 'purchases' && $purchases) block with this --}}

            @if ($activeTab === 'purchases' && $purchases)
                <div class="space-y-6">
                    @forelse($purchases as $purchase)
                        @php
                            $formatted = $this->formatPurchase($purchase);
                        @endphp
                        <div
                            class="group bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-lg transition-all duration-300 overflow-hidden">
                            <!-- Header -->
                            <div
                                class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/10 dark:to-purple-900/10 border-b border-gray-200 dark:border-zinc-800 px-6 py-5 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                                        <x-heroicon-o-shopping-bag class="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $formatted['purchase_id'] }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $formatted['business_name'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-blue-600 dark:text-blue-400">Rs
                                        {{ $formatted['total_amount'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $formatted['created_date'] }}</p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-4">
                                <!-- Status Badge -->
                                <div class="flex items-center gap-3">
                                    @if ($formatted['status_raw'] === 'completed')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                            <x-heroicon-s-check-circle class="w-4 h-4" />
                                            Completed
                                        </span>
                                    @elseif($formatted['status_raw'] === 'pending')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300">
                                            <x-heroicon-o-clock class="w-4 h-4" />
                                            Pending
                                        </span>
                                    @elseif($formatted['status_raw'] === 'refunded')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                            <x-heroicon-s-x-circle class="w-4 h-4" />
                                            Refunded
                                        </span>
                                    @endif
                                </div>

                                {{-- FIXED: Show single credit transaction instead of cart_items loop --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div
                                        class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/10 dark:to-orange-900/10 rounded-xl p-4 border border-amber-200 dark:border-amber-800/30">
                                        <div class="flex items-start gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center flex-shrink-0">
                                                <span class="text-white font-bold text-sm">⚡</span>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-900 dark:text-white">
                                                    {{ $formatted['credit_plan'] }}</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ $formatted['credits'] }} Credits
                                                </p>
                                                <p
                                                    class="text-xs text-amber-600 dark:text-amber-400 font-semibold mt-1">
                                                    Total: {{ $formatted['credits'] }} Credits
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary -->
                                <div
                                    class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                                        <x-heroicon-o-list-bullet class="w-5 h-5" />
                                        {{-- FIXED: Changed from count($formatted['cart_items']) to just show 1 --}}
                                        <span class="font-semibold">1 Item</span>
                                        @if ($formatted['credits'] > 0)
                                            <span class="text-sm text-gray-500 dark:text-gray-400">•</span>
                                            <span
                                                class="text-sm text-amber-600 dark:text-amber-400 font-semibold">{{ $formatted['credits'] }}
                                                Credits</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div
                                class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                                <button wire:click="viewPurchaseDetails({{ $purchase->id }})"
                                    class="px-4 py-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 font-semibold transition-all flex items-center gap-2">
                                    <x-heroicon-o-eye class="w-4 h-4" />
                                    View Details
                                </button>
                                @if ($formatted['status_raw'] === 'completed')
                                    <button wire:click="openCancelModal({{ $purchase->id }})"
                                        class="px-4 py-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 font-semibold transition-all flex items-center gap-2">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div
                            class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-zinc-800 flex items-center justify-center mb-4">
                                    <x-heroicon-o-shopping-bag class="w-8 h-8 text-gray-400 dark:text-gray-600" />
                                </div>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Purchases Found</p>
                                <p class="text-gray-600 dark:text-gray-400">You haven't made any purchases yet.</p>
                            </div>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if ($purchases->hasPages())
                        <div class="flex justify-center mt-8">
                            {{ $purchases->links() }}
                        </div>
                    @endif
                </div>
            @endif

            <!-- Bookings Section -->
            @if ($activeTab === 'bookings' && $bookings)
                <div class="space-y-6">
                    @forelse($bookings as $booking)
                        @php
                            $formatted = $this->formatBooking($booking);
                        @endphp
                        <div
                            class="group bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-lg transition-all duration-300 overflow-hidden">
                            <!-- Header -->
                            <div
                                class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/10 dark:to-pink-900/10 border-b border-gray-200 dark:border-zinc-800 px-6 py-5 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                                        <x-heroicon-o-calendar-days class="w-6 h-6 text-white" />
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $formatted['custom_id'] }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            {{ $formatted['host_name'] }}
                                            • {{ $formatted['business_name'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-purple-600 dark:text-purple-400">Rs
                                        {{ $formatted['final_amount'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $formatted['event_date'] }}
                                    </p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-4">
                                <!-- Status Badge -->
                                <div class="flex items-center gap-3">
                                    @if ($formatted['status_raw'] === 'completed')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                            <x-heroicon-s-check-circle class="w-4 h-4" />
                                            Completed
                                        </span>
                                    @elseif($formatted['status_raw'] === 'pending')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300">
                                            <x-heroicon-o-clock class="w-4 h-4" />
                                            Pending
                                        </span>
                                    @elseif($formatted['status_raw'] === 'refunded')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                            <x-heroicon-s-x-circle class="w-4 h-4" />
                                            Refunded
                                        </span>
                                    @endif
                                </div>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div
                                        class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-4 border border-gray-200 dark:border-zinc-700">
                                        <p
                                            class="text-xs text-gray-600 dark:text-gray-400 font-semibold mb-1 flex items-center gap-1">
                                            <x-heroicon-o-calendar class="w-4 h-4" />
                                            Event Date
                                        </p>
                                        <p class="font-bold text-gray-900 dark:text-white">
                                            {{ $formatted['event_date'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-4 border border-gray-200 dark:border-zinc-700">
                                        <p
                                            class="text-xs text-gray-600 dark:text-gray-400 font-semibold mb-1 flex items-center gap-1">
                                            <x-heroicon-o-user-group class="w-4 h-4" />
                                            Guests
                                        </p>
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $formatted['guests'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-4 border border-gray-200 dark:border-zinc-700">
                                        <p
                                            class="text-xs text-gray-600 dark:text-gray-400 font-semibold mb-1 flex items-center gap-1">
                                            <x-heroicon-o-list-bullet class="w-4 h-4" />
                                            Package
                                        </p>
                                        <p class="font-bold text-gray-900 dark:text-white text-sm truncate">
                                            {{ $formatted['package_name'] }}</p>
                                    </div>
                                    <div
                                        class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-4 border border-gray-200 dark:border-zinc-700">
                                        <p
                                            class="text-xs text-gray-600 dark:text-gray-400 font-semibold mb-1 flex items-center gap-1">
                                            <x-heroicon-o-credit-card class="w-4 h-4" />
                                            Payment
                                        </p>
                                        <p class="font-bold text-gray-900 dark:text-white">
                                            {{ $formatted['advance_paid'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div
                                class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                                <button wire:click="viewBookingDetails({{ $booking->id }})"
                                    class="px-4 py-2 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-900/50 font-semibold transition-all flex items-center gap-2">
                                    <x-heroicon-o-eye class="w-4 h-4" />
                                    View Details
                                </button>
                                @if ($formatted['status_raw'] === 'pending')
                                    <button wire:click="openActionModal({{ $booking->id }}, 'accept')"
                                        class="px-4 py-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-900/50 font-semibold transition-all flex items-center gap-2">
                                        <x-heroicon-s-check-circle class="w-4 h-4" />
                                        Accept
                                    </button>
                                    <button wire:click="openActionModal({{ $booking->id }}, 'reject')"
                                        class="px-4 py-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/50 font-semibold transition-all flex items-center gap-2">
                                        <x-heroicon-s-x-circle class="w-4 h-4" />
                                        Reject
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div
                            class="bg-white dark:bg-zinc-900 rounded-2xl border border-gray-200 dark:border-zinc-800 p-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-zinc-800 flex items-center justify-center mb-4">
                                    <x-heroicon-o-calendar class="w-8 h-8 text-gray-400 dark:text-gray-600" />
                                </div>
                                <p class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Bookings Found</p>
                                <p class="text-gray-600 dark:text-gray-400">You don't have any bookings at the moment.
                                </p>
                            </div>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if ($bookings->hasPages())
                        <div class="flex justify-center mt-8">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Purchase Details Modal -->
        @if ($showDetailsModal && $selectedItem && $itemType === 'purchase')
            <div class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 dark:border-zinc-800">
                    <!-- Header -->
                    <div
                        class="sticky top-0 bg-gradient-to-r from-blue-500 to-purple-500 dark:from-blue-700 dark:to-purple-700 px-6 py-6 flex items-center justify-between border-b border-blue-600 dark:border-blue-900">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center">
                                <x-heroicon-o-shopping-bag class="w-5 h-5 text-white" />
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $selectedItem['purchase_id'] }}</h2>
                                <p class="text-blue-100 text-sm">Purchase Details</p>
                            </div>
                        </div>
                        <button wire:click="closeDetailsModal"
                            class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-6">
                        <!-- Business Info -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/10 dark:to-purple-900/10 rounded-xl p-5 border border-blue-200 dark:border-blue-800/30">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                    <x-heroicon-o-building-storefront class="w-5 h-5 text-white" />
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $selectedItem['business_name'] }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Purchase Date:
                                        {{ $selectedItem['created_date'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Items -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <x-heroicon-o-list-bullet class="w-5 h-5 text-blue-600" />
                                Purchased Items
                            </h3>
                            <div class="space-y-3">
                                @foreach ($selectedItem['cart_items'] as $item)
                                    @if ($item['type'] === 'credit')
                                        <div
                                            class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/10 dark:to-orange-900/10 rounded-xl p-4 border border-amber-200 dark:border-amber-800/30">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center">
                                                        <span class="text-white font-bold text-sm">⚡</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-900 dark:text-white">
                                                            {{ $item['name'] }}</p>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $item['credits'] }} Credits each</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-bold text-amber-600 dark:text-amber-400">
                                                        {{ $item['quantity'] }}×</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Rs
                                                        {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/10 dark:to-purple-900/10 rounded-xl p-4 border border-indigo-200 dark:border-indigo-800/30">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center">
                                                        <span class="text-white font-bold text-sm">👑</span>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-gray-900 dark:text-white">
                                                            {{ $item['name'] }}</p>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ ucfirst($item['cycle']) }} Plan</p>
                                                    </div>
                                                </div>
                                                <p class="font-bold text-indigo-600 dark:text-indigo-400">Rs
                                                    {{ number_format($item['price'], 2) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Total -->
                        <div
                            class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10 rounded-xl p-5 border border-green-200 dark:border-green-800/30">
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-bold text-gray-900 dark:text-white">Total Amount</p>
                                <p class="text-3xl font-black text-green-600 dark:text-green-400">Rs
                                    {{ $selectedItem['total_amount'] }}</p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div
                            class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-4 border border-gray-200 dark:border-zinc-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold mb-2">Status</p>
                            @if ($selectedItem['status_raw'] === 'completed')
                                <div class="flex items-center gap-2">
                                    <x-heroicon-s-check-circle class="w-5 h-5 text-green-600 dark:text-green-400" />
                                    <span
                                        class="font-semibold text-green-600 dark:text-green-400">{{ $selectedItem['status'] }}</span>
                                </div>
                            @elseif($selectedItem['status_raw'] === 'failed')
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-x-circle class="w-5 h-5 text-red-600 dark:text-red-400" />
                                    <span
                                        class="font-semibold text-red-600 dark:text-red-400">{{ $selectedItem['status'] }}</span>
                                </div>
                            @elseif($selectedItem['status_raw'] === 'refunded')
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-arrow-uturn-left class="w-5 h-5 text-gray-600 dark:text-gray-300" />
                                    <span
                                        class="font-semibold text-gray-600 dark:text-gray-300">{{ $selectedItem['status'] }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                        <button wire:click="closeDetailsModal"
                            class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-colors">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Cancel Purchase Modal -->
        @if ($showCancelModal && $selectedItem && $itemType === 'purchase')
            <div class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800">
                    <!-- Header -->
                    <div
                        class="bg-gradient-to-r from-red-500 to-rose-600 dark:from-red-700 dark:to-rose-800 px-6 py-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center">
                                <x-heroicon-o-trash class="w-6 h-6 text-white" />
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-white">Cancel Purchase</h2>
                            </div>
                        </div>
                        <button wire:click="closeCancelModal"
                            class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-4">
                        <div class="space-y-2">
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $selectedItem['purchase_id'] }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedItem['business_name'] }}
                            </p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">Rs
                                {{ $selectedItem['total_amount'] }}</p>
                        </div>

                        <div
                            class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <p class="text-sm text-red-800 dark:text-red-200 flex items-start gap-2">
                                <x-heroicon-o-exclamation-triangle class="w-5 h-5 flex-shrink-0 mt-0.5" />
                                <span>Are you sure you want to cancel this purchase? A refund will be initiated.</span>
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Reason
                                (Optional)</label>
                            <textarea wire:model="cancelReason" placeholder="Tell us why you're canceling..."
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                                rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                        <button wire:click="closeCancelModal"
                            class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-colors">
                            Keep It
                        </button>
                        <button wire:click="cancelPurchase"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition-colors flex items-center gap-2">
                            <x-heroicon-o-trash class="w-4 h-4" />
                            Cancel Purchase
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Booking Details Modal -->
        @if ($showDetailsModal && $selectedItem && $itemType === 'booking')
            <div class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 dark:border-zinc-800">
                    <!-- Header -->
                    <div
                        class="sticky top-0 bg-gradient-to-r from-purple-500 to-pink-500 dark:from-purple-700 dark:to-pink-700 px-6 py-6 flex items-center justify-between border-b border-purple-600 dark:border-purple-900">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center">
                                <x-heroicon-o-calendar-days class="w-5 h-5 text-white" />
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $selectedItem['custom_id'] }}</h2>
                                <p class="text-purple-100 text-sm">Booking Details</p>
                            </div>
                        </div>
                        <button wire:click="closeDetailsModal"
                            class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-6">
                        <!-- Host Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/10 dark:to-cyan-900/10 rounded-xl p-5 border border-blue-200 dark:border-blue-800/30">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <x-heroicon-o-user class="w-5 h-5 text-blue-600" />
                                    Host Information
                                </h3>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Name</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['host_name'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Email</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['host_email'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Phone</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['host_phone'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10 rounded-xl p-5 border border-green-200 dark:border-green-800/30">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <x-heroicon-o-calendar class="w-5 h-5 text-green-600" />
                                    Event Information
                                </h3>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Event Date</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['event_date'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Time Slot</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['time_slot'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Guests</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['guests'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Package & Business -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/10 dark:to-violet-900/10 rounded-xl p-5 border border-purple-200 dark:border-purple-800/30">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <x-heroicon-o-list-bullet class="w-5 h-5 text-purple-600" />
                                    Package
                                </h3>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Package Name</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['package_name'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Extra Services</p>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">
                                            {{ $selectedItem['extra_services'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 rounded-xl p-5 border border-orange-200 dark:border-orange-800/30">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <x-heroicon-o-briefcase class="w-5 h-5 text-orange-600" />
                                    Business
                                </h3>
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Business Name</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['business_name'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Timezone</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $selectedItem['timezone'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <x-heroicon-o-credit-card class="w-5 h-5 text-green-600" />
                                Payment Information
                            </h3>
                            <div
                                class="bg-gradient-to-br from-green-50 to-blue-50 dark:from-green-900/10 dark:to-blue-900/10 rounded-xl p-5 border border-green-200 dark:border-green-800/30">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Total</p>
                                        <p class="font-bold text-gray-900 dark:text-white">Rs
                                            {{ $selectedItem['amount'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Advance %</p>
                                        <p class="font-bold text-gray-900 dark:text-white">
                                            {{ $selectedItem['advance_percentage'] }}%</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Advance</p>
                                        <p class="font-bold text-gray-900 dark:text-white">Rs
                                            {{ $selectedItem['advance_amount'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Final</p>
                                        <p class="font-bold text-gray-900 dark:text-white">Rs
                                            {{ $selectedItem['final_amount'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                        @if ($selectedItem['status_raw'] === 'confirmed')
                            <button wire:click="completeBooking"
                                class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors flex items-center gap-2">
                                <x-heroicon-s-check-circle class="w-5 h-5" />
                                Mark as Completed
                            </button>
                        @endif
                        <button wire:click="closeDetailsModal"
                            class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-colors">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Modal -->
        @if ($showActionModal && $selectedItem && $itemType === 'booking')
            <div class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-50">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800">
                    <!-- Header -->
                    <div
                        class="bg-gradient-to-r {{ $actionType === 'accept' ? 'from-green-500 to-emerald-600 dark:from-green-700 dark:to-emerald-800' : 'from-red-500 to-rose-600 dark:from-red-700 dark:to-rose-800' }} px-6 py-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center">
                                @if ($actionType === 'accept')
                                    <x-heroicon-o-check-circle class="w-6 h-6 text-white" />
                                @else
                                    <x-heroicon-o-x-circle class="w-6 h-6 text-white" />
                                @endif
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-white">
                                    {{ $actionType === 'accept' ? 'Accept Booking' : 'Reject Booking' }}</h2>
                            </div>
                        </div>
                        <button wire:click="closeActionModal"
                            class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-4">
                        <div class="space-y-2">
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $selectedItem['custom_id'] }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedItem['host_name'] }}</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">Rs
                                {{ $selectedItem['final_amount'] }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 flex items-center gap-2">
                                <x-heroicon-o-calendar class="w-4 h-4" />
                                Event Date
                            </p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $selectedItem['event_date'] }}
                            </p>
                        </div>

                        @if ($actionType === 'reject')
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Reason
                                    (Optional)</label>
                                <textarea wire:model="actionReason" placeholder="Tell the host why you're rejecting..."
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                                    rows="3"></textarea>
                            </div>
                        @endif

                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <p class="text-sm text-blue-800 dark:text-blue-200 flex items-start gap-2">
                                <x-heroicon-o-information-circle class="w-5 h-5 flex-shrink-0 mt-0.5" />
                                {{ $actionType === 'accept' ? 'The host will be notified that you\'ve accepted the booking.' : 'The host will be notified of your rejection.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                        <button wire:click="closeActionModal"
                            class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-colors">
                            Cancel
                        </button>
                        @if ($actionType === 'accept')
                            <button wire:click="acceptBooking"
                                class="px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition-colors flex items-center gap-2">
                                <x-heroicon-s-check-circle class="w-5 h-5" />
                                Confirm
                            </button>
                        @else
                            <button wire:click="rejectBooking"
                                class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition-colors flex items-center gap-2">
                                <x-heroicon-s-x-circle class="w-5 h-5" />
                                Reject
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
