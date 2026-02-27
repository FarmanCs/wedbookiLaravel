<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Messages</h1>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col md:flex-row h-[600px]">
            <!-- Conversation List -->
            <div class="w-full md:w-80 border-r border-gray-200 dark:border-gray-700 overflow-y-auto">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <input type="text" placeholder="Search conversations..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach(['ALI ZAHID', 'Alina rizvi', 'Hanzala Khalid', 'BAKKI UK', 'Nazia Siddique', 'Atif Abbas', 'waseem hanan'] as $index => $name)
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer {{ $index == 0 ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $name }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">2m ago</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 truncate">Hi there, I have just booked your services!</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Chat Area -->
            <div class="flex-1 flex flex-col">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center">
                    <span class="font-medium text-gray-900 dark:text-white">ALI ZAHID</span>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center text-primary-600 dark:text-primary-300">AZ</div>
                        <div class="ml-3 bg-gray-100 dark:bg-gray-700 rounded-lg p-3 max-w-xs">
                            <p class="text-sm text-gray-900 dark:text-white">hi</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex space-x-2">
                        <input type="text" placeholder="Type a message..." class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
                        <button class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>