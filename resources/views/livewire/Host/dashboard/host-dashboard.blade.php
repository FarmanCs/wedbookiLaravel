<div class="space-y-6">
    <!-- Welcome Row -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold">
                Welcome back,
                <span class="text-emerald-600 dark:text-emerald-500">
                    {{ auth()->user()->full_name ?? 'Guest' }}
                </span>
            </h1>
            <p class="text-gray-600 dark:text-gray-400">Your event planning dashboard</p>
        </div>
    </div>

    <!-- Stats Cards (Vendors & Guests) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Vendors Card -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl">
                    <x-heroicon-o-briefcase class="w-6 h-6 text-emerald-700 dark:text-emerald-400"/>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">0 of 18</span>
            </div>
            <h3 class="text-lg font-semibold">Vendors</h3>
            <div class="mt-2 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                <x-heroicon-o-check-circle class="w-4 h-4"/>
                <span>Tasks: 0 of 0</span>
            </div>
        </div>
        <!-- Guests Card -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl">
                    <x-heroicon-o-users class="w-6 h-6 text-emerald-700 dark:text-emerald-400"/>
                </div>
                <span class="text-sm text-gray-500 dark:text-gray-400">0 of 100</span>
            </div>
            <h3 class="text-lg font-semibold">Guests</h3>
            <div class="mt-2 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                <x-heroicon-o-check-circle class="w-4 h-4"/>
                <span>Tasks: 0 of 0</span>
            </div>
            <a href="#" class="mt-4 inline-flex items-center text-sm text-emerald-600 dark:text-emerald-500 hover:underline">
                VIEW ALL
                <x-heroicon-o-arrow-right class="w-4 h-4 ml-1"/>
            </a>
        </div>
    </div>

    <!-- Event Countdown (uses user's wedding date if available) -->
    <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-purple-700 dark:from-purple-950 dark:via-pink-950 dark:to-purple-950 rounded-2xl shadow-sm p-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <p class="text-white/80 text-sm">EVENT COUNTDOWN</p>
                <p class="text-white text-2xl font-bold">
                    {{ auth()->user()->wedding_date ? \Carbon\Carbon::parse(auth()->user()->wedding_date)->format('j F Y') : 'Not set' }}
                </p>
            </div>
            <div class="flex gap-4 sm:gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">05</div>
                    <div class="text-white/80 text-xs">DAYS</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">23</div>
                    <div class="text-white/80 text-xs">HOURS</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">40</div>
                    <div class="text-white/80 text-xs">MINS</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">28</div>
                    <div class="text-white/80 text-xs">SECS</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Carousel (with Prev/Next & tagline) -->
    <div id="default-carousel" class="relative w-full h-40" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-36 overflow-hidden rounded-lg md:h-40">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="#" class="bg-neutral-primary-soft max-w-sm p-6 shadow-xs hover:bg-neutral-secondary-medium block">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Noteworthy technology acquisitions 2021</h5>
                    <p class="text-body">Here are the biggest technology acquisitions of 2025 so far, in reverse chronological order.</p>
                </a>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="#" class="bg-neutral-primary-soft max-w-sm p-6 shadow-xs hover:bg-neutral-secondary-medium block">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Another exciting offer</h5>
                    <p class="text-body">Don't miss out on our latest promotions and deals.</p>
                </a>
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="#" class="bg-neutral-primary-soft max-w-sm p-6 shadow-xs hover:bg-neutral-secondary-medium block">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Wedding planning tips</h5>
                    <p class="text-body">Get expert advice for your perfect day.</p>
                </a>
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="#" class="bg-neutral-primary-soft max-w-sm p-6 shadow-xs hover:bg-neutral-secondary-medium block">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Vendor spotlight</h5>
                    <p class="text-body">Meet our trusted partners.</p>
                </a>
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="#" class="bg-neutral-primary-soft max-w-sm p-6 shadow-xs hover:bg-neutral-secondary-medium block">
                    <h5 class="mb-3 text-2xl font-semibold tracking-tight text-heading leading-8">Last minute deals</h5>
                    <p class="text-body">Save big on your wedding needs.</p>
                </a>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/50 hover:bg-white" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- Upcoming Tasks (empty state) -->
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">UPCOMING TASKS</h3>
            <span class="text-sm text-gray-500 dark:text-gray-400">Your next tasks to complete</span>
        </div>
        <div class="text-center py-8">
            <x-heroicon-o-clipboard-document-list class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-700 mb-4"/>
            <p class="text-gray-600 dark:text-gray-400">No upcoming tasks</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">All caught up!</p>
        </div>
    </div>
</div>
