<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-olive-950 dark:via-olive-900 dark:to-taupe-950">
    <!-- Navigation Header -->
    <div class="sticky top-0 z-40 bg-white/90 dark:bg-slate-950/35 backdrop-blur-lg border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <a href="{{ auth('host')->check() ? route('host.venues.index') : route('wedding-venues.index') }}" class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-semibold text-sm hover:gap-3 transition-all">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                Back
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8 py-6 md:py-10">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div class="flex-1">
                    <h1 class="text-3xl md:text-4xl font-black bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 bg-clip-text text-transparent mb-2">
                        {{ $venue->name }}
                    </h1>
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400 text-sm">
                        <x-heroicon-o-map-pin class="w-4 h-4 text-indigo-600 dark:text-indigo-400 flex-shrink-0" />
                        <span>{{ $venue->city }}, {{ $venue->country }}</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 rounded-xl p-4 shadow-lg text-white">
                    <p class="text-xs font-bold uppercase tracking-wider opacity-90">Starting From</p>
                    <div class="text-3xl font-black mt-1">${{ number_format($venue->price, 0) }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Gallery -->
                <div class="group bg-white dark:bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border border-slate-200 dark:border-slate-700">
                    @php $images = is_array($venue->images) ? $venue->images : []; @endphp
                    @if($currentImage)
                        <div class="relative bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 h-64 md:h-80 overflow-hidden">
                            <img src="{{ $currentImage }}" alt="{{ $venue->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 cursor-pointer" wire:click="toggleImageModal" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            @if($hasMultipleImages)
                                <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-xs font-bold border border-white/20">
                                    {{ $selectedImageIndex + 1 }}/{{ count($images) }}
                                </div>
                            @endif

                            @if($hasMultipleImages)
                                <button wire:click="selectImage({{ $selectedImageIndex > 0 ? $selectedImageIndex - 1 : count($images) - 1 }})" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md hover:bg-white dark:hover:bg-slate-700 text-slate-900 dark:text-white p-2.5 rounded-full transition-all duration-300 hover:scale-110 shadow-lg">
                                    <x-heroicon-o-chevron-left class="w-5 h-5" />
                                </button>

                                <button wire:click="selectImage({{ $selectedImageIndex < count($images) - 1 ? $selectedImageIndex + 1 : 0 }})" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md hover:bg-white dark:hover:bg-slate-700 text-slate-900 dark:text-white p-2.5 rounded-full transition-all duration-300 hover:scale-110 shadow-lg">
                                    <x-heroicon-o-chevron-right class="w-5 h-5" />
                                </button>
                            @endif
                        </div>

                        @if($hasMultipleImages)
                            <div class="p-4 bg-gradient-to-b from-slate-50 dark:from-slate-800/50 to-slate-100 dark:to-slate-800 border-t border-slate-200 dark:border-slate-700">
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-3 uppercase tracking-wide">Gallery</p>
                                <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-hide">
                                    @foreach($images as $index => $image)
                                        <button wire:click="selectImage({{ $index }})" class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 {{ $selectedImageIndex === $index ? 'border-indigo-500 shadow-md shadow-indigo-500/40' : 'border-slate-300 dark:border-slate-600 hover:border-indigo-400' }} transition-all duration-300 hover:scale-105">
                                            <img src="{{ $image }}" alt="Thumbnail" class="w-full h-full object-cover" />
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 h-64 md:h-80 flex items-center justify-center">
                            <div class="text-center">
                                <x-heroicon-o-photo class="w-12 h-12 text-slate-400 dark:text-slate-500 mx-auto mb-2" />
                                <p class="text-slate-600 dark:text-slate-400 text-sm">No images</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                @php
                    $availableDates = is_array($venue->available_dates) ? $venue->available_dates : [];
                    $extraServices = is_array($venue->extra_services) ? $venue->extra_services : [];
                @endphp
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 rounded-xl p-4 text-center border border-indigo-200 dark:border-indigo-800/50 hover:shadow-md transition-all">
                        <div class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg mx-auto mb-2 shadow-md">
                            <x-heroicon-o-users class="w-5 h-5 text-white" />
                        </div>
                        <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">Capacity</p>
                        <p class="text-2xl font-black text-indigo-700 dark:text-indigo-400 mt-1">{{ $venue->capacity }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-xl p-4 text-center border border-emerald-200 dark:border-emerald-800/50 hover:shadow-md transition-all">
                        <div class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg mx-auto mb-2 shadow-md">
                            <x-heroicon-o-calendar-days class="w-5 h-5 text-white" />
                        </div>
                        <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">Available</p>
                        <p class="text-2xl font-black text-emerald-700 dark:text-emerald-400 mt-1">{{ count($availableDates) }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-rose-50 to-rose-100 dark:from-rose-900/20 dark:to-rose-800/20 rounded-xl p-4 text-center border border-rose-200 dark:border-rose-800/50 hover:shadow-md transition-all">
                        <div class="flex items-center justify-center w-9 h-9 bg-gradient-to-br from-rose-500 to-pink-500 rounded-lg mx-auto mb-2 shadow-md">
                            <x-heroicon-o-sparkles class="w-5 h-5 text-white" />
                        </div>
                        <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">Services</p>
                        <p class="text-2xl font-black text-rose-700 dark:text-rose-400 mt-1">{{ count($extraServices) }}</p>
                    </div>
                </div>

                <!-- About -->
                <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                        <div class="w-0.5 h-5 bg-gradient-to-b from-indigo-500 to-purple-500 rounded-full"></div>
                        <x-heroicon-o-information-circle class="w-5 h-5 text-indigo-600 dark:text-indigo-400" />
                        About
                    </h2>
                    <p class="text-slate-700 dark:text-slate-300 leading-relaxed text-sm mb-4">
                        Premium venue in {{ $venue->city }} accommodating {{ $venue->capacity }} guests.
                        @if($vendor && $vendor->about)
                            <br><br>{{ $vendor->about }}
                        @endif
                    </p>

                    <div class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700/50 dark:to-slate-800/50 rounded-lg p-4 border border-slate-200 dark:border-slate-700">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm mb-2 flex items-center gap-2">
                            <x-heroicon-o-map-pin class="w-4 h-4 text-indigo-600" />
                            Location
                        </h3>
                        <div class="text-xs text-slate-700 dark:text-slate-300 space-y-0.5">
                            <p>{{ $venue->street }}</p>
                            <p>{{ $venue->city }}, {{ $venue->state }} {{ $venue->postal_code }}</p>
                            <p>{{ $venue->country }}</p>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                @if(count($extraServices) > 0)
                    <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <div class="w-0.5 h-5 bg-gradient-to-b from-emerald-500 to-teal-500 rounded-full"></div>
                            <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-600" />
                            Amenities
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5">
                            @foreach($extraServices as $service)
                                <div class="flex items-center gap-3 p-2.5 bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-lg border border-emerald-200 dark:border-emerald-800/50 hover:shadow-sm transition-all group">
                                    <div class="w-8 h-8 rounded-md bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center flex-shrink-0">
                                        <x-heroicon-o-check class="w-4 h-4 text-white" />
                                    </div>
                                    <span class="text-slate-700 dark:text-slate-300 font-medium text-sm">{{ $service }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Packages -->
                @if($packages->isNotEmpty())
                    <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <div class="w-0.5 h-5 bg-gradient-to-b from-purple-500 to-pink-500 rounded-full"></div>
                            <x-heroicon-o-gift class="w-5 h-5 text-purple-600" />
                            Packages
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($packages as $package)
                                <div class="group relative bg-gradient-to-br from-white to-slate-50 dark:from-slate-700/50 dark:to-slate-800/50 border-2 border-slate-200 dark:border-slate-700 rounded-lg p-4 hover:border-purple-500 dark:hover:border-purple-400 hover:shadow-lg transition-all overflow-hidden">
                                    <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-full -mr-8 -mt-8"></div>
                                    
                                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1">{{ $package->name }}</h3>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mb-3">{{ $package->description }}</p>
                                    
                                    <div class="flex justify-between items-end mb-3">
                                        <div>
                                            <p class="text-xs text-slate-500 uppercase font-bold">Price</p>
                                            <p class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent">${{ number_format($package->price, 0) }}</p>
                                        </div>
                                        <p class="text-xs text-slate-500">per event</p>
                                    </div>
                                    
                                    @if($package->features && is_array($package->features))
                                        <div class="border-t border-slate-200 dark:border-slate-600 pt-3 mt-3">
                                            <ul class="space-y-1">
                                                @foreach(array_slice($package->features, 0, 2) as $feature)
                                                    <li class="text-xs text-slate-600 dark:text-slate-300 flex items-center gap-1.5">
                                                        <x-heroicon-o-check class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0" />
                                                        {{ $feature }}
                                                    </li>
                                                @endforeach
                                                @if(count($package->features) > 2)
                                                    <li class="text-xs text-slate-500 font-semibold">+{{ count($package->features)-2 }} more</li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Hours -->
                <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-slate-200 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <div class="w-0.5 h-5 bg-gradient-to-b from-orange-500 to-red-500 rounded-full"></div>
                        <x-heroicon-o-clock class="w-5 h-5 text-orange-600" />
                        Hours
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($formattedTimings as $timeSlot => $time)
                            <div class="p-3 bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 border border-orange-200 dark:border-orange-800/50 rounded-lg">
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase mb-1">{{ $timeSlot }}</p>
                                <p class="text-lg font-bold text-orange-700 dark:text-orange-400">{{ $time }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Vendor -->
                @if($vendor)
                    <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-5 border border-slate-200 dark:border-slate-700">
                        <div class="flex items-center gap-3 mb-4">
                            @if($vendor->profile_image)
                                <img src="{{ $vendor->profile_image }}" alt="{{ $vendor->full_name }}" class="w-12 h-12 rounded-xl object-cover border-2 border-indigo-500 shadow-md">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-sm font-black text-white shadow-md">
                                    {{ substr($vendor->full_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white text-sm">{{ $vendor->full_name }}</h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400">{{ $vendor->years_of_experience ?? '0' }}y experience</p>
                            </div>
                        </div>

                        @if($vendor->about)
                            <p class="text-xs text-slate-700 dark:text-slate-300 mb-3 line-clamp-2">{{ $vendor->about }}</p>
                        @endif

                        <div class="grid grid-cols-2 gap-2 text-xs pt-3 border-t border-slate-200 dark:border-slate-700">
                            @if($vendor->languages)
                                <div>
                                    <p class="font-bold text-slate-500 dark:text-slate-400 uppercase text-xs">Languages</p>
                                    <p class="font-semibold text-slate-900 dark:text-white mt-0.5">{{ is_array($vendor->languages) ? implode(', ', $vendor->languages) : $vendor->languages }}</p>
                                </div>
                            @endif
                            @if($vendor->team_members)
                                <div>
                                    <p class="font-bold text-slate-500 dark:text-slate-400 uppercase text-xs">Team</p>
                                    <p class="font-semibold text-slate-900 dark:text-white mt-0.5">{{ $vendor->team_members }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Booking (Sticky) -->
                <div class="sticky top-20 bg-gradient-to-br from-white/80 to-indigo-50/80 dark:from-slate-800/50 dark:to-indigo-900/20 backdrop-blur-md rounded-2xl shadow-xl p-5 border border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Ready?</h3>

                    <div class="space-y-2.5 mb-4">
                        <button class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-2.5 px-3 rounded-lg hover:shadow-lg transition-all text-sm flex items-center justify-center gap-2 transform hover:scale-105 active:scale-95">
                            <x-heroicon-o-calendar-days class="w-4 h-4" />
                            Check Dates
                        </button>

                        <button class="w-full bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-bold py-2.5 px-3 rounded-lg transition-all text-sm flex items-center justify-center gap-2">
                            <x-heroicon-o-envelope class="w-4 h-4" />
                            Inquiry
                        </button>

                        <button class="w-full bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-bold py-2.5 px-3 rounded-lg transition-all text-sm flex items-center justify-center gap-2">
                            <x-heroicon-o-phone class="w-4 h-4" />
                            Call
                        </button>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-lg p-3 border border-emerald-200 dark:border-emerald-800/50">
                        <p class="text-xs font-bold text-emerald-900 dark:text-emerald-300 mb-1 flex items-center gap-1">
                            <x-heroicon-o-calendar-days class="w-3.5 h-3.5" />
                            Available
                        </p>
                        <p class="text-xs text-emerald-800 dark:text-emerald-200 leading-tight">{{ $formattedDates }}</p>
                    </div>
                </div>

                <!-- Info -->
                <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-5 border border-slate-200 dark:border-slate-700">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-3 text-sm">Info</h3>
                    <div class="space-y-2.5">
                        <div class="flex items-start gap-3 p-2 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800/50">
                            <x-heroicon-o-users class="w-4 h-4 text-indigo-600 dark:text-indigo-400 flex-shrink-0 mt-0.5" />
                            <div>
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">Capacity</p>
                                <p class="text-slate-900 dark:text-white font-semibold text-sm">{{ $venue->capacity }} guests</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/50">
                            <x-heroicon-o-currency-dollar class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5" />
                            <div>
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">Price</p>
                                <p class="text-slate-900 dark:text-white font-semibold text-sm">${{ number_format($venue->price, 0) }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-2 rounded-lg bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800/50">
                            <x-heroicon-o-map-pin class="w-4 h-4 text-rose-600 dark:text-rose-400 flex-shrink-0 mt-0.5" />
                            <div>
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase">City</p>
                                <p class="text-slate-900 dark:text-white font-semibold text-sm">{{ $venue->city }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                @if($reviews->isNotEmpty())
                    <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-5 border border-slate-200 dark:border-slate-700">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-3 text-sm flex items-center gap-2">
                            <x-heroicon-o-star class="w-4 h-4 text-yellow-500" />
                            Reviews
                        </h3>
                        <div class="space-y-3">
                            @foreach($reviews->take(2) as $review)
                                <div class="pb-2.5 border-b border-slate-200 dark:border-slate-700 last:border-0 last:pb-0">
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <div class="font-semibold text-slate-900 dark:text-white text-xs">{{ $review->host->name ?? 'Guest' }}</div>
                                        <div class="flex items-center gap-0.5">
                                            @for($i=1; $i<=5; $i++)
                                                <x-heroicon-o-star class="w-2.5 h-2.5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-300 dark:text-slate-600' }}" />
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Related -->
                @if($relatedVenues->count() > 0)
                    <div class="bg-white/70 dark:bg-slate-800/50 backdrop-blur-md rounded-2xl shadow-lg p-5 border border-slate-200 dark:border-slate-700">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-3 text-sm">Similar</h3>
                        <div class="space-y-2">
                            @foreach($relatedVenues->take(3) as $related)
                                <a href="{{ auth('host')->check() ? route('host.venues.detail', $related->id) : route('wedding-venues.detail', $related->id) }}" class="block p-2.5 border border-slate-200 dark:border-slate-700 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all group">
                                    <p class="font-semibold text-slate-900 dark:text-white text-xs group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-1">{{ $related->name }}</p>
                                    <div class="flex items-center justify-between mt-1 text-xs">
                                        <span class="text-emerald-600 dark:text-emerald-400 font-bold">${{ number_format($related->price, 0) }}</span>
                                        <span class="text-slate-500">{{ $related->city }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($showImageModal && $currentImage)
        <div class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4" wire:click="toggleImageModal">
            <div class="relative max-w-5xl w-full" wire:click.stop>
                <button wire:click="toggleImageModal" class="absolute top-3 right-3 text-white hover:text-indigo-400 z-10 p-2 rounded-full hover:bg-white/10 transition-all">
                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>
                <img src="{{ $currentImage }}" alt="{{ $venue->name }}" class="w-full h-auto max-h-[85vh] object-contain rounded-xl shadow-2xl">
            </div>
        </div>
    @endif

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</div>