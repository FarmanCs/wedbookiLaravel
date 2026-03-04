<div x-data="{ show: @entangle('show') }" 
     x-show="show" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto" 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500/50 dark:bg-gray-900/60" 
             @click="show = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <!-- Modal panel with max height and scrollable body -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200 dark:border-gray-700 max-h-[90vh] flex flex-col"
             @click.away="show = false">
            
            <!-- Fixed Header with gradient -->
            <div class="px-6 py-5 bg-gradient-to-r from-accent/10 to-accent/5 dark:from-accent/20 dark:to-accent/10 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between rounded-t-2xl">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <flux:icon name="building-library" class="w-5 h-5 mr-2 text-accent" />
                    {{ $accountId ? 'Edit Bank Account' : 'Add Bank Account' }}
                </h3>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <flux:icon name="x-mark" class="w-5 h-5" />
                </button>
            </div>

            <!-- Scrollable Form Body -->
            <div class="flex-1 overflow-y-auto p-6">
                <form wire:submit.prevent="save" class="space-y-4" id="bank-account-form">
                    <!-- Account Holder Name -->
                    <div>
                        <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <flux:icon name="user" class="w-4 h-4 mr-1 text-accent" />
                            Account Holder Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="account_holder_name" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                               placeholder="Full name on account">
                        @error('account_holder_name') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Bank Name -->
                    <div>
                        <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <flux:icon name="building-office" class="w-4 h-4 mr-1 text-accent" />
                            Bank Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="bank_name" 
                               class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                               placeholder="e.g., HBL, UBL">
                        @error('bank_name') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Bank Code & Currency -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <flux:icon name="hashtag" class="w-4 h-4 mr-1 text-accent" />
                                Bank Code
                            </label>
                            <input type="text" wire:model="bank_code" 
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                                   placeholder="Routing/Sort code">
                        </div>
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <flux:icon name="currency-dollar" class="w-4 h-4 mr-1 text-accent" />
                                Currency
                            </label>
                            <select wire:model="currency" 
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white">
                                <option value="PKR">PKR</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                    </div>

                    <!-- Account Number & Last 4 -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <flux:icon name="credit-card" class="w-4 h-4 mr-1 text-accent" />
                                Account Number
                            </label>
                            <input type="text" wire:model="account_number" 
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                                   placeholder="Full account number">
                        </div>
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <flux:icon name="lock-closed" class="w-4 h-4 mr-1 text-accent" />
                                Last 4 Digits
                            </label>
                            <input type="text" wire:model="account_last4" maxlength="4" 
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                                   placeholder="1234">
                        </div>
                    </div>

                    <!-- IBAN & SWIFT -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <flux:icon name="globe-alt" class="w-4 h-4 mr-1 text-accent" />
                                IBAN
                            </label>
                            <input type="text" wire:model="iban" 
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                                   placeholder="International format">
                        </div>
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                <flux:icon name="arrows-right-left" class="w-4 h-4 mr-1 text-accent" />
                                SWIFT
                            </label>
                            <input type="text" wire:model="swift" 
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                                   placeholder="BIC code">
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            <flux:icon name="document-text" class="w-4 h-4 mr-1 text-accent" />
                            Notes
                        </label>
                        <textarea wire:model="notes" rows="2" 
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent dark:bg-gray-700 dark:text-white"
                                  placeholder="Any additional info"></textarea>
                    </div>

                    <!-- Default checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="is_default" id="is_default" 
                               class="h-4 w-4 text-accent focus:ring-accent border-gray-300 rounded">
                        <label for="is_default" class="ml-2 flex items-center text-sm text-gray-700 dark:text-gray-300">
                            <flux:icon name="star" class="w-4 h-4 mr-1 text-accent" />
                            Set as default withdrawal method
                        </label>
                    </div>
                </form>
            </div>

            <!-- Fixed Footer with buttons -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3 rounded-b-2xl">
                <button type="button" @click="show = false" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="submit" form="bank-account-form" 
                        class="px-4 py-2 bg-accent hover:bg-accent/90 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    Save Account
                </button>
            </div>
        </div>
    </div>
</div>