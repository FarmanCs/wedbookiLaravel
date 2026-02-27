<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Payments</h1>
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Earnings</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rs 0.00</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">Pending to Withdraw</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rs 0.00</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">Paid Amount</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rs 0.00</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-500 dark:text-gray-400">Dispute/Refunded</p>
                <p class="text-2xl font-semibold text-gray-900 dark:text-white">Rs 0.00</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Payment Methods -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Payment Methods</h2>
                <button class="flex items-center text-primary-600 hover:text-primary-700">
                    <x-heroicon-s-plus-circle class="w-5 h-5 mr-1" /> Add Payment Method
                </button>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Manage your payment methods</p>
            </div>

            <!-- Withdraw Requests -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Withdraw Requests</h2>
                <button class="flex items-center text-primary-600 hover:text-primary-700">
                    <x-heroicon-s-arrow-up-tray class="w-5 h-5 mr-1" /> Request Withdraw
                </button>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Manage your withdraw requests</p>
                <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-center text-gray-500 dark:text-gray-400">
                    No request found. You haven't made any withdrawal requests yet.
                </div>
            </div>
        </div>
    </div>
</div>