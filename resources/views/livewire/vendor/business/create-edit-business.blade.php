<div class="min-h-screen relative overflow-hidden">
    <!-- Ambient Background – Light / Dark adaptive -->
    <div class="fixed inset-0 bg-gradient-to-br from-neutral-50 via-white to-neutral-100 dark:from-stone-950 dark:via-stone-900 dark:to-stone-950 -z-50"></div>
    
    <!-- Animated Gradient Orbs – softer in light mode, richer in dark -->
    <div class="fixed inset-0 -z-40 overflow-hidden">
        <div class="absolute -top-1/2 -right-1/2 w-[800px] h-[800px] bg-gradient-to-br from-cyan-200/40 to-blue-200/30 dark:from-cyan-500/20 dark:to-blue-600/15 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -left-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-violet-200/40 to-purple-200/30 dark:from-violet-500/20 dark:to-purple-600/15 rounded-full blur-3xl animate-pulse" style="animation-delay: 3s"></div>
        <div class="absolute top-1/3 left-1/2 w-[500px] h-[500px] bg-gradient-to-br from-emerald-200/30 to-cyan-200/30 dark:from-emerald-500/15 dark:to-cyan-600/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 6s"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <!-- Premium Header Section (updated) -->
        <div class="mb-12 max-w-6xl mx-auto">
            <div class="relative overflow-hidden group">
                <div class="absolute inset-0 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-3xl border border-neutral-200 dark:border-white/10"></div>
                <div class="absolute inset-0 bg-gradient-to-tr from-white/40 to-transparent dark:from-white/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative p-8 lg:p-12">
                    <!-- Header Content -->
                    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-8">
                        <div class="flex items-center gap-4">
                            <!-- Icon Container -->
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-cyan-400 via-blue-400 to-violet-400 dark:from-cyan-500 dark:via-blue-500 dark:to-violet-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-all duration-300"></div>
                                <div class="relative p-4 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-2xl border border-cyan-300/50 dark:border-cyan-500/30 group-hover:border-cyan-400 dark:group-hover:border-cyan-400/50 transition-all duration-300 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-8 h-8 text-cyan-600 dark:text-cyan-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-200 transition-colors">
                                        <rect x="3" y="3" width="18" height="18" rx="2.5"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                        <path d="M21 14.5l-5.5-5.5L6 17"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Text Content -->
                            <div>
                                <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-cyan-600 via-blue-600 to-violet-600 dark:from-cyan-300 dark:via-blue-300 dark:to-violet-300 bg-clip-text text-transparent">
                                    {{ $isEditing ? 'Refine Business' : 'Create Business' }}
                                </h1>
                                <p class="text-sm lg:text-base mt-2 text-neutral-600 dark:text-neutral-400">
                                    {{ $isEditing ? 'Update your business to reflect your growth' : 'Launch your business profile and start accepting bookings' }}
                                </p>
                            </div>
                        </div>

                        <!-- Progress Ring (colors updated) -->
                        <div class="flex items-center justify-center">
                            <div class="relative w-24 h-24">
                                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100">
                                    <!-- Background Circle -->
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" class="text-neutral-200 dark:text-neutral-700" stroke-width="2"/>
                                    <!-- Progress Circle -->
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="url(#progressGradient)" stroke-width="2.5"
                                        stroke-linecap="round" stroke-dasharray="141"
                                        :stroke-dashoffset="$currentStep === 'basic' ? 70.5 : 0"
                                        style="transition: stroke-dashoffset 0.5s ease-out; transform: rotate(-90deg); transform-origin: 50% 50%"/>
                                    <defs>
                                        <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color: #06b6d4; stop-opacity: 1" />
                                            <stop offset="50%" style="stop-color: #3b82f6; stop-opacity: 1" />
                                            <stop offset="100%" style="stop-color: #a855f7; stop-opacity: 1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-cyan-600 dark:text-cyan-300">{{ $currentStep === 'basic' ? '50' : '100' }}%</div>
                                        <div class="text-xs text-neutral-500 dark:text-neutral-500 uppercase tracking-wider">Complete</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step Indicators (colors updated) -->
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative mb-4">
                                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 dark:from-cyan-500 dark:to-blue-500 rounded-full blur-lg opacity-40 transition-all duration-300"
                                        :class="$currentStep === 'basic' ? 'opacity-60' : 'opacity-0'"></div>
                                    <div class="relative w-12 h-12 rounded-full flex items-center justify-center font-bold transition-all duration-300 shadow-md"
                                        :class="$currentStep === 'basic' ? 
                                            'bg-gradient-to-br from-cyan-500 to-blue-600 text-white ring-2 ring-cyan-300/50' : 
                                            ($currentStep === 'contact' ? 'bg-gradient-to-br from-emerald-500 to-teal-500 text-white' : 'bg-neutral-200 dark:bg-stone-700 text-neutral-600 dark:text-neutral-400')">
                                        <svg x-show="$currentStep !== 'basic' && $currentStep === 'contact'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="w-6 h-6">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span x-show="!($currentStep !== 'basic' && $currentStep === 'contact')">1</span>
                                    </div>
                                </div>
                                <span class="text-sm font-semibold" :class="$currentStep === 'basic' ? 'text-cyan-600 dark:text-cyan-300' : 'text-neutral-600 dark:text-neutral-400'">Basic Info</span>
                                <span class="text-xs text-neutral-500 dark:text-neutral-500">Business Details</span>
                            </div>

                            <!-- Connector Line -->
                            <div class="flex-1 mx-4 h-1 bg-neutral-200 dark:bg-stone-700 rounded-full overflow-hidden mb-8">
                                <div class="h-full bg-gradient-to-r from-cyan-500 via-blue-500 to-transparent transition-all duration-500"
                                    :style="{ width: $currentStep === 'contact' ? '100%' : '0%' }"></div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex flex-col items-center flex-1">
                                <div class="relative mb-4">
                                    <div class="absolute inset-0 bg-gradient-to-r from-violet-400 to-purple-400 dark:from-violet-500 dark:to-purple-500 rounded-full blur-lg opacity-40 transition-all duration-300"
                                        :class="$currentStep === 'contact' ? 'opacity-60' : 'opacity-0'"></div>
                                    <div class="relative w-12 h-12 rounded-full flex items-center justify-center font-bold transition-all duration-300 shadow-md"
                                        :class="$currentStep === 'contact' ? 
                                            'bg-gradient-to-br from-violet-500 to-purple-600 text-white ring-2 ring-violet-300/50' : 
                                            ($currentStep === 'basic' ? 'bg-neutral-200 dark:bg-stone-700 text-neutral-600 dark:text-neutral-400' : 'bg-gradient-to-br from-emerald-500 to-teal-500 text-white')">
                                        <svg x-show="$currentStep === 'contact'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="w-6 h-6">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span x-show="$currentStep !== 'contact'">2</span>
                                    </div>
                                </div>
                                <span class="text-sm font-semibold" :class="$currentStep === 'contact' ? 'text-violet-600 dark:text-violet-300' : 'text-neutral-600 dark:text-neutral-400'">Contact Info</span>
                                <span class="text-xs text-neutral-500 dark:text-neutral-500">Location & Services</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message (updated) -->
        @if ($showSuccess)
            <div class="fixed top-6 right-6 max-w-sm z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                <div class="relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/30 to-teal-400/30 dark:from-emerald-500/20 dark:to-teal-500/20 blur-xl group-hover:from-emerald-400/40 dark:group-hover:from-emerald-500/30 transition-all duration-300"></div>
                    <div class="relative backdrop-blur-xl bg-white/80 dark:bg-stone-800/80 border border-emerald-300/50 dark:border-emerald-500/30 p-6 rounded-2xl shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="relative flex-shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 dark:from-emerald-500 dark:to-teal-500 rounded-full blur-lg opacity-50"></div>
                                <div class="relative h-12 w-12 rounded-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500 text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="w-6 h-6">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-emerald-700 dark:text-emerald-300 text-base">{{ $isEditing ? 'Business updated!' : 'Business created!' }}</h3>
                                <p class="text-sm text-emerald-600/70 dark:text-emerald-400/80 mt-1">{{ $isEditing ? 'Your changes have been saved.' : 'Your business is now live.' }}</p>
                            </div>
                            <button @click="show = false" class="text-emerald-500/50 hover:text-emerald-600 dark:text-emerald-400/50 dark:hover:text-emerald-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 dark:from-emerald-500 dark:to-teal-500 rounded-full animate-pulse" style="width: 100%; animation: progress 3s ease-out forwards;"></div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Error Message (updated) -->
        @if ($errors->has('general'))
            <div class="fixed top-6 right-6 max-w-sm z-50">
                <div class="relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-400/30 to-rose-400/30 dark:from-red-500/20 dark:to-rose-500/20 blur-xl group-hover:from-red-400/40 dark:group-hover:from-red-500/30 transition-all duration-300"></div>
                    <div class="relative backdrop-blur-xl bg-white/80 dark:bg-stone-800/80 border border-red-300/50 dark:border-red-500/30 p-6 rounded-2xl shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="relative flex-shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-rose-400 dark:from-red-500 dark:to-rose-500 rounded-full blur-lg opacity-50"></div>
                                <div class="relative h-12 w-12 rounded-full flex items-center justify-center bg-gradient-to-br from-red-400 to-rose-500 text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="w-6 h-6">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-red-700 dark:text-red-300">Error</h3>
                                <p class="text-sm text-red-600/70 dark:text-red-400/80 mt-1">{{ $errors->first('general') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Container -->
        <div class="max-w-4xl mx-auto mb-12">
            <form wire:submit="save" class="space-y-8">
                <!-- Form Card -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-3xl border border-neutral-200 dark:border-white/10 group-hover:border-neutral-300 dark:group-hover:border-white/20 transition-all duration-500 shadow-2xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-cyan-100/30 via-transparent to-violet-100/30 dark:from-cyan-600/5 dark:via-transparent dark:to-violet-600/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative p-8 lg:p-12 space-y-10">
                        @if($currentStep === 'basic')
                            <!-- BASIC INFORMATION SECTION -->
                            <div class="space-y-8">
                                <!-- Section Header -->
                                <div class="flex items-center gap-4 pb-6 border-b border-neutral-200 dark:border-white/5">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400 to-blue-400 dark:from-cyan-500 dark:to-blue-500 rounded-2xl blur-lg opacity-40"></div>
                                        <div class="relative p-3.5 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-2xl border border-cyan-300/50 dark:border-cyan-500/30 shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-6 h-6 text-cyan-600 dark:text-cyan-300">
                                                <rect x="3" y="3" width="18" height="18" rx="2.5"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                                <path d="M21 14.5l-5.5-5.5L6 17"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl lg:text-3xl font-bold text-neutral-800 dark:text-neutral-50">Business Foundation</h2>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Create a compelling business profile</p>
                                    </div>
                                </div>

                                <!-- Business Name -->
                                <div class="group/field relative">
                                    <label for="company_name" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-cyan-400 to-blue-400"></span>
                                        Business Name
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-cyan-500/60 dark:text-cyan-400/60 group-focus-within/field:text-cyan-600 dark:group-focus-within/field:text-cyan-300 transition-colors">
                                                <text x="4" y="16" font-size="14" font-weight="bold">ABC</text>
                                            </svg>
                                        </div>
                                        <input type="text" id="company_name" wire:model="company_name" 
                                            placeholder="Your business name"
                                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-cyan-400 dark:focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-300/50 dark:focus:ring-cyan-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>
                                    @error('company_name')
                                        <p class="text-rose-600 dark:text-rose-400 text-sm mt-2 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Business Description -->
                                <div class="group/field relative">
                                    <label for="business_desc" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-cyan-400 to-blue-400"></span>
                                        Business Description
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-4 left-4 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-cyan-500/60 dark:text-cyan-400/60 group-focus-within/field:text-cyan-600 dark:group-focus-within/field:text-cyan-300 transition-colors">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                            </svg>
                                        </div>
                                        <textarea id="business_desc" wire:model="business_desc" rows="5"
                                            placeholder="Tell us what makes your business unique..."
                                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-cyan-400 dark:focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-300/50 dark:focus:ring-cyan-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 resize-none shadow-sm"></textarea>
                                    </div>
                                    <p class="text-xs text-neutral-500 dark:text-neutral-500 mt-2">20-1000 characters</p>
                                    @error('business_desc')
                                        <p class="text-rose-600 dark:text-rose-400 text-sm mt-2 flex items-center gap-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Category & Subcategory Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="group/field relative">
                                        <label for="category_id" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-violet-400 to-purple-400"></span>
                                            Category
                                            <span class="text-rose-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-violet-500/60 dark:text-violet-400/60 group-focus-within/field:text-violet-600 dark:group-focus-within/field:text-violet-300 transition-colors">
                                                    <rect x="3" y="3" width="8" height="8"></rect>
                                                    <rect x="13" y="3" width="8" height="8"></rect>
                                                    <rect x="3" y="13" width="8" height="8"></rect>
                                                    <rect x="13" y="13" width="8" height="8"></rect>
                                                </svg>
                                            </div>
                                            <select id="category_id" wire:model="category_id"
                                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 focus:outline-none focus:border-violet-400 dark:focus:border-violet-500/50 focus:ring-2 focus:ring-violet-300/50 dark:focus:ring-violet-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 cursor-pointer appearance-none shadow-sm">
                                                <option value="">Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category['id'] }}">{{ $category['type'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 text-neutral-500 dark:text-neutral-500">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="group/field relative">
                                        <label for="subcategory_id" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-violet-400 to-purple-400"></span>
                                            Subcategory
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-purple-500/60 dark:text-purple-400/60 group-focus-within/field:text-purple-600 dark:group-focus-within/field:text-purple-300 transition-colors">
                                                    <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                                                </svg>
                                            </div>
                                            <select id="subcategory_id" wire:model="subcategory_id"
                                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 focus:outline-none focus:border-purple-400 dark:focus:border-purple-500/50 focus:ring-2 focus:ring-purple-300/50 dark:focus:ring-purple-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 cursor-pointer appearance-none shadow-sm">
                                                <option value="">Select a subcategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory['id'] }}">{{ $subcategory['type'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 text-neutral-500 dark:text-neutral-500">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Image (updated) -->
                                <div class="group/upload">
                                    <label class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-emerald-600 dark:text-emerald-400">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        Profile Image
                                    </label>
                                    <div class="relative border-2 border-dashed border-neutral-200 dark:border-white/10 hover:border-emerald-300 dark:hover:border-emerald-500/30 rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer bg-gradient-to-br from-emerald-50/50 to-teal-50/50 dark:from-emerald-950/20 dark:to-teal-950/20 hover:from-emerald-100/50 dark:hover:from-emerald-950/30 dark:hover:to-teal-950/30 group-hover/upload:border-emerald-400 dark:group-hover/upload:border-emerald-500/50"
                                        onclick="document.getElementById('profile_image_input').click()">
                                        <div class="flex flex-col items-center">
                                            <div class="p-4 rounded-2xl bg-gradient-to-br from-emerald-200 to-teal-200 dark:from-emerald-500/30 dark:to-teal-500/30 border border-emerald-300/50 dark:border-emerald-500/30 mb-4 group-hover/upload:from-emerald-300 dark:group-hover/upload:from-emerald-500/50 dark:group-hover/upload:to-teal-500/50 transition-all duration-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-8 h-8 text-emerald-700 dark:text-emerald-300">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                                    <path d="M21 15l-5-5L5 21"></path>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-semibold text-neutral-700 dark:text-slate-200 mb-1">Upload profile picture</p>
                                            <p class="text-xs text-neutral-500 dark:text-neutral-500">PNG, JPG • Up to 5MB</p>
                                        </div>
                                        <input type="file" id="profile_image_input" wire:model="profile_image" accept="image/*" style="display: none;">
                                    </div>
                                @if ($profile_image || $existing_profile_image)
                                              <div class="mt-4 relative inline-block group/preview">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-300 to-teal-300 dark:from-emerald-500/30 dark:to-teal-500/30 rounded-2xl blur-lg opacity-50 group-hover/preview:opacity-75 transition-all duration-300"></div>
            <img src="{{ $profile_image ? $profile_image->temporaryUrl() : asset('storage/' . $existing_profile_image) }}" 
                 alt="Profile" 
                 class="relative h-32 w-32 rounded-2xl object-cover shadow-2xl border border-emerald-300/50 dark:border-emerald-500/30 group-hover/preview:border-emerald-400 dark:group-hover/preview:border-emerald-500/50 transition-all duration-300">
        </div>
        <button type="button" 
            wire:click="$set('{{ $profile_image ? 'profile_image' : 'existing_profile_image' }}', null)"
            class="absolute -top-3 -right-3 bg-gradient-to-br from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-lg hover:scale-110 transition-all duration-300 border border-white/30">✕</button>
    </div>
@endif
                                </div>

                                <!-- Cover Image (updated) -->
                                <div class="group/upload">
                                    <label class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-indigo-600 dark:text-indigo-400">
                                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                            <path d="M21 15l-5-5L5 21"></path>
                                        </svg>
                                        Cover Image
                                    </label>
                                    <div class="relative border-2 border-dashed border-neutral-200 dark:border-white/10 hover:border-indigo-300 dark:hover:border-indigo-500/30 rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer bg-gradient-to-br from-indigo-50/50 to-blue-50/50 dark:from-indigo-950/20 dark:to-blue-950/20 hover:from-indigo-100/50 dark:hover:from-indigo-950/30 dark:hover:to-blue-950/30 group-hover/upload:border-indigo-400 dark:group-hover/upload:border-indigo-500/50"
                                        onclick="document.getElementById('cover_image_input').click()">
                                        <div class="flex flex-col items-center">
                                            <div class="p-4 rounded-2xl bg-gradient-to-br from-indigo-200 to-blue-200 dark:from-indigo-500/30 dark:to-blue-500/30 border border-indigo-300/50 dark:border-indigo-500/30 mb-4 group-hover/upload:from-indigo-300 dark:group-hover/upload:from-indigo-500/50 dark:group-hover/upload:to-blue-500/50 transition-all duration-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-8 h-8 text-indigo-700 dark:text-indigo-300">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                                    <path d="M21 15l-5-5L5 21"></path>
                                                </svg>
                                            </div>
                                            <p class="text-sm font-semibold text-neutral-700 dark:text-slate-200 mb-1">Upload cover image</p>
                                            <p class="text-xs text-neutral-500 dark:text-neutral-500">PNG, JPG • Up to 5MB (1200x600px)</p>
                                        </div>
                                        <input type="file" id="cover_image_input" wire:model="cover_image" accept="image/*" style="display: none;">
                                    </div>
                                    @if ($cover_image || $existing_cover_image)
    <div class="mt-4 relative group/preview overflow-hidden rounded-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-300 to-blue-300 dark:from-indigo-500/30 dark:to-blue-500/30 blur-lg opacity-50 group-hover/preview:opacity-75 transition-all duration-300"></div>
        <img src="{{ $cover_image ? $cover_image->temporaryUrl() : asset('storage/' . $existing_cover_image) }}" 
             alt="Cover" 
             class="relative max-h-64 w-full rounded-2xl object-cover shadow-2xl border border-indigo-300/50 dark:border-indigo-500/30 group-hover/preview:border-indigo-400 dark:group-hover/preview:border-indigo-500/50 transition-all duration-300">
        <button type="button" 
            wire:click="$set('{{ $cover_image ? 'cover_image' : 'existing_cover_image' }}', null)"
            class="absolute -top-3 -right-3 bg-gradient-to-br from-rose-500 to-pink-500 hover:from-rose-600 hover:to-pink-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-lg hover:scale-110 transition-all duration-300 border border-white/30">✕</button>
    </div>
@endif
                                </div>
                            </div>
                        @endif

                        @if($currentStep === 'contact')
                            <!-- CONTACT & LOCATION SECTION (updated similarly) -->
                            <div class="space-y-8">
                                <!-- Section Header -->
                                <div class="flex items-center gap-4 pb-6 border-b border-neutral-200 dark:border-white/5">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-violet-400 to-purple-400 dark:from-violet-500 dark:to-purple-500 rounded-2xl blur-lg opacity-40"></div>
                                        <div class="relative p-3.5 bg-white/70 dark:bg-stone-800/70 backdrop-blur-xl rounded-2xl border border-violet-300/50 dark:border-violet-500/30 shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-6 h-6 text-violet-600 dark:text-violet-300">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl lg:text-3xl font-bold text-neutral-800 dark:text-neutral-50">Connection & Location</h2>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">Help customers reach and find you</p>
                                    </div>
                                </div>

                                <!-- Email & Phone -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="group/field relative">
                                        <label for="business_email" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-blue-400 to-cyan-400"></span>
                                            Business Email
                                            <span class="text-rose-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-blue-500/60 dark:text-blue-400/60 group-focus-within/field:text-blue-600 dark:group-focus-within/field:text-blue-300 transition-colors">
                                                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                                    <path d="m22 6-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 6"></path>
                                                </svg>
                                            </div>
                                            <input type="email" id="business_email" wire:model="business_email" 
                                                placeholder="hello@business.com"
                                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-blue-400 dark:focus:border-blue-500/50 focus:ring-2 focus:ring-blue-300/50 dark:focus:ring-blue-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                        </div>
                                    </div>

                                    <div class="group/field relative">
                                        <label for="business_phone" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-emerald-400 to-teal-400"></span>
                                            Business Phone
                                            <span class="text-rose-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-emerald-500/60 dark:text-emerald-400/60 group-focus-within/field:text-emerald-600 dark:group-focus-within/field:text-emerald-300 transition-colors">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                            </div>
                                            <input type="tel" id="business_phone" wire:model="business_phone" 
                                                placeholder="+1 (555) 000-0000"
                                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-emerald-400 dark:focus:border-emerald-500/50 focus:ring-2 focus:ring-emerald-300/50 dark:focus:ring-emerald-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                        </div>
                                    </div>
                                </div>

                                <!-- Website -->
                                <div class="group/field relative">
                                    <label for="website" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-purple-400 to-pink-400"></span>
                                        Website (Optional)
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-purple-500/60 dark:text-purple-400/60 group-focus-within/field:text-purple-600 dark:group-focus-within/field:text-purple-300 transition-colors">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                            </svg>
                                        </div>
                                        <input type="url" id="website" wire:model="website" 
                                            placeholder="https://www.example.com"
                                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-purple-400 dark:focus:border-purple-500/50 focus:ring-2 focus:ring-purple-300/50 dark:focus:ring-purple-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="group/field relative">
                                    <label for="street_address" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-amber-400 to-orange-400"></span>
                                        Street Address
                                        <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-amber-500/60 dark:text-amber-400/60 group-focus-within/field:text-amber-600 dark:group-focus-within/field:text-amber-300 transition-colors">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                        </div>
                                        <input type="text" id="street_address" wire:model="street_address" 
                                            placeholder="123 Business Avenue"
                                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-amber-400 dark:focus:border-amber-500/50 focus:ring-2 focus:ring-amber-300/50 dark:focus:ring-amber-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>
                                </div>

                                <!-- City, Country, Postal Code -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="group/field relative">
                                        <label for="city" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-red-400 to-rose-400"></span>
                                            City
                                            <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" id="city" wire:model="city" 
                                            placeholder="New York"
                                            class="w-full px-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-red-400 dark:focus:border-red-500/50 focus:ring-2 focus:ring-red-300/50 dark:focus:ring-red-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>

                                    <div class="group/field relative">
                                        <label for="country" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-cyan-400 to-blue-400"></span>
                                            Country
                                            <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" id="country" wire:model="country" 
                                            placeholder="United States"
                                            class="w-full px-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-cyan-400 dark:focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-300/50 dark:focus:ring-cyan-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>

                                    <div class="group/field relative">
                                        <label for="postal_code" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                            <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-teal-400 to-emerald-400"></span>
                                            Postal Code (Optional)
                                        </label>
                                        <input type="text" id="postal_code" wire:model="postal_code" 
                                            placeholder="10001"
                                            class="w-full px-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-teal-400 dark:focus:border-teal-500/50 focus:ring-2 focus:ring-teal-300/50 dark:focus:ring-teal-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>
                                </div>

                                <!-- Capacity -->
                                <div class="group/field relative">
                                    <label for="capacity" class="block text-sm font-bold text-neutral-700 dark:text-slate-200 mb-3 flex items-center gap-2">
                                        <span class="inline-block w-1 h-1 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400"></span>
                                        Guest Capacity (Optional)
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-indigo-500/60 dark:text-indigo-400/60 group-focus-within/field:text-indigo-600 dark:group-focus-within/field:text-indigo-300 transition-colors">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg>
                                        </div>
                                        <input type="number" id="capacity" wire:model="capacity" 
                                            placeholder="50" min="1"
                                            class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-indigo-400 dark:focus:border-indigo-500/50 focus:ring-2 focus:ring-indigo-300/50 dark:focus:ring-indigo-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm">
                                    </div>
                                </div>

                                <!-- Features -->
                                <div class="space-y-4">
                                    <label class="block text-sm font-bold text-neutral-700 dark:text-slate-200 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-amber-500">
                                            <polygon points="12 2 15.09 10.26 24 10.27 17.18 16.93 20.27 25.19 12 19.54 3.73 25.19 6.82 16.93 0 10.27 8.91 10.26 12 2"></polygon>
                                        </svg>
                                        Key Features (Optional)
                                    </label>
                                    <div class="flex gap-3">
                                        <div class="relative flex-1 group/field">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-amber-500/60 dark:text-amber-400/60 group-focus-within/field:text-amber-600 dark:group-focus-within/field:text-amber-300 transition-colors">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <input type="text" wire:model="newFeature" 
                                                placeholder="e.g., Free Parking, WiFi..."
                                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-amber-400 dark:focus:border-amber-500/50 focus:ring-2 focus:ring-amber-300/50 dark:focus:ring-amber-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm"
                                                @keyup.enter="$wire.addFeature()">
                                        </div>
                                        <button type="button" wire:click="addFeature" 
                                            class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-amber-200 to-yellow-200 dark:from-amber-500/20 dark:to-yellow-500/20 hover:from-amber-300 dark:hover:from-amber-500/40 dark:hover:to-yellow-500/40 border border-amber-300/50 dark:border-amber-500/30 text-amber-700 dark:text-amber-300 hover:text-amber-800 dark:hover:text-amber-200 font-semibold transition-all duration-300 hover:border-amber-400 dark:hover:border-amber-500/50 backdrop-blur-xl flex items-center gap-2 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    @if (count($features) > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($features as $index => $feature)
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-amber-100 to-yellow-100 dark:from-amber-500/20 dark:to-yellow-500/20 border border-amber-300/50 dark:border-amber-500/30 text-amber-700 dark:text-amber-300 rounded-full text-xs font-semibold backdrop-blur-sm hover:from-amber-200 dark:hover:from-amber-500/30 dark:hover:to-yellow-500/30 hover:border-amber-400 dark:hover:border-amber-500/50 transition-all duration-300 group/tag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3 h-3 text-amber-600 dark:text-amber-300">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    {{ $feature }}
                                                    <button type="button" wire:click="removeFeature({{ $index }})" 
                                                        class="opacity-0 group-hover/tag:opacity-100 transition-opacity hover:text-rose-500 dark:hover:text-rose-400">✕</button>
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Services -->
                                <div class="space-y-4">
                                    <label class="block text-sm font-bold text-neutral-700 dark:text-slate-200 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-purple-600 dark:text-purple-400">
                                            <circle cx="12" cy="12" r="1" fill="currentColor"></circle>
                                            <circle cx="19" cy="12" r="1" fill="currentColor"></circle>
                                            <circle cx="5" cy="12" r="1" fill="currentColor"></circle>
                                        </svg>
                                        Services Offered (Optional)
                                    </label>
                                    <div class="flex gap-3">
                                        <div class="relative flex-1 group/field">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-5 h-5 text-purple-500/60 dark:text-purple-400/60 group-focus-within/field:text-purple-600 dark:group-focus-within/field:text-purple-300 transition-colors">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <input type="text" wire:model="newService" 
                                                placeholder="e.g., Photography, Videography..."
                                                class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-neutral-200 dark:border-white/10 bg-white/70 dark:bg-stone-800/70 text-neutral-800 dark:text-neutral-50 placeholder-neutral-400 dark:placeholder-slate-500 focus:outline-none focus:border-purple-400 dark:focus:border-purple-500/50 focus:ring-2 focus:ring-purple-300/50 dark:focus:ring-purple-500/20 transition-all duration-300 backdrop-blur-xl hover:bg-white dark:hover:bg-stone-800/90 group-focus-within/field:bg-white dark:group-focus-within/field:bg-stone-800/90 shadow-sm"
                                                @keyup.enter="$wire.addService()">
                                        </div>
                                        <button type="button" wire:click="addService" 
                                            class="px-6 py-3.5 rounded-2xl bg-gradient-to-r from-purple-200 to-pink-200 dark:from-purple-500/20 dark:to-pink-500/20 hover:from-purple-300 dark:hover:from-purple-500/40 dark:hover:to-pink-500/40 border border-purple-300/50 dark:border-purple-500/30 text-purple-700 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-200 font-semibold transition-all duration-300 hover:border-purple-400 dark:hover:border-purple-500/50 backdrop-blur-xl flex items-center gap-2 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    @if (count($services) > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($services as $index => $service)
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-500/20 dark:to-pink-500/20 border border-purple-300/50 dark:border-purple-500/30 text-purple-700 dark:text-purple-300 rounded-full text-xs font-semibold backdrop-blur-sm hover:from-purple-200 dark:hover:from-purple-500/30 dark:hover:to-pink-500/30 hover:border-purple-400 dark:hover:border-purple-500/50 transition-all duration-300 group/tag">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3 h-3 text-purple-600 dark:text-purple-300">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    {{ $service }}
                                                    <button type="button" wire:click="removeService({{ $index }})" 
                                                        class="opacity-0 group-hover/tag:opacity-100 transition-opacity hover:text-rose-500 dark:hover:text-rose-400">✕</button>
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Form Actions -->
                        <div class="flex gap-4 pt-8 border-t border-neutral-200 dark:border-white/5">
                            @if ($currentStep === 'contact')
                                <button type="button" wire:click="previousStep" 
                                    class="flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-neutral-100 dark:bg-stone-800/70 hover:bg-neutral-200 dark:hover:bg-stone-800 border border-neutral-200 dark:border-white/10 hover:border-neutral-300 dark:hover:border-white/20 text-neutral-700 dark:text-neutral-300 hover:text-neutral-800 dark:hover:text-neutral-50 font-semibold transition-all duration-300 backdrop-blur-xl shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                    Back
                                </button>
                            @endif

                            @if ($currentStep === 'basic')
                                <button type="button" wire:click="nextStep" 
                                    class="ml-auto flex items-center gap-2 px-8 py-3.5 rounded-2xl bg-gradient-to-r from-cyan-200 via-blue-200 to-violet-200 dark:from-cyan-500/20 dark:via-blue-500/20 dark:to-violet-500/20 hover:from-cyan-300 dark:hover:from-cyan-500/40 dark:hover:via-blue-500/40 dark:hover:to-violet-500/40 border border-cyan-300/50 dark:border-cyan-500/30 hover:border-cyan-400 dark:hover:border-cyan-500/50 text-cyan-700 dark:text-cyan-300 hover:text-cyan-800 dark:hover:text-cyan-200 font-semibold transition-all duration-300 backdrop-blur-xl hover:shadow-lg hover:shadow-cyan-200/50 dark:hover:shadow-cyan-500/10 transform hover:scale-105 shadow-sm">
                                    Next Step
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </button>
                            @else
                                <button type="submit" 
                                    class="ml-auto flex items-center gap-2 px-8 py-3.5 rounded-2xl bg-gradient-to-r from-emerald-200 via-teal-200 to-cyan-200 dark:from-emerald-500/20 dark:via-teal-500/20 dark:to-cyan-500/20 hover:from-emerald-300 dark:hover:from-emerald-500/40 dark:hover:via-teal-500/40 dark:hover:to-cyan-500/40 border border-emerald-300/50 dark:border-emerald-500/30 hover:border-emerald-400 dark:hover:border-emerald-500/50 text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 font-semibold transition-all duration-300 backdrop-blur-xl hover:shadow-lg hover:shadow-emerald-200/50 dark:hover:shadow-emerald-500/10 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm" wire:loading.attr="disabled">
                                    <span wire:loading.remove class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        {{ $isEditing ? 'Update Business' : 'Create Business' }}
                                    </span>
                                    <span wire:loading class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes progress {
            0% { width: 0%; }
            100% { width: 100%; }
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</div>