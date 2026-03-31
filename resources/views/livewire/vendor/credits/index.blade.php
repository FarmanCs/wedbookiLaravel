<div>
    @if ($showPurchaseModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center p-4 z-50 animate-fade-in"
            wire:key="credit-modal">
            <div
                class="bg-white dark:bg-zinc-900 rounded-3xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto border border-white/20 dark:border-zinc-800 animate-scale-up">
                <!-- Modal Header -->
                <div
                    class="sticky top-0 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-800 dark:to-purple-800 px-6 py-6 rounded-t-3xl flex items-center justify-between z-10">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                            <flux:icon.gift class="w-6 h-6 text-white" />
                        </div>
                        <h2 class="text-xl font-bold text-white">Purchase Ad Credits</h2>
                    </div>
                    <button wire:click="closeModal" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                        <flux:icon.x-mark class="w-6 h-6" />
                    </button>
                </div>

                <!-- Plans Grid -->
                <div class="p-6 lg:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($plans as $plan)
                            <div
                                class="group relative bg-white dark:bg-zinc-800/50 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 overflow-hidden">
                                <!-- Shine effect on hover -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                                </div>

                                <!-- Plan Content -->
                                <div class="p-6">
                                    @if ($plan['image'])
                                        <div class="mb-4 flex justify-center">
                                            <img src="{{ asset('storage/' . $plan['image']) }}"
                                                alt="{{ $plan['name'] }}" class="h-16 w-16 object-contain">
                                        </div>
                                    @endif
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $plan['name'] }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $plan['description'] }}
                                    </p>

                                    <div class="mb-6">
                                        <div class="flex items-baseline gap-2">
                                            @if ($plan['discounted_percentage'])
                                                <span class="text-3xl font-black text-indigo-600 dark:text-indigo-400">
                                                    Rs
                                                    {{ number_format(($plan['price'] * (100 - $plan['discounted_percentage'])) / 100, 2) }}
                                                </span>
                                                <span class="text-sm line-through text-gray-400">Rs
                                                    {{ number_format($plan['price'], 2) }}</span>
                                                <span
                                                    class="ml-2 text-xs font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                    {{ $plan['discounted_percentage'] }}% OFF
                                                </span>
                                            @else
                                                <span class="text-3xl font-black text-indigo-600 dark:text-indigo-400">
                                                    Rs {{ number_format($plan['price'], 2) }}
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <flux:icon.star class="inline w-4 h-4 mr-1 text-amber-400" />
                                            {{ $plan['no_of_credits'] }} Credits
                                        </p>
                                    </div>

                                    <button wire:click="buyPlan({{ $plan['id'] }})"
                                        class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold shadow-md transition-all flex items-center justify-center gap-2 group/btn">
                                        <flux:icon.shopping-cart class="w-5 h-5" />
                                        Buy Now
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                        <flux:icon.shield-check class="inline w-5 h-5 mr-1 text-green-500" />
                        Your data and payments are always safe with us!
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Confirmation Modal -->
    @if ($showConfirmModal && $selectedPlan)
        <div
            class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-[60] animate-fade-in">
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 animate-scale-up">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Confirm Purchase</h3>
                    <div class="space-y-3">
                        <p class="text-gray-700 dark:text-gray-300">Package:
                            <strong>{{ $selectedPlan['name'] }}</strong></p>
                        <p class="text-gray-700 dark:text-gray-300">Ad Credits:
                            <strong>{{ $selectedPlan['no_of_credits'] }}</strong></p>
                        @php
                            $finalPrice = $selectedPlan['price'];
                            if ($selectedPlan['discounted_percentage']) {
                                $finalPrice =
                                    ($selectedPlan['price'] * (100 - $selectedPlan['discounted_percentage'])) / 100;
                            }
                        @endphp
                        <p class="text-gray-700 dark:text-gray-300">Total: <strong
                                class="text-indigo-600 dark:text-indigo-400">Rs
                                {{ number_format($finalPrice, 2) }}</strong></p>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button wire:click="cancelConfirm"
                            class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                        <button wire:click="confirmPurchase"
                            class="px-6 py-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-md hover:shadow-lg transition">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
            animation: fade-in 0.2s ease-out;
        }

        .animate-scale-up {
            animation: scale-up 0.2s ease-out;
        }
    </style>
</div>
