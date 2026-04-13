<div
    class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('host.bookings.index') }}" wire:navigate
                        class="p-2 bg-white dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <x-heroicon-o-arrow-left class="size-6 text-gray-600 dark:text-gray-300" />
                    </a>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Booking Details</h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">{{ $booking->custom_booking_id }}</p>
                    </div>
                </div>

                {{-- Status Badge --}}
                <span
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                    @switch($booking->status)
                        @case('confirmed') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 @break
                        @case('pending') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 @break
                        @case('cancelled') bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 @break
                        @case('rejected') bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 @break
                        @case('completed') bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 @break
                        @default bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                    @endswitch">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Booking Information Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <x-heroicon-o-information-circle class="size-6 text-blue-600 dark:text-blue-400" />
                        Booking Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Booking Type --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Booking Type</label>
                            <p class="mt-1 text-gray-900 dark:text-white font-medium">
                                @if ($booking->isPackageBooking())
                                    <span class="inline-flex items-center gap-2">
                                        <x-heroicon-o-cube class="size-5 text-blue-600 dark:text-blue-400" />
                                        Package Booking
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2">
                                        <x-heroicon-o-building-office
                                            class="size-5 text-purple-600 dark:text-purple-400" />
                                        Venue Booking
                                    </span>
                                @endif
                            </p>
                        </div>

                        {{-- Package/Venue Name --}}
                        <div>
                            <label
                                class="text-sm font-semibold text-gray-600 dark:text-gray-400">{{ $booking->isPackageBooking() ? 'Package' : 'Venue' }}</label>
                            <p class="mt-1 text-gray-900 dark:text-white font-medium">
                                {{ $booking->getBookableItemName() }}
                            </p>
                        </div>

                        {{-- Event Date --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Event Date</label>
                            <p class="mt-1 text-gray-900 dark:text-white font-medium flex items-center gap-2">
                                <x-heroicon-o-calendar-days class="size-5 text-blue-600 dark:text-blue-400" />
                                {{ $booking->event_date->format('l, F d, Y') }}
                            </p>
                        </div>

                        {{-- Event Time --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Event Time</label>
                            <p class="mt-1 text-gray-900 dark:text-white font-medium flex items-center gap-2">
                                <x-heroicon-o-clock class="size-5 text-blue-600 dark:text-blue-400" />
                                {{ $booking->start_time->format('h:i A') }} - {{ $booking->end_time->format('h:i A') }}
                            </p>
                        </div>

                        {{-- Guests --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Number of
                                Guests</label>
                            <p class="mt-1 text-gray-900 dark:text-white font-medium flex items-center gap-2">
                                <x-heroicon-o-users class="size-5 text-blue-600 dark:text-blue-400" />
                                {{ $booking->guests }} guests
                            </p>
                        </div>

                        {{-- Created Date --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Booking
                                Created</label>
                            <p class="mt-1 text-gray-900 dark:text-white font-medium">
                                {{ $booking->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>
                    </div>

                    {{-- Special Requests --}}
                    @if ($booking->special_requests)
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400">Special
                                Requests</label>
                            <p class="mt-2 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                                {{ $booking->special_requests }}
                            </p>
                        </div>
                    @endif

                    {{-- Extra Services --}}
                    @if ($booking->extra_services && count($booking->extra_services) > 0)
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <label class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3 block">Extra
                                Services</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($booking->extra_services as $service)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200">
                                        <x-heroicon-o-check-circle class="size-4 mr-1" />
                                        {{ $service }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Vendor/Business Information --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <x-heroicon-o-building-office-2 class="size-6 text-blue-600 dark:text-blue-400" />
                        Vendor Information
                    </h2>

                    <div class="flex items-start gap-4">
                        @if ($booking->business && $booking->business->profile_image)
                            <img src="{{ Storage::url($booking->business->profile_image) }}" alt="Business"
                                class="size-20 rounded-lg object-cover border-2 border-blue-200 dark:border-blue-800">
                        @else
                            <div
                                class="size-20 rounded-lg bg-gradient-to-br from-blue-400 to-purple-400 flex items-center justify-center text-white font-bold text-2xl">
                                {{ substr($booking->business->company_name ?? 'V', 0, 1) }}
                            </div>
                        @endif

                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ $booking->business->company_name ?? 'N/A' }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-1">
                                {{ $booking->vendor->full_name ?? 'N/A' }}
                            </p>

                            @if ($booking->business && $booking->business->rating)
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <x-heroicon-o-star
                                                class="size-4 {{ $i <= $booking->business->rating ? 'text-yellow-400 fill-current' : 'text-gray-300 dark:text-gray-600' }}" />
                                        @endfor
                                    </div>
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-300">{{ number_format($booking->business->rating, 1) }}</span>
                                </div>
                            @endif

                            @if ($booking->business && $booking->business->business_phone)
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 flex items-center gap-2">
                                    <x-heroicon-o-phone class="size-4" />
                                    {{ $booking->business->business_phone }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Payment Timeline --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <x-heroicon-o-clock class="size-6 text-blue-600 dark:text-blue-400" />
                        Payment Timeline
                    </h2>

                    <div class="space-y-4">
                        {{-- Advance Payment --}}
                        <div class="flex items-start gap-4">
                            <div
                                class="p-3 rounded-full {{ $booking->advance_paid ? 'bg-green-100 dark:bg-green-900/50' : 'bg-gray-100 dark:bg-gray-700' }}">
                                @if ($booking->advance_paid)
                                    <x-heroicon-o-check-circle class="size-6 text-green-600 dark:text-green-400" />
                                @else
                                    <x-heroicon-o-clock class="size-6 text-gray-400 dark:text-gray-500" />
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Advance Payment</h3>
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($booking->advance_amount, 2) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    Due by: {{ $booking->advance_due_date->format('M d, Y') }}
                                </p>
                                @if ($booking->advance_paid)
                                    <p class="text-sm text-green-600 dark:text-green-400 font-semibold mt-1">
                                        ✓ Paid
                                    </p>
                                @else
                                    <p class="text-sm text-yellow-600 dark:text-yellow-400 font-semibold mt-1">
                                        Pending
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Final Payment --}}
                        <div class="flex items-start gap-4">
                            <div
                                class="p-3 rounded-full {{ $booking->final_paid ? 'bg-green-100 dark:bg-green-900/50' : 'bg-gray-100 dark:bg-gray-700' }}">
                                @if ($booking->final_paid)
                                    <x-heroicon-o-check-circle class="size-6 text-green-600 dark:text-green-400" />
                                @else
                                    <x-heroicon-o-clock class="size-6 text-gray-400 dark:text-gray-500" />
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Final Payment</h3>
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($booking->final_amount - $booking->advance_amount, 2) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    Due by: {{ $booking->final_due_date->format('M d, Y') }}
                                </p>
                                @if ($booking->final_paid)
                                    <p class="text-sm text-green-600 dark:text-green-400 font-semibold mt-1">
                                        ✓ Paid
                                    </p>
                                @else
                                    <p class="text-sm text-yellow-600 dark:text-yellow-400 font-semibold mt-1">
                                        {{ $booking->advance_paid ? 'Pending' : 'Pay advance first' }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Payment Summary Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <x-heroicon-o-currency-dollar class="size-6 text-green-600 dark:text-green-400" />
                        Payment Summary
                    </h2>

                    <div class="space-y-4">
                        <div
                            class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">Total Amount</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">
                                ${{ number_format($booking->amount, 2) }}
                            </span>
                        </div>

                        <div
                            class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">Advance
                                ({{ $booking->advance_percentage }}%)</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">
                                ${{ number_format($booking->advance_amount, 2) }}
                            </span>
                        </div>

                        <div
                            class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-gray-700">
                            <span class="text-gray-600 dark:text-gray-400">Remaining</span>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">
                                ${{ number_format($booking->getRemainingAmount(), 2) }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center pt-3">
                            <span class="text-gray-600 dark:text-gray-400 font-semibold">Payment Status</span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                @if ($booking->payment_status === 'completed') bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200
                                @elseif($booking->payment_status === 'partial') bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200
                                @else bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-200 @endif">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Payment Button --}}
                    @if ($booking->canBePaid() && $booking->status === 'confirmed')
                        <button wire:click="initiatePayment"
                            class="w-full mt-6 py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-lg transition-all duration-300 flex items-center justify-center gap-2 shadow-lg">
                            <x-heroicon-o-credit-card class="size-5" />
                            Pay ${{ number_format($booking->getNextPaymentAmount(), 2) }}
                            ({{ ucfirst($booking->getNextPaymentType()) }})
                        </button>
                    @endif
                </div>

                {{-- Actions Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Actions</h2>

                    <div class="space-y-3">
                        @if (in_array($booking->status, ['pending', 'confirmed']))
                            <button wire:click="openCancelModal"
                                class="w-full py-2 px-4 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-800 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                                <x-heroicon-o-x-mark class="size-5" />
                                Cancel Booking
                            </button>
                        @endif

                        <button wire:click="downloadInvoice"
                            class="w-full py-2 px-4 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                            <x-heroicon-o-document-arrow-down class="size-5" />
                            Download Invoice
                        </button>

                        <a href="{{ route('host.messages') }}" wire:navigate
                            class="w-full py-2 px-4 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-800 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                            <x-heroicon-o-chat-bubble-left-right class="size-5" />
                            Message Vendor
                        </a>
                    </div>
                </div>

                {{-- Booking Status Info --}}
                @if ($booking->status === 'pending')
                    <div
                        class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <x-heroicon-o-exclamation-triangle
                                class="size-6 text-yellow-600 dark:text-yellow-400 flex-shrink-0" />
                            <div>
                                <h3 class="font-semibold text-yellow-900 dark:text-yellow-200">Awaiting Vendor Approval
                                </h3>
                                <p class="text-sm text-yellow-800 dark:text-yellow-300 mt-1">
                                    Your booking request has been sent to the vendor. You'll be able to make payment
                                    once they approve your request.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Cancel Booking Modal --}}
        @if ($showCancelModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Cancel Booking</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Are you sure you want to cancel this booking? Please provide a reason.
                    </p>

                    <textarea wire:model="cancelReason" rows="4" placeholder="Please provide a reason for cancellation..."
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>

                    @error('cancelReason')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-3 mt-6">
                        <button wire:click="closeCancelModal"
                            class="flex-1 py-2 px-4 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                            Cancel
                        </button>
                        <button wire:click="cancelBooking"
                            class="flex-1 py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors">
                            Confirm Cancellation
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Loading State --}}
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 flex flex-col items-center shadow-2xl">
            <div
                class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 dark:border-blue-400 mb-4">
            </div>
            <p class="text-gray-700 dark:text-gray-300 font-semibold">Processing...</p>
        </div>
    </div>
</div>
