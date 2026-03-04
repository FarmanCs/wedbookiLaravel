<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-stone-900 dark:via-stone-800 dark:to-stone-900">
    <!-- Back Button & Navigation -->
    <div class="bg-white dark:bg-stone-800 border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a 
                href="{{ auth('host')->check() ? route('host.venues.index') : route('wedding-venues.index') }}"
                class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 font-semibold transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
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
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
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
                                    {{ $selectedImageIndex + 1 }} / {{ count($venue->images) }}
                                </div>
                            @endif

                            <!-- Navigation Arrows -->
                            @if($hasMultipleImages)
                                <button 
                                    wire:click="selectImage(@if($selectedImageIndex > 0) {{ $selectedImageIndex - 1 }} @else {{ count($venue->images) - 1 }} @endif)"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-900 dark:text-white p-2 rounded-full transition-all"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>

                                <button 
                                    wire:click="selectImage(@if($selectedImageIndex < count($venue->images) - 1) {{ $selectedImageIndex + 1 }} @else 0 @endif)"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white dark:bg-slate-800/80 dark:hover:bg-slate-700 text-slate-900 dark:text-white p-2 rounded-full transition-all"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if($hasMultipleImages)
                            <div class="p-4 bg-slate-50 dark:bg-stone-700 border-t border-slate-200 dark:border-slate-700">
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-3">Gallery</p>
                                <div class="flex gap-2 overflow-x-auto pb-2">
                                    @foreach($venue->images as $index => $image)
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
                                <svg class="w-16 h-16 text-slate-400 dark:text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-slate-600 dark:text-slate-400">No images available</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="bg-white dark:bg-stone-800 rounded-xl shadow-md p-4 text-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-emerald-100 dark:bg-emerald-900 rounded-lg mx-auto mb-2">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 006-6V9a6 6 0 00-6-6H6a6 6 0 00-6 6v5a6 6 0 006 6z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Capacity</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $venue->capacity }}</p>
                    </div>

                    <div class="bg-white dark:bg-stone-800 rounded-xl shadow-md p-4 text-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg mx-auto mb-2">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Available</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ count($venue->available_dates ?? []) }}</p>
                    </div>

                    <div class="bg-white dark:bg-stone-800 rounded-xl shadow-md p-4 text-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg mx-auto mb-2">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Services</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ count($venue->extra_services ?? []) }}</p>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">About This Venue</h2>
                    <p class="text-slate-700 dark:text-slate-300 leading-relaxed mb-6">
                        {{ $venue->name }} is a stunning wedding venue located in the heart of {{ $venue->city }}. 
                        With a capacity of up to {{ $venue->capacity }} guests, this venue is perfect for intimate gatherings or grand celebrations. 
                        The venue offers a range of services and amenities to make your special day unforgettable.
                    </p>

                    <!-- Address Section -->
                    <div class="bg-slate-50 dark:bg-stone-700 rounded-lg p-4 mb-6">
                        <h3 class="font-semibold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Location
                        </h3>
                        <p class="text-slate-700 dark:text-slate-300">{{ $venue->street }}</p>
                        <p class="text-slate-700 dark:text-slate-300">{{ $venue->city }}, {{ $venue->state }} {{ $venue->postal_code }}</p>
                        <p class="text-slate-700 dark:text-slate-300">{{ $venue->country }}</p>
                    </div>
                </div>

                <!-- Services & Amenities -->
                @if($venue->extra_services && is_array($venue->extra_services) && count($venue->extra_services) > 0)
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Services & Amenities</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($venue->extra_services as $service)
                                <div class="flex items-center gap-3 p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $service }}</span>
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
                            <div class="p-4 border-2 border-slate-200 dark:border-slate-700 rounded-lg">
                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-1">{{ $timeSlot }}</p>
                                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $time }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Booking & Related -->
            <div class="lg:col-span-1">
                <!-- Booking Card -->
                <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6 mb-8 sticky top-24">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Interested in This Venue?</h3>

                    <div class="space-y-4 mb-6">
                        <button 
                            class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold py-3 px-4 rounded-lg hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Check Availability
                        </button>

                        <button 
                            class="w-full bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Send Inquiry
                        </button>

                        <button 
                            class="w-full bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948-.684l1.498-4.493a1 1 0 011.502-.684l1.498 4.493a1 1 0 00.948.684H19a2 2 0 012 2v1a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM3 15a2 2 0 012-2h3.28a1 1 0 00.948-.684l1.498-4.493a1 1 0 011.502-.684l1.498 4.493a1 1 0 00.948.684H19a2 2 0 012 2v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z"></path>
                            </svg>
                            Call Venue
                        </button>
                    </div>

                    <!-- Availability Info -->
                    <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-4">
                        <p class="text-sm font-semibold text-emerald-900 dark:text-emerald-300 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
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
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 006-6V9a6 6 0 00-6-6H6a6 6 0 00-6 6v5a6 6 0 006 6z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Guest Capacity</p>
                                <p class="text-slate-600 dark:text-slate-400">Up to {{ $venue->capacity }} guests</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Pricing</p>
                                <p class="text-slate-600 dark:text-slate-400">${{ number_format($venue->price, 0) }} per event</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Location</p>
                                <p class="text-slate-600 dark:text-slate-400">{{ $venue->city }}, {{ $venue->country }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Venues -->
                @if($relatedVenues->count() > 0)
                    <div class="bg-white dark:bg-stone-800 rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Similar Venues</h3>

                        <div class="space-y-4">
                            @foreach($relatedVenues as $related)
                                <a 
                                    href="{{ auth('host')->check() ? route('host.venues.detail', $related->id) : route('wedding-venues.detail', $related->id) }}"
                                    class="block p-4 border-2 border-slate-200 dark:border-slate-700 rounded-lg hover:border-emerald-600 dark:hover:border-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all duration-300 group"
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
</div>