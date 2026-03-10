<div
    class="min-h-screen bg-gradient-to-br from-rose-50 via-fuchsia-50 to-indigo-50 dark:from-slate-950 dark:via-purple-950 dark:to-indigo-950 transition-colors duration-700">
    <!-- ==================== NAVIGATION HEADER ==================== -->
    <div
        class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-rose-200/50 dark:border-indigo-800/50 shadow-lg shadow-rose-500/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ auth('host')->check() ? route('host.venues.index') : route('wedding-venues.index') }}"
                    class="group inline-flex items-center gap-2 bg-gradient-to-r from-rose-600 to-indigo-600 dark:from-rose-500 dark:to-indigo-500 bg-clip-text text-transparent font-bold text-sm hover:gap-3 transition-all duration-300">
                    <div
                        class="p-2 rounded-lg bg-gradient-to-br from-rose-100 to-indigo-100 dark:from-rose-900/30 dark:to-indigo-900/30 group-hover:scale-110 transition-transform">
                        <x-heroicon-o-arrow-left class="w-4 h-4 text-rose-600 dark:text-rose-400" />
                    </div>
                    <span class="relative">
                        Back to Venues
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-rose-600 to-indigo-600 group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>

                <div class="flex items-center gap-2">
                    <span
                        class="px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        <span class="relative flex h-2 w-2 mr-1.5 inline-block">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        {{ $venue->status ?? 'Active' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== HERO SECTION ==================== -->
    <div class="relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-rose-300 to-purple-300 dark:from-rose-600/20 dark:to-purple-600/20 rounded-full blur-3xl animate-pulse">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-blue-300 to-indigo-300 dark:from-blue-600/20 dark:to-indigo-600/20 rounded-full blur-3xl animate-pulse delay-1000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 relative">
            <!-- Header Section -->
            <div class="mb-8 relative">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                    <div class="flex-1">
                        <!-- Breadcrumb -->
                        <div class="flex items-center gap-2 text-sm mb-3">
                            <span
                                class="px-2.5 py-1 rounded-lg bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm text-rose-600 dark:text-rose-400 font-semibold text-xs border border-rose-200 dark:border-rose-800">
                                {{ $venue->city }}
                            </span>
                            <x-heroicon-o-chevron-right class="w-3 h-3 text-slate-400" />
                            <span class="text-slate-600 dark:text-slate-400 text-sm">{{ $venue->country }}</span>
                        </div>

                        <h1 class="text-4xl md:text-6xl font-black mb-3">
                            <span
                                class="bg-gradient-to-r from-rose-600 via-fuchsia-600 to-indigo-600 dark:from-rose-400 dark:via-fuchsia-400 dark:to-indigo-400 bg-clip-text text-transparent animate-gradient">
                                {{ $venue->name }}
                            </span>
                        </h1>

                        <div class="flex items-center gap-4 flex-wrap">
                            <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400">
                                <div class="p-1.5 rounded-lg bg-rose-100 dark:bg-rose-900/30">
                                    <x-heroicon-o-map-pin class="w-4 h-4 text-rose-600 dark:text-rose-400" />
                                </div>
                                <span class="font-medium">{{ $venue->street }}, {{ $venue->city }},
                                    {{ $venue->country }}</span>
                            </div>

                            @if ($vendor)
                                <div class="flex items-center gap-2">
                                    <div class="w-px h-4 bg-slate-300 dark:bg-slate-700"></div>
                                    <div class="flex items-center gap-1.5">
                                        <div class="p-1 rounded-lg bg-amber-100 dark:bg-amber-900/30">
                                            <x-heroicon-o-star class="w-3 h-3 text-amber-600 dark:text-amber-400" />
                                        </div>
                                        <span class="text-sm font-bold text-amber-600 dark:text-amber-400">4.8</span>
                                        <span class="text-xs text-slate-500">(128 reviews)</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Price Card -->
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-rose-600 to-indigo-600 rounded-2xl blur-xl opacity-50 group-hover:opacity-70 transition-opacity">
                        </div>
                        <div
                            class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-6 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                            <p class="text-xs font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400 mb-1">
                                Starting From</p>
                            <div class="flex items-end gap-1">
                                <span
                                    class="text-4xl font-black text-slate-900 dark:text-white">${{ number_format($venue->price, 0) }}</span>
                                <span class="text-sm text-slate-500 mb-1">/event</span>
                            </div>
                            <div class="mt-2 flex items-center gap-1 text-xs text-slate-600 dark:text-slate-400">
                                <x-heroicon-o-users class="w-3 h-3" />
                                <span>Up to {{ $venue->capacity }} guests</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">
                <!-- Left Column - Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Gallery -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-rose-600 to-indigo-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                        </div>
                        <div
                            class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl overflow-hidden border border-white/20 dark:border-slate-700/50 shadow-2xl">
                            @php $images = is_array($venue->images) ? $venue->images : []; @endphp
                            @if ($currentImage)
                                <div
                                    class="relative h-[400px] md:h-[500px] bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-800 dark:to-slate-700 overflow-hidden">
                                    <img src="{{ $currentImage }}" alt="{{ $venue->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 cursor-pointer"
                                        wire:click="toggleImageModal" />

                                    <!-- Gradient Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>

                                    <!-- Image Counter -->
                                    @if ($hasMultipleImages)
                                        <div
                                            class="absolute top-4 right-4 bg-black/50 backdrop-blur-xl text-white px-4 py-2 rounded-full text-sm font-bold border border-white/20">
                                            {{ $selectedImageIndex + 1 }} / {{ count($images) }}
                                        </div>
                                    @endif

                                    <!-- Navigation Arrows -->
                                    @if ($hasMultipleImages)
                                        <button
                                            wire:click="selectImage({{ $selectedImageIndex > 0 ? $selectedImageIndex - 1 : count($images) - 1 }})"
                                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl hover:bg-white dark:hover:bg-slate-700 text-slate-900 dark:text-white p-3 rounded-full transition-all duration-300 hover:scale-110 shadow-2xl border border-white/20 group/btn">
                                            <x-heroicon-o-chevron-left
                                                class="w-5 h-5 group-hover/btn:-translate-x-0.5 transition-transform" />
                                        </button>

                                        <button
                                            wire:click="selectImage({{ $selectedImageIndex < count($images) - 1 ? $selectedImageIndex + 1 : 0 }})"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl hover:bg-white dark:hover:bg-slate-700 text-slate-900 dark:text-white p-3 rounded-full transition-all duration-300 hover:scale-110 shadow-2xl border border-white/20 group/btn">
                                            <x-heroicon-o-chevron-right
                                                class="w-5 h-5 group-hover/btn:translate-x-0.5 transition-transform" />
                                        </button>
                                    @endif
                                </div>

                                <!-- Thumbnails -->
                                @if ($hasMultipleImages)
                                    <div
                                        class="p-6 bg-gradient-to-b from-white/50 to-white/30 dark:from-slate-800/50 dark:to-slate-800/30 backdrop-blur-sm border-t border-slate-200/50 dark:border-slate-700/50">
                                        <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                                            @foreach ($images as $index => $image)
                                                <button wire:click="selectImage({{ $index }})"
                                                    class="flex-shrink-0 group/thumb relative">
                                                    <div
                                                        class="absolute -inset-0.5 bg-gradient-to-r from-rose-600 to-indigo-600 rounded-lg opacity-0 group-hover/thumb:opacity-100 transition-opacity {{ $selectedImageIndex === $index ? 'opacity-100' : '' }}">
                                                    </div>
                                                    <div
                                                        class="relative w-20 h-20 rounded-lg overflow-hidden border-2 {{ $selectedImageIndex === $index ? 'border-transparent' : 'border-slate-300 dark:border-slate-600' }}">
                                                        <img src="{{ $image }}" alt="Thumbnail"
                                                            class="w-full h-full object-cover group-hover/thumb:scale-110 transition-transform duration-300" />
                                                    </div>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div
                                    class="bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700 h-[400px] md:h-[500px] flex items-center justify-center">
                                    <div class="text-center">
                                        <div
                                            class="p-4 rounded-full bg-white/50 dark:bg-slate-700/50 inline-block mb-3">
                                            <x-heroicon-o-photo class="w-12 h-12 text-slate-400 dark:text-slate-500" />
                                        </div>
                                        <p class="text-slate-600 dark:text-slate-400 font-medium">No images available
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Stats with Glassmorphism -->
                    <div class="grid grid-cols-3 gap-4">
                        @php
                            $availableDates = is_array($venue->available_dates) ? $venue->available_dates : [];
                            $extraServices = is_array($venue->extra_services) ? $venue->extra_services : [];
                        @endphp

                        <div class="group relative">
                            <div
                                class="absolute -inset-0.5 bg-gradient-to-r from-rose-500 to-pink-500 rounded-xl blur opacity-0 group-hover:opacity-75 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-xl p-5 border border-white/20 dark:border-slate-700/50 hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-3">
                                    <div class="p-2.5 rounded-lg bg-gradient-to-br from-rose-500 to-pink-500">
                                        <x-heroicon-o-users class="w-5 h-5 text-white" />
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-rose-600 dark:text-rose-400 uppercase">Capacity
                                        </p>
                                        <p class="text-2xl font-black text-slate-900 dark:text-white">
                                            {{ $venue->capacity }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="group relative">
                            <div
                                class="absolute -inset-0.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl blur opacity-0 group-hover:opacity-75 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-xl p-5 border border-white/20 dark:border-slate-700/50 hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-3">
                                    <div class="p-2.5 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
                                        <x-heroicon-o-calendar-days class="w-5 h-5 text-white" />
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase">
                                            Available</p>
                                        <p class="text-2xl font-black text-slate-900 dark:text-white">
                                            {{ count($availableDates) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="group relative">
                            <div
                                class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl blur opacity-0 group-hover:opacity-75 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-xl p-5 border border-white/20 dark:border-slate-700/50 hover:scale-105 transition-transform duration-300">
                                <div class="flex items-center gap-3">
                                    <div class="p-2.5 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-500">
                                        <x-heroicon-o-sparkles class="w-5 h-5 text-white" />
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-purple-600 dark:text-purple-400 uppercase">
                                            Services</p>
                                        <p class="text-2xl font-black text-slate-900 dark:text-white">
                                            {{ count($extraServices) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                        </div>
                        <div
                            class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-8 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2.5 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-500">
                                    <x-heroicon-o-information-circle class="w-5 h-5 text-white" />
                                </div>
                                <h2 class="text-xl font-bold text-slate-900 dark:text-white">About This Venue</h2>
                            </div>

                            <div class="space-y-6">
                                <p class="text-slate-700 dark:text-slate-300 leading-relaxed">
                                    Premium venue located in the heart of {{ $venue->city }}, beautifully designed to
                                    accommodate up to {{ $venue->capacity }} guests for your special occasion.
                                    @if ($vendor && $vendor->about)
                                        <br><br>{{ $vendor->about }}
                                    @endif
                                </p>

                                <!-- Location Details -->
                                <div
                                    class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700/30 dark:to-slate-800/30 rounded-xl p-5 border border-slate-200/50 dark:border-slate-700/50">
                                    <h3 class="font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                                        <div class="p-1.5 rounded-lg bg-rose-100 dark:bg-rose-900/30">
                                            <x-heroicon-o-map-pin class="w-4 h-4 text-rose-600 dark:text-rose-400" />
                                        </div>
                                        Location Details
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Street Address</p>
                                            <p class="font-medium text-slate-900 dark:text-white">{{ $venue->street }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">City/State</p>
                                            <p class="font-medium text-slate-900 dark:text-white">{{ $venue->city }},
                                                {{ $venue->state }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Postal Code</p>
                                            <p class="font-medium text-slate-900 dark:text-white">
                                                {{ $venue->postal_code }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 mb-1">Country</p>
                                            <p class="font-medium text-slate-900 dark:text-white">
                                                {{ $venue->country }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amenities/Services -->
                    @if (count($extraServices) > 0)
                        <div class="group relative">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-8 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="p-2.5 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
                                        <x-heroicon-o-check-circle class="w-5 h-5 text-white" />
                                    </div>
                                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Amenities & Services
                                    </h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($extraServices as $service)
                                        <div
                                            class="group/item flex items-center gap-3 p-3 bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-lg border border-emerald-200 dark:border-emerald-800/50 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all">
                                            <div
                                                class="p-1.5 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
                                                <x-heroicon-o-check class="w-3.5 h-3.5 text-white" />
                                            </div>
                                            <span
                                                class="text-slate-700 dark:text-slate-300 font-medium text-sm">{{ $service }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Packages -->
                    @if ($packages && $packages->isNotEmpty())
                        <div class="group relative">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-8 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="p-2.5 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500">
                                        <x-heroicon-o-gift class="w-5 h-5 text-white" />
                                    </div>
                                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Wedding Packages</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($packages as $package)
                                        <div class="group/package relative">
                                            <div
                                                class="absolute -inset-0.5 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur opacity-0 group-hover/package:opacity-75 transition-opacity">
                                            </div>
                                            <div
                                                class="relative bg-white dark:bg-slate-800 rounded-xl p-5 border border-slate-200 dark:border-slate-700 hover:scale-[1.02] transition-all duration-300">
                                                @if ($package->is_popular)
                                                    <div class="absolute -top-3 right-4">
                                                        <span
                                                            class="px-3 py-1 text-xs font-bold text-white bg-gradient-to-r from-amber-500 to-orange-500 rounded-full shadow-lg">
                                                            Popular
                                                        </span>
                                                    </div>
                                                @endif

                                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                                                    {{ $package->name }}</h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                                                    {{ $package->description }}</p>

                                                <div class="flex items-end justify-between mb-4">
                                                    <div>
                                                        <p class="text-xs text-slate-500 mb-1">Starting at</p>
                                                        <p
                                                            class="text-3xl font-black bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                                                            ${{ number_format($package->price, 0) }}
                                                        </p>
                                                    </div>
                                                    @if ($package->discount > 0)
                                                        <span
                                                            class="px-2 py-1 text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 rounded">
                                                            -{{ $package->discount_percentage }}%
                                                        </span>
                                                    @endif
                                                </div>

                                                @if ($package->features && is_array($package->features))
                                                    <div class="border-t border-slate-200 dark:border-slate-700 pt-4">
                                                        <ul class="space-y-2">
                                                            @foreach (array_slice($package->features, 0, 3) as $feature)
                                                                <li
                                                                    class="text-sm text-slate-600 dark:text-slate-400 flex items-start gap-2">
                                                                    <x-heroicon-o-check
                                                                        class="w-4 h-4 text-emerald-500 flex-shrink-0 mt-0.5" />
                                                                    <span>{{ $feature }}</span>
                                                                </li>
                                                            @endforeach
                                                            @if (count($package->features) > 3)
                                                                <li
                                                                    class="text-sm text-purple-600 dark:text-purple-400 font-semibold">
                                                                    +{{ count($package->features) - 3 }} more features
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Operating Hours -->
                    <div class="group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                        </div>
                        <div
                            class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-8 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2.5 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500">
                                    <x-heroicon-o-clock class="w-5 h-5 text-white" />
                                </div>
                                <h2 class="text-xl font-bold text-slate-900 dark:text-white">Operating Hours</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ($formattedTimings as $day => $hours)
                                    <div
                                        class="p-4 bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-lg border border-amber-200 dark:border-amber-800/50 hover:border-amber-500 dark:hover:border-amber-500 transition-all">
                                        <p class="text-xs font-bold text-amber-700 dark:text-amber-400 mb-1 uppercase">
                                            {{ $day }}</p>
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                            {{ $hours }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Vendor Card -->
                    @if ($vendor)
                        <div class="group relative">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-6 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                                <div class="flex items-center gap-4 mb-4">
                                    @if ($vendor->profile_image)
                                        <img src="{{ $vendor->profile_image }}" alt="{{ $vendor->full_name }}"
                                            class="w-16 h-16 rounded-xl object-cover border-2 border-transparent bg-gradient-to-r from-indigo-500 to-purple-500 p-0.5" />
                                    @else
                                        <div
                                            class="w-16 h-16 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-xl font-black text-white">
                                            {{ $vendor->initials() }}
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-bold text-slate-900 dark:text-white">{{ $vendor->full_name }}
                                        </h3>
                                        <p
                                            class="text-xs text-slate-600 dark:text-slate-400 flex items-center gap-1 mt-1">
                                            <x-heroicon-o-briefcase class="w-3 h-3" />
                                            {{ $vendor->years_of_experience ?? '0' }} years experience
                                        </p>
                                    </div>
                                </div>

                                @if ($vendor->about)
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 line-clamp-3">
                                        {{ $vendor->about }}</p>
                                @endif

                                <div
                                    class="grid grid-cols-2 gap-3 text-xs border-t border-slate-200 dark:border-slate-700 pt-4">
                                    @if ($vendor->languages)
                                        <div>
                                            <p class="text-slate-500 mb-1">Languages</p>
                                            <p class="font-semibold text-slate-900 dark:text-white">
                                                {{ is_array($vendor->languages) ? implode(', ', array_slice($vendor->languages, 0, 2)) : $vendor->languages }}
                                                @if (is_array($vendor->languages) && count($vendor->languages) > 2)
                                                    <span
                                                        class="text-slate-400">+{{ count($vendor->languages) - 2 }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                    @if ($vendor->team_members)
                                        <div>
                                            <p class="text-slate-500 mb-1">Team Size</p>
                                            <p class="font-semibold text-slate-900 dark:text-white">
                                                {{ $vendor->team_members }} members</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4 flex gap-2">
                                    <button
                                        class="flex-1 py-2 px-3 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white text-sm font-bold rounded-lg transition-all transform hover:scale-105 active:scale-95">
                                        View Profile
                                    </button>
                                    <button
                                        class="p-2 rounded-lg bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                                        <x-heroicon-o-chat-bubble-left-ellipsis
                                            class="w-4 h-4 text-slate-700 dark:text-slate-300" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Booking Card (Sticky) -->
                    <div class="sticky top-24 group relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-rose-500 to-indigo-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                        </div>
                        <div
                            class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-6 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Ready to Book?</h3>

                            <div class="space-y-3">
                                <button class="w-full group/btn relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-rose-600 to-indigo-600 rounded-lg blur opacity-75 group-hover/btn:opacity-100 transition-opacity">
                                    </div>
                                    <div
                                        class="relative w-full py-3 px-4 bg-gradient-to-r from-rose-600 to-indigo-600 hover:from-rose-700 hover:to-indigo-700 text-white font-bold rounded-lg transition-all transform hover:scale-[1.02] active:scale-98 flex items-center justify-center gap-2">
                                        <x-heroicon-o-calendar-days class="w-5 h-5" />
                                        Check Availability
                                    </div>
                                </button>

                                <button
                                    class="w-full py-3 px-4 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-bold rounded-lg transition-all border border-slate-200 dark:border-slate-600 flex items-center justify-center gap-2">
                                    <x-heroicon-o-envelope class="w-5 h-5" />
                                    Send Inquiry
                                </button>

                                <button
                                    class="w-full py-3 px-4 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 text-slate-900 dark:text-white font-bold rounded-lg transition-all border border-slate-200 dark:border-slate-600 flex items-center justify-center gap-2">
                                    <x-heroicon-o-phone class="w-5 h-5" />
                                    Call Venue
                                </button>
                            </div>

                            <!-- Availability Preview -->
                            <div
                                class="mt-6 p-4 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800/50">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="p-1.5 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500">
                                        <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-white" />
                                    </div>
                                    <p class="text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase">Next
                                        Available</p>
                                </div>
                                <p class="text-sm text-emerald-800 dark:text-emerald-300 font-medium">
                                    {{ $formattedDates }}</p>
                            </div>

                            <!-- Quick Info -->
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-600 dark:text-slate-400">Capacity</span>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $venue->capacity }}
                                        guests</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-600 dark:text-slate-400">Price starts at</span>
                                    <span
                                        class="font-bold text-rose-600 dark:text-rose-400">${{ number_format($venue->price, 0) }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-slate-600 dark:text-slate-400">Location</span>
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $venue->city }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Reviews -->
                    @if ($reviews && $reviews->isNotEmpty())
                        <div class="group relative">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-yellow-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-6 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="p-2 rounded-lg bg-gradient-to-br from-amber-500 to-yellow-500">
                                        <x-heroicon-o-star class="w-4 h-4 text-white" />
                                    </div>
                                    <h3 class="font-bold text-slate-900 dark:text-white">Recent Reviews</h3>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($reviews->take(3) as $review)
                                        <div
                                            class="border-b border-slate-200 dark:border-slate-700 last:border-0 last:pb-0 pb-3">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="font-semibold text-slate-900 dark:text-white text-sm">
                                                    {{ $review->host->name ?? 'Guest' }}
                                                </span>
                                                <div class="flex items-center gap-0.5">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <x-heroicon-o-star
                                                            class="w-3 h-3 {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-300 dark:text-slate-600' }}" />
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">
                                                {{ $review->comment }}</p>
                                            <p class="text-xs text-slate-500 mt-1">
                                                {{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <button
                                    class="w-full mt-4 text-sm text-amber-600 dark:text-amber-400 font-semibold hover:underline flex items-center justify-center gap-1">
                                    View All Reviews
                                    <x-heroicon-o-arrow-right class="w-3 h-3" />
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Similar Venues -->
                    @if ($relatedVenues && $relatedVenues->count() > 0)
                        <div class="group relative">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity">
                            </div>
                            <div
                                class="relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl p-6 border border-white/20 dark:border-slate-700/50 shadow-2xl">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-500">
                                        <x-heroicon-o-building-library class="w-4 h-4 text-white" />
                                    </div>
                                    <h3 class="font-bold text-slate-900 dark:text-white">Similar Venues</h3>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($relatedVenues as $related)
                                        <a href="{{ auth('host')->check() ? route('host.venues.detail', $related->id) : route('wedding-venues.detail', $related->id) }}"
                                            class="group/item block p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/20 dark:hover:to-indigo-900/20 transition-all border border-slate-200 dark:border-slate-600 hover:border-blue-500 dark:hover:border-blue-500">
                                            <div class="flex items-center gap-3">
                                                @if ($related->images && is_array($related->images) && count($related->images) > 0)
                                                    <img src="{{ $related->images[0] }}" alt="{{ $related->name }}"
                                                        class="w-12 h-12 rounded-lg object-cover" />
                                                @else
                                                    <div
                                                        class="w-12 h-12 rounded-lg bg-gradient-to-br from-slate-300 to-slate-400 dark:from-slate-600 dark:to-slate-700 flex items-center justify-center">
                                                        <x-heroicon-o-building-library
                                                            class="w-6 h-6 text-slate-500" />
                                                    </div>
                                                @endif
                                                <div class="flex-1 min-w-0">
                                                    <p
                                                        class="font-semibold text-slate-900 dark:text-white text-sm truncate group-hover/item:text-blue-600 dark:group-hover/item:text-blue-400 transition-colors">
                                                        {{ $related->name }}
                                                    </p>
                                                    <div class="flex items-center gap-2 text-xs text-slate-500 mt-1">
                                                        <span class="flex items-center gap-0.5">
                                                            <x-heroicon-o-users class="w-3 h-3" />
                                                            {{ $related->capacity }}
                                                        </span>
                                                        <span>•</span>
                                                        <span
                                                            class="font-bold text-emerald-600 dark:text-emerald-400">${{ number_format($related->price, 0) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== IMAGE MODAL ==================== -->
    @if ($showImageModal && $currentImage)
        <div class="fixed inset-0 bg-black/95 backdrop-blur-2xl z-50 flex items-center justify-center p-4"
            wire:click="toggleImageModal">
            <div class="relative max-w-6xl w-full" wire:click.stop>
                <!-- Close Button -->
                <button wire:click="toggleImageModal"
                    class="absolute -top-12 right-0 text-white/80 hover:text-white p-2 rounded-full hover:bg-white/10 transition-all z-10 group">
                    <x-heroicon-o-x-mark class="w-8 h-8 group-hover:scale-110 transition-transform" />
                </button>

                <!-- Image -->
                <img src="{{ $currentImage }}" alt="{{ $venue->name }}"
                    class="w-full h-auto max-h-[85vh] object-contain rounded-2xl shadow-2xl" />

                <!-- Navigation in Modal -->
                @if ($hasMultipleImages)
                    <button
                        wire:click="selectImage({{ $selectedImageIndex > 0 ? $selectedImageIndex - 1 : count($images) - 1 }})"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-xl text-white p-3 rounded-full transition-all hover:scale-110 border border-white/20">
                        <x-heroicon-o-chevron-left class="w-6 h-6" />
                    </button>

                    <button
                        wire:click="selectImage({{ $selectedImageIndex < count($images) - 1 ? $selectedImageIndex + 1 : 0 }})"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-xl text-white p-3 rounded-full transition-all hover:scale-110 border border-white/20">
                        <x-heroicon-o-chevron-right class="w-6 h-6" />
                    </button>

                    <div
                        class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/50 backdrop-blur-xl text-white px-4 py-2 rounded-full text-sm border border-white/20">
                        {{ $selectedImageIndex + 1 }} / {{ count($images) }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Custom Styles -->
    <style>
        @keyframes gradient {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 4s ease infinite;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .animate-ping {
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</div>
