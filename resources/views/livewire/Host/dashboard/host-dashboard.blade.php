<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-slate-50/95 to-slate-100/50 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 selection:bg-amber-500/30 dark:selection:bg-amber-500/20">

    {{-- TOP RIGHT COUNTDOWN WIDGET WITH EVENT TIME DETAILS --}}
    @if ($weddingDate)
        <div class="fixed top-20 right-6 z-40 group" x-data="countdownTimer()" x-init="init('{{ $weddingDate }}', '{{ $eventStartTime ?? '10:00' }}')" wire:ignore
            x-effect="updateEventDateTime('{{ $weddingDate }}', '{{ $eventStartTime ?? '10:00' }}')">
            <!-- Glow effect -->
            <div
                class="absolute -inset-2 bg-gradient-to-r from-amber-500 to-rose-500 rounded-2xl blur-xl opacity-0 group-hover:opacity-40 transition-all duration-300">
            </div>

            <!-- Countdown card -->
            <div
                class="relative backdrop-blur-xl bg-white/90 dark:bg-slate-800/90 border border-white/50 dark:border-slate-700/50 rounded-2xl p-4 shadow-xl dark:shadow-2xl max-w-xs">
                <div class="space-y-3">
                    <!-- Header with edit button -->
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Your
                            Big Day</p>
                        <button wire:click="openEventTimingModal"
                            class="p-1.5 rounded-lg bg-amber-500/20 hover:bg-amber-500/30 transition-all duration-200"
                            title="Edit event time">
                            <x-heroicon-o-pencil-square class="w-4 h-4 text-amber-600 dark:text-amber-400" />
                        </button>
                    </div>

                    <!-- Countdown Grid -->
                    <div class="grid grid-cols-4 gap-1.5">
                        @foreach (['days' => 'D', 'hours' => 'H', 'minutes' => 'M', 'seconds' => 'S'] as $key => $label)
                            <div class="flex flex-col items-center">
                                <span
                                    class="text-xl font-black bg-gradient-to-r from-amber-600 to-rose-600 dark:from-amber-400 dark:to-rose-400 bg-clip-text text-transparent tabular-nums">
                                    <span x-text="String($data.{{ $key }}).padStart(2, '0')">00</span>
                                </span>
                                <span
                                    class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-1">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Event Time Display -->
                    <div class="border-t border-white/20 dark:border-slate-700/20 pt-2">
                        <p class="text-xs text-slate-600 dark:text-slate-400 text-center">
                            <span
                                class="font-semibold">{{ Carbon\Carbon::parse($weddingDate)->format('M d, Y') }}</span>
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 text-center mt-1">
                            {{ $eventStartTime ?? '10:00' }} - {{ $eventEndTime ?? '23:00' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- MAIN CONTENT --}}
    <section class="relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-48 -right-48 w-96 h-96 bg-gradient-to-br from-amber-200/15 to-amber-300/5 rounded-full blur-3xl animate-blob">
            </div>
            <div
                class="absolute -bottom-48 -left-48 w-96 h-96 bg-gradient-to-br from-rose-200/15 to-rose-300/5 rounded-full blur-3xl animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute top-1/3 right-1/4 w-72 h-72 bg-gradient-to-br from-indigo-200/10 to-indigo-300/5 rounded-full blur-3xl animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <!-- Hero Section -->
            <div class="space-y-8">
                <div class="space-y-3">
                    <p
                        class="text-sm font-medium text-amber-600 dark:text-amber-400 tracking-widest uppercase flex items-center gap-2">
                        <span class="h-0.5 w-6 bg-gradient-to-r from-amber-500 to-transparent"></span>
                        Welcome Back
                    </p>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-tight">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-slate-800 to-slate-700 dark:from-slate-100 dark:via-slate-50 dark:to-slate-200">
                            {{ Auth::guard('host')->user()->full_name ?? 'Host' }}
                        </span>
                    </h1>
                </div>

                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-light max-w-2xl">
                    Plan your perfect celebration. Let's make every moment unforgettable.
                </p>

                <!-- Quick Actions -->
                <div class="flex flex-wrap gap-3 pt-4">
                    <a href="{{ route('host.vendors.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-amber-500/20 dark:bg-amber-500/10 text-amber-700 dark:text-amber-300 font-semibold hover:bg-amber-500/30 dark:hover:bg-amber-500/20 transition-all duration-300">
                        <x-heroicon-o-plus-circle class="w-5 h-5 text-amber-600 dark:text-amber-400" />
                        Book Vendor
                    </a>
                    <a href="{{ route('host.checklists.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-violet-500/20 dark:bg-violet-500/10 text-violet-700 dark:text-violet-300 font-semibold hover:bg-violet-500/30 dark:hover:bg-violet-500/20 transition-all duration-300">
                        <x-heroicon-o-clipboard-document-list class="w-5 h-5 text-violet-600 dark:text-violet-400" />
                        View Tasks
                    </a>
                </div>
            </div>

            <!-- Event Timing Card -->
            @if ($weddingDate)
                <div class="mt-12 max-w-2xl">
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-amber-500/15 to-rose-500/15 dark:from-amber-500/5 dark:to-rose-500/5 rounded-2xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div
                            class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-2xl p-6 sm:p-8 hover:border-white/60 dark:hover:border-slate-600/60 transition-all duration-300">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex-1">
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                        Your Special Day</p>
                                    <p class="text-4xl font-light text-slate-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($weddingDate)->format('F d, Y') }}
                                    </p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                                        {{ \Carbon\Carbon::parse($weddingDate)->diffForHumans() }}
                                    </p>
                                </div>
                                <button wire:click="openEventTimingModal"
                                    class="group/btn relative p-3 rounded-xl bg-gradient-to-br from-amber-500 to-rose-500 hover:from-amber-600 hover:to-rose-600 text-white shadow-lg hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300 flex-shrink-0"
                                    title="Edit event timing">
                                    <x-heroicon-o-clock class="w-6 h-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-12 max-w-2xl">
                    <div class="group relative">
                        <div
                            class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-2xl p-6 sm:p-8">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p
                                        class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">
                                        Set Your Wedding Date</p>
                                    <p class="text-lg font-light text-slate-700 dark:text-slate-200">Click below to add
                                        your special date</p>
                                </div>
                                <button wire:click="openEventTimingModal"
                                    class="group/btn relative p-3 rounded-xl bg-gradient-to-br from-amber-500 to-rose-500 hover:from-amber-600 hover:to-rose-600 text-white shadow-lg hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-300 flex-shrink-0">
                                    <x-heroicon-o-calendar class="w-6 h-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- STATS SECTION - SMALLER CARDS --}}
    <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @php
                $stats = [
                    [
                        'icon' => 'briefcase',
                        'label' => 'Vendors',
                        'value' => $vendorCategories['hiredCount'],
                        'total' => $vendorCategories['totalCount'],
                        'color' => 'from-emerald-500 to-teal-500',
                        'icon_bg' => 'bg-emerald-500/20 dark:bg-emerald-500/10',
                        'icon_color' => 'text-emerald-600 dark:text-emerald-400',
                    ],
                    [
                        'icon' => 'check-circle',
                        'label' => 'Tasks',
                        'value' => $doneTasks,
                        'total' => $totalTasks,
                        'color' => 'from-amber-500 to-orange-500',
                        'icon_bg' => 'bg-amber-500/20 dark:bg-amber-500/10',
                        'icon_color' => 'text-amber-600 dark:text-amber-400',
                    ],
                    [
                        'icon' => 'users',
                        'label' => 'Guests',
                        'value' => $respondedGuests,
                        'total' => $totalGuests,
                        'color' => 'from-indigo-500 to-purple-500',
                        'icon_bg' => 'bg-indigo-500/20 dark:bg-indigo-500/10',
                        'icon_color' => 'text-indigo-600 dark:text-indigo-400',
                    ],
                    [
                        'icon' => 'banknotes',
                        'label' => 'Budget',
                        'value' => '85%',
                        'total' => 'Used',
                        'color' => 'from-rose-500 to-pink-500',
                        'icon_bg' => 'bg-rose-500/20 dark:bg-rose-500/10',
                        'icon_color' => 'text-rose-600 dark:text-rose-400',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br {{ $stat['color'] }} opacity-0 group-hover:opacity-10 dark:group-hover:opacity-5 rounded-xl blur-lg transition-all duration-500">
                    </div>

                    <div
                        class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-xl p-4 hover:border-white/60 dark:hover:border-slate-600/60 transition-all duration-300 hover:shadow-md dark:hover:shadow-lg h-full">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-8 h-8 rounded-lg {{ $stat['icon_bg'] }} p-1.5">
                                @switch($stat['icon'])
                                    @case('briefcase')
                                        <x-heroicon-o-briefcase class="w-full h-full {{ $stat['icon_color'] }}" />
                                    @break

                                    @case('check-circle')
                                        <x-heroicon-o-check-circle class="w-full h-full {{ $stat['icon_color'] }}" />
                                    @break

                                    @case('users')
                                        <x-heroicon-o-users class="w-full h-full {{ $stat['icon_color'] }}" />
                                    @break

                                    @case('banknotes')
                                        <x-heroicon-o-banknotes class="w-full h-full {{ $stat['icon_color'] }}" />
                                    @break
                                @endswitch
                            </div>
                        </div>

                        <h3
                            class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-1">
                            {{ $stat['label'] }}</h3>
                        <div class="flex items-baseline gap-1.5 mb-2">
                            <p class="text-2xl font-light text-slate-900 dark:text-white">{{ $stat['value'] }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">/ {{ $stat['total'] }}</p>
                        </div>

                        @php
                            $progressWidth = 0;
                            if (is_numeric($stat['total']) && $stat['total'] > 0) {
                                $progressWidth = min(100, ($stat['value'] / $stat['total']) * 100);
                            } elseif ($stat['label'] === 'Budget') {
                                $progressWidth = 85;
                            }
                        @endphp

                        <div class="h-1 bg-slate-200/50 dark:bg-slate-700/50 rounded-full overflow-hidden">
                            @if ($progressWidth > 0)
                                <div class="h-full bg-gradient-to-r {{ $stat['color'] }} rounded-full transition-all duration-500"
                                    style="width: {{ $progressWidth }}%"></div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- MAIN CONTENT GRID --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- LEFT COLUMN (2/3 width) -->
            <div class="lg:col-span-2 space-y-5">
                {{-- VENDORS SECTION --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-amber-500/15 to-orange-500/15 dark:from-amber-500/5 dark:to-orange-500/5 rounded-xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div
                        class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-xl overflow-hidden hover:border-white/60 dark:hover:border-slate-600/60 transition-all duration-300 shadow-sm hover:shadow-md dark:hover:shadow-lg">
                        <!-- Header -->
                        <div
                            class="px-5 sm:px-6 py-4 border-b border-white/30 dark:border-slate-700/30 bg-gradient-to-r from-amber-500/5 to-orange-500/5 dark:from-amber-500/2 dark:to-orange-500/2 flex items-center justify-between">
                            <h2 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                <span>👰</span> Vendors
                                <span
                                    class="px-2 py-0.5 bg-amber-500/20 dark:bg-amber-500/10 text-amber-700 dark:text-amber-300 text-xs font-semibold rounded-lg border border-amber-500/30 dark:border-amber-500/20">{{ $vendorCategories['hiredCount'] }}/{{ $vendorCategories['totalCount'] }}</span>
                            </h2>
                            <a href="{{ route('host.vendors.index') }}"
                                class="text-xs font-semibold text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 transition-colors">View
                                All →</a>
                        </div>

                        <!-- Vendors Grid -->
                        <div class="p-5 sm:p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                @foreach (array_slice($vendorCategories['all'], 0, 8) as $category)
                                    <div class="group/item relative">
                                        <div
                                            class="relative backdrop-blur-sm bg-white/40 dark:bg-slate-700/40 border border-white/30 dark:border-slate-600/30 rounded-lg p-3 flex items-center justify-between hover:border-white/60 dark:hover:border-slate-500/60 hover:bg-white/50 dark:hover:bg-slate-700/50 transition-all duration-300">
                                            <span
                                                class="font-medium text-xs text-slate-900 dark:text-white line-clamp-1">{{ $category }}</span>
                                            @if (in_array($category, $vendorCategories['hired']))
                                                <span
                                                    class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-500/20 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 text-xs font-semibold rounded-lg border border-emerald-500/30 dark:border-emerald-500/20 flex-shrink-0 ml-2">
                                                    <span
                                                        class="w-1 h-1 bg-emerald-500 rounded-full animate-pulse"></span>
                                                    ✓
                                                </span>
                                            @else
                                                <a href="{{ route('wedding-vendors.index', ['category' => $category]) }}"
                                                    class="px-2 py-0.5 bg-amber-500/20 dark:bg-amber-500/10 hover:bg-amber-500/30 dark:hover:bg-amber-500/20 text-amber-700 dark:text-amber-300 text-xs font-semibold rounded-lg border border-amber-500/30 dark:border-amber-500/20 transition-all duration-300 flex-shrink-0 ml-2">
                                                    +
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOOKINGS SECTION --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-indigo-500/15 to-blue-500/15 dark:from-indigo-500/5 dark:to-blue-500/5 rounded-xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div
                        class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-xl overflow-hidden hover:border-white/60 dark:hover:border-slate-600/60 transition-all duration-300 shadow-sm hover:shadow-md dark:hover:shadow-lg">
                        <!-- Header -->
                        <div
                            class="px-5 sm:px-6 py-4 border-b border-white/30 dark:border-slate-700/30 bg-gradient-to-r from-indigo-500/5 to-blue-500/5 dark:from-indigo-500/2 dark:to-blue-500/2 flex items-center justify-between">
                            <h2 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                <span>📅</span> Recent Bookings
                            </h2>
                            <a href="{{ route('host.bookings.index') }}"
                                class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">View
                                All →</a>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs">
                                <thead
                                    class="border-b border-white/30 dark:border-slate-700/30 bg-white/20 dark:bg-slate-800/20">
                                    <tr>
                                        <th
                                            class="px-4 py-2 text-left font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                            #</th>
                                        <th
                                            class="px-4 py-2 text-left font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                            Vendor</th>
                                        <th
                                            class="hidden sm:table-cell px-4 py-2 text-left font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-4 py-2 text-left font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/20 dark:divide-slate-700/20">
                                    @foreach (array_slice($recentBookings, 0, 4) as $index => $booking)
                                        <tr
                                            class="hover:bg-white/30 dark:hover:bg-slate-700/30 transition-colors duration-200">
                                            <td class="px-4 py-2.5 text-slate-900 dark:text-white font-medium">
                                                {{ $index + 1 }}</td>
                                            <td
                                                class="px-4 py-2.5 text-slate-900 dark:text-white font-medium truncate">
                                                {{ $booking['vendor'] }}</td>
                                            <td
                                                class="hidden sm:table-cell px-4 py-2.5 text-slate-600 dark:text-slate-400 text-xs">
                                                {{ $booking['event_date'] }}</td>
                                            <td class="px-4 py-2.5">
                                                <span
                                                    class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded-lg border
                                                    @if ($booking['status'] === 'confirmed') bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 border-emerald-500/30 dark:border-emerald-500/20
                                                    @elseif($booking['status'] === 'pending')
                                                        bg-amber-500/20 text-amber-700 dark:text-amber-300 border-amber-500/30 dark:border-amber-500/20
                                                    @else
                                                        bg-rose-500/20 text-rose-700 dark:text-rose-300 border-rose-500/30 dark:border-rose-500/20 @endif
                                                ">
                                                    {{ ucfirst($booking['status']) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN (1/3 width) -->
            <div class="space-y-5">
                {{-- CHECKLIST SECTION --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-violet-500/15 to-purple-500/15 dark:from-violet-500/5 dark:to-purple-500/5 rounded-xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div
                        class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-xl overflow-hidden hover:border-white/60 dark:hover:border-slate-600/60 transition-all duration-300 shadow-sm hover:shadow-md dark:hover:shadow-lg h-full flex flex-col">
                        <!-- Header -->
                        <div
                            class="px-5 py-4 border-b border-white/30 dark:border-slate-700/30 bg-gradient-to-r from-violet-500/5 to-purple-500/5 dark:from-violet-500/2 dark:to-purple-500/2 flex items-center justify-between">
                            <h2 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                <span>✅</span> Tasks
                            </h2>
                            <a href="{{ route('host.checklists.index') }}"
                                class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 transition-colors">More
                                →</a>
                        </div>

                        <!-- Content -->
                        <div class="p-5 space-y-3 flex-1 flex flex-col">
                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-2 mb-3">
                                <div class="text-center p-1.5 rounded-lg bg-white/30 dark:bg-slate-700/30">
                                    <p class="text-lg font-light text-emerald-600 dark:text-emerald-400">
                                        {{ $doneTasks }}</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">Done</p>
                                </div>
                                <div class="text-center p-1.5 rounded-lg bg-white/30 dark:bg-slate-700/30">
                                    <p class="text-lg font-light text-amber-600 dark:text-amber-400">
                                        {{ $totalTasks - $doneTasks }}</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">Pending</p>
                                </div>
                                <div class="text-center p-1.5 rounded-lg bg-white/30 dark:bg-slate-700/30">
                                    <p class="text-lg font-light text-rose-600 dark:text-rose-400">{{ $overdueTasks }}
                                    </p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">Overdue</p>
                                </div>
                            </div>

                            <!-- Tasks List -->
                            <div class="space-y-1.5 flex-1 overflow-y-auto">
                                @foreach (array_slice($checklistTasks, 0, 3) as $task)
                                    <div class="group/task relative">
                                        <div
                                            class="relative flex items-start gap-2 p-2.5 bg-white/40 dark:bg-slate-700/40 rounded-lg border border-white/20 dark:border-slate-600/20 hover:border-white/40 dark:hover:border-slate-600/40 transition-all duration-300">
                                            <input type="checkbox"
                                                class="mt-0.5 w-3 h-3 rounded accent-violet-600 dark:accent-violet-400 cursor-pointer flex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <p
                                                    class="text-xs font-medium text-slate-900 dark:text-white line-clamp-1">
                                                    {{ $task['title'] }}</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1">
                                                    {{ $task['due'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <a href="{{ route('host.checklists.index') }}"
                                class="mt-auto w-full py-2 text-center text-xs font-semibold text-violet-600 dark:text-violet-400 hover:bg-violet-500/10 dark:hover:bg-violet-500/5 rounded-lg transition-colors duration-300">
                                + Add Task
                            </a>
                        </div>
                    </div>
                </div>

                {{-- BUDGET SECTION --}}
                <div class="group relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-rose-500/15 to-pink-500/15 dark:from-rose-500/5 dark:to-pink-500/5 rounded-xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div
                        class="relative backdrop-blur-md bg-white/50 dark:bg-slate-800/50 border border-white/40 dark:border-slate-700/40 rounded-xl overflow-hidden hover:border-white/60 dark:hover:border-slate-600/60 transition-all duration-300 shadow-sm hover:shadow-md dark:hover:shadow-lg h-full flex flex-col">
                        <!-- Header -->
                        <div
                            class="px-5 py-4 border-b border-white/30 dark:border-slate-700/30 bg-gradient-to-r from-rose-500/5 to-pink-500/5 dark:from-rose-500/2 dark:to-pink-500/2 flex items-center justify-between">
                            <h2 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                <span>💰</span> Budget
                            </h2>
                            <a href="{{ route('host.budget') }}"
                                class="text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors">View
                                →</a>
                        </div>

                        <!-- Content -->
                        <div class="p-5 space-y-3 flex-1 flex flex-col">
                            <!-- Total Amount -->
                            <div class="text-center py-1">
                                <p class="text-xs text-slate-600 dark:text-slate-400 mb-1 font-medium">Total Budget</p>
                                <p
                                    class="text-2xl font-light bg-clip-text text-transparent bg-gradient-to-r from-rose-600 to-pink-600 dark:from-rose-400 dark:to-pink-400">
                                    {{ $budgetTotal }}
                                </p>
                            </div>

                            <!-- Progress -->
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-medium text-slate-600 dark:text-slate-400">Spent</span>
                                    @php
                                        $totalBudgetNum = floatval(preg_replace('/[^0-9.]/', '', $budgetTotal));
                                        $spentBudgetNum = floatval(preg_replace('/[^0-9.]/', '', $budgetSpent));
                                        $spentPercent =
                                            $totalBudgetNum > 0
                                                ? min(100, ($spentBudgetNum / $totalBudgetNum) * 100)
                                                : 0;
                                    @endphp
                                    <span
                                        class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">{{ round($spentPercent) }}%</span>
                                </div>
                                <div class="h-1.5 bg-slate-200/50 dark:bg-slate-700/50 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-rose-500 to-pink-500 rounded-full transition-all duration-500"
                                        style="width: {{ $spentPercent }}%"></div>
                                </div>
                            </div>

                            <!-- Remaining -->
                            <div
                                class="bg-white/30 dark:bg-slate-700/30 rounded-lg p-2.5 border border-white/20 dark:border-slate-600/20 mt-auto">
                                <p class="text-xs text-slate-600 dark:text-slate-400 mb-0.5 font-medium">Remaining</p>
                                <p class="text-sm font-light text-slate-900 dark:text-white">
                                    PKR {{ number_format(max(0, $totalBudgetNum - $spentBudgetNum), 0) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- EVENT TIMING MODAL --}}
    @if ($showDateModal)
        <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            @click.self="$wire.closeDateModal()">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl dark:shadow-2xl max-w-md w-full p-6 space-y-5 backdrop-blur-xl border border-white/70 dark:border-slate-700/50"
                @click.stop x-data="eventTimingModal('{{ $weddingDate ?? '' }}', '{{ $eventStartTime ?? '10:00' }}', '{{ $eventEndTime ?? '23:00' }}')">

                <!-- Header -->
                <div>
                    <h3 class="text-2xl font-light text-slate-900 dark:text-white flex items-center gap-2">
                        <x-heroicon-o-calendar class="w-6 h-6 text-amber-600 dark:text-amber-400" />
                        Event Timing
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1 font-light">Set your wedding date and
                        event time</p>
                </div>

                <!-- Form -->
                <div class="space-y-4">
                    <!-- Wedding Date -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Wedding
                            Date</label>
                        <input type="date" x-model="date" :min="todayDate"
                            class="w-full px-4 py-3 text-base border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:outline-none focus:border-amber-500 dark:focus:border-amber-400 transition-colors duration-300" />
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Event Start
                            Time</label>
                        <input type="time" x-model="startTime"
                            class="w-full px-4 py-3 text-base border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:outline-none focus:border-amber-500 dark:focus:border-amber-400 transition-colors duration-300" />
                    </div>

                    <!-- End Time -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Event End
                            Time</label>
                        <input type="time" x-model="endTime"
                            class="w-full px-4 py-3 text-base border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:outline-none focus:border-amber-500 dark:focus:border-amber-400 transition-colors duration-300" />
                    </div>
                </div>

                <p class="text-xs text-slate-500 dark:text-slate-400 font-light">Minimum date: <span
                        x-text="formatDate(todayDate)" class="font-semibold"></span></p>

                <!-- Actions -->
                <div class="flex gap-3 pt-2">
                    <button @click="$wire.closeDateModal()"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg transition-colors duration-300">
                        Cancel
                    </button>
                    <button type="button" @click="$wire.saveEventTiming(date, startTime, endTime)"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold bg-gradient-to-r from-amber-500 to-rose-500 hover:from-amber-600 hover:to-rose-600 text-white rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/30">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- STYLES --}}
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        * {
            @apply transition-colors duration-300;
        }

        ::selection {
            background-color: rgba(217, 119, 6, 0.3);
        }

        .dark ::selection {
            background-color: rgba(217, 119, 6, 0.2);
        }
    </style>

    {{-- SCRIPTS --}}
    <script>
        document.addEventListener('alpine:init', () => {
            // Countdown Timer
            window.countdownTimer = () => ({
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,
                weddingDateStr: '',
                eventStartTime: '10:00',
                intervalId: null,
                init(weddingDate, startTime) {
                    this.weddingDateStr = weddingDate;
                    this.eventStartTime = startTime || '10:00';
                    this.updateCountdown();
                    this.intervalId = setInterval(() => this.updateCountdown(), 1000);
                },
                updateEventDateTime(newDate, newStartTime) {
                    // Called when Livewire updates and x-effect triggers
                    const dateChanged = newDate && newDate !== this.weddingDateStr;
                    const timeChanged = newStartTime && newStartTime !== this.eventStartTime;

                    if (dateChanged || timeChanged) {
                        if (dateChanged) this.weddingDateStr = newDate;
                        if (timeChanged) this.eventStartTime = newStartTime;
                        this.updateCountdown();
                    }
                },
                updateCountdown() {
                    const now = new Date();

                    // Combine date and time to create the event datetime
                    const [hours, minutes] = this.eventStartTime.split(':');
                    const eventDateTime = new Date(this.weddingDateStr);
                    eventDateTime.setHours(parseInt(hours), parseInt(minutes), 0, 0);

                    if (eventDateTime <= now) {
                        this.days = 0;
                        this.hours = 0;
                        this.minutes = 0;
                        this.seconds = 0;
                        return;
                    }

                    const diff = eventDateTime - now;
                    this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    this.hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                    this.minutes = Math.floor((diff / (1000 * 60)) % 60);
                    this.seconds = Math.floor((diff / 1000) % 60);
                }
            });

            // Event Timing Modal - for handling modal state
            window.eventTimingModal = (currentDate, currentStartTime, currentEndTime) => ({
                date: currentDate,
                startTime: currentStartTime || '10:00',
                endTime: currentEndTime || '23:00',
                todayDate: new Date().toISOString().split('T')[0],
                init() {
                    if (!this.date) {
                        this.date = this.todayDate;
                    }
                },
                formatDate(dateStr) {
                    const date = new Date(dateStr + 'T00:00:00');
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                }
            });
        });
    </script>
</div>
