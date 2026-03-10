@use('Illuminate\Support\Facades\Auth')

<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 relative overflow-hidden transition-colors duration-300">
    <!-- Animated gradient orbs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Light mode orbs -->
        <div
            class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-blue-200/30 via-purple-200/20 to-transparent rounded-full blur-3xl animate-pulse dark:hidden">
        </div>
        <div class="absolute top-1/3 -left-52 w-96 h-96 bg-gradient-to-br from-cyan-200/20 via-blue-200/15 to-transparent rounded-full blur-3xl animate-pulse dark:hidden"
            style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-40 right-1/4 w-96 h-96 bg-gradient-to-br from-pink-200/20 via-rose-200/15 to-transparent rounded-full blur-3xl animate-pulse dark:hidden"
            style="animation-delay: 4s;"></div>

        <!-- Dark mode orbs -->
        <div
            class="hidden dark:block absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-indigo-500/15 via-purple-600/15 to-transparent rounded-full blur-3xl animate-pulse">
        </div>
        <div class="hidden dark:block absolute top-1/3 -left-52 w-96 h-96 bg-gradient-to-br from-cyan-500/10 via-blue-600/10 to-transparent rounded-full blur-3xl animate-pulse"
            style="animation-delay: 2s;"></div>
        <div class="hidden dark:block absolute -bottom-40 right-1/4 w-96 h-96 bg-gradient-to-br from-pink-500/10 via-rose-600/10 to-transparent rounded-full blur-3xl animate-pulse"
            style="animation-delay: 4s;"></div>
    </div>

    <!-- Main content -->
    <div class="relative z-10">
        <!-- Header -->
        <div
            class="sticky top-0 z-40 backdrop-blur-md bg-white/70 dark:bg-slate-950/70 border-b border-slate-200/50 dark:border-slate-800/50 supports-[backdrop-filter]:bg-white/60 dark:supports-[backdrop-filter]:bg-slate-950/60 transition-colors duration-300">
            <div class="px-6 py-8">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <!-- Title -->
                        <div class="space-y-3">
                            <div class="flex items-center gap-4">
                                <!-- Icon with glow -->
                                <div class="relative">
                                    <!-- Light mode glow -->
                                    <div
                                        class="hidden dark:block absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-xl blur-lg opacity-60 group-hover:opacity-100 transition-all duration-500">
                                    </div>
                                    <div
                                        class="dark:hidden absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 rounded-xl blur-lg opacity-40 group-hover:opacity-60 transition-all duration-500">
                                    </div>

                                    <!-- Icon background -->
                                    <div
                                        class="relative p-3 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-slate-900 dark:to-slate-800 rounded-xl border border-blue-200/50 dark:border-slate-700/50">
                                        <svg class="w-7 h-7 text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Title text -->
                                <div>
                                    <h1
                                        class="text-4xl font-black bg-clip-text text-transparent bg-gradient-to-r from-blue-700 via-purple-700 to-pink-700 dark:from-indigo-300 dark:via-purple-300 dark:to-pink-300 tracking-tight">
                                        Packages
                                    </h1>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1 font-medium">Manage your
                                        service offerings</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            @if ($packages->count() > 0)
                                <div
                                    class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 dark:from-slate-800/50 dark:via-slate-800/30 dark:to-slate-900/50 border border-blue-200/50 dark:border-slate-700/50 dark:backdrop-blur-sm">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-cyan-100 to-blue-100 dark:from-cyan-500/20 dark:to-blue-500/20 border border-cyan-300/50 dark:border-cyan-500/30">
                                        <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs text-slate-600 dark:text-slate-500 font-semibold uppercase tracking-wider">
                                            Total Packages</p>
                                        <p class="text-2xl font-bold text-slate-900 dark:text-white">
                                            {{ $packages->count() }}</p>
                                    </div>
                                </div>
                            @endif

                            @if (!$showForm)
                                <button wire:click="create"
                                    class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold text-white overflow-hidden rounded-xl transition-all duration-300 hover:scale-105 active:scale-95">
                                    <!-- Background gradient -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 dark:from-indigo-600 dark:via-purple-600 dark:to-pink-600 opacity-100 group-hover:opacity-110 transition-all duration-300">
                                    </div>

                                    <!-- Glow effect -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 dark:from-indigo-600 dark:via-purple-600 dark:to-pink-600 opacity-0 blur-xl group-hover:opacity-50 transition-all duration-500">
                                    </div>

                                    <!-- Shine animation -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                                    </div>

                                    <!-- Content -->
                                    <div class="relative flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>Add Package</span>
                                    </div>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash messages -->
        @if (session()->has('message'))
            <div class="px-6 py-4 max-w-7xl mx-auto" x-data="{ show: true }" x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:leave="transition ease-in duration-200">
                <div
                    class="relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-50 via-teal-50 to-cyan-50 dark:from-emerald-500/20 dark:via-teal-500/15 dark:to-cyan-500/20 border border-emerald-200/50 dark:border-emerald-500/40 dark:backdrop-blur-sm p-4 shadow-lg shadow-emerald-500/10 dark:shadow-emerald-500/10 transition-colors duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-emerald-100/30 to-cyan-100/30 dark:from-emerald-600/5 dark:to-cyan-600/5">
                    </div>
                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="relative mt-0.5 flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 animate-bounce"
                                    style="animation-duration: 2s;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-700 dark:text-emerald-300">
                                    {{ session('message') }}</p>
                            </div>
                        </div>
                        <button @click="show = false"
                            class="flex-shrink-0 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="px-6 py-4 max-w-7xl mx-auto" x-data="{ show: true }" x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:leave="transition ease-in duration-200">
                <div
                    class="relative overflow-hidden rounded-xl bg-gradient-to-r from-red-50 via-rose-50 to-pink-50 dark:from-red-500/20 dark:via-rose-500/15 dark:to-pink-500/20 border border-red-200/50 dark:border-red-500/40 dark:backdrop-blur-sm p-4 shadow-lg shadow-red-500/10 dark:shadow-red-500/10 transition-colors duration-300">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-100/30 to-pink-100/30 dark:from-red-600/5 dark:to-pink-600/5">
                    </div>
                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="relative mt-0.5 flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-red-700 dark:text-red-300">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button @click="show = false"
                            class="flex-shrink-0 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main content area -->
        <div class="px-6 py-8">
            <div class="max-w-7xl mx-auto space-y-8">
                <!-- Create/Edit form -->
                @if ($showForm)
                    <div class="relative rounded-2xl overflow-hidden">
                        <!-- Gradient border animation -->
                        <div
                            class="hidden dark:block absolute inset-0 bg-gradient-to-br from-indigo-600/20 via-purple-600/20 to-pink-600/20 rounded-2xl">
                        </div>
                        <div
                            class="dark:hidden absolute inset-0 bg-gradient-to-br from-blue-400/20 via-purple-400/20 to-pink-400/20 rounded-2xl">
                        </div>

                        <!-- Backdrop -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-white via-slate-50 to-white dark:from-slate-900/90 dark:via-purple-900/30 dark:to-slate-900/90 backdrop-blur-xl rounded-2xl transition-colors duration-300">
                        </div>

                        <!-- Border -->
                        <div
                            class="absolute inset-0 rounded-2xl border border-blue-200/50 dark:border-slate-700/50 transition-colors duration-300">
                        </div>

                        <!-- Content -->
                        <div class="relative p-8 lg:p-12">
                            <!-- Header -->
                            <div
                                class="flex items-start justify-between gap-6 mb-8 pb-8 border-b border-slate-200/50 dark:border-slate-700/30 transition-colors duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="relative">
                                        <div
                                            class="hidden dark:block absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-lg blur opacity-50">
                                        </div>
                                        <div
                                            class="dark:hidden absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 rounded-lg blur opacity-40">
                                        </div>
                                        <div
                                            class="relative p-3 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-slate-900 dark:to-slate-800 rounded-lg border border-blue-200/50 dark:border-slate-700/50 transition-colors duration-300">
                                            @if ($editingPackage)
                                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 transition-colors duration-300"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-blue-600 dark:text-indigo-400 transition-colors duration-300"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <h3
                                            class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white transition-colors duration-300">
                                            {{ $editingPackage ? 'Edit Package' : 'Create New Package' }}
                                        </h3>
                                        <p
                                            class="text-sm text-slate-600 dark:text-slate-400 mt-2 transition-colors duration-300">
                                            {{ $editingPackage ? 'Update your package details' : 'Create a new service package' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Close button -->
                                <button type="button" wire:click="cancel"
                                    class="flex-shrink-0 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors p-2 hover:bg-slate-100 dark:hover:bg-slate-800/50 rounded-lg">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Form -->
                            <form wire:submit="save" class="space-y-7">
                                <!-- Business & Name row -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Business -->
                                    <div>
                                        <label
                                            class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-indigo-400 transition-colors duration-300"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                            </svg>
                                            Business <span class="text-red-500 dark:text-red-400">*</span>
                                        </label>
                                        <select wire:model="business_id"
                                            class="w-full px-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-blue-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 font-medium transition-all duration-300 focus:border-blue-500 dark:focus:border-indigo-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/30 dark:focus:ring-indigo-500/30 hover:border-blue-300 dark:hover:border-slate-600/50">
                                            <option value="">-- Select a business --</option>
                                            @foreach ($businesses as $business)
                                                <option value="{{ $business['id'] }}">{{ $business['company_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('business_id')
                                            <div
                                                class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400 text-sm font-medium transition-colors duration-300">
                                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Package Name -->
                                    <div>
                                        <label
                                            class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400 transition-colors duration-300"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
                                            </svg>
                                            Package Name <span class="text-red-500 dark:text-red-400">*</span>
                                        </label>
                                        <input type="text" wire:model="name"
                                            placeholder="e.g., Premium Wedding Package"
                                            class="w-full px-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-purple-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 font-medium transition-all duration-300 focus:border-purple-500 dark:focus:border-purple-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-purple-500/30 dark:focus:ring-purple-500/30 hover:border-purple-300 dark:hover:border-slate-600/50">
                                        @error('name')
                                            <div
                                                class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400 text-sm font-medium transition-colors duration-300">
                                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pricing row -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Price -->
                                    <div>
                                        <label
                                            class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 transition-colors duration-300"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M8.16 5.314l6.526 6.527a1 1 0 11-1.415 1.415L6.745 6.73A2.5 2.5 0 1010.186 2.288l6.527 6.527a1 1 0 11-1.415 1.415L8.77 3.702A1 1 0 108.16 5.314zM16.02 18.586a1 1 0 11-1.414-1.414L9.17 9.316a1 1 0 111.415-1.414l5.435 5.435z" />
                                            </svg>
                                            Price <span class="text-red-500 dark:text-red-400">*</span>
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-lg font-bold transition-colors duration-300">$</span>
                                            <input type="number" step="0.01" wire:model="price"
                                                placeholder="0.00"
                                                class="w-full pl-8 pr-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-emerald-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 font-medium transition-all duration-300 focus:border-emerald-500 dark:focus:border-emerald-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 dark:focus:ring-emerald-500/30 hover:border-emerald-300 dark:hover:border-slate-600/50">
                                        </div>
                                        @error('price')
                                            <div
                                                class="mt-2 flex items-center gap-2 text-red-600 dark:text-red-400 text-sm font-medium transition-colors duration-300">
                                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Discount Amount -->
                                    <div>
                                        <label
                                            class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-orange-600 dark:text-orange-400 transition-colors duration-300"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v2H3a1 1 0 000 2h1v2H3a1 1 0 000 2h1v2H3a1 1 0 000 2h1v2a1 1 0 002 0v-1h2v1a1 1 0 002 0v-1h2v1a1 1 0 002 0v-2h1a1 1 0 000-2h-1v-2h1a1 1 0 000-2h-1V9h1a1 1 0 000-2h-1V5h1a1 1 0 000-2h-1V3a1 1 0 00-1-1h-2V2a1 1 0 00-1-1H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Discount ($)
                                        </label>
                                        <div class="relative">
                                            <span
                                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-lg font-bold transition-colors duration-300">$</span>
                                            <input type="number" step="0.01" wire:model="discount"
                                                placeholder="0.00"
                                                class="w-full pl-8 pr-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-orange-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 font-medium transition-all duration-300 focus:border-orange-500 dark:focus:border-orange-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500/30 dark:focus:ring-orange-500/30 hover:border-orange-300 dark:hover:border-slate-600/50">
                                        </div>
                                    </div>

                                    <!-- Discount Percentage -->
                                    <div>
                                        <label
                                            class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-pink-600 dark:text-pink-400 transition-colors duration-300"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                            Discount (%)
                                        </label>
                                        <div class="relative">
                                            <input type="number" step="0.01" max="100"
                                                wire:model="discount_percentage" placeholder="0.00"
                                                class="w-full px-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-pink-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 font-medium transition-all duration-300 focus:border-pink-500 dark:focus:border-pink-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-pink-500/30 dark:focus:ring-pink-500/30 hover:border-pink-300 dark:hover:border-slate-600/50">
                                            <span
                                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 dark:text-slate-400 text-lg font-bold transition-colors duration-300">%</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400 transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" />
                                        </svg>
                                        Description
                                    </label>
                                    <textarea wire:model="description" rows="3" placeholder="Describe what's included in this package..."
                                        class="w-full px-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-cyan-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 font-medium transition-all duration-300 focus:border-cyan-500 dark:focus:border-cyan-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-cyan-500/30 dark:focus:ring-cyan-500/30 hover:border-cyan-300 dark:hover:border-slate-600/50 resize-none"></textarea>
                                </div>

                                <!-- Features -->
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-3 flex items-center gap-2 transition-colors duration-300">
                                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l1.414-1.414a1 1 0 011.414 0L9 12.586l4.293-4.293a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414l-6 6z" />
                                        </svg>
                                        Features (one per line)
                                    </label>
                                    <textarea wire:model="features" rows="4"
                                        placeholder="24/7 Support&#10;Free Cancellation&#10;Customizable&#10;Premium Materials"
                                        class="w-full px-4 py-3 rounded-lg bg-white dark:bg-slate-800/50 border-2 border-teal-200 dark:border-slate-700/50 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 font-medium transition-all duration-300 focus:border-teal-500 dark:focus:border-teal-500/80 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/30 dark:focus:ring-teal-500/30 hover:border-teal-300 dark:hover:border-slate-600/50 resize-none font-mono text-sm"></textarea>
                                    <p
                                        class="mt-2 text-xs text-slate-600 dark:text-slate-400 flex items-center gap-1 transition-colors duration-300">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Each line will be a separate feature
                                    </p>
                                </div>

                                <!-- Popular toggle -->
                                <div
                                    class="group flex items-center gap-3 p-4 rounded-lg bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-slate-800/30 dark:via-slate-800/20 dark:to-slate-800/30 border-2 border-yellow-200 dark:border-slate-700/30 hover:border-yellow-300 dark:hover:border-slate-600/50 hover:bg-gradient-to-r hover:from-yellow-100 hover:to-amber-100 dark:hover:bg-slate-800/40 cursor-pointer transition-all duration-300">
                                    <input type="checkbox" wire:model="is_popular" id="is_popular"
                                        class="w-5 h-5 rounded-lg bg-white dark:bg-slate-700 border-2 border-yellow-300 dark:border-slate-600 text-yellow-600 dark:text-indigo-600 focus:ring-2 focus:ring-yellow-500 dark:focus:ring-indigo-500 focus:ring-offset-0 cursor-pointer transition-all duration-300 accent-yellow-600 dark:accent-indigo-600">
                                    <label for="is_popular"
                                        class="flex items-center gap-2 cursor-pointer text-slate-800 dark:text-slate-200 font-semibold group-hover:text-slate-900 dark:group-hover:text-white transition-colors flex-1">
                                        <svg class="w-5 h-5 text-yellow-500 dark:text-yellow-400 transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Mark as popular/featured
                                    </label>
                                </div>

                                <!-- Actions -->
                                <div
                                    class="flex items-center justify-end gap-3 pt-8 border-t border-slate-200 dark:border-slate-700/30 transition-colors duration-300">
                                    <button type="button" wire:click="cancel"
                                        class="px-6 py-3 rounded-lg font-bold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800/50 border border-slate-300 dark:border-slate-700/50 hover:bg-slate-200 dark:hover:bg-slate-800 hover:border-slate-400 dark:hover:border-slate-600 hover:text-slate-900 dark:hover:text-white transition-all duration-300 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="group relative inline-flex items-center justify-center gap-2 px-8 py-3 font-bold text-white overflow-hidden rounded-lg transition-all duration-300 hover:scale-105 active:scale-95">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 dark:from-emerald-600 dark:via-teal-600 dark:to-cyan-600 opacity-100 group-hover:opacity-110 transition-all duration-300">
                                        </div>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 dark:from-emerald-600 dark:via-teal-600 dark:to-cyan-600 opacity-0 blur-xl group-hover:opacity-40 transition-all duration-500">
                                        </div>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                                        </div>
                                        <div class="relative flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $editingPackage ? 'Update Package' : 'Create Package' }}</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Packages grid or empty state -->
                @if ($packages->count() > 0)
                    <div class="space-y-6">
                        <!-- Packages Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($packages as $package)
                                <div class="group relative h-full">
                                    <!-- Card background with gradient -->
                                    <div
                                        class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white via-slate-50 to-white dark:from-slate-800/50 dark:via-slate-800/30 dark:to-slate-900/50 border border-slate-200 dark:border-slate-700/50 dark:backdrop-blur-sm group-hover:border-blue-300 dark:group-hover:border-slate-600/80 transition-all duration-300 group-hover:shadow-xl dark:group-hover:shadow-2xl group-hover:shadow-blue-500/10 dark:group-hover:shadow-indigo-500/15">
                                    </div>

                                    <!-- Card Content -->
                                    <div class="relative h-full flex flex-col p-6 lg:p-7 space-y-5">
                                        <!-- Header -->
                                        <div
                                            class="flex items-start justify-between gap-3 pb-4 border-b border-slate-200 dark:border-slate-700/30 transition-colors duration-300">
                                            <div class="flex-1">
                                                <p
                                                    class="text-xs font-bold uppercase tracking-widest text-blue-600 dark:text-indigo-400/80 mb-1 transition-colors duration-300">
                                                    {{ $package->business->company_name ?? 'Business' }}
                                                </p>
                                                <h3
                                                    class="text-lg lg:text-xl font-bold text-slate-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-indigo-300 transition-colors line-clamp-2">
                                                    {{ $package->name }}
                                                </h3>
                                            </div>

                                            <!-- Popular badge -->
                                            @if ($package->is_popular)
                                                <div class="relative flex-shrink-0">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-amber-400 to-orange-400 rounded-full blur opacity-60 animate-pulse">
                                                    </div>
                                                    <div
                                                        class="relative px-3 py-1.5 bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-slate-900 dark:to-slate-800 rounded-full border border-yellow-300/60 dark:border-yellow-400/60 flex items-center gap-1.5 transition-colors duration-300">
                                                        <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400 fill-yellow-600 dark:fill-yellow-400 transition-colors duration-300"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <span
                                                            class="text-xs font-bold text-yellow-700 dark:text-yellow-300 transition-colors duration-300">Popular</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Pricing -->
                                        <div class="space-y-1">
                                            <div class="flex items-baseline gap-3">
                                                <span
                                                    class="text-3xl lg:text-4xl font-black bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 dark:from-emerald-400 dark:via-teal-400 dark:to-cyan-400 transition-colors duration-300">
                                                    ${{ number_format($package->price - $package->discount, 2) }}
                                                </span>
                                                @if ($package->discount > 0 || $package->discount_percentage > 0)
                                                    <span
                                                        class="text-sm line-through text-slate-500 dark:text-slate-500 font-semibold transition-colors duration-300">
                                                        ${{ number_format($package->price, 2) }}
                                                    </span>
                                                    <div
                                                        class="px-2.5 py-1 rounded-lg bg-gradient-to-r from-rose-100 to-pink-100 dark:from-rose-500/25 dark:to-pink-500/25 border border-rose-300 dark:border-rose-500/50 transition-colors duration-300">
                                                        <span
                                                            class="text-xs font-bold text-rose-700 dark:text-rose-400 transition-colors duration-300">
                                                            @if ($package->discount_percentage)
                                                                -{{ number_format($package->discount_percentage, 0) }}%
                                                            @else
                                                                -${{ number_format($package->discount, 2) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        @if ($package->description)
                                            <p
                                                class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed transition-colors duration-300">
                                                {{ $package->description }}
                                            </p>
                                        @endif

                                        <!-- Features -->
                                        @if (is_array($package->features) && count($package->features) > 0)
                                            <div class="space-y-2 pt-1 pb-2">
                                                @foreach (array_slice($package->features, 0, 3) as $feature)
                                                    <div class="flex items-center gap-2 text-sm">
                                                        <div
                                                            class="flex-shrink-0 w-5 h-5 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-500/30 dark:to-purple-500/30 border border-indigo-300 dark:border-indigo-500/50 flex items-center justify-center transition-colors duration-300">
                                                            <svg class="w-3 h-3 text-indigo-600 dark:text-indigo-400 fill-indigo-600 dark:fill-indigo-400 transition-colors duration-300"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        <span
                                                            class="text-slate-700 dark:text-slate-300 transition-colors duration-300">{{ $feature }}</span>
                                                    </div>
                                                @endforeach

                                                @if (count($package->features) > 3)
                                                    <div
                                                        class="text-xs text-slate-600 dark:text-slate-500 italic pt-1 ml-7 transition-colors duration-300">
                                                        +{{ count($package->features) - 3 }} more
                                                        {{ count($package->features) - 3 === 1 ? 'feature' : 'features' }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        <!-- Actions -->
                                        <div
                                            class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-700/30 flex items-center gap-2 transition-colors duration-300">
                                            <button wire:click="edit({{ $package->id }})"
                                                class="flex-1 flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg bg-gradient-to-r from-blue-100 to-blue-100 dark:from-blue-500/20 dark:to-blue-500/10 hover:from-blue-200 hover:to-blue-200 dark:hover:from-blue-500/30 dark:hover:to-blue-500/20 text-blue-700 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 border border-blue-300 dark:border-blue-500/40 hover:border-blue-400 dark:hover:border-blue-500/60 transition-all duration-300 font-semibold group/btn">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                                <span class="text-sm">Edit</span>
                                            </button>

                                            <button wire:click="delete({{ $package->id }})"
                                                wire:confirm="Delete this package? This action cannot be undone."
                                                class="flex items-center justify-center px-3 py-2.5 rounded-lg bg-gradient-to-r from-red-100 to-red-100 dark:from-red-500/20 dark:to-red-500/10 hover:from-red-200 hover:to-red-200 dark:hover:from-red-500/30 dark:hover:to-red-500/20 text-red-700 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 border border-red-300 dark:border-red-500/40 hover:border-red-400 dark:hover:border-red-500/60 transition-all duration-300 font-semibold group/btn">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-sm">Delete</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Empty state -->
                    <div class="relative rounded-2xl overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-50/50 via-white/50 to-blue-50/50 dark:from-indigo-950/30 dark:via-slate-950/30 dark:to-slate-950/30 dark:backdrop-blur-sm transition-colors duration-300">
                        </div>
                        <div
                            class="absolute inset-0 border border-slate-200 dark:border-slate-700/30 transition-colors duration-300">
                        </div>

                        <div class="relative py-20 px-6 text-center">
                            <div class="flex justify-center mb-8">
                                <div class="relative">
                                    <div
                                        class="hidden dark:block absolute inset-0 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-600 rounded-3xl blur-xl opacity-30 animate-pulse">
                                    </div>
                                    <div
                                        class="dark:hidden absolute inset-0 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 rounded-3xl blur-xl opacity-20 animate-pulse">
                                    </div>
                                    <div
                                        class="relative p-6 bg-gradient-to-br from-blue-50 to-purple-50 dark:from-slate-900 dark:to-slate-800 rounded-3xl border border-blue-200 dark:border-slate-700/50 transition-colors duration-300">
                                        <svg class="w-12 h-12 text-slate-400 dark:text-slate-500 transition-colors duration-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM15 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM5 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM15 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <h3
                                class="text-3xl font-bold text-slate-900 dark:text-white mb-3 transition-colors duration-300">
                                No packages yet</h3>
                            <p
                                class="text-slate-600 dark:text-slate-400 mb-10 max-w-sm mx-auto text-base transition-colors duration-300">
                                Create your first service package to start offering amazing deals to your customers.
                            </p>
                            <button wire:click="create"
                                class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 font-bold text-white overflow-hidden rounded-xl transition-all duration-300 hover:scale-105 active:scale-95 mx-auto">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 dark:from-indigo-600 dark:via-purple-600 dark:to-pink-600 opacity-100 group-hover:opacity-110 transition-all duration-300">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 dark:from-indigo-600 dark:via-purple-600 dark:to-pink-600 opacity-0 blur-xl group-hover:opacity-50 transition-all duration-500">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                                </div>
                                <div class="relative flex items-center gap-2">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Create Your First Package</span>
                                </div>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-hide flash messages
            document.addEventListener('livewire:updated', () => {
                const messages = document.querySelectorAll('[x-data*="show: true"]');
                messages.forEach(msg => {
                    setTimeout(() => {
                        if (msg && msg.hasAttribute('x-show')) {
                            msg.dispatchEvent(new Event('click'));
                        }
                    }, 5000);
                });
            });
        </script>
    @endpush
</div>
