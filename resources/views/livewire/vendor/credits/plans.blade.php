<div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-fuchsia-950/20">

    {{-- Animated background --}}
    <div
        class="fixed inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-fuchsia-100/30 via-transparent to-cyan-100/30 dark:from-fuchsia-950/30 dark:via-transparent dark:to-cyan-950/30 animate-gradient-slow">
    </div>

    {{-- ── Stripe redirect handler ── --}}
    {{-- This is the KEY fix: Livewire cannot redirect to external URLs like Stripe. --}}
    {{-- We listen for the 'stripe-redirect' event dispatched from the component --}}
    {{-- and do a plain window.location redirect instead. --}}
    <div x-data="{}" x-on:stripe-redirect.window="window.location.href = $event.detail.url"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 relative z-10">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div
                class="mb-4 p-5 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/50 dark:to-teal-950/50 border border-emerald-200 dark:border-emerald-800/50 flex items-center gap-4 shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                    <flux:icon.check-circle class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                </div>
                <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200 flex-1">{{ session('success') }}
                </p>
                <button onclick="this.parentElement.remove()"
                    class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800">
                    <flux:icon.x-mark class="w-5 h-5" />
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="mb-4 p-5 rounded-2xl bg-gradient-to-r from-rose-50 to-pink-50 dark:from-rose-950/50 dark:to-pink-950/50 border border-rose-200 dark:border-rose-800/50 flex items-center gap-4 shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-900/50 flex items-center justify-center">
                    <flux:icon.x-circle class="w-6 h-6 text-rose-600 dark:text-rose-400" />
                </div>
                <p class="text-sm font-semibold text-rose-800 dark:text-rose-200 flex-1">{{ session('error') }}</p>
                <button onclick="this.parentElement.remove()"
                    class="text-rose-600 dark:text-rose-400 hover:text-rose-800">
                    <flux:icon.x-mark class="w-5 h-5" />
                </button>
            </div>
        @endif

        {{-- ========== SUBSCRIPTION PLANS SECTION ========== --}}
        <div x-data="{ cycle: 'quarterly' }" class="text-center mb-8">
            <h1
                class="text-4xl md:text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">
                Choose the Plan That Fits Your Business
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">{{ $categoryName ?? 'Cakes And Bakes' }} Pricing
            </p>

            {{-- Billing Toggle --}}
            <div class="flex justify-center gap-4 mt-6">
                <button @click="cycle = 'monthly'"
                    :class="cycle === 'monthly' ? 'bg-indigo-600 text-white shadow-lg' :
                        'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'"
                    class="px-6 py-2 rounded-full font-semibold transition-all duration-200">Monthly</button>
                <button @click="cycle = 'quarterly'"
                    :class="cycle === 'quarterly' ? 'bg-indigo-600 text-white shadow-lg' :
                        'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'"
                    class="px-6 py-2 rounded-full font-semibold transition-all duration-200">
                    Quarterly <span class="text-xs font-bold text-green-500">5%</span>
                </button>
                <button @click="cycle = 'annually'"
                    :class="cycle === 'annually' ? 'bg-indigo-600 text-white shadow-lg' :
                        'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'"
                    class="px-6 py-2 rounded-full font-semibold transition-all duration-200">
                    Annual <span class="text-xs font-bold text-green-500">-10%</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                @foreach ($plans as $plan)
                    @php
                        $finalMonthly = $plan->monthly_price;
                        $finalQuarterly = ($plan->quarterly_price * 95) / 100;
                        $finalAnnual = ($plan->yearly_price * 90) / 100;
                    @endphp
                    <div
                        class="group relative bg-white dark:bg-zinc-800/50 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 overflow-hidden flex flex-col">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                        <div class="p-6 flex-1">
                            @if ($plan->badge)
                                <div
                                    class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 mb-4">
                                    {{ $plan->badge }}
                                </div>
                            @endif
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $plan->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $plan->description }}</p>
                            <div class="mb-6">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-3xl font-black text-indigo-600 dark:text-indigo-400">
                                        <span x-show="cycle === 'monthly'">Rs
                                            {{ number_format($finalMonthly, 2) }}</span>
                                        <span x-show="cycle === 'quarterly'">Rs
                                            {{ number_format($finalQuarterly, 2) }}</span>
                                        <span x-show="cycle === 'annually'">Rs
                                            {{ number_format($finalAnnual, 2) }}</span>
                                    </span>
                                    <span x-show="cycle === 'quarterly'" class="text-sm line-through text-gray-400">Rs
                                        {{ number_format($plan->quarterly_price, 2) }}</span>
                                    <span x-show="cycle === 'annually'" class="text-sm line-through text-gray-400">Rs
                                        {{ number_format($plan->yearly_price, 2) }}</span>
                                    <span x-show="cycle === 'quarterly'"
                                        class="ml-2 text-xs font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">5%
                                        OFF</span>
                                    <span x-show="cycle === 'annually'"
                                        class="ml-2 text-xs font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">10%
                                        OFF</span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <flux:icon.calendar class="inline w-4 h-4 mr-1" />
                                    <span
                                        x-text="cycle === 'monthly' ? 'Monthly billing' : (cycle === 'quarterly' ? 'Quarterly billing' : 'Annual billing')"></span>
                                </p>
                            </div>
                            <button x-on:click="$wire.openPurchaseModal('plan', {{ $plan->id }}, cycle)"
                                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold shadow-md transition-all flex items-center justify-center gap-2">
                                <flux:icon.shopping-cart class="w-5 h-5" />
                                Buy Now
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Feature Comparison Table --}}
        @if (isset($plans) &&
                $plans instanceof \Illuminate\Support\Collection &&
                $plans->isNotEmpty() &&
                $plans->first()->features &&
                $plans->first()->features->isNotEmpty())
            <div
                class="mt-12 bg-white/80 dark:bg-zinc-800/40 rounded-2xl p-6 backdrop-blur-sm border border-gray-200 dark:border-zinc-700">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">Compare Plans</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Features</th>
                                @foreach ($plans as $plan)
                                    <th
                                        class="px-4 py-3 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        {{ $plan->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                            @php $allFeatures = $plans->flatMap->features->unique('id'); @endphp
                            @foreach ($allFeatures as $feature)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $feature->name }}
                                    </td>
                                    @foreach ($plans as $plan)
                                        <td class="px-4 py-3 text-center">
                                            @if ($plan->features && $plan->features->contains($feature->id))
                                                <flux:icon.check class="w-5 h-5 text-green-500 mx-auto" />
                                            @else
                                                <flux:icon.x-mark class="w-5 h-5 text-red-400 mx-auto" />
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- ========== AD CREDITS SECTION ========== --}}
        <div class="mt-16 pt-8 border-t border-gray-200 dark:border-zinc-700">
            <div class="text-center mb-8">
                <h2
                    class="text-3xl md:text-4xl font-black bg-gradient-to-r from-amber-600 to-orange-600 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">
                    Ad Credits
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Boost your vendor visibility</p>
                <p class="text-gray-500 dark:text-gray-500 mt-1">Redeem ad credits for engagement, promotions and more
                    to boost your business visibility.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($creditPlans as $plan)
                    @php
                        $finalPrice = $plan->price;
                        $discount = $plan->discounted_percentage;
                        if ($discount) {
                            $finalPrice = ($plan->price * (100 - $discount)) / 100;
                        }
                    @endphp
                    <div
                        class="group relative bg-white dark:bg-zinc-800/50 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 hover:shadow-2xl hover:shadow-amber-500/20 transition-all duration-300 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                        <div class="p-6">
                            @if ($plan->image)
                                <div class="mb-4 flex justify-center">
                                    <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->name }}"
                                        class="h-16 w-16 object-contain">
                                </div>
                            @endif
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $plan->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $plan->description }}</p>
                            <div class="mb-6">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-3xl font-black text-amber-600 dark:text-amber-400">
                                        Rs {{ number_format($finalPrice, 2) }}
                                    </span>
                                    @if ($discount)
                                        <span class="text-sm line-through text-gray-400">Rs
                                            {{ number_format($plan->price, 2) }}</span>
                                        <span
                                            class="ml-2 text-xs font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">{{ $discount }}%
                                            OFF</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <flux:icon.star class="inline w-4 h-4 mr-1 text-amber-400" />
                                    {{ $plan->no_of_credits }} Credits
                                </p>
                            </div>
                            <button wire:click="openPurchaseModal('credit', {{ $plan->id }})"
                                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold shadow-md transition-all flex items-center justify-center gap-2">
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

    {{-- ── Purchase Modal ── --}}
    @if ($showPurchaseModal && $selectedItem)
        <div
            class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-[60] animate-fade-in">
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-lg w-full border border-white/20 dark:border-zinc-800 animate-scale-up">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Purchase Details</h3>

                    {{-- Selected Item --}}
                    <div class="mb-4 p-4 bg-gray-50 dark:bg-zinc-800 rounded-lg">
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $selectedItem['name'] }}</h4>
                        @if ($selectedItem['type'] === 'credit')
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $selectedItem['credits'] }} Credits
                            </p>
                            <div class="flex items-center gap-2 mt-2">
                                <button wire:click="updateSelectedQuantity({{ $selectedQuantity - 1 }})"
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600 flex items-center justify-center"
                                    {{ $selectedQuantity <= 1 ? 'disabled' : '' }}>-</button>
                                <span class="text-sm font-medium">{{ $selectedQuantity }}</span>
                                <button wire:click="updateSelectedQuantity({{ $selectedQuantity + 1 }})"
                                    class="w-8 h-8 rounded-full bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600 flex items-center justify-center">+</button>
                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">x Rs
                                    {{ number_format($selectedItem['price'], 2) }}</span>
                            </div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">Subtotal: Rs
                                {{ number_format($selectedItem['price'] * $selectedQuantity, 2) }}</p>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($selectedItem['cycle']) }}
                                Plan</p>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Price: Rs
                                {{ number_format($selectedItem['price'], 2) }}</p>
                        @endif
                    </div>

                    {{-- Add Plan for Credit --}}
                    @if ($selectedItem['type'] === 'credit')
                        <div class="mb-4">
                            <h5 class="font-semibold text-gray-900 dark:text-white mb-2">Add a Plan (Optional)</h5>
                            @if ($selectedPlanForPurchase)
                                <div
                                    class="p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-indigo-900 dark:text-indigo-200">
                                            {{ $selectedPlanForPurchase['name'] }}</p>
                                        <p class="text-sm text-indigo-700 dark:text-indigo-300">
                                            {{ ucfirst($selectedPlanForPurchase['cycle']) }} - Rs
                                            {{ number_format($selectedPlanForPurchase['price'], 2) }}</p>
                                    </div>
                                    <button wire:click="removePlanForPurchase"
                                        class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @else
                                <div class="space-y-2">
                                    <select wire:model="tempPlanId"
                                        class="w-full p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                                        <option value="">Select a plan</option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="flex gap-2">
                                        <button wire:click="$set('tempCycle', 'monthly')"
                                            :class="$wire.tempCycle === 'monthly' ? 'bg-indigo-600 text-white' :
                                                'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'"
                                            class="px-3 py-1 rounded text-sm">Monthly</button>
                                        <button wire:click="$set('tempCycle', 'quarterly')"
                                            :class="$wire.tempCycle === 'quarterly' ? 'bg-indigo-600 text-white' :
                                                'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'"
                                            class="px-3 py-1 rounded text-sm">Quarterly</button>
                                        <button wire:click="$set('tempCycle', 'annually')"
                                            :class="$wire.tempCycle === 'annually' ? 'bg-indigo-600 text-white' :
                                                'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300'"
                                            class="px-3 py-1 rounded text-sm">Annual</button>
                                    </div>
                                    <button wire:click="selectPlanForPurchase(tempPlanId, tempCycle)"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Add
                                        Plan</button>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Add Credits for Plan --}}
                    @if ($selectedItem['type'] === 'plan')
                        <div class="mb-4">
                            <h5 class="font-semibold text-gray-900 dark:text-white mb-2">Add Credits (Optional)</h5>
                            @if (!empty($selectedCreditsForPurchase))
                                <div class="space-y-2">
                                    @foreach ($selectedCreditsForPurchase as $index => $credit)
                                        <div
                                            class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg flex justify-between items-center">
                                            <div>
                                                <p class="font-medium text-amber-900 dark:text-amber-200">
                                                    {{ $credit['name'] }}</p>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <button
                                                        wire:click="updateCreditQuantity({{ $index }}, {{ $credit['quantity'] - 1 }})"
                                                        class="w-6 h-6 rounded-full bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600 flex items-center justify-center text-sm"
                                                        {{ $credit['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                                    <span class="text-sm">{{ $credit['quantity'] }}</span>
                                                    <button
                                                        wire:click="updateCreditQuantity({{ $index }}, {{ $credit['quantity'] + 1 }})"
                                                        class="w-6 h-6 rounded-full bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600 flex items-center justify-center text-sm">+</button>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">x Rs
                                                        {{ number_format($credit['price'], 2) }}</span>
                                                </div>
                                            </div>
                                            <button wire:click="updateCreditQuantity({{ $index }}, 0)"
                                                class="text-red-500 hover:text-red-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mt-2">
                                <select wire:model="tempCreditId"
                                    class="w-full p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                                    <option value="">Select credits to add</option>
                                    @foreach ($creditPlans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                                <button wire:click="addCreditToPurchase($wire.tempCreditId)"
                                    class="mt-2 px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Add
                                    Credits</button>
                            </div>
                        </div>
                    @endif

                    {{-- Total --}}
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <p class="text-lg font-bold text-green-900 dark:text-green-200">Total: Rs
                            {{ number_format($this->getPurchaseTotalProperty(), 2) }}</p>
                    </div>

                    {{-- Business Selection --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select
                            Business</label>
                        <select wire:model="selectedBusinessIdForCart"
                            class="w-full p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                            <option value="">-- Select a business --</option>
                            @foreach ($businesses as $business)
                                <option value="{{ $business->id }}">{{ $business->company_name }}</option>
                            @endforeach
                        </select>
                        @error('selectedBusinessIdForCart')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3">
                        <button wire:click="closePurchaseModal"
                            class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                        <button wire:click="proceedToPayment" wire:loading.attr="disabled"
                            class="px-6 py-2 rounded-xl bg-gradient-to-r from-green-600 to-blue-600 text-white font-semibold shadow-md hover:shadow-lg transition disabled:opacity-60 disabled:cursor-not-allowed flex items-center gap-2">
                            <span wire:loading.remove>
                                <flux:icon.credit-card class="w-4 h-4" />
                                Proceed to Payment
                            </span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ── Confirmation Modal: Subscription Plan ── --}}
    @if (isset($showPlanConfirmModal) && $showPlanConfirmModal && isset($selectedPlan) && $selectedPlan)
        <div
            class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-[60] animate-fade-in">
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 animate-scale-up">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Confirm Subscription</h3>
                    <div class="space-y-4">
                        <p class="text-gray-700 dark:text-gray-300">Plan: <strong>{{ $selectedPlan->name }}</strong>
                        </p>
                        <p class="text-gray-700 dark:text-gray-300">Billing Cycle:
                            <strong>{{ isset($selectedCycle) ? ucfirst($selectedCycle) : '' }}</strong>
                        </p>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select
                                Business</label>
                            <select wire:model="selectedBusinessId"
                                class="w-full p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                                <option value="">-- Select a business --</option>
                                @foreach ($businesses as $business)
                                    <option value="{{ $business->id }}">{{ $business->company_name }}</option>
                                @endforeach
                            </select>
                            @error('selectedBusinessId')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <p class="text-gray-700 dark:text-gray-300">Total: <strong
                                class="text-indigo-600 dark:text-indigo-400">Rs
                                {{ isset($selectedPrice) ? number_format($selectedPrice, 2) : '' }}</strong></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">By confirming, you agree to the
                            subscription terms. Your card will be charged accordingly.</p>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button wire:click="cancelPlanConfirm"
                            class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-zinc-600 transition">Cancel</button>
                        <button wire:click="confirmPlanPurchase"
                            class="px-6 py-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-md hover:shadow-lg transition">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ── Confirmation Modal: Ad Credits ── --}}
    @if (isset($showCreditConfirmModal) && $showCreditConfirmModal && isset($selectedCreditPlan) && $selectedCreditPlan)
        @php
            $modalFinalPrice = $selectedCreditPlan->price;
            if ($selectedCreditPlan->discounted_percentage) {
                $modalFinalPrice =
                    ($selectedCreditPlan->price * (100 - $selectedCreditPlan->discounted_percentage)) / 100;
            }
        @endphp
        <div
            class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-[60] animate-fade-in">
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full border border-white/20 dark:border-zinc-800 animate-scale-up">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Confirm Purchase</h3>

                    @if ($processingPayment)
                        {{-- Loading state while Stripe session is being created --}}
                        <div class="flex flex-col items-center justify-center py-8 gap-4">
                            <svg class="animate-spin h-10 w-10 text-amber-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <p class="text-gray-600 dark:text-gray-300 font-medium">Redirecting to payment...</p>
                            <p class="text-xs text-gray-400">Please do not close this window.</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            <p class="text-gray-700 dark:text-gray-300">Package:
                                <strong>{{ $selectedCreditPlan->name }}</strong>
                            </p>
                            <p class="text-gray-700 dark:text-gray-300">Ad Credits:
                                <strong>{{ $selectedCreditPlan->no_of_credits }}</strong>
                            </p>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select
                                    Business</label>
                                <select wire:model="selectedBusinessIdForCredits"
                                    class="w-full p-2 border rounded-lg dark:bg-zinc-800 dark:border-zinc-700">
                                    <option value="">-- Select a business --</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->id }}">{{ $business->company_name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedBusinessIdForCredits')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <p class="text-gray-700 dark:text-gray-300">Total: <strong
                                    class="text-amber-600 dark:text-amber-400">Rs
                                    {{ number_format($modalFinalPrice, 2) }}</strong></p>

                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                You will be redirected to Stripe's secure checkout to complete your payment.
                            </p>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button wire:click="cancelCreditConfirm"
                                class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-zinc-600 transition">
                                Cancel
                            </button>
                            <button wire:click="confirmCreditPurchase" wire:loading.attr="disabled"
                                class="px-6 py-2 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold shadow-md hover:shadow-lg transition disabled:opacity-60 disabled:cursor-not-allowed flex items-center gap-2">
                                <span wire:loading.remove wire:target="confirmCreditPurchase">
                                    <flux:icon.credit-card class="w-4 h-4 inline mr-1" />
                                    Pay Now
                                </span>
                                <span wire:loading wire:target="confirmCreditPurchase"
                                    class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    @endif
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

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradient-slow {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.2s ease-out;
        }

        .animate-scale-up {
            animation: scale-up 0.2s ease-out;
        }

        .animate-slide-down {
            animation: slide-down 0.3s ease-out;
        }

        .animate-gradient-slow {
            animation: gradient-slow 8s ease-in-out infinite;
        }
    </style>
</div>
