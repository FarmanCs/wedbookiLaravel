<div
    class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1
                        class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent">
                        My Bookings
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Manage your venue and package reservations</p>
                </div>
                {{-- Create button commented out as in original --}}
            </div>
        </div>

        {{-- Booking Type Tabs --}}
        <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-2 inline-flex space-x-2">
                <button wire:click="$set('bookingType', 'all')"
                    class="px-6 py-3 rounded-xl font-medium transition-all duration-300 {{ $bookingType === 'all' ? 'bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 text-white shadow-lg' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    All Bookings
                </button>
                <button wire:click="$set('bookingType', 'package')"
                    class="px-6 py-3 rounded-xl font-medium transition-all duration-300 {{ $bookingType === 'package' ? 'bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 text-white shadow-lg' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Package Bookings
                </button>
                <button wire:click="$set('bookingType', 'venue')"
                    class="px-6 py-3 rounded-xl font-medium transition-all duration-300 {{ $bookingType === 'venue' ? 'bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 text-white shadow-lg' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Venue Bookings
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Bookings</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $bookings->total() }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                        <x-heroicon-o-calendar class="size-8 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-green-500 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Confirmed</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $bookings->where('status', 'confirmed')->count() }}</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                        <x-heroicon-o-check-circle class="size-8 text-green-600 dark:text-green-400" />
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Pending</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ $bookings->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl">
                        <x-heroicon-o-clock class="size-8 text-yellow-600 dark:text-yellow-400" />
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-purple-500 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Spent</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            ${{ number_format($bookings->sum('final_amount'), 2) }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                        <x-heroicon-o-currency-dollar class="size-8 text-purple-600 dark:text-purple-400" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <x-heroicon-o-funnel class="size-5 mr-2" />
                    Filters & Search
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Search by vendor or business..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <x-heroicon-o-magnifying-glass
                            class="size-5 text-gray-400 dark:text-gray-500 absolute left-3 top-1/2 transform -translate-y-1/2" />
                    </div>

                    <select wire:model.live="statusFilter"
                        class="border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="all">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>

                    <select wire:model.live="sortBy"
                        class="border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="event_date">Sort by Event Date</option>
                        <option value="created_at">Sort by Created Date</option>
                        <option value="amount">Sort by Amount</option>
                    </select>

                    <select wire:model.live="sortDirection"
                        class="border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Bookings Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Booking ID</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Type</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Vendor/Business</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Package/Venue</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Event Date</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Amount</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Payment</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-blue-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                {{-- Booking ID --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="p-2 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 rounded-lg mr-3">
                                            <x-heroicon-o-ticket class="size-5 text-blue-600 dark:text-blue-400" />
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $booking->custom_booking_id }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $booking->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Booking Type --}}
                                <td class="px-6 py-4">
                                    @if ($booking->package_id)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200">
                                            <x-heroicon-o-cube class="size-3 mr-1" />
                                            Package
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-200">
                                            <x-heroicon-o-building-office class="size-3 mr-1" />
                                            Venue
                                        </span>
                                    @endif
                                </td>

                                {{-- Vendor/Business Info --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($booking->business && $booking->business->profile_image)
                                            <img src="{{ Storage::url($booking->business->profile_image) }}"
                                                alt="Business"
                                                class="size-10 rounded-full object-cover mr-3 border-2 border-blue-200 dark:border-blue-800">
                                        @else
                                            <div
                                                class="size-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-400 flex items-center justify-center text-white font-bold mr-3">
                                                {{ substr($booking->business->company_name ?? 'N', 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $booking->business->company_name ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $booking->vendor->full_name ?? 'N/A' }}</p>
                                            @if ($booking->business && $booking->business->rating)
                                                <div class="flex items-center mt-1">
                                                    <x-heroicon-o-star class="size-3 text-yellow-400 fill-current" />
                                                    <span
                                                        class="text-xs text-gray-600 dark:text-gray-300 ml-1">{{ number_format($booking->business->rating, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Package/Venue --}}
                                <td class="px-6 py-4">
                                    @if ($booking->package_id && $booking->package)
                                        <div class="flex items-center">
                                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-2">
                                                <x-heroicon-o-sparkles
                                                    class="size-4 text-blue-600 dark:text-blue-400" />
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">
                                                    {{ $booking->package->name }}</p>
                                                @if ($booking->package->is_popular)
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 mt-1">
                                                        Popular
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-2">
                                                <x-heroicon-o-map-pin
                                                    class="size-4 text-purple-600 dark:text-purple-400" />
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Custom Venue</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Direct Booking</p>
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                {{-- Event Date --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <x-heroicon-o-calendar-days
                                            class="size-5 text-gray-400 dark:text-gray-500 mr-2" />
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">
                                                {{ $booking->event_date->format('M d, Y') }}</p>
                                            @if ($booking->start_time)
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $booking->start_time->format('h:i A') }}</p>
                                            @endif
                                            @if ($booking->event_date->isPast())
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 mt-1">Past
                                                    Event</span>
                                            @elseif($booking->event_date->isToday())
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-300 mt-1">Today</span>
                                            @elseif($booking->event_date->isFuture() && $booking->event_date->diffInDays() <= 7)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-300 mt-1">Upcoming</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Amount --}}
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                                            ${{ number_format($booking->final_amount, 2) }}</p>
                                        @if ($booking->advance_amount)
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Advance:
                                                ${{ number_format($booking->advance_amount, 2) }}</p>
                                        @endif
                                    </div>
                                </td>

                                {{-- Payment Status --}}
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        @if ($booking->payment_status === 'completed' || ($booking->advance_paid && $booking->final_paid))
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200">
                                                <x-heroicon-o-check-circle class="size-3 mr-1" />
                                                Paid
                                            </span>
                                        @elseif($booking->advance_paid && !$booking->final_paid)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200">
                                                <x-heroicon-o-clock class="size-3 mr-1" />
                                                Partial
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200">
                                                <x-heroicon-o-x-circle class="size-3 mr-1" />
                                                Unpaid
                                            </span>
                                        @endif

                                        @if (!$booking->final_paid)
                                            <button wire:click="initiatePayment({{ $booking->id }})"
                                                class="mt-1 inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 text-white hover:from-blue-700 hover:to-purple-700 transition-all duration-300">
                                                <x-heroicon-o-credit-card class="size-3 mr-1" />
                                                Pay Now
                                            </button>
                                        @endif
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                        @switch($booking->status)
                                            @case('confirmed') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 @break
                                            @case('pending') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 @break
                                            @case('cancelled') bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 @break
                                            @case('completed') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 @break
                                            @default bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                        @endswitch">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('host.bookings.show', $booking) }}" wire:navigate
                                            class="inline-flex items-center p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors duration-200">
                                            <x-heroicon-o-eye class="size-4" />
                                        </a>

                                        @if ($booking->status === 'pending')
                                            <a href="{{ route('host.bookings.edit', $booking) }}" wire:navigate
                                                class="inline-flex items-center p-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-lg hover:bg-purple-200 dark:hover:bg-purple-800 transition-colors duration-200">
                                                <x-heroicon-o-pencil class="size-4" />
                                            </a>
                                        @endif

                                        @if (in_array($booking->status, ['pending', 'confirmed']))
                                            <button wire:click="cancelBooking({{ $booking->id }})"
                                                wire:confirm="Are you sure you want to cancel this booking? This action cannot be undone."
                                                class="inline-flex items-center p-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition-colors duration-200">
                                                <x-heroicon-o-x-mark class="size-4" />
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="p-6 bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 rounded-full mb-4">
                                            <x-heroicon-o-calendar-days
                                                class="size-16 text-gray-400 dark:text-gray-500" />
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No
                                            bookings found</h3>
                                        <p class="text-gray-600 dark:text-gray-300 mb-6">Start planning your event by
                                            creating your first
                                            booking</p>
                                        <a href="{{ route('host.bookings.create') }}" wire:navigate
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg shadow-lg transition-all duration-300">
                                            <x-heroicon-o-plus class="size-5 mr-2" />
                                            Create Your First Booking
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($bookings->hasPages())
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>

        {{-- Quick Actions Panel --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
                <x-heroicon-o-calendar-days class="size-10 mb-4 opacity-80" />
                <h3 class="text-xl font-bold mb-2">Upcoming Events</h3>
                <p class="text-blue-100 mb-4">{{ $bookings->where('event_date', '>=', now())->count() }} events
                    scheduled</p>
                <a href="#"
                    class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                    View Calendar
                </a>
            </div>

            <div
                class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-700 dark:to-purple-800 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
                <x-heroicon-o-credit-card class="size-10 mb-4 opacity-80" />
                <h3 class="text-xl font-bold mb-2">Pending Payments</h3>
                <p class="text-purple-100 mb-4">
                    ${{ number_format($bookings->where('final_paid', false)->sum('final_amount'), 2) }} outstanding</p>
                <a href="#"
                    class="inline-flex items-center px-4 py-2 bg-white text-purple-600 rounded-lg hover:bg-purple-50 transition-colors duration-200">
                    Manage Payments
                </a>
            </div>

            <div
                class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-700 dark:to-green-800 rounded-2xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-300">
                <x-heroicon-o-chart-bar class="size-10 mb-4 opacity-80" />
                <h3 class="text-xl font-bold mb-2">Event Insights</h3>
                <p class="text-green-100 mb-4">Track your event planning progress</p>
                <a href="#"
                    class="inline-flex items-center px-4 py-2 bg-white text-green-600 rounded-lg hover:bg-green-50 transition-colors duration-200">
                    View Reports
                </a>
            </div>
        </div>
    </div>

    {{-- Loading State Overlay --}}
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 flex flex-col items-center shadow-2xl">
            <div
                class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 dark:border-blue-400 mb-4">
            </div>
            <p class="text-gray-700 dark:text-gray-300 font-semibold">Loading...</p>
        </div>
    </div>
</div>
