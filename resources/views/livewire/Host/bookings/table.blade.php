<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header with Back Button --}}
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <flux:button href="{{ route('host.bookings.index') }}" wire:navigate variant="ghost"
                    class="hover:bg-white">
                    <flux:icon.arrow-left class="size-5" />
                </flux:button>
                <div>
                    <h1
                        class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Booking Details
                    </h1>
                    <p class="text-gray-600 mt-1">{{ $booking->custom_booking_id }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                @if ($booking->status === 'pending')
                    <flux:button href="{{ route('host.bookings.edit', $booking) }}" wire:navigate
                        class="bg-purple-600 hover:bg-purple-700 text-white">
                        <flux:icon.pencil class="size-4 mr-2" />
                        Edit Booking
                    </flux:button>
                @endif
                @if (!$booking->final_paid)
                    <flux:button wire:click="initiatePayment"
                        class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white">
                        <flux:icon.credit-card class="size-4 mr-2" />
                        Pay Now
                    </flux:button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Status Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Booking Status</h2>
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                            {{ match ($booking->status) {
                                'confirmed' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                                'completed' => 'bg-blue-100 text-blue-800',
                                default => 'bg-gray-100 text-gray-800',
                            } }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    {{-- Timeline --}}
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full {{ $booking->created_at ? 'bg-green-100' : 'bg-gray-100' }}">
                                    <flux:icon.check-circle
                                        class="size-6 {{ $booking->created_at ? 'text-green-600' : 'text-gray-400' }}" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">Booking Created</p>
                                <p class="text-sm text-gray-600">{{ $booking->created_at->format('M d, Y \a\t h:i A') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full {{ $booking->approved_at ? 'bg-green-100' : 'bg-gray-100' }}">
                                    <flux:icon.check-badge
                                        class="size-6 {{ $booking->approved_at ? 'text-green-600' : 'text-gray-400' }}" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">Booking Confirmed</p>
                                <p class="text-sm text-gray-600">
                                    {{ $booking->approved_at ? $booking->approved_at->format('M d, Y \a\t h:i A') : 'Pending confirmation' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full {{ $booking->payment_completed_at ? 'bg-green-100' : 'bg-gray-100' }}">
                                    <flux:icon.currency-dollar
                                        class="size-6 {{ $booking->payment_completed_at ? 'text-green-600' : 'text-gray-400' }}" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">Payment Completed</p>
                                <p class="text-sm text-gray-600">
                                    {{ $booking->payment_completed_at ? $booking->payment_completed_at->format('M d, Y \a\t h:i A') : 'Awaiting payment' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full {{ $booking->event_date->isPast() ? 'bg-green-100' : 'bg-gray-100' }}">
                                    <flux:icon.calendar-days
                                        class="size-6 {{ $booking->event_date->isPast() ? 'text-green-600' : 'text-gray-400' }}" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">Event Date</p>
                                <p class="text-sm text-gray-600">{{ $booking->event_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Vendor/Business Information --}}
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Vendor Information</h2>

                    <div class="flex items-start space-x-4">
                        @if ($booking->business && $booking->business->profile_image)
                            <img src="{{ Storage::url($booking->business->profile_image) }}" alt="Business"
                                class="size-20 rounded-2xl object-cover border-2 border-blue-200">
                        @else
                            <div
                                class="size-20 rounded-2xl bg-gradient-to-br from-blue-400 to-purple-400 flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($booking->business->company_name ?? 'N', 0, 1) }}
                            </div>
                        @endif

                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900">{{ $booking->business->company_name ?? 'N/A' }}
                            </h3>
                            <p class="text-gray-600">{{ $booking->vendor->full_name ?? 'N/A' }}</p>

                            @if ($booking->business && $booking->business->rating)
                                <div class="flex items-center mt-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <flux:icon.star
                                            class="size-4 {{ $i < floor($booking->business->rating) ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" />
                                    @endfor
                                    <span
                                        class="ml-2 text-sm text-gray-600">{{ number_format($booking->business->rating, 1) }}
                                        rating</span>
                                </div>
                            @endif

                            @if ($booking->business)
                                <div class="mt-4 space-y-2">
                                    @if ($booking->business->business_email)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <flux:icon.envelope class="size-4 mr-2" />
                                            {{ $booking->business->business_email }}
                                        </div>
                                    @endif
                                    @if ($booking->business->business_phone)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <flux:icon.phone class="size-4 mr-2" />
                                            {{ $booking->business->business_phone }}
                                        </div>
                                    @endif
                                    @if ($booking->business->street_address)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <flux:icon.map-pin class="size-4 mr-2" />
                                            {{ $booking->business->street_address }}, {{ $booking->business->city }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Package/Venue Details --}}
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">
                        @if ($booking->package_id)
                            Package Details
                        @else
                            Venue Details
                        @endif
                    </h2>

                    @if ($booking->package_id && $booking->package)
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900">{{ $booking->package->name }}</h3>
                                @if ($booking->package->is_popular)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <flux:icon.star class="size-3 mr-1 fill-current" />
                                        Popular
                                    </span>
                                @endif
                            </div>

                            @if ($booking->package->description)
                                <p class="text-gray-600">{{ $booking->package->description }}</p>
                            @endif

                            @if ($booking->package->features)
                                <div class="mt-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Package Features:</h4>
                                    <ul class="space-y-2">
                                        @foreach ($booking->package->features as $feature)
                                            <li class="flex items-start">
                                                <flux:icon.check-circle
                                                    class="size-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" />
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <flux:icon.building-office class="size-10 text-purple-600 mr-4" />
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">Custom Venue Booking</h3>
                                    <p class="text-gray-600">Direct venue reservation</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Extra Services --}}
                @if ($booking->extra_services)
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Extra Services</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($booking->extra_services as $service)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                    <flux:icon.sparkles class="size-6 text-blue-600 mr-3" />
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $service['name'] ?? 'Service' }}</p>
                                        <p class="text-sm text-gray-600">
                                            ${{ number_format($service['price'] ?? 0, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Event Details --}}
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Event Details</h2>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <flux:icon.calendar-days class="size-5 text-gray-400 mr-3" />
                            <div>
                                <p class="text-xs text-gray-500">Event Date</p>
                                <p class="font-semibold text-gray-900">{{ $booking->event_date->format('F d, Y') }}
                                </p>
                            </div>
                        </div>

                        @if ($booking->start_time)
                            <div class="flex items-center">
                                <flux:icon.clock class="size-5 text-gray-400 mr-3" />
                                <div>
                                    <p class="text-xs text-gray-500">Time</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ $booking->start_time->format('h:i A') }}
                                        @if ($booking->end_time)
                                            - {{ $booking->end_time->format('h:i A') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($booking->guests)
                            <div class="flex items-center">
                                <flux:icon.user-group class="size-5 text-gray-400 mr-3" />
                                <div>
                                    <p class="text-xs text-gray-500">Guests</p>
                                    <p class="font-semibold text-gray-900">{{ $booking->guests }} people</p>
                                </div>
                            </div>
                        @endif

                        @if ($booking->timezone)
                            <div class="flex items-center">
                                <flux:icon.globe-alt class="size-5 text-gray-400 mr-3" />
                                <div>
                                    <p class="text-xs text-gray-500">Timezone</p>
                                    <p class="font-semibold text-gray-900">{{ $booking->timezone }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Payment Summary --}}
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                    <h2 class="text-xl font-bold mb-6">Payment Summary</h2>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-white/20">
                            <span class="text-blue-100">Base Amount</span>
                            <span class="font-semibold">${{ number_format($booking->amount, 2) }}</span>
                        </div>

                        @if ($booking->advance_amount)
                            <div class="flex justify-between items-center">
                                <span class="text-blue-100">Advance ({{ $booking->advance_percentage }}%)</span>
                                <span class="font-semibold">${{ number_format($booking->advance_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="text-blue-100 mr-2">Advance Status</span>
                                    @if ($booking->advance_paid)
                                        <flux:icon.check-circle class="size-4 text-green-300" />
                                    @else
                                        <flux:icon.x-circle class="size-4 text-red-300" />
                                    @endif
                                </div>
                                <span class="text-sm">{{ $booking->advance_paid ? 'Paid' : 'Unpaid' }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between items-center pt-4 border-t border-white/20">
                            <span class="text-lg font-bold">Total Amount</span>
                            <span class="text-2xl font-bold">${{ number_format($booking->final_amount, 2) }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-white/10 rounded-xl">
                            <span class="font-semibold">Payment Status</span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $booking->advance_paid && $booking->final_paid ? 'bg-green-500' : 'bg-yellow-500' }} text-white">
                                {{ $booking->advance_paid && $booking->final_paid ? 'Fully Paid' : ($booking->advance_paid ? 'Partially Paid' : 'Unpaid') }}
                            </span>
                        </div>

                        @if (!$booking->final_paid)
                            <flux:button wire:click="initiatePayment"
                                class="w-full bg-white text-blue-600 hover:bg-blue-50 font-semibold">
                                <flux:icon.credit-card class="size-4 mr-2" />
                                Pay
                                ${{ number_format($booking->advance_paid ? $booking->final_amount - $booking->advance_amount : $booking->advance_amount, 2) }}
                            </flux:button>
                        @endif
                    </div>
                </div>

                {{-- Transaction History --}}
                @if ($booking->transactions && $booking->transactions->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Transaction History</h2>

                        <div class="space-y-3">
                            @foreach ($booking->transactions->sortByDesc('paid_at') as $transaction)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                                            <flux:icon.check-circle class="size-4 text-green-600" />
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ ucfirst($transaction->payment_type) }} Payment</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $transaction->paid_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                    <p class="font-bold text-green-600">${{ number_format($transaction->amount, 2) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
