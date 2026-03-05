<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-stone-900 dark:via-stone-800 dark:to-stone-900">
    <!-- Back Button & Navigation -->
    <div class="bg-white dark:bg-stone-800 border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a
                href="{{ auth('host')->check() ? route('host.venues.index') : route('wedding-venues.index') }}"
                class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 font-semibold transition-colors"
            >
                <flux:icon.arrow-left class="w-5 h-5" />
                Back to Venues
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white mb-3">
                        {{ $venue->name }}
                    </h1>
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400">
                        <flux:icon.map-pin class="w-5 h-5 text-emerald-600" />
                        <span>{{ $venue->street }}, {{ $venue->city }}, {{ $venue->state }}, {{ $venue->country }}</span>
                    </div>
                </div>

                <div class="mt-4 md:mt-0 text-right">
                    <div class="text-4xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">
                        ${{ number_format($venue->price, 0) }}
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Base venue rental price</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Gallery & Details -->
            <div class="lg:col-span-2">
                <!-- Main Image Gallery -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg overflow-hidden mb-8">
                    @php $images = is_array($venue->images) ? $venue->images : []; @endphp
                    @if($currentImage)
                        <div class="relative bg-slate-200 dark:bg-slate-700 h-96 md:h-[500px] overflow-hidden group">
                            <img
                                src="{{ $currentImage }}"
                                alt="{{ $venue->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 cursor-pointer"
                                wire:click="toggleImageModal"
                            />

                            <!-- Image Counter -->
                            @if($hasMultipleImages)
                                <div class="absolute top-4 right-4 bg-black/60 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $selectedImageIndex + 1 }} / {{ count($images) }}
                                </div>
                            @endif

                            <!-- Navigation Arrows -->
                            @if($hasMultipleImages)
                                <button
                                    wire:click="selectImage({{ $selectedImageIndex > 0 ? $selectedImageIndex - 1 : count($images) - 1 }})"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-900 dark:text-white p-2 rounded-full transition-all"
                                >
                                    <flux:icon.chevron-left class="w-6 h-6" />
                                </button>

                                <button
                                    wire:click="selectImage({{ $selectedImageIndex < count($images) - 1 ? $selectedImageIndex + 1 : 0 }})"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-900 dark:text-white p-2 rounded-full transition-all"
                                >
                                    <flux:icon.chevron-right class="w-6 h-6" />
                                </button>
                            @endif
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if($hasMultipleImages)
                            <div class="p-4 bg-slate-50 dark:bg-stone-700 border-t border-slate-200 dark:border-slate-700">
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Gallery</p>
                                <div class="flex gap-2 overflow-x-auto pb-2">
                                    @foreach($images as $index => $image)
                                        <button
                                            wire:click="selectImage({{ $index }})"
                                            class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 {{ $selectedImageIndex === $index ? 'border-emerald-600' : 'border-slate-300 dark:border-slate-600' }} hover:border-emerald-400 transition-colors"
                                        >
                                            <img
                                                src="{{ $image }}"
                                                alt="Thumbnail {{ $index + 1 }}"
                                                class="w-full h-full object-cover"
                                            />
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="bg-slate-100 dark:bg-slate-700 h-96 md:h-[500px] flex items-center justify-center">
                            <div class="text-center">
                                <flux:icon.photo class="w-16 h-16 text-slate-400 dark:text-slate-500 mx-auto mb-4" />
                                <p class="text-slate-600 dark:text-slate-400">No images available</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                @php
                    $availableDates = is_array($venue->available_dates) ? $venue->available_dates : [];
                    $extraServices = is_array($venue->extra_services) ? $venue->extra_services : [];
                @endphp
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="bg-white dark:bg-stone-800 rounded-xl shadow-md p-4 text-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-emerald-100 dark:bg-emerald-900 rounded-lg mx-auto mb-2">
                            <flux:icon.users class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Capacity</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $venue->capacity }}</p>
                    </div>

                    <div class="bg-white dark:bg-stone-800 rounded-xl shadow-md p-4 text-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg mx-auto mb-2">
                            <flux:icon.calendar class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Available</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ count($availableDates) }} dates</p>
                    </div>

                    <div class="bg-white dark:bg-stone-800 rounded-xl shadow-md p-4 text-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg mx-auto mb-2">
                            <flux:icon.sparkles class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Services</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ count($extraServices) }}</p>
                    </div>
                </div>

                <!-- About This Venue -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">About This Venue</h2>
                    <p class="text-slate-700 dark:text-slate-300 leading-relaxed mb-6">
                        Located in {{ $venue->city }}, this venue can accommodate up to {{ $venue->capacity }} guests.
                        @if($vendor && $vendor->about)
                            <br><br>{{ $vendor->about }}
                        @endif
                    </p>

                    <!-- Address Section -->
                    <div class="bg-slate-50 dark:bg-stone-700 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <flux:icon.map-pin class="w-5 h-5 text-emerald-600" />
                            Location
                        </h3>
                        <p class="text-slate-700 dark:text-slate-300">{{ $venue->street }}</p>
                        <p class="text-slate-700 dark:text-slate-300">{{ $venue->city }}, {{ $venue->state }} {{ $venue->postal_code }}</p>
                        <p class="text-slate-700 dark:text-slate-300">{{ $venue->country }}</p>
                    </div>
                </div>

                <!-- Services & Amenities (from venue's extra_services) -->
                @if(count($extraServices) > 0)
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Services & Amenities</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($extraServices as $service)
                                <div class="flex items-center gap-3 p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                                    <flux:icon.check-circle class="w-6 h-6 text-emerald-600 dark:text-emerald-400 flex-shrink-0" />
                                    <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $service }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Vendor's Services (if different from venue's extra_services) -->
                @if($services->isNotEmpty())
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Vendor Services</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($services as $service)
                                <div class="flex items-center gap-3 p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
                                    <flux:icon.cog class="w-6 h-6 text-indigo-600 dark:text-indigo-400 flex-shrink-0" />
                                    <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $service->name ?? $service }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Packages -->
                @if($packages->isNotEmpty())
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Wedding Packages</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($packages as $package)
                                <div class="border-2 border-slate-200 dark:border-stone-700 rounded-xl p-5 hover:border-emerald-600 dark:hover:border-emerald-400 transition-colors">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $package->name }}</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">{{ $package->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">${{ number_format($package->price, 0) }}</span>
                                        <span class="text-xs text-slate-500 dark:text-slate-500">per event</span>
                                    </div>
                                    @if($package->features && is_array($package->features))
                                        <ul class="mt-3 space-y-1">
                                            @foreach(array_slice($package->features, 0, 3) as $feature)
                                                <li class="text-xs text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                                    <flux:icon.check class="w-3 h-3 text-emerald-600" /> {{ $feature }}
                                                </li>
                                            @endforeach
                                            @if(count($package->features) > 3)
                                                <li class="text-xs text-slate-500">+{{ count($package->features)-3 }} more</li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Timings Section -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Operating Hours</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($formattedTimings as $timeSlot => $time)
                            <div class="p-4 border-2 border-slate-200 dark:border-stone-700 rounded-lg">
                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">{{ $timeSlot }}</p>
                                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $time }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Vendor Info, Booking, Related -->
            <div class="lg:col-span-1">
                <!-- Vendor Profile Card -->
                @if($vendor)
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 mb-8">
                        <div class="flex items-center gap-4 mb-4">
                            @if($vendor->profile_image)
                                <img src="{{ $vendor->profile_image }}" alt="{{ $vendor->full_name }}" class="w-16 h-16 rounded-full object-cover border-2 border-emerald-600">
                            @else
                                <div class="w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center text-2xl font-bold text-emerald-700 dark:text-emerald-300">
                                    {{ $vendor->initials() }}
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $vendor->full_name }}</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $vendor->years_of_experience ?? '0' }} years experience</p>
                            </div>
                        </div>

                        @if($vendor->about)
                            <p class="text-sm text-slate-700 dark:text-slate-300 mb-4 line-clamp-3">{{ $vendor->about }}</p>
                        @endif

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            @if($vendor->languages)
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Languages</p>
                                    <p class="font-medium">{{ is_array($vendor->languages) ? implode(', ', $vendor->languages) : $vendor->languages }}</p>
                                </div>
                            @endif
                            @if($vendor->team_members)
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Team Size</p>
                                    <p class="font-medium">{{ $vendor->team_members }}</p>
                                </div>
                            @endif
                            @if($vendor->specialties)
                                <div class="col-span-2">
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Specialties</p>
                                    <p class="font-medium">{{ is_array($vendor->specialties) ? implode(', ', $vendor->specialties) : $vendor->specialties }}</p>
                                </div>
                            @endif
                        </div>

                        <a href="#" class="mt-4 inline-flex items-center gap-2 text-emerald-600 dark:text-emerald-400 text-sm font-medium hover:underline">
                            View Full Profile <flux:icon.arrow-right class="w-4 h-4" />
                        </a>
                    </div>
                @endif

                <!-- Booking Card -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 mb-8 sticky top-24">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Interested in This Venue?</h3>

                    <div class="space-y-4 mb-6">
                        <button
                            class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold py-3 px-4 rounded-lg hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <flux:icon.calendar class="w-5 h-5" />
                            Check Availability
                        </button>

                        <button
                            class="w-full bg-slate-100 dark:bg-stone-700 hover:bg-slate-200 dark:hover:bg-stone-600 text-slate-900 dark:text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <flux:icon.envelope class="w-5 h-5" />
                            Send Inquiry
                        </button>

                        <button
                            class="w-full bg-slate-100 dark:bg-stone-700 hover:bg-slate-200 dark:hover:bg-stone-600 text-slate-900 dark:text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <flux:icon.phone class="w-5 h-5" />
                            Call Venue
                        </button>
                    </div>

                    <!-- Availability Info -->
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-4">
                        <p class="text-sm font-semibold text-emerald-900 dark:text-emerald-300 mb-2 flex items-center gap-2">
                            <flux:icon.calendar class="w-4 h-4" />
                            Available Dates
                        </p>
                        <p class="text-xs text-emerald-800 dark:text-emerald-300 leading-relaxed">
                            {{ $formattedDates }}
                        </p>
                    </div>
                </div>

                <!-- Venue Info Card -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 mb-8">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Venue Information</h3>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <flux:icon.users class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" />
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Guest Capacity</p>
                                <p class="text-slate-600 dark:text-slate-400">Up to {{ $venue->capacity }} guests</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <flux:icon.currency-dollar class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" />
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Pricing</p>
                                <p class="text-slate-600 dark:text-slate-400">${{ number_format($venue->price, 0) }} per event</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <flux:icon.map-pin class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" />
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Location</p>
                                <p class="text-slate-600 dark:text-slate-400">{{ $venue->city }}, {{ $venue->country }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                @if($reviews->isNotEmpty())
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 mb-8">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <flux:icon.star class="w-5 h-5 text-yellow-500" />
                            Recent Reviews
                        </h3>
                        <div class="space-y-4">
                            @foreach($reviews as $review)
                                <div class="border-b border-slate-200 dark:border-stone-700 last:border-0 pb-4 last:pb-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="font-semibold text-slate-900 dark:text-white">{{ $review->host->name ?? 'Guest' }}</div>
                                        <div class="flex items-center">
                                            @for($i=1; $i<=5; $i++)
                                                <flux:icon.star class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-500' : 'text-slate-300 dark:text-stone-600' }}" />
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Related Venues -->
                @if($relatedVenues->count() > 0)
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Similar Venues</h3>

                        <div class="space-y-4">
                            @foreach($relatedVenues as $related)
                                <a
                                    href="{{ auth('host')->check() ? route('host.venues.detail', $related->id) : route('wedding-venues.detail', $related->id) }}"
                                    class="block p-4 border-2 border-slate-200 dark:border-stone-700 rounded-lg hover:border-emerald-600 dark:hover:border-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all duration-300 group"
                                >
                                    <p class="font-semibold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-1">
                                        {{ $related->name }}
                                    </p>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                        ${{ number_format($related->price, 0) }}
                                    </p>
                                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">
                                        {{ $related->city }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    @if($showImageModal && $currentImage)
        <div class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" wire:click="toggleImageModal">
            <div class="relative max-w-6xl w-full" wire:click.stop>
                <button wire:click="toggleImageModal" class="absolute top-4 right-4 text-white hover:text-emerald-400 z-10">
                    <flux:icon.x-mark class="w-8 h-8" />
                </button>
                <img src="{{ $currentImage }}" alt="{{ $venue->name }}" class="w-full h-auto max-h-[90vh] object-contain">
            </div>
        </div>
    @endif
</div>