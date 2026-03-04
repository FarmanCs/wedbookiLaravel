<!-- resources/views/livewire/vendor/payments/withdraw-modal.blade.php -->
<div x-data="{ open: @entangle('showModal') }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Request Withdrawal</h3>
            </div>
            <div class="p-6">
                <form wire:submit="submitWithdrawRequest">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Amount (Rs)</label>
                        <input type="number" wire:model="amount" step="0.01" min="1" max="{{ $pendingToWithdraw }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white" placeholder="Enter amount">
                        @error('amount') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Available balance: Rs {{ number_format($pendingToWithdraw, 2) }}</p>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="open = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>