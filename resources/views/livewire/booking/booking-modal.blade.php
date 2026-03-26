<div>
    @if ($isOpen)
        {{-- Backdrop --}}
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data x-init="document.body.style.overflow = 'hidden'"
            x-destroy="document.body.style.overflow = ''">
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeModal"></div>

            {{-- Modal Panel --}}
            <div class="relative z-10 w-full max-w-2xl max-h-[92vh] overflow-y-auto bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-gray-100 dark:border-slate-700 flex flex-col"
                style="scrollbar-width: thin;">
                {{-- ── Header ── --}}
                <div
                    class="sticky top-0 z-20 bg-white dark:bg-slate-900 px-7 pt-6 pb-4 border-b border-gray-100 dark:border-slate-800 rounded-t-3xl">
                    <div class="flex items-start justify-between gap-4 mb-5">
                        <div>
                            <p
                                class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-1">
                                Complete your booking in 4 simple steps
                            </p>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white leading-tight">
                                Book {{ $selectedItemData['name'] ?? 'Item' }}
                            </h3>
                        </div>
                        <button wire:click="closeModal"
                            class="flex-shrink-0 w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Step Indicators --}}
                    <div class="flex items-center gap-0">
                        @foreach ([1 => 'Details', 2 => 'Date', 3 => 'Services', 4 => 'Confirm'] as $num => $label)
                            <div class="flex items-center {{ $num < 4 ? 'flex-1' : '' }}">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-black transition-all duration-300
                                        {{ $step > $num ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200 dark:shadow-emerald-900' : ($step == $num ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200 dark:shadow-emerald-900 ring-4 ring-emerald-100 dark:ring-emerald-900/50' : 'bg-gray-100 dark:bg-slate-800 text-gray-400 dark:text-gray-500') }}">
                                        @if ($step > $num)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        @else
                                            {{ $num }}
                                        @endif
                                    </div>
                                    <span
                                        class="text-[10px] font-bold mt-1 {{ $step >= $num ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-400 dark:text-gray-600' }}">
                                        {{ $label }}
                                    </span>
                                </div>
                                @if ($num < 4)
                                    <div
                                        class="flex-1 h-0.5 mx-1 mb-4 rounded-full transition-all duration-500 {{ $step > $num ? 'bg-emerald-500' : 'bg-gray-200 dark:bg-slate-700' }}">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ── Body ── --}}
                <div class="px-7 py-6 flex-1">

                    {{-- ── STEP 1: Contact Details ── --}}
                    @if ($step == 1)
                        <div>
                            <h4 class="text-xl font-black text-slate-900 dark:text-white mb-1">Your Contact Details</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Here are your details, please
                                confirm them.</p>

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Full
                                        Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text" wire:model="name" placeholder="Enter your full name"
                                            class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-gray-50 dark:bg-slate-800 border-2 border-gray-200 dark:border-slate-700 focus:border-emerald-500 dark:focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-800 outline-none transition-all text-slate-900 dark:text-white placeholder-gray-400 text-sm font-medium">
                                    </div>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email
                                        Address</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="email" wire:model="email" placeholder="your@email.com"
                                            class="w-full pl-11 pr-4 py-3.5 rounded-2xl bg-gray-50 dark:bg-slate-800 border-2 border-gray-200 dark:border-slate-700 focus:border-emerald-500 dark:focus:border-emerald-500 focus:bg-white dark:focus:bg-slate-800 outline-none transition-all text-slate-900 dark:text-white placeholder-gray-400 text-sm font-medium">
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Item preview card --}}
                            @if (!empty($selectedItemData))
                                <div
                                    class="mt-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p
                                            class="text-xs text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wide">
                                            Selected Item</p>
                                        <p class="text-slate-900 dark:text-white font-black text-sm">
                                            {{ $selectedItemData['name'] }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-emerald-600 dark:text-emerald-400 font-black">Rs
                                            {{ number_format($selectedItemData['price'] ?? 0, 0) }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- ── STEP 2: Date & Time ── --}}
                    @elseif ($step == 2)
                        <div x-data="{
                            currentMonth: {{ (int) date('m') }},
                            currentYear: {{ (int) date('Y') }},
                            selectedDay: null,
                            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            get daysInMonth() {
                                return new Date(this.currentYear, this.currentMonth, 0).getDate();
                            },
                            get firstDayOfMonth() {
                                return new Date(this.currentYear, this.currentMonth - 1, 1).getDay();
                            },
                            get todayDate() {
                                return new Date().getDate();
                            },
                            get todayMonth() {
                                return new Date().getMonth() + 1;
                            },
                            get todayYear() {
                                return new Date().getFullYear();
                            },
                            isPast(day) {
                                if (this.currentYear < this.todayYear) return true;
                                if (this.currentYear === this.todayYear && this.currentMonth < this.todayMonth) return true;
                                if (this.currentYear === this.todayYear && this.currentMonth === this.todayMonth && day < this.todayDate) return true;
                                return false;
                            },
                            prevMonth() {
                                if (this.currentMonth === 1) { this.currentMonth = 12;
                                    this.currentYear--; } else this.currentMonth--;
                            },
                            nextMonth() {
                                if (this.currentMonth === 12) { this.currentMonth = 1;
                                    this.currentYear++; } else this.currentMonth++;
                            },
                            selectDay(day) {
                                if (this.isPast(day)) return;
                                this.selectedDay = day;
                                let m = String(this.currentMonth).padStart(2, '0');
                                let d = String(day).padStart(2, '0');
                                let dateStr = this.currentYear + '-' + m + '-' + d;
                                $wire.set('selectedDate', dateStr);
                            }
                        }">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                {{-- Calendar --}}
                                <div>
                                    <h4 class="text-base font-black text-slate-900 dark:text-white mb-4">Select Date
                                    </h4>
                                    <div
                                        class="rounded-2xl border-2 border-gray-100 dark:border-slate-800 p-4 bg-white dark:bg-slate-900">
                                        {{-- Month/Year nav --}}
                                        <div class="flex items-center justify-between mb-4">
                                            <button @click="prevMonth()" type="button"
                                                class="w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <div class="flex items-center gap-2">
                                                <select x-model="currentMonth"
                                                    class="text-sm font-bold text-slate-900 dark:text-white bg-transparent outline-none cursor-pointer">
                                                    <template x-for="(m, i) in months" :key="i">
                                                        <option :value="i + 1" x-text="m"></option>
                                                    </template>
                                                </select>
                                                <select x-model="currentYear"
                                                    class="text-sm font-bold text-slate-900 dark:text-white bg-transparent outline-none cursor-pointer">
                                                    @for ($y = date('Y'); $y <= date('Y') + 3; $y++)
                                                        <option value="{{ $y }}">{{ $y }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <button @click="nextMonth()" type="button"
                                                class="w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                                                <svg class="w-4 h-4 text-gray-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                        {{-- Day headers --}}
                                        <div class="grid grid-cols-7 mb-2">
                                            @foreach (['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'] as $day)
                                                <div class="text-center text-[10px] font-bold text-gray-400 py-1">
                                                    {{ $day }}</div>
                                            @endforeach
                                        </div>
                                        {{-- Days grid --}}
                                        <div class="grid grid-cols-7">
                                            <template x-for="blank in firstDayOfMonth" :key="'b' + blank">
                                                <div></div>
                                            </template>
                                            <template x-for="day in daysInMonth" :key="day">
                                                <button type="button" @click="selectDay(day)" :disabled="isPast(day)"
                                                    :class="{
                                                        'bg-emerald-600 text-white font-black shadow-lg shadow-emerald-200 dark:shadow-emerald-900 scale-110': selectedDay ===
                                                            day && currentMonth === new Date().getMonth() + 1 ||
                                                            selectedDay === day,
                                                        'text-gray-300 dark:text-gray-600 cursor-not-allowed': isPast(
                                                            day),
                                                        'hover:bg-emerald-50 dark:hover:bg-emerald-900/30 hover:text-emerald-700 dark:hover:text-emerald-400 cursor-pointer font-semibold text-slate-700 dark:text-slate-300':
                                                            !isPast(day) && selectedDay !== day
                                                    }"
                                                    class="aspect-square flex items-center justify-center text-xs rounded-full transition-all duration-150 mx-auto w-8 h-8"
                                                    x-text="day"></button>
                                            </template>
                                        </div>
                                    </div>
                                    @error('selectedDate')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Time Slots --}}
                                <div>
                                    <h4 class="text-base font-black text-slate-900 dark:text-white mb-4">Select Time
                                    </h4>
                                    @php
                                        $timeSlots = [
                                            '09:00 AM - 10:30 AM',
                                            '10:30 AM - 12:00 PM',
                                            '12:00 PM - 01:30 PM',
                                            '01:30 PM - 03:00 PM',
                                            '03:00 PM - 04:30 PM',
                                            '04:30 PM - 06:00 PM',
                                        ];
                                    @endphp
                                    <div class="grid grid-cols-1 gap-2">
                                        @foreach ($timeSlots as $slot)
                                            <button type="button"
                                                wire:click="$set('selectedTimeSlot', '{{ $slot }}')"
                                                class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150 text-left border-2
                                                    {{ $selectedTimeSlot == $slot
                                                        ? 'bg-emerald-600 border-emerald-600 text-white shadow-md shadow-emerald-200 dark:shadow-emerald-900'
                                                        : 'bg-white dark:bg-slate-800 border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 hover:border-emerald-400 dark:hover:border-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20' }}">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-3.5 h-3.5 flex-shrink-0 {{ $selectedTimeSlot == $slot ? 'text-white' : 'text-gray-400' }}"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $slot }}
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                    @error('selectedTimeSlot')
                                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Selected summary --}}
                            @if ($selectedDate && $selectedTimeSlot)
                                <div
                                    class="mt-4 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 flex items-center gap-3">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-400">
                                        {{ \Carbon\Carbon::parse($selectedDate)->format('D, j M Y') }} &bull;
                                        {{ $selectedTimeSlot }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- ── STEP 3: Add-ons / Customize ── --}}
                    @elseif ($step == 3)
                        <div>
                            <h4 class="text-xl font-black text-slate-900 dark:text-white mb-1">Customize Booking</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">Add extras to enhance your
                                experience.</p>

                            {{-- Selected item card --}}
                            @if (!empty($selectedItemData))
                                <div class="rounded-2xl border-2 border-gray-100 dark:border-slate-800 p-4 mb-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-base font-black text-slate-900 dark:text-white">
                                                {{ $selectedItemData['name'] }}</p>
                                            <p class="text-emerald-600 dark:text-emerald-400 font-bold text-sm mt-0.5">
                                                Rs {{ number_format($selectedItemData['price'] ?? 0, 2) }}
                                            </p>
                                            @if ($selectedTimeSlot && $selectedDate)
                                                <div class="flex items-center gap-1.5 mt-2">
                                                    <span
                                                        class="w-2 h-2 rounded-full bg-emerald-500 flex-shrink-0"></span>
                                                    <span
                                                        class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $selectedTimeSlot }}</span>
                                                </div>
                                                <p class="text-xs text-gray-400 dark:text-gray-500 ml-3.5 font-medium">
                                                    {{ \Carbon\Carbon::parse($selectedDate)->format('j M Y') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Add-ons --}}
                            @if (!empty($availableAddons))
                                <div class="mb-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <p
                                            class="text-sm font-black text-slate-700 dark:text-slate-300 uppercase tracking-wide">
                                            Want to upgrade?</p>
                                        <span class="text-xs text-emerald-600 dark:text-emerald-400 font-bold">+ Add
                                            Package</span>
                                    </div>
                                    <div class="space-y-2">
                                        @foreach ($availableAddons as $addon)
                                            <label
                                                class="flex items-center justify-between p-4 rounded-2xl border-2 cursor-pointer transition-all duration-150
                                                {{ in_array($addon['id'], $selectedAddons)
                                                    ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20'
                                                    : 'border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 hover:border-emerald-300 dark:hover:border-emerald-700' }}">
                                                <div class="flex items-center gap-3">
                                                    <div class="relative">
                                                        <input type="checkbox" wire:model.live="selectedAddons"
                                                            value="{{ $addon['id'] }}" class="sr-only peer"
                                                            id="addon_{{ $addon['id'] }}">
                                                        <div
                                                            class="w-5 h-5 rounded-md border-2 border-gray-300 dark:border-slate-600 peer-checked:bg-emerald-600 peer-checked:border-emerald-600 flex items-center justify-center transition-all">
                                                            @if (in_array($addon['id'], $selectedAddons))
                                                                <svg class="w-3 h-3 text-white" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="3"
                                                                        d="M5 13l4 4L19 7" />
                                                                </svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <span
                                                        class="font-semibold text-slate-800 dark:text-slate-200 text-sm">{{ $addon['name'] }}</span>
                                                </div>
                                                <span
                                                    class="text-sm font-bold text-emerald-600 dark:text-emerald-400 flex-shrink-0">
                                                    + Rs {{ number_format($addon['price'], 0) }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div
                                    class="rounded-2xl border-2 border-dashed border-gray-200 dark:border-slate-700 p-6 text-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300 dark:text-gray-600 mx-auto mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <p class="text-sm text-gray-400 dark:text-gray-500 font-medium">No additional
                                        services available</p>
                                </div>
                            @endif

                            {{-- Add Another Service CTA --}}
                            <button type="button"
                                class="w-full mt-3 py-3.5 rounded-2xl border-2 border-dashed border-emerald-300 dark:border-emerald-700 text-emerald-600 dark:text-emerald-400 font-bold text-sm flex items-center justify-center gap-2 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Another Service
                            </button>

                            {{-- Running total --}}
                            <div
                                class="mt-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800 flex justify-between items-center">
                                <span class="text-sm font-bold text-gray-600 dark:text-gray-400">Running Total</span>
                                <span class="text-lg font-black text-slate-900 dark:text-white">Rs
                                    {{ number_format($totalPrice, 0) }}</span>
                            </div>
                        </div>

                        {{-- ── STEP 4: Confirm ── --}}
                    @elseif ($step == 4)
                        <div>
                            <div class="text-center mb-6">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-black text-slate-900 dark:text-white">Confirm Booking</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Please review the details
                                    before confirming.</p>
                            </div>

                            <div class="rounded-2xl border-2 border-gray-100 dark:border-slate-800 overflow-hidden">
                                {{-- Summary header --}}
                                <div
                                    class="flex items-center justify-between px-5 py-3 bg-gray-50 dark:bg-slate-800 border-b border-gray-100 dark:border-slate-700">
                                    <span
                                        class="text-xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">Booking
                                        Summary</span>
                                    <span
                                        class="text-xs font-bold text-amber-600 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 px-2.5 py-1 rounded-full">Draft</span>
                                </div>

                                <div class="p-5 space-y-5">
                                    {{-- Booked by --}}
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 font-semibold mb-0.5">
                                                Booked by</p>
                                            <p class="font-black text-slate-900 dark:text-white text-sm">
                                                {{ $name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $email }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-100 dark:border-slate-800"></div>

                                    {{-- When --}}
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 font-semibold mb-0.5">
                                                When</p>
                                            <p class="font-black text-slate-900 dark:text-white text-sm">
                                                {{ \Carbon\Carbon::parse($selectedDate)->format('l, j F Y') }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $selectedTimeSlot }}</p>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-100 dark:border-slate-800"></div>

                                    {{-- Items --}}
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-400 dark:text-gray-500 font-semibold mb-2">
                                                Items</p>
                                            <div class="space-y-1.5">
                                                <div class="flex justify-between items-center">
                                                    <span
                                                        class="text-sm font-bold text-slate-900 dark:text-white">{{ $selectedItemData['name'] ?? '' }}</span>
                                                    <span class="text-sm font-bold text-slate-900 dark:text-white">Rs
                                                        {{ number_format($selectedItemData['price'] ?? 0, 0) }}</span>
                                                </div>
                                                @foreach ($selectedAddons as $addonId)
                                                    @php $addon = collect($availableAddons)->firstWhere('id', $addonId); @endphp
                                                    @if ($addon)
                                                        <div class="flex justify-between items-center">
                                                            <span
                                                                class="text-xs text-gray-500 dark:text-gray-400 font-medium">+
                                                                {{ $addon['name'] }}</span>
                                                            <span
                                                                class="text-xs text-gray-500 dark:text-gray-400 font-medium">Rs
                                                                {{ number_format($addon['price'], 0) }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Total --}}
                                    <div
                                        class="bg-emerald-50 dark:bg-emerald-900/20 rounded-2xl p-4 flex justify-between items-center border border-emerald-200 dark:border-emerald-800">
                                        <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Total
                                            Amount</span>
                                        <span class="text-xl font-black text-emerald-600 dark:text-emerald-400">Rs
                                            {{ number_format($totalPrice, 0) }}</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-xs text-gray-400 dark:text-gray-500 text-center mt-4 font-medium">
                                By confirming you agree to the booking terms & conditions.
                            </p>
                        </div>
                    @endif

                </div>

                {{-- ── Footer ── --}}
                <div
                    class="sticky bottom-0 bg-white dark:bg-slate-900 px-7 py-4 border-t border-gray-100 dark:border-slate-800 flex items-center justify-between gap-3 rounded-b-3xl">
                    @if ($step > 1)
                        <button wire:click="previousStep"
                            class="px-6 py-2.5 rounded-xl border-2 border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 font-bold text-sm hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors">
                            Back
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if ($step < 4)
                        <button wire:click="nextStep"
                            class="px-8 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition-all hover:shadow-lg hover:shadow-emerald-200 dark:hover:shadow-emerald-900 active:scale-95">
                            Continue
                        </button>
                    @else
                        <button wire:click="confirmBooking"
                            class="px-8 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition-all hover:shadow-lg hover:shadow-emerald-200 dark:hover:shadow-emerald-900 active:scale-95 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Confirm Booking
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Flash success toast --}}
    @if (session()->has('booking_success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed bottom-6 right-6 z-[100] flex items-center gap-3 bg-white dark:bg-slate-800 border border-emerald-200 dark:border-emerald-800 shadow-xl rounded-2xl px-5 py-4">
            <div
                class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ session('booking_success') }}</p>
        </div>
    @endif
</div>
