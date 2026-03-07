<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-16 bg-white dark:bg-zinc-950 transition-colors duration-300">
    
    <!-- Hero Section -->
    <section class="text-center mb-12">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <!-- Left Content -->
            <div class="flex-1">
                <h1 class="text-5xl md:text-6xl font-bold text-slate-900 dark:text-white mb-4 leading-tight">
                    PLAN YOUR <span class="bg-gradient-to-r from-emerald-500 to-teal-500 bg-clip-text text-transparent">EVENT</span>
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-300 mb-8">
                    Webbooki's planning tools help you stay organised while managing your time and budget with ease.
                    Everything you need to plan your event — all in one place.
                </p>
                <a href="#pricing" class="inline-block px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                    Start planning
                </a>
            </div>
            
            <!-- Right Image -->
            <div class="flex-1">
                <img src="{{ asset('imgs/extra/1.webp') }}" alt="Wedding Planning" class="w-full h-auto rounded-2xl shadow-2xl object-cover border-4 border-emerald-500/20 dark:border-emerald-600/20">
            </div>
        </div>
    </section>

    <!-- Stats Cards (Vendors, Tasks, Guests) -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
        <!-- Vendors -->
        <div class="group bg-white dark:bg-zinc-900 rounded-xl shadow-sm hover:shadow-lg border-2 border-slate-200 dark:border-zinc-800 hover:border-blue-500 dark:hover:border-blue-600 p-6 transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Vendors</h3>
                <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.5 1.5H5.75A2.75 2.75 0 0 0 3 4.25v11.5A2.75 2.75 0 0 0 5.75 18.5h8.5a2.75 2.75 0 0 0 2.75-2.75V7M14 1.5v4M3.5 9.5h13"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">9 <span class="text-sm font-normal text-slate-500 dark:text-slate-400">of 18</span></p>
            <div class="w-full bg-slate-200 dark:bg-zinc-800 h-2 rounded-full mt-3">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 50%"></div>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">50% completed</p>
        </div>

        <!-- Tasks -->
        <div class="group bg-white dark:bg-zinc-900 rounded-xl shadow-sm hover:shadow-lg border-2 border-slate-200 dark:border-zinc-800 hover:border-pink-500 dark:hover:border-pink-600 p-6 transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Tasks</h3>
                <svg class="w-6 h-6 text-pink-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">35 <span class="text-sm font-normal text-slate-500 dark:text-slate-400">of 70</span></p>
            <div class="w-full bg-slate-200 dark:bg-zinc-800 h-2 rounded-full mt-3">
                <div class="bg-pink-500 h-2 rounded-full" style="width: 50%"></div>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">50% completed</p>
        </div>

        <!-- Guests -->
        <div class="group bg-white dark:bg-zinc-900 rounded-xl shadow-sm hover:shadow-lg border-2 border-slate-200 dark:border-zinc-800 hover:border-green-500 dark:hover:border-green-600 p-6 transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Guests</h3>
                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a9 9 0 1-9 0 3 3 0 011 1zm0 0h6a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">50 <span class="text-sm font-normal text-slate-500 dark:text-slate-400">of 100</span></p>
            <div class="w-full bg-slate-200 dark:bg-zinc-800 h-2 rounded-full mt-3">
                <div class="bg-green-500 h-2 rounded-full" style="width: 50%"></div>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">50% completed</p>
        </div>
    </section>

    <!-- One Time Payment Card -->
    <section class="max-w-2xl mx-auto w-full">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl shadow-xl p-8 text-center text-white border-2 border-emerald-400 hover:border-emerald-300 transition-all duration-300">
            <h3 class="text-3xl font-bold mb-2">One Time Payment</h3>
            <p class="text-5xl font-extrabold mb-2">£19.99</p>
            <p class="text-lg mb-6">for lifetime access</p>
            <button class="bg-white text-emerald-600 hover:bg-slate-100 px-8 py-3 rounded-lg text-lg font-semibold transition shadow-lg">
                Get Premium Access
            </button>
        </div>
    </section>

    <!-- Feature Overview: Checklist, Vendor Manager, Guest List, Budget -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Checklist Card -->
        <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl shadow-lg hover:shadow-2xl border-2 border-slate-200 dark:border-zinc-800 hover:border-pink-500 dark:hover:border-pink-600 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-pink-500/10 to-transparent rounded-bl-3xl group-hover:from-pink-500/20 transition-all duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-pink-100 to-rose-100 dark:from-pink-900/40 dark:to-rose-900/40 rounded-xl group-hover:from-pink-200 dark:group-hover:from-pink-900/60 transition-all">
                        <svg class="w-8 h-8 text-pink-600 dark:text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">CHECKLIST</h2>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-4 leading-relaxed">
                    Create your ultimate event checklist to ensure everything gets done. Personalize, add, edit or delete tasks anytime.
                </p>
                <div class="space-y-3">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Your tasks: add, edit or delete</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Track your progress – pending vs completed</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Sync with your budget to manage expenses</span>
                    </div>
                </div>
                <button class="mt-6 w-full py-2 bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                    Customize your checklist
                </button>
            </div>
        </div>

        <!-- Vendor Manager Card -->
        <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl shadow-lg hover:shadow-2xl border-2 border-slate-200 dark:border-zinc-800 hover:border-blue-500 dark:hover:border-blue-600 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-500/10 to-transparent rounded-bl-3xl group-hover:from-blue-500/20 transition-all duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-blue-100 to-cyan-100 dark:from-blue-900/40 dark:to-cyan-900/40 rounded-xl group-hover:from-blue-200 dark:group-hover:from-blue-900/60 transition-all">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H5.75A2.75 2.75 0 0 0 3 4.25v11.5A2.75 2.75 0 0 0 5.75 18.5h8.5a2.75 2.75 0 0 0 2.75-2.75V7M14 1.5v4M3.5 9.5h13"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">VENDOR MANAGER</h2>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-4 leading-relaxed">
                    Find, message and book your chosen vendors. Keep everything in one place.
                </p>
                <div class="space-y-3">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Contact professionals directly</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Add notes for each vendor</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Save favourites to compare later</span>
                    </div>
                </div>
                <button class="mt-6 w-full py-2 bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                    Find your vendor manager
                </button>
            </div>
        </div>

        <!-- Guest List Card -->
        <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl shadow-lg hover:shadow-2xl border-2 border-slate-200 dark:border-zinc-800 hover:border-green-500 dark:hover:border-green-600 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-green-500/10 to-transparent rounded-bl-3xl group-hover:from-green-500/20 transition-all duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/40 dark:to-emerald-900/40 rounded-xl group-hover:from-green-200 dark:group-hover:from-green-900/60 transition-all">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM9 6a9 9 0 1-9 0 3 3 0 011 1zm0 0h6a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">GUEST LIST</h2>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-4 leading-relaxed">
                    Organize and manage your guests, track RSVPs, and store contact information.
                </p>
                <div class="space-y-3">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Track RSVPs and meal preferences</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Store all guest contacts</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Send digital invitations</span>
                    </div>
                </div>
                <button class="mt-6 w-full py-2 bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                    Check your guest list
                </button>
            </div>
        </div>

        <!-- Budget Card -->
        <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl shadow-lg hover:shadow-2xl border-2 border-slate-200 dark:border-zinc-800 hover:border-amber-500 dark:hover:border-amber-600 p-8 transition-all duration-300 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-amber-500/10 to-transparent rounded-bl-3xl group-hover:from-amber-500/20 transition-all duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-amber-100 to-orange-100 dark:from-amber-900/40 dark:to-orange-900/40 rounded-xl group-hover:from-amber-200 dark:group-hover:from-amber-900/60 transition-all">
                        <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM12.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM12.5 14a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">BUDGET</h2>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-4 leading-relaxed">
                    Track and manage your event expenses, get payment reminders, and view breakdowns.
                </p>
                <div class="space-y-3">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Expense tracking on one platform</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Payment reminders for vendors</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm text-slate-600 dark:text-slate-300">Visual charts – see where your money goes</span>
                    </div>
                </div>
                <button class="mt-6 w-full py-2 bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                    Check your budget
                </button>
            </div>
        </div>
    </section>

    <!-- Detailed Checklist Preview -->
    <section class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border-2 border-slate-200 dark:border-zinc-800 hover:border-emerald-500 dark:hover:border-emerald-600 p-6 max-w-3xl mx-auto transition-all duration-300">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Check List</h3>
            <div class="flex space-x-2 mt-3 md:mt-0">
                <button class="px-3 py-1.5 bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-slate-200 rounded-lg text-sm font-medium flex items-center gap-1 hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586l5.293-5.293a1 1 0 111.414 1.414l-6 6a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export CSV
                </button>
                <button class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium flex items-center gap-1 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add
                </button>
            </div>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage your check list to keep track of your wedding day.</p>
        <div class="mt-4">
            <div class="flex justify-between text-sm">
                <span class="text-slate-600 dark:text-slate-300">You have completed <span class="font-bold">0</span> out of <span class="font-bold">34</span> tasks</span>
                <span class="text-slate-600 dark:text-slate-300">0%</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-zinc-800 h-2 rounded-full mt-1">
                <div class="bg-emerald-600 h-2 rounded-full" style="width: 0%"></div>
            </div>
        </div>
        <div class="mt-6">
            <div class="flex items-center gap-4 text-sm">
                <span class="font-medium text-slate-700 dark:text-slate-200">Filter By</span>
                <button class="px-3 py-1 bg-slate-100 dark:bg-zinc-800 rounded-full text-xs text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-zinc-700 transition">All</button>
                <button class="px-3 py-1 bg-slate-100 dark:bg-zinc-800 rounded-full text-xs text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-zinc-700 transition">Payment</button>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex items-center gap-3 p-2 hover:bg-slate-50 dark:hover:bg-zinc-800 rounded-lg transition">
                    <input type="checkbox" class="rounded border-slate-300 dark:border-zinc-700 dark:bg-zinc-800">
                    <div>
                        <p class="text-sm font-medium text-slate-800 dark:text-white">Ahsan Malik</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Booking: WB-B400134223 (2 tasks)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Plans from Database -->
    <section id="pricing" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($plans as $plan)
            <div class="group relative bg-white dark:bg-zinc-900 rounded-xl shadow-md hover:shadow-xl border-2 border-slate-200 dark:border-zinc-800 hover:border-emerald-500 dark:hover:border-emerald-600 overflow-hidden transition-all duration-300">
                
                <!-- Image Container - Reduced Height -->
                <div class="relative h-32 overflow-hidden bg-gradient-to-br from-slate-200 to-slate-300 dark:from-zinc-800 dark:to-zinc-700">
                    <img 
                        src="{{ $loop->index === 0 ? asset('imgs/extra/5.jpg') : ($loop->index === 1 ? asset('imgs/extra/6.jpg') : asset('imgs/extra/7.jpg')) }}" 
                        alt="{{ $plan->name }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    >
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    
                    <!-- Plan Name Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-3">
                        <h3 class="text-lg font-bold text-white capitalize drop-shadow-lg">{{ $plan->name }}</h3>
                    </div>
                </div>
                
                <!-- Content - Compact -->
                <div class="p-4">
                    <!-- Price Highlight -->
                    <div class="mb-3 pb-3 border-b-2 border-slate-200 dark:border-zinc-800">
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">£{{ number_format($plan->monthly_price, 2) }}</span>
                            <span class="text-xs text-slate-600 dark:text-slate-400">/month</span>
                        </div>
                    </div>

                    <!-- Other Pricing - Compact -->
                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <div class="bg-slate-50 dark:bg-zinc-800 rounded p-2 text-center">
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Quarterly</p>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">£{{ number_format($plan->quarterly_price, 2) }}</p>
                        </div>
                        <div class="bg-slate-50 dark:bg-zinc-800 rounded p-2 text-center">
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-0.5">Yearly</p>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">£{{ number_format($plan->yearly_price, 2) }}</p>
                        </div>
                    </div>
                    
                    <!-- Features - Compact -->
                    @if($plan->features->isNotEmpty())
                        <div class="mb-3 pb-3 border-b-2 border-slate-200 dark:border-zinc-800">
                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Features</p>
                            <div class="space-y-1.5">
                                @foreach($plan->features->take(2) as $feature)
                                    <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300">
                                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="line-clamp-1">{{ $feature->name }}</span>
                                    </div>
                                @endforeach
                                @if($plan->features->count() > 2)
                                    <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold pt-0.5">
                                        +{{ $plan->features->count() - 2 }} more
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <!-- Stats - Compact -->
                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded p-2 text-center">
                            <p class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $plan->subscriptions_count ?? 0 }}</p>
                            <p class="text-xs text-blue-600 dark:text-blue-400">Plans</p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 rounded p-2 text-center">
                            <p class="text-sm font-bold text-purple-600 dark:text-purple-400">{{ $plan->transactions_count ?? 0 }}</p>
                            <p class="text-xs text-purple-600 dark:text-purple-400">Trans</p>
                        </div>
                    </div>
                    
                    <!-- Button - Compact -->
                    <button wire:click="selectPlan({{ $plan->id }})" 
                            class="w-full py-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-600 dark:to-teal-600 dark:hover:from-emerald-700 dark:hover:to-teal-700 text-white rounded-lg text-xs font-bold transition-all duration-300 flex items-center justify-center gap-1 transform hover:scale-105 active:scale-95 shadow-md">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Select Now
                    </button>
                </div>

                <!-- Hover Accent -->
                <div class="absolute -bottom-12 -right-12 w-24 h-24 bg-gradient-to-tl from-emerald-500/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <svg class="w-12 h-12 text-slate-400 dark:text-slate-600 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 2a1 1 0 011-1h8a1 1 0 011 1v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v6h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H8v1a1 1 0 11-2 0v-1H4a2 2 0 01-2-2v-2H1a1 1 0 110-2h1V7H1a1 1 0 012-2h2V3a2 2 0 012-2h8V2H6V1z" clip-rule="evenodd" />
                </svg>
                <p class="text-slate-600 dark:text-slate-400 font-medium">No plans available at the moment.</p>
            </div>
        @endforelse
    </section>
</div>