<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Payments</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage your earnings, withdraw funds, and view transaction history.</p>
        </div>

        <!-- Stats Grid with Gradients -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
            <!-- Total Earnings -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-2xl shadow-md border border-green-200 dark:border-green-800 p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-700 dark:text-green-300">Total Earnings</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rs {{ number_format($totalEarnings, 2) }}</p>
                    </div>
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                        <x-heroicon-m-currency-rupee class="w-6 h-6 text-green-600 dark:text-green-400" />
                    </div>
                </div>
            </div>

            <!-- Pending to Withdraw -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-2xl shadow-md border border-yellow-200 dark:border-yellow-800 p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-yellow-700 dark:text-yellow-300">Pending to Withdraw</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rs {{ number_format($pendingToWithdraw, 2) }}</p>
                    </div>
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                        <x-heroicon-m-clock class="w-6 h-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                </div>
            </div>

            <!-- Paid Amount -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-2xl shadow-md border border-blue-200 dark:border-blue-800 p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-700 dark:text-blue-300">Paid Amount</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rs {{ number_format($paidAmount, 2) }}</p>
                    </div>
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                        <x-heroicon-m-banknotes class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
            </div>

            <!-- Dispute Refunded -->
            <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-2xl shadow-md border border-red-200 dark:border-red-800 p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-700 dark:text-red-300">Dispute Refunded</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rs {{ number_format($totalDisputeRefunded, 2) }}</p>
                    </div>
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                        <x-heroicon-m-scale class="w-6 h-6 text-red-600 dark:text-red-400" />
                    </div>
                </div>
            </div>

            <!-- Waiver Refunded -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-2xl shadow-md border border-purple-200 dark:border-purple-800 p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-700 dark:text-purple-300">Waiver Refunded</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rs {{ number_format($totalWaiverRefunded, 2) }}</p>
                    </div>
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                        <x-heroicon-m-document-text class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Payment Methods Card (Enhanced) -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden backdrop-blur-sm">
                <div class="px-6 py-5 bg-gradient-to-r from-primary-50 to-primary-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-m-credit-card class="w-5 h-5 mr-2 text-primary-600 dark:text-primary-400" />
                        Payment Methods
                    </h2>
                    <button wire:click="$dispatch('openBankAccountModal')" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg shadow-sm transition">
                        <x-heroicon-m-plus class="w-5 h-5 mr-1" />
                        Add
                    </button>
                </div>
                <div class="p-6">
                    @if($bankAccounts && $bankAccounts->count())
                        <div class="space-y-4">
                            @foreach($bankAccounts as $account)
                                <div class="flex items-start justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600 {{ $account->is_default ? 'ring-2 ring-primary-500' : '' }}">
                                    <div class="flex items-start space-x-3">
                                        <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                                            <x-heroicon-m-building-library class="w-6 h-6 text-gray-600 dark:text-gray-300" />
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $account->account_holder_name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $account->bank_name }} • {{ $account->masked_account_number }}</p>
                                            @if($account->is_default)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-400 mt-1">
                                                    Default
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if(!$account->is_default)
                                            <button wire:click="setDefault({{ $account->id }})" class="text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition" title="Set as default">
                                                <x-heroicon-m-star class="w-5 h-5" />
                                            </button>
                                        @endif
                                        <button wire:click="$dispatch('editBankAccount', { id: {{ $account->id }} })" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                                            <x-heroicon-m-pencil class="w-5 h-5" />
                                        </button>
                                        <button wire:click="confirmDelete({{ $account->id }})" class="text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition">
                                            <x-heroicon-m-trash class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                                <x-heroicon-m-building-library class="w-8 h-8 text-gray-400 dark:text-gray-500" />
                            </div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">No Bank Account Added</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Add a bank account to receive payments seamlessly.</p>
                            <button wire:click="$dispatch('openBankAccountModal')" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                                <x-heroicon-m-plus class="w-5 h-5 mr-2" />
                                Add Bank Account
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Withdraw Requests Card (Enhanced) -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden backdrop-blur-sm">
                <div class="px-6 py-5 bg-gradient-to-r from-primary-50 to-primary-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <x-heroicon-m-arrow-up-tray class="w-5 h-5 mr-2 text-primary-600 dark:text-primary-400" />
                        Withdraw Requests
                    </h2>
                    <button wire:click="requestWithdraw" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg shadow-sm transition" 
                        @if($pendingToWithdraw <= 0) disabled @endif>
                        <x-heroicon-m-plus class="w-5 h-5 mr-1" />
                        Request
                    </button>
                </div>
                <div class="p-6">
                    @if($withdrawRequests->count())
                        <div class="space-y-4">
                            @foreach($withdrawRequests as $request)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                            <x-heroicon-m-currency-rupee class="w-5 h-5 text-gray-600 dark:text-gray-300" />
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Rs {{ number_format($request->amount, 2) }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $request->requested_at->format('d M Y, h:i A') }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @if($request->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                                <x-heroicon-m-clock class="w-3 h-3 mr-1" />
                                                Pending
                                            </span>
                                        @elseif($request->status == 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                <x-heroicon-m-check-circle class="w-3 h-3 mr-1" />
                                                Approved
                                            </span>
                                        @elseif($request->status == 'paid')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                <x-heroicon-m-check-badge class="w-3 h-3 mr-1" />
                                                Paid
                                            </span>
                                        @elseif($request->status == 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                                <x-heroicon-m-x-circle class="w-3 h-3 mr-1" />
                                                Rejected
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center pt-2">
                                <a href="{{ route('vendor.withdraw-requests') }}" class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 font-medium">
                                    View all requests →
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                                <x-heroicon-m-arrow-up-tray class="w-8 h-8 text-gray-400 dark:text-gray-500" />
                            </div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">No Withdraw Requests</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">You haven't made any withdrawal requests yet.</p>
                            <button wire:click="requestWithdraw" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm transition" 
                                @if($pendingToWithdraw <= 0) disabled @endif>
                                <x-heroicon-m-plus class="w-5 h-5 mr-2" />
                                Request Withdraw
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Withdraw Request Modal (Fixed) -->
    <div x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75 backdrop-blur-sm" @click="show = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5 bg-gradient-to-r from-primary-50 to-primary-100 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Request Withdrawal</h3>
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <x-heroicon-m-x-mark class="w-5 h-5" />
                    </button>
                </div>
                <form wire:submit.prevent="submitWithdrawRequest" class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount (Rs)</label>
                            <input type="number" wire:model="amount" step="0.01" min="1" max="{{ $pendingToWithdraw }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white transition-shadow" placeholder="Enter amount">
                            @error('amount') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Available balance: Rs {{ number_format($pendingToWithdraw, 2) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bank Account</label>
                            <select wire:model="selectedBankAccountId" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                <option value="">Select a bank account</option>
                                @if($bankAccounts && $bankAccounts->count())
                                    @foreach($bankAccounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->bank_name }} - {{ $account->masked_account_number }} {{ $account->is_default ? '(Default)' : '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('selectedBankAccountId') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm transition focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bank Account Modal Component (the modal itself is defined in its own file, but we include it here) -->
    <livewire:vendor.payments.bank-account-modal />

    <!-- Delete Confirmation Modal (Fixed) -->
    <div x-data="{ show: @entangle('showDeleteModal') }" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75 backdrop-blur-sm" @click="show = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-5 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Bank Account</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Are you sure you want to delete this bank account? This action cannot be undone.</p>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="show = false" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">Cancel</button>
                        <button type="button" wire:click="deleteAccount" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>