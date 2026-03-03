<div class="min-h-screen bg-gray-50 dark:bg-zinc-950" x-data="{ showTooltip: false }">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            {{-- <flux:icon.document-text class="w-6 h-6 text-green-600 dark:text-green-400" /> --}}
                            <x-heroicon-o-currency-dollar/>
                        </div>
                        Total Bookings
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Manage all your bookings and accept/reject requests</p>
                </div>
                <div class="hidden md:block text-right">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Bookings</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $bookings->total() }}</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 flex items-center gap-3">
                    <flux:icon.check-circle class="w-5 h-5 text-green-600 dark:text-green-400" />
                    <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 flex items-center gap-3">
                    <flux:icon.x-circle class="w-5 h-5 text-red-600 dark:text-red-400" />
                    <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
                </div>
            @endif
        </div>

        <!-- Filters and Search Section -->
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Bookings</label>
                    <div class="relative">
                        <flux:icon.magnifying-glass class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="searchQuery"
                            placeholder="Search by booking ID or host name..."
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                        />
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select 
                        wire:model.live="selectedStatus"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                        <option value="all">All Bookings</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="rejected">Rejected</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
            
            <!-- Table Header -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <button wire:click="updateSort('custom_booking_id')" class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider flex items-center gap-2 hover:text-gray-900 dark:hover:text-white">
                                    Booking ID
                                    <flux:icon.arrows-up-down class="w-4 h-4" />
                                </button>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Host Name</th>
                            <th class="px-6 py-4 text-left">
                                <button wire:click="updateSort('event_date')" class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider flex items-center gap-2 hover:text-gray-900 dark:hover:text-white">
                                    Event Date
                                    <flux:icon.arrows-up-down class="w-4 h-4" />
                                </button>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <button wire:click="updateSort('status')" class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider flex items-center gap-2 hover:text-gray-900 dark:hover:text-white">
                                    Status
                                    <flux:icon.arrows-up-down class="w-4 h-4" />
                                </button>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <button wire:click="updateSort('amount')" class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider flex items-center gap-2 hover:text-gray-900 dark:hover:text-white">
                                    Amount
                                    <flux:icon.arrows-up-down class="w-4 h-4" />
                                </button>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                        @forelse($bookings as $booking)
                            @php
                                $formatted = $this->formatBooking($booking);
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <!-- Booking ID -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                            <flux:icon.document-text class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                        </div>
                                        <div>
                                            <p class="font-mono font-semibold text-gray-900 dark:text-white text-sm">{{ $formatted['custom_id'] }}</p>
                                            
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $formatted['created_date'] }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Host Name -->
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $formatted['host_name'] }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $formatted['business_name'] }}</p>
                                </td>

                                <!-- Event Date -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-900 dark:text-white">
                                        <flux:icon.calendar class="w-4 h-4 text-gray-400" />
                                        {{ $formatted['event_date'] }}
                                    </div>
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4">
                                    @if($formatted['status_raw'] === 'pending')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-yellow-600 animate-pulse"></span>
                                            {{ $formatted['status'] }}
                                        </span>
                                    @elseif($formatted['status_raw'] === 'confirmed')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-green-600"></span>
                                            {{ $formatted['status'] }}
                                        </span>
                                    @elseif($formatted['status_raw'] === 'completed')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                            {{ $formatted['status'] }}
                                        </span>
                                    @elseif($formatted['status_raw'] === 'rejected' || $formatted['status_raw'] === 'cancelled')
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                            {{ $formatted['status'] }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 text-xs font-medium">
                                            <span class="w-2 h-2 rounded-full bg-gray-600"></span>
                                            {{ $formatted['status'] }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Amount -->
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white">Rs {{ $formatted['final_amount'] }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $formatted['payment_status'] }}</p>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($formatted['status_raw'] === 'pending')
                                            <!-- Accept Button -->
                                            <button 
                                                wire:click="openActionModal({{ $booking->id }}, 'accept')"
                                                class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors group relative"
                                                title="Accept Booking"
                                            >
                                                <flux:icon.check class="w-5 h-5" />
                                                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">Accept</span>
                                            </button>

                                            <!-- Reject Button -->
                                            <button 
                                                wire:click="openActionModal({{ $booking->id }}, 'reject')"
                                                class="p-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors group relative"
                                                title="Reject Booking"
                                            >
                                                <flux:icon.x-mark class="w-5 h-5" />
                                                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">Reject</span>
                                            </button>
                                        @endif

                                        <!-- View Details Button -->
                                        <button 
                                            wire:click="viewDetails({{ $booking->id }})"
                                            class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors group relative"
                                            title="View Details"
                                        >
                                            <flux:icon.eye class="w-5 h-5" />
                                            <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">View Details</span>
                                        </button>

                                        <!-- More Options -->                                
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <flux:icon.inbox class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4" />
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No Bookings Found</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">You don't have any bookings yet. Check back soon!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4">
                {{ $bookings->links() }}
            </div>
        </div>

    </div>

    <!-- Booking Details Modal -->
    @if($showDetailsModal && $selectedBooking)
        <div class="fixed inset-0 bg-black bg-opacity-50 dark:bg-opacity-70 flex items-center justify-center p-4 z-50" wire:key="details-modal">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 dark:border-zinc-800">
                
                <!-- Modal Header -->
                <div class="sticky top-0 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 px-6 py-6 flex items-center justify-between border-b border-blue-600 dark:border-blue-900">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center">
                            <flux:icon.document-text class="w-5 h-5 text-white" />
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">{{ $selectedBooking['custom_id'] }}</h2>
                            <p class="text-blue-100 text-sm">Booking Details</p>
                        </div>
                    </div>
                    <button 
                        wire:click="closeDetailsModal"
                        class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors"
                    >
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6">
                    
                    <!-- Host Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <flux:icon.user class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                Host Information
                            </h3>
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 space-y-2">
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Full Name</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['host_name'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Email</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['host_email'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Phone</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['host_phone'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Event Information -->
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <flux:icon.calendar class="w-5 h-5 text-green-600 dark:text-green-400" />
                                Event Information
                            </h3>
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 space-y-2">
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Event Date</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['event_date'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Time Slot</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['time_slot'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Guests</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['guests'] }} guests</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package & Business -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <flux:icon.cube class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                                Package
                            </h3>
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 space-y-2">
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Package Name</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['package_name'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Extra Services</p>
                                    <p class="font-medium text-gray-900 dark:text-white text-sm">{{ $selectedBooking['extra_services'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Business -->
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                <flux:icon.briefcase class="w-5 h-5 text-orange-600 dark:text-orange-400" />
                                Business
                            </h3>
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 space-y-2">
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Business Name</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['business_name'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Timezone</p>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $selectedBooking['timezone'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="space-y-3">
                        <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <flux:icon.banknotes class="w-5 h-5 text-green-600 dark:text-green-400" />
                            Payment Information
                        </h3>
                        <div class="bg-gradient-to-br from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20 rounded-lg p-4">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Total Amount</p>
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">Rs {{ $selectedBooking['amount'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Advance %</p>
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">{{ $selectedBooking['advance_percentage'] }}%</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Advance Amount</p>
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">Rs {{ $selectedBooking['advance_amount'] }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Final Amount</p>
                                    <p class="font-bold text-lg text-gray-900 dark:text-white">Rs {{ $selectedBooking['final_amount'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Advance Payment</p>
                                <div class="flex items-center gap-2">
                                    @if($selectedBooking['advance_paid'] === 'Paid')
                                        <flux:icon.check-circle class="w-5 h-5 text-green-600 dark:text-green-400" />
                                        <span class="font-semibold text-green-600 dark:text-green-400">{{ $selectedBooking['advance_paid'] }}</span>
                                    @else
                                        <flux:icon.clock class="w-5 h-5 text-yellow-600 dark:text-yellow-400" />
                                        <span class="font-semibold text-yellow-600 dark:text-yellow-400">{{ $selectedBooking['advance_paid'] }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Final Payment</p>
                                <div class="flex items-center gap-2">
                                    @if($selectedBooking['final_paid'] === 'Paid')
                                        <flux:icon.check-circle class="w-5 h-5 text-green-600 dark:text-green-400" />
                                        <span class="font-semibold text-green-600 dark:text-green-400">{{ $selectedBooking['final_paid'] }}</span>
                                    @else
                                        <flux:icon.clock class="w-5 h-5 text-yellow-600 dark:text-yellow-400" />
                                        <span class="font-semibold text-yellow-600 dark:text-yellow-400">{{ $selectedBooking['final_paid'] }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                                <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">Overall Status</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full 
                                        @if($selectedBooking['status_raw'] === 'confirmed') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                                        @elseif($selectedBooking['status_raw'] === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                                        @elseif($selectedBooking['status_raw'] === 'rejected' || $selectedBooking['status_raw'] === 'cancelled') bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                                        @else bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400
                                        @endif">
                                        {{ $selectedBooking['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Due Dates -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                                <p class="text-xs text-gray-600 dark:text-gray-400">Advance Due Date</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $selectedBooking['advance_due_date'] }}</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                                <p class="text-xs text-gray-600 dark:text-gray-400">Final Due Date</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $selectedBooking['final_due_date'] }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    @if($selectedBooking['status_raw'] === 'confirmed')
                        <button 
                            wire:click="completeBooking"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors flex items-center gap-2"
                        >
                            <flux:icon.check-circle class="w-5 h-5" />
                            Mark as Completed
                        </button>
                    @endif
                    <button 
                        wire:click="closeDetailsModal"
                        class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-colors"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Confirmation Modal -->
    @if($showActionModal && $selectedBooking)
        <div class="fixed inset-0 bg-black bg-opacity-50 dark:bg-opacity-70 flex items-center justify-center p-4 z-50" wire:key="action-modal">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-gray-200 dark:border-zinc-800">
                
                <!-- Modal Header -->
                <div class="bg-gradient-to-r {{ $actionType === 'accept' ? 'from-green-500 to-green-600 dark:from-green-700 dark:to-green-800' : 'from-red-500 to-red-600 dark:from-red-700 dark:to-red-800' }} px-6 py-6 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white bg-opacity-20 flex items-center justify-center">
                            <flux:icon.{{ $actionType === 'accept' ? 'check' : 'x-mark' }} class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">{{ $actionType === 'accept' ? 'Accept Booking' : 'Reject Booking' }}</h2>
                        </div>
                    </div>
                    <button 
                        wire:click="closeActionModal"
                        class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition-colors"
                    >
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-4">
                    <div class="space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{ $selectedBooking['custom_id'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedBooking['host_name'] }}</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Rs {{ $selectedBooking['final_amount'] }}</p>
                    </div>

                    <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Event Date</p>
                        <p class="font-medium text-gray-900 dark:text-white flex items-center gap-2">
                            <flux:icon.calendar class="w-4 h-4" />
                            {{ $selectedBooking['event_date'] }}
                        </p>
                    </div>

                    @if($actionType === 'reject')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Reason (Optional)</label>
                            <textarea 
                                wire:model="actionReason"
                                placeholder="Add a reason for rejection..."
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                                rows="3"
                            ></textarea>
                        </div>
                    @endif

                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-800 dark:text-blue-200 flex items-center gap-2">
                            <flux:icon.information-circle class="w-5 h-5" />
                            {{ $actionType === 'accept' ? 'You\'re about to confirm this booking. The host will be notified immediately.' : 'You\'re about to reject this booking. The host will be notified.' }}
                        </p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3">
                    <button 
                        wire:click="closeActionModal"
                        class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-colors"
                    >
                        Cancel
                    </button>
                    <button 
                        wire:click="{{ $actionType === 'accept' ? 'acceptBooking' : 'rejectBooking' }}"
                        class="px-4 py-2 rounded-lg {{ $actionType === 'accept' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white font-semibold transition-colors flex items-center gap-2"
                    >
                        <flux:icon.{{ $actionType === 'accept' ? 'check' : 'x-mark' }} class="w-5 h-5" />
                        {{ $actionType === 'accept' ? 'Confirm' : 'Reject' }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Livewire event listener for booking updates -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('booking-updated', () => {
                // Optional: show a toast or refresh data
            });
        });
    </script>
</div>