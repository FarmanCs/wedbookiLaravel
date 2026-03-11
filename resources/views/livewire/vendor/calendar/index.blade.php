<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-zinc-950 dark:to-zinc-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📅 Calendar</h1>
            <div class="flex flex-wrap items-center gap-4">
                <!-- Business selector -->
                <select wire:model.live="selectedBusiness"
                    class="rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white px-4 py-2.5 pr-8 focus:ring-2 focus:ring-green-500 shadow-sm">
                    <option value="">Select a business</option>
                    @foreach ($businesses as $business)
                        <option value="{{ $business['id'] }}">{{ $business['name'] }}</option>
                    @endforeach
                </select>
                <!-- Month navigation -->
                <div
                    class="flex items-center gap-2 bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-1">
                    <button wire:click="previousMonth"
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
                        <flux:icon.chevron-left class="w-5 h-5 text-gray-600 dark:text-gray-300" />
                    </button>
                    <span
                        class="px-3 font-semibold text-gray-900 dark:text-white min-w-[140px] text-center">{{ $monthName }}</span>
                    <button wire:click="nextMonth"
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-700 transition-colors">
                        <flux:icon.chevron-right class="w-5 h-5 text-gray-600 dark:text-gray-300" />
                    </button>
                </div>
                <!-- Today button -->
                <button wire:click="setTodayTimings"
                    class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-md flex items-center gap-2 transition-all">
                    <flux:icon.sun class="w-5 h-5" />
                    Set Today's Timings
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div
                class="mb-4 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800/50 flex items-center gap-3 shadow-sm">
                <flux:icon.check-circle class="w-6 h-6 text-green-600 dark:text-green-400" />
                <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Calendar Grid -->
        @if ($selectedBusiness)
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                <!-- Weekday Headers -->
                <div
                    class="grid grid-cols-7 bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-200 dark:border-zinc-800">
                    @foreach ($weekDays as $day)
                        <div class="py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-400">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>

                <!-- Calendar Days -->
                <div class="grid grid-cols-7 divide-x divide-gray-200 dark:divide-zinc-800">
                    @foreach ($calendarDays as $day)
                        <div class="min-h-[140px] p-3 {{ $day['isCurrentMonth'] ? 'bg-white dark:bg-zinc-900' : 'bg-gray-50 dark:bg-zinc-800/30 text-gray-400' }} 
                                    hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer border-b border-gray-200 dark:border-zinc-800 relative group"
                            wire:click="openTimingModal('{{ $day['date'] }}')">
                            <div class="flex justify-between items-start">
                                <span
                                    class="text-sm {{ $day['isToday'] ? 'font-bold text-green-600 dark:text-green-400' : '' }}">
                                    {{ $day['day'] }}
                                </span>
                                @if ($day['timings'] && count($day['timings']) > 0)
                                    <span
                                        class="inline-flex items-center px-1.5 py-0.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-medium">
                                        Set
                                    </span>
                                @endif
                            </div>
                            <!-- Timing indicators (colored dots with tooltip) -->
                            <div class="mt-2 space-y-1.5">
                                @php
                                    $slotInfo = [
                                        'morning' => ['color' => 'bg-green-400', 'label' => 'Morning'],
                                        'afternoon' => ['color' => 'bg-amber-400', 'label' => 'Afternoon'],
                                        'evening' => ['color' => 'bg-purple-400', 'label' => 'Evening'],
                                    ];
                                @endphp
                                @foreach ($slotInfo as $slot => $info)
                                    @php
                                        $enabled =
                                            $day['timings'] &&
                                            isset($day['timings'][$slot]['enabled']) &&
                                            $day['timings'][$slot]['enabled'];
                                        $timeRange = $enabled
                                            ? $day['timings'][$slot]['start'] . ' - ' . $day['timings'][$slot]['end']
                                            : 'Closed';
                                    @endphp
                                    <div class="flex items-center gap-2 group/tooltip">
                                        <div
                                            class="w-2 h-2 rounded-full {{ $enabled ? $info['color'] : 'bg-gray-300 dark:bg-zinc-600' }}">
                                        </div>
                                        <span
                                            class="text-xs {{ $enabled ? 'text-gray-700 dark:text-gray-300' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ $info['label'] }}
                                        </span>
                                        <!-- Tooltip on hover -->
                                        <div
                                            class="absolute left-0 -top-8 hidden group-hover/tooltip:block bg-gray-800 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-10">
                                            {{ $timeRange }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Hover hint -->
                            <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-xs bg-gray-800 text-white px-2 py-1 rounded-lg shadow-lg">Click to
                                    edit</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 p-12 text-center">
                <flux:icon.calendar class="w-16 h-16 mx-auto text-gray-400 mb-4" />
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Business Selected</h3>
                <p class="text-gray-500 dark:text-gray-400">Please select a business from the dropdown above to view and
                    manage timings.</p>
            </div>
        @endif

        <!-- Weekly Timings Overview Table -->
        @if ($selectedBusiness)
            <!-- Info note -->
            <div
                class="mb-2 flex items-center gap-2 text-sm text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg border border-blue-200 dark:border-blue-800">
                <flux:icon.information-circle class="w-5 h-5 flex-shrink-0" />
                <span>The table below shows your <strong>recurring weekly schedule</strong>. To set custom times for a
                    specific date, click that day in the calendar above.
                    <button wire:click="openWeeklyModal" class="underline font-medium">Click here</button> to edit the
                    weekly schedule.</span>
            </div>

            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                <div
                    class="px-6 py-4 border-b border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-800/50 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <flux:icon.clock class="w-5 h-5 text-amber-500" />
                        Weekly Recurring Schedule
                    </h2>
                    <button wire:click="openWeeklyModal"
                        class="text-sm text-amber-600 dark:text-amber-400 hover:underline flex items-center gap-1">
                        <flux:icon.pencil-square class="w-4 h-4" />
                        Edit Weekly
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-zinc-800/50">
                            <tr class="border-b border-gray-200 dark:border-zinc-800">
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Day</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Morning
                                </th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Afternoon
                                </th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300">Evening
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-800">
                            @php
                                $daysOfWeek = [
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday',
                                    'Saturday',
                                    'Sunday',
                                ];
                            @endphp
                            @foreach ($daysOfWeek as $day)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $day }}
                                    </td>
                                    @foreach (['morning', 'afternoon', 'evening'] as $slot)
                                        <td class="px-6 py-4">
                                            @php
                                                $slotData = $weeklyTimings[$day][$slot] ?? ['enabled' => false];
                                            @endphp
                                            @if ($slotData['enabled'])
                                                <span class="inline-flex items-center gap-1.5">
                                                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                                    <span
                                                        class="text-gray-900 dark:text-white">{{ $slotData['start'] }}
                                                        - {{ $slotData['end'] }}</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5">
                                                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                                    <span class="text-gray-600 dark:text-gray-400">Closed</span>
                                                </span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-6 py-3 border-t border-gray-200 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-800/50 text-xs text-gray-500 dark:text-gray-400">
                    * This is your recurring weekly schedule. Per‑date overrides are shown in the calendar with a "Set"
                    badge.
                </div>
            </div>
        @endif

        <!-- Set Timings Modal (Simplified, screenshot style) -->
        @if ($showTimingModal)
            <div
                class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-lg w-full border border-gray-200 dark:border-zinc-800 animate-scale-up">
                    <!-- Header with day name -->
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-zinc-800">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Set Venue Timings</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}
                        </p>
                    </div>

                    <!-- Body - Three slots with Start/End times -->
                    <div class="p-6 space-y-6">
                        @php
                            $slots = [
                                'morning' => 'Morning',
                                'afternoon' => 'Afternoon',
                                'evening' => 'Evening',
                            ];
                        @endphp

                        @foreach ($slots as $slotKey => $slotLabel)
                            <div class="space-y-2">
                                <h3
                                    class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    {{ $slotLabel }}
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Start
                                            Time</label>
                                        <input type="time" wire:model="timings.{{ $slotKey }}.start"
                                            placeholder="--:-- --"
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">End
                                            Time</label>
                                        <input type="time" wire:model="timings.{{ $slotKey }}.end"
                                            placeholder="--:-- --"
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Optional note (can be removed if not needed) -->
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Leave fields empty to mark the slot as closed.
                        </p>
                    </div>

                    <!-- Footer with Cancel / Save -->
                    <div
                        class="px-6 py-4 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 rounded-b-2xl flex items-center justify-end gap-3">
                        <button wire:click="closeTimingModal"
                            class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-all">
                            Cancel
                        </button>
                        <button wire:click="saveTimings"
                            class="px-6 py-2.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-semibold shadow-md transition-all">
                            Save Timings
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Weekly Schedule Modal -->
        @if ($showWeeklyModal)
            <div
                class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50 animate-fade-in">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-2xl w-full border border-gray-200 dark:border-zinc-800 max-h-[90vh] overflow-y-auto animate-scale-up">
                    <!-- Sticky header -->
                    <div
                        class="sticky top-0 bg-gradient-to-r from-blue-500 to-indigo-600 dark:from-blue-700 dark:to-indigo-800 px-6 py-6 rounded-t-2xl z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                                    <flux:icon.calendar-days class="w-6 h-6 text-white" />
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-white">Edit Weekly Schedule</h2>
                                    <p class="text-sm text-blue-100">Set recurring timings for each day of the week</p>
                                </div>
                            </div>
                            <button wire:click="closeWeeklyModal"
                                class="text-white hover:bg-white/20 p-2 rounded-lg transition-all">
                                <flux:icon.x-mark class="w-6 h-6" />
                            </button>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6 space-y-6">
                        @php
                            $daysOfWeek = [
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday',
                                'Saturday',
                                'Sunday',
                            ];
                            $slotColors = [
                                'morning' =>
                                    'bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 border-green-200 dark:border-green-800',
                                'afternoon' =>
                                    'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                                'evening' =>
                                    'bg-purple-100 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 border-purple-200 dark:border-purple-800',
                            ];
                        @endphp

                        @foreach ($daysOfWeek as $day)
                            <div class="border border-gray-200 dark:border-zinc-700 rounded-xl overflow-hidden">
                                <div
                                    class="bg-gray-50 dark:bg-zinc-800/50 px-4 py-3 font-semibold text-gray-900 dark:text-white">
                                    {{ $day }}
                                </div>
                                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach (['morning', 'afternoon', 'evening'] as $slot)
                                        <div class="p-3 rounded-lg border {{ $slotColors[$slot] }}">
                                            <div class="flex items-center justify-between mb-2">
                                                <span
                                                    class="text-sm font-medium capitalize">{{ $slot }}</span>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox"
                                                        wire:model="weeklyForm.{{ $day }}.{{ $slot }}.enabled"
                                                        class="sr-only peer">
                                                    <div
                                                        class="w-9 h-5 bg-gray-200 dark:bg-zinc-700 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600 dark:peer-checked:bg-blue-500">
                                                    </div>
                                                </label>
                                            </div>
                                            @if ($weeklyForm[$day][$slot]['enabled'] ?? false)
                                                <div class="grid grid-cols-2 gap-2 mt-2">
                                                    <div>
                                                        <label
                                                            class="block text-xs text-gray-500 dark:text-gray-400">Start</label>
                                                        <input type="time"
                                                            wire:model="weeklyForm.{{ $day }}.{{ $slot }}.start"
                                                            class="w-full px-2 py-1 text-sm rounded border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs text-gray-500 dark:text-gray-400">End</label>
                                                        <input type="time"
                                                            wire:model="weeklyForm.{{ $day }}.{{ $slot }}.end"
                                                            class="w-full px-2 py-1 text-sm rounded border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-xs text-gray-500 dark:text-gray-400 italic mt-1">
                                                    Disabled</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <!-- Info note -->
                        <div
                            class="text-xs text-gray-500 dark:text-gray-400 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg border border-blue-200 dark:border-blue-800">
                            <flux:icon.information-circle class="w-4 h-4 inline mr-1 text-blue-500" />
                            These timings will apply every week. You can override any specific date by clicking on the
                            calendar day.
                        </div>
                    </div>

                    <!-- Sticky footer -->
                    <div
                        class="sticky bottom-0 bg-gray-50 dark:bg-zinc-800/50 border-t border-gray-200 dark:border-zinc-800 px-6 py-4 flex items-center justify-end gap-3 rounded-b-2xl">
                        <button wire:click="closeWeeklyModal"
                            class="px-6 py-2.5 rounded-lg bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white font-semibold hover:bg-gray-300 dark:hover:bg-zinc-600 transition-all">
                            Cancel
                        </button>
                        <button wire:click="saveWeeklyTimings"
                            class="px-6 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md flex items-center gap-2 transition-all">
                            <flux:icon.check class="w-5 h-5" /> Save Weekly Schedule
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Animations -->
        <style>
            @keyframes fade-in {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes scale-up {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .animate-fade-in {
                animation: fade-in 0.3s ease-in-out forwards;
            }

            .animate-scale-up {
                animation: scale-up 0.3s ease-out forwards;
            }
        </style>
    </div>
</div>
