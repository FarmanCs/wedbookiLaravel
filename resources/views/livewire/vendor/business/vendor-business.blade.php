<div class="min-h-screen relative overflow-hidden">
    <!-- Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 -z-50"></div>
    
    <!-- Animated Ambient Background -->
    <div class="fixed inset-0 -z-40 overflow-hidden">
        <div class="absolute -top-1/2 -right-1/2 w-[800px] h-[800px] bg-gradient-to-br from-cyan-500/15 to-blue-600/8 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -left-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-violet-500/15 to-purple-600/8 rounded-full blur-3xl animate-pulse" style="animation-delay: 3s"></div>
        <div class="absolute top-1/3 left-1/2 w-[500px] h-[500px] bg-gradient-to-br from-emerald-500/10 to-cyan-600/8 rounded-full blur-3xl animate-pulse" style="animation-delay: 6s"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <!-- Premium Header -->
        <div class="mb-12 max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 via-blue-500 to-violet-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-all duration-300"></div>
                            <div class="relative p-4 bg-gradient-to-br from-cyan-600/30 to-blue-600/30 backdrop-blur-xl rounded-2xl border border-cyan-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-8 h-8 text-cyan-300">
                                    <rect x="3" y="3" width="18" height="18" rx="2.5"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                    <path d="M21 14.5l-5.5-5.5L6 17"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-cyan-300 via-blue-300 to-violet-300 bg-clip-text text-transparent group-hover:from-cyan-200 group-hover:via-blue-200 group-hover:to-violet-200 transition-all duration-300">
                                My Businesses
                            </h1>
                            <p class="text-sm lg:text-base text-slate-400 mt-2 group-hover:text-slate-300 transition-colors">
                                Manage your portfolio and grow your revenue
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Create Button -->
                <a href="{{ route('vendor.business.create') }}" 
                    class="relative group/btn inline-flex items-center gap-3 px-8 py-4 rounded-2xl">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/20 to-cyan-500/20 rounded-2xl blur-xl opacity-40 group-hover/btn:opacity-60 transition-all duration-300"></div>
                    <div class="relative flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-600/30 to-teal-600/30 backdrop-blur-xl border border-emerald-500/30 group-hover/btn:border-emerald-500/50 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 text-emerald-300">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="text-emerald-300 font-semibold group-hover/btn:text-emerald-200 transition-colors">Add Business</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Delete Success Message -->
        @if ($showDeleteSuccess)
            <div class="fixed top-6 right-6 max-w-sm z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in duration-200">
                <div class="relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 blur-xl group-hover:from-emerald-500/30 group-hover:to-teal-500/30 transition-all duration-300"></div>
                    <div class="relative backdrop-blur-xl bg-gradient-to-br from-emerald-950/80 to-teal-950/60 border border-emerald-500/30 p-6 rounded-2xl shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="relative flex-shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full blur-lg opacity-50"></div>
                                <div class="relative h-10 w-10 rounded-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500 text-slate-950">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="w-5 h-5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-emerald-300">Business Deleted</h3>
                                <p class="text-sm text-emerald-400/80 mt-1">"{{ $deletedBusinessName }}" has been removed from your portfolio.</p>
                            </div>
                            <button @click="show = false" class="text-emerald-400/50 hover:text-emerald-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($businesses->isEmpty())
            <!-- Empty State -->
            <div class="max-w-2xl mx-auto">
                <div class="relative group overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-600/10 via-blue-600/10 to-violet-600/10 backdrop-blur-xl rounded-3xl border border-white/10"></div>
                    <div class="absolute inset-0 bg-gradient-to-tr from-white/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative p-12 lg:p-16 text-center">
                        <div class="relative inline-block mb-8">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-3xl blur-2xl opacity-30 group-hover:opacity-50 transition-all duration-300"></div>
                            <div class="relative p-8 bg-gradient-to-br from-emerald-600/30 to-teal-600/30 backdrop-blur-xl rounded-3xl border border-emerald-500/30 group-hover:border-emerald-500/50 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-16 h-16 text-emerald-300">
                                    <rect x="3" y="3" width="18" height="18" rx="2.5"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                    <path d="M21 14.5l-5.5-5.5L6 17"></path>
                                </svg>
                            </div>
                        </div>

                        <h2 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-emerald-300 to-teal-300 bg-clip-text text-transparent mb-4">
                            No Businesses Yet
                        </h2>
                        <p class="text-slate-400 text-lg mb-8 max-w-md mx-auto">
                            Create your first business profile to start managing services and accepting bookings
                        </p>

                        <a href="{{ route('vendor.business.create') }}" 
                            class="relative inline-group/btn">
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/20 to-cyan-500/20 rounded-2xl blur-xl opacity-40 group-hover/btn:opacity-60 transition-all duration-300"></div>
                            <div class="relative inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-600/30 to-teal-600/30 backdrop-blur-xl border border-emerald-500/30 group-hover/btn:border-emerald-500/50 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 text-emerald-300">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span class="text-emerald-300 font-semibold group-hover/btn:text-emerald-200 transition-colors">Create First Business</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Businesses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-7xl mx-auto">
                @foreach($businesses as $business)
                    <div class="group/card h-full">
                        <!-- Card Glow -->
                        <div class="absolute -inset-0.5 bg-gradient-to-br from-cyan-500/20 via-blue-500/20 to-violet-500/20 rounded-2xl opacity-0 group-hover/card:opacity-100 blur-xl transition-all duration-500 -z-10"></div>

                        <!-- Card Container -->
                        <div class="relative h-full flex flex-col overflow-hidden rounded-2xl border border-white/10 group-hover/card:border-white/20 transition-all duration-300 backdrop-blur-xl bg-gradient-to-br from-slate-900/50 to-slate-950/50">
                            
                            <!-- Cover Section -->
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-cyan-600/20 to-blue-600/20">
                                @if($business->cover_image)
                                    <img src="{{ Storage::url($business->cover_image) }}" 
                                        alt="Cover" 
                                        class="w-full h-full object-cover group-hover/card:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-cyan-600/30 to-blue-600/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-12 h-12 text-cyan-300/30">
                                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor"></circle>
                                            <path d="M21 15l-5-5L5 21"></path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>

                                <!-- Rating Badge -->
                                <div class="absolute top-4 right-4 backdrop-blur-xl bg-slate-900/80 border border-white/10 rounded-xl px-3.5 py-2 shadow-xl">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-yellow-400">
                                            <polygon points="12 2 15.09 10.26 24 10.27 17.18 16.93 20.27 25.19 12 19.54 3.73 25.19 6.82 16.93 0 10.27 8.91 10.26 12 2"></polygon>
                                        </svg>
                                        <span class="font-bold text-slate-100 text-xs">
                                            {{ number_format($business->reviews_avg_points ?? 0, 1) }}
                                        </span>
                                        <span class="text-xs text-slate-400">
                                            ({{ $business->reviews_count ?? 0 }})
                                        </span>
                                    </div>
                                </div>

                                <!-- Profile Image -->
                                <div class="absolute -bottom-6 left-6 z-20">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 via-blue-500 to-violet-500 rounded-2xl blur-xl opacity-40 group-hover/card:opacity-60 transition-all duration-300"></div>
                                        <div class="relative w-28 h-28 rounded-2xl border-4 border-slate-900 overflow-hidden bg-gradient-to-br from-cyan-600/50 to-blue-600/50 flex items-center justify-center text-3xl font-bold text-white shadow-2xl">
                                            @if($business->profile_image)
                                                <img src="{{ Storage::url($business->profile_image) }}" 
                                                    alt="{{ $business->company_name }}" 
                                                    class="w-full h-full object-cover">
                                            @else
                                                <span class="text-cyan-200">{{ substr($business->company_name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="flex-1 flex flex-col p-6 pt-12">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-slate-100 group-hover/card:text-cyan-300 transition-colors duration-300 mb-3 line-clamp-1">
                                    {{ $business->company_name }}
                                </h3>

                                <!-- Category Tags -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-500/30 text-cyan-300 text-xs font-semibold rounded-full backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-3 h-3">
                                            <rect x="3" y="3" width="8" height="8"></rect>
                                            <rect x="13" y="3" width="8" height="8"></rect>
                                            <rect x="3" y="13" width="8" height="8"></rect>
                                            <rect x="13" y="13" width="8" height="8"></rect>
                                        </svg>
                                        {{ $business->category?->type ?? 'General' }}
                                    </span>
                                    @if($business->subCategory)
                                        <span class="inline-flex items-center px-3 py-1 bg-white/5 border border-white/10 text-slate-400 text-xs font-semibold rounded-full backdrop-blur-sm">
                                            {{ $business->subCategory->type }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-3 gap-3 mb-5 py-3 bg-gradient-to-r from-white/5 to-transparent rounded-xl px-3 border border-white/5 backdrop-blur-sm">
                                    <div class="text-center group/stat">
                                        <div class="flex items-center justify-center mb-1 opacity-60 group-hover/stat:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-4 h-4 text-cyan-400">
                                                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                            </svg>
                                        </div>
                                        <div class="text-base font-bold text-cyan-300 group-hover/stat:text-cyan-200 transition-colors">
                                            {{ $business->packages_count ?? 0 }}
                                        </div>
                                        <div class="text-xs text-slate-500 group-hover/stat:text-slate-400 transition-colors">Packages</div>
                                    </div>
                                    <div class="text-center border-l border-r border-white/5 group/stat">
                                        <div class="flex items-center justify-center mb-1 opacity-60 group-hover/stat:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-4 h-4 text-purple-400">
                                                <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                <path d="M16 2v4M8 2v4"></path>
                                            </svg>
                                        </div>
                                        <div class="text-base font-bold text-purple-300 group-hover/stat:text-purple-200 transition-colors">
                                            {{ $business->bookings_count ?? 0 }}
                                        </div>
                                        <div class="text-xs text-slate-500 group-hover/stat:text-slate-400 transition-colors">Bookings</div>
                                    </div>
                                    <div class="text-center group/stat">
                                        <div class="flex items-center justify-center mb-1 opacity-60 group-hover/stat:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-yellow-400">
                                                <polygon points="12 2 15.09 10.26 24 10.27 17.18 16.93 20.27 25.19 12 19.54 3.73 25.19 6.82 16.93 0 10.27 8.91 10.26 12 2"></polygon>
                                            </svg>
                                        </div>
                                        <div class="text-base font-bold text-yellow-300 group-hover/stat:text-yellow-200 transition-colors">
                                            {{ $business->reviews_count ?? 0 }}
                                        </div>
                                        <div class="text-xs text-slate-500 group-hover/stat:text-slate-400 transition-colors">Reviews</div>
                                    </div>
                                </div>

                                <!-- Description -->
                                @if($business->business_desc)
                                    <p class="text-sm text-slate-400 group-hover/card:text-slate-300 transition-colors line-clamp-2 mb-4">
                                        {{ $business->business_desc }}
                                    </p>
                                @endif

                                <!-- Contact Info -->
                                <div class="space-y-2 mb-5 text-xs">
                                    @if($business->business_email)
                                        <div class="flex items-center gap-2 text-slate-500 group-hover/card:text-slate-400 transition-colors hover:text-cyan-400 group/item">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-3.5 h-3.5 text-cyan-400/60 flex-shrink-0 group-hover/item:text-cyan-400 transition-colors">
                                                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                                <path d="m22 6-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 6"></path>
                                            </svg>
                                            <span class="truncate">{{ $business->business_email }}</span>
                                        </div>
                                    @endif
                                    @if($business->business_phone)
                                        <div class="flex items-center gap-2 text-slate-500 group-hover/card:text-slate-400 transition-colors hover:text-emerald-400 group/item">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-3.5 h-3.5 text-emerald-400/60 flex-shrink-0 group-hover/item:text-emerald-400 transition-colors">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                            </svg>
                                            <span>{{ $business->business_phone }}</span>
                                        </div>
                                    @endif
                                    @if($business->city)
                                        <div class="flex items-center gap-2 text-slate-500 group-hover/card:text-slate-400 transition-colors hover:text-violet-400 group/item">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-3.5 h-3.5 text-violet-400/60 flex-shrink-0 group-hover/item:text-violet-400 transition-colors">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <span>{{ $business->city }}@if($business->country), {{ $business->country }}@endif</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Divider -->
                                <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent my-4"></div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3 mt-auto">
                                    <a href="{{ route('vendor.business.edit', $business->id) }}" 
                                        class="flex-1 group/edit relative">
                                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 rounded-xl opacity-0 group-hover/edit:opacity-100 blur-lg transition-all duration-300"></div>
                                        <div class="relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-600/20 border border-cyan-500/30 hover:border-cyan-500/50 text-cyan-300 hover:text-cyan-200 font-medium transition-all duration-300 backdrop-blur-sm text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-4 h-4">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            Edit
                                        </div>
                                    </a>
                                    <button type="button" 
                                        wire:click="delete({{ $business->id }})" 
                                        wire:confirm="Are you sure? This cannot be undone."
                                        class="flex-1 group/delete relative">
                                        <div class="absolute inset-0 bg-gradient-to-r from-rose-500/20 to-red-500/20 rounded-xl opacity-0 group-hover/delete:opacity-100 blur-lg transition-all duration-300"></div>
                                        <div class="relative flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-600/20 border border-rose-500/30 hover:border-rose-500/50 text-rose-300 hover:text-rose-200 font-medium transition-all duration-300 backdrop-blur-sm text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="w-4 h-4">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            Delete
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; }
            50% { opacity: 0.6; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(10px); }
        }

        .group\/card {
            position: relative;
        }
    </style>
</div>