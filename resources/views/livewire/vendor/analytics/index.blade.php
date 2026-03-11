<div class="py-6 space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h1>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Last updated: {{ now()->format('M d, Y H:i') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Views -->
        <div
            class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div
                class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity">
            </div>
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Views</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalViews) }}</p>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="text-green-500 font-semibold">↑ 12%</span> vs last week
            </div>
        </div>

        <!-- Social Clicks -->
        <div
            class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div
                class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity">
            </div>
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Social Clicks</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalClicks) }}</p>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="text-green-500 font-semibold">↑ 8%</span> vs last week
            </div>
        </div>

        <!-- Average Rating -->
        <div
            class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div
                class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity">
            </div>
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Avg Rating</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $avgRating }} / 5</p>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $avgRating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                @endfor
            </div>
        </div>

        <!-- Total Reviews -->
        <div
            class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
            <div
                class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-bl-full opacity-10 group-hover:opacity-20 transition-opacity">
            </div>
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-green-500 to-green-700 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Reviews</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalReviews) }}</p>
                </div>
            </div>
            <div class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                <span class="text-green-500 font-semibold">↑ 5%</span> vs last week
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Views Over Time (Bar Chart) -->
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Views (Last 7 Days)</h3>
            <div class="flex items-end space-x-2 h-40">
                @foreach ($viewsOverTime as $date => $count)
                    @php
                        $max = max($viewsOverTime) ?: 1;
                        $height = ($count / $max) * 100;
                        $day = \Carbon\Carbon::parse($date)->format('D');
                    @endphp
                    <div class="flex-1 flex flex-col items-center group">
                        <div class="w-full bg-gradient-to-t from-blue-400 to-blue-600 rounded-t-lg transition-all duration-300 group-hover:from-blue-500 group-hover:to-blue-700"
                            style="height: {{ $height }}%; min-height: 4px;"></div>
                        <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">{{ $day }}</div>
                        <div class="text-xs font-medium text-gray-800 dark:text-gray-200">{{ $count }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Clicks by Platform -->
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Clicks by Platform</h3>
            @if (count($clicksByPlatform) > 0)
                <div class="space-y-4">
                    @foreach ($clicksByPlatform as $platform)
                        @php
                            $total = array_sum(array_column($clicksByPlatform, 'count'));
                            $percentage = $total ? round(($platform['count'] / $total) * 100) : 0;
                            $colors = ['bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-blue-500'];
                            $color = $colors[$loop->index % count($colors)];
                        @endphp
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <span
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 capitalize">{{ $platform['platform'] }}</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $platform['count'] }}
                                    ({{ $percentage }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                <div class="{{ $color }} h-2.5 rounded-full transition-all duration-500"
                                    style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-sm">No clicks recorded yet.</p>
            @endif
        </div>
    </div>

    <!-- Recent Reviews -->
    <div
        class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recent Reviews</h3>
        @if ($recentReviews->count() > 0)
            <div class="space-y-4">
                @foreach ($recentReviews as $review)
                    <div
                        class="flex items-start space-x-4 p-4 rounded-xl bg-gray-50/50 dark:bg-gray-700/50 backdrop-blur-sm border border-gray-100 dark:border-gray-600 transition-all hover:shadow-md">
                        <div class="flex-shrink-0">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white font-bold">
                                {{ substr($review->business->company_name, 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-white">
                                    {{ $review->business->company_name }}</h4>
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->points ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $review->text }}</p>
                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400 text-sm">No reviews yet.</p>
        @endif
    </div>

    <!-- Businesses Summary (optional) -->
    @if ($businesses->count() > 0)
        <div
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Your Businesses</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($businesses as $business)
                    <div
                        class="p-4 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-3">
                            @if ($business->profile_image)
                                <img src="{{ Storage::url($business->profile_image) }}"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold">
                                    {{ substr($business->company_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 dark:text-white">
                                    {{ $business->company_name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Views:
                                    {{ $business->view_count ?? 0 }} · Rating: {{ $business->rating ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
