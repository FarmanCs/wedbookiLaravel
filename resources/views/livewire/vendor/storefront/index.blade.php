<div class="py-8 space-y-8" x-data="{ activeTab: 'business' }">
    <!-- Header with progress and view button -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <h1
                    class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Storefront
                </h1>
                <div class="flex items-center gap-2 bg-gray-100 dark:bg-gray-700 px-3 py-1.5 rounded-full">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">0% Complete</span>
                </div>
            </div>
            <a href="#"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View Storefront
            </a>
        </div>

        <!-- Progress bar -->
        <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-2.5 rounded-full transition-all duration-500"
                style="width: 0%"></div>
        </div>
    </div>

    <!-- Main content grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tab navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <nav class="flex space-x-8">
                <button @click="activeTab = 'business'"
                    :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'business', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'business' }"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-all">
                    Business Info
                </button>
                <button @click="activeTab = 'services'"
                    :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'services', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'services' }"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-all">
                    Services & Media
                </button>
                <button @click="activeTab = 'packages'"
                    :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'packages', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'packages' }"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-all">
                    Packages
                </button>
                <button @click="activeTab = 'documents'"
                    :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'documents', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'documents' }"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-all">
                    Documents & Policy
                </button>
            </nav>
        </div>

        <!-- Tab: Business Info -->
        <div x-show="activeTab === 'business'" x-cloak class="space-y-6">
            <!-- Business Description Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Business Description</h2>
                </div>
                <div class="p-6 space-y-5">
                    <!-- Business Name & Category -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Business
                                Name</label>
                            <input type="text" wire:model="business.company_name"
                                placeholder="Enter your business name"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition">
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                            <select wire:model="business.category_id"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Not Specified</option>
                                <!-- Options dynamically loaded -->
                            </select>
                        </div>
                    </div>

                    <!-- Business Type + Registration -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Business
                                Type</label>
                            <select wire:model="business.business_type"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Business Type</option>
                                <option value="sole_proprietor">Sole Proprietor</option>
                                <option value="llc">LLC</option>
                                <option value="corporation">Corporation</option>
                            </select>
                            <p class="mt-1 text-xs text-amber-600 dark:text-amber-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Once saved, cannot be changed later.
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company
                                Registration Number</label>
                            <div class="flex rounded-xl shadow-sm">
                                <input type="text" wire:model="business.business_registration"
                                    placeholder="Enter company registration number"
                                    class="flex-1 rounded-l-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-r-xl hover:bg-gray-100 dark:hover:bg-gray-600 text-sm font-medium transition">
                                    Verify
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Not Verified
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea wire:model="business.business_desc" rows="4"
                            placeholder="Describe your business and services... (minimum 20 characters)"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 20 characters</p>
                    </div>

                    <!-- Features (tags) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Features</label>
                        <div
                            class="flex flex-wrap gap-2 p-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700">
                            @if (!empty($business->features))
                                @foreach ($business->features as $feature)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/40 dark:to-purple-900/40 text-indigo-800 dark:text-indigo-300 rounded-full text-sm">
                                        {{ $feature }}
                                        <button type="button" wire:click="removeFeature('{{ $feature }}')"
                                            class="hover:text-indigo-600 dark:hover:text-indigo-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            @endif
                            <input type="text" wire:model.defer="newFeature" wire:keydown.enter="addFeature"
                                placeholder="Type a feature and press Enter"
                                class="flex-1 min-w-[200px] border-0 p-0 focus:ring-0 dark:bg-gray-700 dark:text-white text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Details Card (contact, address, etc) -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Business Details</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" wire:model="business.business_email"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                        <input type="tel" wire:model="business.business_phone"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Street
                            Address</label>
                        <input type="text" wire:model="business.street_address"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                        <input type="text" wire:model="business.city"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                        <input type="text" wire:model="business.country"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Postal
                            Code</label>
                        <input type="text" wire:model="business.postal_code"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Services & Media -->
        <div x-show="activeTab === 'services'" x-cloak class="space-y-6">
            <!-- Social Media Links -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Social Media</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="url" wire:model="business.social_links.facebook" placeholder="Facebook URL"
                            class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <input type="url" wire:model="business.social_links.instagram"
                            placeholder="Instagram URL"
                            class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <input type="url" wire:model="business.social_links.twitter" placeholder="Twitter URL"
                            class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- FAQs -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">FAQs</h2>
                </div>
                <div class="p-6 space-y-4">
                    @if (!empty($business->faqs))
                        @foreach ($business->faqs as $index => $faq)
                            <div class="flex gap-3 items-start">
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input type="text" wire:model="business.faqs.{{ $index }}.question"
                                        placeholder="Question"
                                        class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <input type="text" wire:model="business.faqs.{{ $index }}.answer"
                                        placeholder="Answer"
                                        class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <button type="button" wire:click="removeFaq({{ $index }})"
                                    class="text-red-500 hover:text-red-700 p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @endif
                    <!-- Add new FAQ -->
                    <div class="flex gap-3 items-start">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input type="text" wire:model="newFaqQuestion" placeholder="New question"
                                class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="text" wire:model="newFaqAnswer" placeholder="New answer"
                                class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <button type="button" wire:click="addFaq"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-medium rounded-xl shadow-sm transition-all hover:shadow">
                            Add
                        </button>
                    </div>
                </div>
            </div>

            <!-- Image Media -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Image Media</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if (!empty($business->portfolio_images))
                            @foreach ($business->portfolio_images as $image)
                                <div
                                    class="relative group aspect-w-1 aspect-h-1 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 shadow-sm">
                                    <img src="{{ Storage::url($image) }}" alt=""
                                        class="object-cover w-full h-full">
                                    <button type="button" wire:click="removeImage('{{ $image }}')"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-all hover:bg-red-600 shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <label
                            class="flex flex-col items-center justify-center aspect-w-1 aspect-h-1 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition bg-gray-50 dark:bg-gray-700/50 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 group">
                            <svg class="w-8 h-8 text-gray-400 group-hover:text-indigo-500 transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span
                                class="mt-1 text-xs text-gray-500 dark:text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Upload</span>
                            <input type="file" wire:model="uploadedImages" multiple accept="image/*"
                                class="hidden">
                        </label>
                    </div>
                    <div wire:loading wire:target="uploadedImages"
                        class="mt-3 text-sm text-indigo-600 dark:text-indigo-400">Uploading...</div>
                </div>
            </div>

            <!-- Video Media -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Video Media</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @if (!empty($business->videos))
                            @foreach ($business->videos as $index => $video)
                                <div class="flex gap-2 items-center">
                                    <input type="url" wire:model="business.videos.{{ $index }}"
                                        placeholder="YouTube/Vimeo URL"
                                        class="flex-1 rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <button type="button" wire:click="removeVideo({{ $index }})"
                                        class="text-red-500 hover:text-red-700 p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <!-- Add new video -->
                        <div class="flex gap-2 items-center">
                            <input type="url" wire:model="newVideoUrl" placeholder="New video URL"
                                class="flex-1 rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <button type="button" wire:click="addVideo"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-medium rounded-xl shadow-sm transition-all hover:shadow">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Packages -->
        <div x-show="activeTab === 'packages'" x-cloak class="space-y-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Packages</h2>
                    </div>
                    <button type="button" wire:click="addPackage"
                        class="inline-flex items-center gap-1 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-medium rounded-xl shadow-sm transition-all hover:shadow">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        New Package
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    @if ($packages && count($packages))
                        @foreach ($packages as $index => $package)
                            <div
                                class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-gray-50 dark:bg-gray-700/30 hover:shadow-md transition">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <input type="text" wire:model="packages.{{ $index }}.name"
                                        placeholder="Package name"
                                        class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <input type="number" wire:model="packages.{{ $index }}.price"
                                        placeholder="Price"
                                        class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <input type="text" wire:model="packages.{{ $index }}.duration"
                                        placeholder="Duration"
                                        class="rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <textarea wire:model="packages.{{ $index }}.description" placeholder="Description" rows="2"
                                    class="mt-3 w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                <div class="mt-3 flex justify-end">
                                    <button type="button" wire:click="removePackage({{ $index }})"
                                        class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-1 px-3 py-1 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p
                            class="text-gray-500 dark:text-gray-400 text-center py-8 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                            No packages yet. Click "New Package" to create one.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tab: Documents & Policy -->
        <div x-show="activeTab === 'documents'" x-cloak class="space-y-6">
            <!-- Licenses & Insurance -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Licences & Insurance
                        (Category-Based)</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 flex items-center gap-1">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Documents are OPTIONAL for your category. Uploading verified documents can help you qualify for
                        a "Verified+" badge later.
                    </p>
                    <div
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-indigo-500 dark:hover:border-indigo-400 transition bg-gray-50 dark:bg-gray-700/30 group">
                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Drag & drop your documents here or
                            <span class="text-indigo-600 dark:text-indigo-400 font-medium">browse files</span></p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PDF, DOCX, JPG, PNG, WEBP (Max 10MB)
                        </p>
                        <input type="file" wire:model="documents" multiple class="hidden">
                    </div>
                    <div wire:loading wire:target="documents"
                        class="mt-3 text-sm text-indigo-600 dark:text-indigo-400">Uploading...</div>
                </div>
            </div>

            <!-- Cancellation Policy -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                <div
                    class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 flex items-center gap-2">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Cancellation Policy</h2>
                </div>
                <div class="p-6">
                    <select wire:model="business.cancellation_policy"
                        class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="flexible">Flexible</option>
                        <option value="moderate" selected>Moderate</option>
                        <option value="strict">Strict</option>
                    </select>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Please see the details on Vendor Agreement
                        Page by scrolling to section #07.</p>
                </div>
            </div>

            <!-- Payout verification note -->
            <div
                class="bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/20 dark:to-yellow-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-5 flex items-start gap-3 shadow-sm">
                <div class="p-2 bg-amber-100 dark:bg-amber-900/40 rounded-lg">
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-amber-800 dark:text-amber-200 font-medium">Receiving payouts? Complete
                        payout verification in Payments (Stripe Connect) <a href="#"
                            class="font-semibold underline hover:text-amber-900 dark:hover:text-amber-100">Click
                            here</a>.</p>
                    <p class="text-xs text-amber-700 dark:text-amber-300 mt-1">Upload your business registration
                        certificate, license, or other relevant documents (PDF, DOCX, DOC, JPG, JPEG, PNG, WEBP)</p>
                </div>
            </div>
        </div>

        <!-- Form Navigation Buttons -->
        <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700 mt-8">
            <button type="button"
                class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all hover:shadow-md">
                Previous
            </button>
            <button type="button" wire:click="save"
                class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-medium rounded-xl shadow-sm transition-all hover:shadow-lg">
                Save & Continue
            </button>
        </div>
    </div>
</div>
