<div
    class="min-h-screen bg-linear-to-br from-slate-50 via-white to-indigo-50 dark:from-zinc-950 dark:via-zinc-900 dark:to-fuchsia-950/20">

    {{-- Animated background --}}
    <div
        class="fixed inset-0 -z-10 bg-[radial-gradient(ellipse_at_top_right,var(--tw-gradient-stops))] from-fuchsia-100/30 via-transparent to-cyan-100/30 dark:from-fuchsia-950/30 dark:via-transparent dark:to-cyan-950/30 animate-gradient-slow">
    </div>

    {{-- ── Stripe redirect handler ── --}}
    <div x-data="{}" @stripe-redirect.window="window.location.href = $event.detail.url"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 relative z-10">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div
                class="mb-4 p-5 rounded-2xl bg-linear-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/50 dark:to-teal-950/50 border border-emerald-200 dark:border-emerald-800/50 flex items-center gap-4 shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                    <x-heroicon-s-check-circle class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                </div>
                <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-200 flex-1">{{ session('success') }}
                </p>
                <button onclick="this.parentElement.remove()"
                    class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800">
                    <x-heroicon-s-x-mark class="w-5 h-5" />
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="mb-4 p-5 rounded-2xl bg-linear-to-r from-rose-50 to-pink-50 dark:from-rose-950/50 dark:to-pink-950/50 border border-rose-200 dark:border-rose-800/50 flex items-center gap-4 shadow-lg backdrop-blur-sm animate-slide-down">
                <div class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-900/50 flex items-center justify-center">
                    <x-heroicon-s-x-circle class="w-6 h-6 text-rose-600 dark:text-rose-400" />
                </div>
                <p class="text-sm font-semibold text-rose-800 dark:text-rose-200 flex-1">{{ session('error') }}</p>
                <button onclick="this.parentElement.remove()"
                    class="text-rose-600 dark:text-rose-400 hover:text-rose-800">
                    <x-heroicon-s-x-mark class="w-5 h-5" />
                </button>
            </div>
        @endif

        {{-- ========== SUBSCRIPTION PLANS SECTION ========== --}}
        <div x-data="{ cycle: 'quarterly' }" class="text-center mb-8">
            <h1
                class="text-4xl md:text-5xl font-black bg-linear-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">
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
                    Quarterly <span class="text-xs font-bold text-green-500">-5%</span>
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
                        $finalMonthly = (float) $plan->monthly_price;
                        $finalQuarterly = round(($plan->quarterly_price * 95) / 100, 2);
                        $finalAnnual = round(($plan->yearly_price * 90) / 100, 2);
                    @endphp
                    <div
                        class="group relative bg-white dark:bg-zinc-800/50 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 overflow-hidden flex flex-col">
                        <div
                            class="absolute inset-0 bg-linear-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
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
                                    <x-heroicon-s-calendar-days class="inline w-4 h-4 mr-1" />
                                    <span
                                        x-text="cycle === 'monthly' ? 'Monthly billing' : (cycle === 'quarterly' ? 'Quarterly billing' : 'Annual billing')"></span>
                                </p>
                            </div>
                            <button @click="$wire.openPurchaseModal('plan', {{ $plan->id }}, cycle)"
                                class="w-full py-3 px-4 rounded-xl bg-linear-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold shadow-md transition-all flex items-center justify-center gap-2">
                                <x-heroicon-s-shopping-bag class="w-5 h-5" />
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
                                                <x-heroicon-s-check class="w-5 h-5 text-green-500 mx-auto" />
                                            @else
                                                <x-heroicon-s-x-mark class="w-5 h-5 text-red-400 mx-auto" />
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
                    class="text-3xl md:text-4xl font-black bg-linear-to-r from-amber-600 to-orange-600 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">
                    Ad Credits
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Boost your vendor visibility</p>
                <p class="text-gray-500 dark:text-gray-500 mt-1">Redeem ad credits for engagement, promotions and more
                    to boost your business visibility.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($credits as $plan)
                    @php
                        $finalPrice = (float) $plan->price;
                        $discount = $plan->discounted_percentage;
                        if ($discount > 0) {
                            $finalPrice = round(($plan->price * (100 - $discount)) / 100, 2);
                        }
                    @endphp
                    <div
                        class="group relative bg-white dark:bg-zinc-800/50 rounded-2xl shadow-lg border border-gray-200 dark:border-zinc-700 hover:shadow-2xl hover:shadow-amber-500/20 transition-all duration-300 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-linear-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700">
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
                                    @if ($discount > 0)
                                        <span class="text-sm line-through text-gray-400">Rs
                                            {{ number_format($plan->price, 2) }}</span>
                                        <span
                                            class="ml-2 text-xs font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">{{ $discount }}%
                                            OFF</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <x-heroicon-s-star class="inline w-4 h-4 mr-1 text-amber-400" />
                                    {{ $plan->no_of_credits }} Credits
                                </p>
                            </div>
                            <button @click="$wire.openPurchaseModal('credit', {{ $plan->id }})"
                                class="w-full py-3 px-4 rounded-xl bg-linear-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-semibold shadow-md transition-all flex items-center justify-center gap-2">
                                <x-heroicon-s-shopping-bag class="w-5 h-5" />
                                Buy Now
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                <x-heroicon-s-shield-check class="inline w-5 h-5 mr-1 text-green-500" />
                Your data and payments are always safe with us!
            </div>
        </div>
    </div>

    {{-- ── Purchase Modal ── --}}
    @if ($showPurchaseModal && $selectedItem)
        <div
            class="fixed inset-0 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 z-60 animate-fade-in">
            <div
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-4xl w-full border border-white/20 dark:border-zinc-800 animate-scale-up max-h-[85vh] overflow-y-auto mx-4 my-8">
                <div class="p-8">
                    {{-- Header --}}
                    <div class="flex items-center gap-4 mb-8">
                        @if ($selectedItem['type'] === 'credit')
                            <div class="w-14 h-14 rounded-2xl bg-linear-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                                <x-heroicon-s-star class="w-7 h-7 text-white" />
                            </div>
                        @else
                            <div class="w-14 h-14 rounded-2xl bg-linear-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <x-heroicon-s-sparkles class="w-7 h-7 text-white" />
                            </div>
                        @endif
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">Flexible Purchase</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-base">Mix and match plans & credits for the best value</p>
                        </div>
                    </div>

                    {{-- Selected Item --}}
                    <div class="mb-8 p-6 bg-linear-to-r from-gray-50 to-gray-100 dark:from-zinc-800 dark:to-zinc-700 rounded-xl border border-gray-200 dark:border-zinc-600">
                        <div class="flex items-center gap-4 mb-4">
                            @if ($selectedItem['type'] === 'credit')
                                <x-heroicon-s-star class="w-6 h-6 text-amber-500" />
                            @else
                                <x-heroicon-s-sparkles class="w-6 h-6 text-indigo-500" />
                            @endif
                            <h4 class="font-bold text-gray-900 dark:text-white text-xl">{{ $selectedItem['name'] }}</h4>
                        </div>
                        @if ($selectedItem['type'] === 'credit')
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-2">
                                <x-heroicon-s-gift class="w-4 h-4 text-amber-500" />
                                {{ $selectedItem['credits'] }} Credits per unit
                            </p>
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex items-center gap-2 bg-white dark:bg-zinc-900 rounded-lg p-2 border border-gray-300 dark:border-zinc-600">
                                    <button wire:click="updateSelectedQuantity({{ $selectedQuantity - 1 }})"
                                        class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 hover:bg-amber-200 dark:hover:bg-amber-900/50 flex items-center justify-center transition"
                                        {{ $selectedQuantity <= 1 ? 'disabled' : '' }}>
                                        <x-heroicon-s-minus class="w-4 h-4" />
                                    </button>
                                    <span
                                        class="text-lg font-semibold text-gray-900 dark:text-white min-w-8 text-center">{{ $selectedQuantity }}</span>
                                    <button wire:click="updateSelectedQuantity({{ $selectedQuantity + 1 }})"
                                        class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 hover:bg-amber-200 dark:hover:bg-amber-900/50 flex items-center justify-center transition">
                                        <x-heroicon-s-plus class="w-4 h-4" />
                                    </button>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <p>x Rs {{ number_format($selectedItem['price'], 2) }}</p>
                                    <p class="font-semibold text-amber-600 dark:text-amber-400">Subtotal: Rs
                                        {{ number_format($selectedItem['price'] * $selectedQuantity, 2) }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-2">
                                <x-heroicon-s-calendar-days class="w-4 h-4 text-indigo-500" />
                                {{ ucfirst($selectedItem['cycle']) }} Plan
                            </p>
                            <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">Price: Rs
                                {{ number_format($selectedItem['price'], 2) }}</p>
                        @endif
                    </div>

                    {{-- Add Plan for Credit --}}
                    @if ($selectedItem['type'] === 'credit')
                        <div class="mb-8 p-6 bg-linear-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl border-2 border-indigo-300 dark:border-indigo-700">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/40 rounded-lg">
                                        <x-heroicon-s-sparkles class="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900 dark:text-white text-lg">Optional: Add a Subscription Plan</h5>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Get recurring subscription benefits with your credit purchase</p>
                                    </div>
                                </div>
                                @if ($selectedPlanForPurchase)
                                    <span class="px-3 py-1 text-xs font-bold text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-full">Added</span>
                                @endif
                            </div>

                            @if ($selectedPlanForPurchase)
                                <div class="p-4 bg-white dark:bg-zinc-800 rounded-lg border-2 border-green-400 dark:border-green-600 mb-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-3">
                                            <x-heroicon-s-check-circle class="w-5 h-5 text-green-500" />
                                            <div>
                                                <p class="font-semibold text-gray-900 dark:text-white">{{ $selectedPlanForPurchase['name'] }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                                    <x-heroicon-s-calendar-days class="w-4 h-4" />
                                                    {{ ucfirst($selectedPlanForPurchase['cycle']) }} Billing - Rs {{ number_format($selectedPlanForPurchase['price'], 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <button wire:click="removePlanForPurchase" title="Remove this plan" class="text-red-500 hover:text-red-700 transition">
                                            <x-heroicon-s-x-mark class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                                <button wire:click="removePlanForPurchase" class="w-full px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 transition font-medium flex items-center justify-center gap-2">
                                    <x-heroicon-s-trash class="w-4 h-4" />
                                    Remove Plan
                                </button>
                            @else
                                <div class="space-y-4 bg-white/50 dark:bg-zinc-900/20 p-4 rounded-lg" x-data="{ planSelected: @entangle('tempPlanId') }">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            <x-heroicon-s-list-bullet class="w-4 h-4 inline mr-1" />
                                            Select a Plan
                                        </label>
                                        <select wire:model.live="tempPlanId" class="w-full p-3 border-2 border-gray-300 dark:border-zinc-600 rounded-lg dark:bg-zinc-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition font-medium">
                                            <option value="">-- Choose a plan --</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->name }} - Rs {{ number_format($plan->monthly_price, 2) }}/month base</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                            <x-heroicon-s-calendar-days class="w-4 h-4 inline mr-1" />
                                            Choose Billing Cycle
                                        </label>
                                        <div class="grid grid-cols-3 gap-2">
                                            <button wire:click="$set('tempCycle', 'monthly')" type="button" class="px-3 py-2 rounded-lg text-xs font-bold transition {{ $tempCycle === 'monthly' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600' }}">
                                                Monthly
                                            </button>
                                            <button wire:click="$set('tempCycle', 'quarterly')" type="button" class="px-3 py-2 rounded-lg text-xs font-bold transition {{ $tempCycle === 'quarterly' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600' }}">
                                                Quarterly
                                                <span class="text-xs text-green-500 block">-5%</span>
                                            </button>
                                            <button wire:click="$set('tempCycle', 'annually')" type="button" class="px-3 py-2 rounded-lg text-xs font-bold transition {{ $tempCycle === 'annually' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-zinc-600' }}">
                                                Annual
                                                <span class="text-xs text-green-500 block">-10%</span>
                                            </button>
                                        </div>
                                    </div>

                                    <button wire:click="selectPlanForPurchase($wire.tempPlanId, '{{ $tempCycle }}')" x-bind:disabled="!planSelected" type="button" class="w-full px-4 py-3 bg-linear-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition font-bold flex items-center justify-center gap-2 shadow-md disabled:opacity-40 disabled:cursor-not-allowed disabled:from-gray-400 disabled:to-gray-500">
                                        <x-heroicon-s-plus class="w-5 h-5" />
                                        Add Plan to Purchase
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Add Credits for Plan --}}
                    @if ($selectedItem['type'] === 'plan')
                        <div class="mb-8 p-6 bg-linear-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl border-2 border-amber-300 dark:border-amber-700">
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-amber-100 dark:bg-amber-900/40 rounded-lg">
                                        <x-heroicon-s-star class="w-6 h-6 text-amber-600 dark:text-amber-400" />
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-gray-900 dark:text-white text-lg">Optional: Add Ad Credits</h5>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Boost your visibility with additional ad credits alongside your plan</p>
                                    </div>
                                </div>
                                @if (!empty($selectedCreditsForPurchase))
                                    <span class="px-3 py-1 text-xs font-bold text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900/30 rounded-full whitespace-nowrap">{{ count($selectedCreditsForPurchase) }} Added</span>
                                @endif
                            </div>

                            @if (!empty($selectedCreditsForPurchase))
                                <div class="space-y-3 mb-6 p-4 bg-white dark:bg-zinc-800 rounded-lg border-2 border-green-400 dark:border-green-600">
                                    <h6 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                        <x-heroicon-s-check-circle class="w-5 h-5 text-green-500" />
                                        Selected Credits
                                    </h6>
                                    <div class="space-y-2">
                                        @foreach ($selectedCreditsForPurchase as $index => $credit)
                                            <div class="flex justify-between items-center bg-gray-50 dark:bg-zinc-900 p-3 rounded-lg">
                                                <div class="flex items-center gap-3 flex-1">
                                                    <x-heroicon-s-gift class="w-5 h-5 text-amber-500" />
                                                    <div>
                                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $credit['name'] }}</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $credit['credits'] }} credits per unit</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <div class="flex items-center gap-1 bg-amber-100 dark:bg-amber-900/30 rounded p-1">
                                                        <button wire:click="updateCreditQuantity({{ $index }}, {{ $credit['quantity'] - 1 }})" type="button" class="w-5 h-5 rounded-full bg-amber-600 text-white hover:bg-amber-700 flex items-center justify-center text-xs transition" {{ $credit['quantity'] <= 1 ? 'disabled' : '' }}>
                                                            <x-heroicon-s-minus class="w-2 h-2" />
                                                        </button>
                                                        <span class="text-sm font-bold min-w-6 text-center text-amber-900 dark:text-amber-200">{{ $credit['quantity'] }}</span>
                                                        <button wire:click="updateCreditQuantity({{ $index }}, {{ $credit['quantity'] + 1 }})" type="button" class="w-5 h-5 rounded-full bg-amber-600 text-white hover:bg-amber-700 flex items-center justify-center text-xs transition">
                                                            <x-heroicon-s-plus class="w-2 h-2" />
                                                        </button>
                                                    </div>
                                                    <span class="text-sm font-bold text-amber-600 dark:text-amber-400 min-w-max">Rs {{ number_format($credit['price'] * $credit['quantity'], 2) }}</span>
                                                    <button wire:click="updateCreditQuantity({{ $index }}, 0)" type="button" class="text-red-500 hover:text-red-700 transition p-1">
                                                        <x-heroicon-s-trash class="w-4 h-4" />
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-4 bg-white/50 dark:bg-zinc-900/20 p-4 rounded-lg" x-data="{ creditSelected: @entangle('tempCreditId') }">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <x-heroicon-s-list-bullet class="w-4 h-4 inline mr-1" />
                                        Select Credit Package
                                    </label>
                                    <select wire:model.live="tempCreditId" class="w-full p-3 border-2 border-gray-300 dark:border-zinc-600 rounded-lg dark:bg-zinc-800 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition font-medium">
                                        <option value="">-- Choose credits to add --</option>
                                        @foreach ($credits as $credit)
                                            <option value="{{ $credit->id }}">{{ $credit->name }} - {{ $credit->no_of_credits }} Credits @ Rs {{ number_format($credit->price, 2) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button wire:click="addCreditToPurchase($wire.tempCreditId)" x-bind:disabled="!creditSelected" type="button" class="w-full px-4 py-3 bg-linear-to-r from-amber-600 to-orange-600 text-white rounded-lg hover:from-amber-700 hover:to-orange-700 transition font-bold flex items-center justify-center gap-2 shadow-md disabled:opacity-40 disabled:cursor-not-allowed disabled:from-gray-400 disabled:to-gray-500">
                                    <x-heroicon-s-plus class="w-5 h-5" />
                                    Add Credits to Purchase
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- Total --}}
                    <div class="mb-8 p-6 bg-linear-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border border-green-200 dark:border-green-800">
                        <div class="flex items-center gap-4">
                            <x-heroicon-s-currency-dollar class="w-7 h-7 text-green-500" />
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Amount</p>
                                <p class="text-3xl font-bold text-green-900 dark:text-green-200">Rs {{ number_format($this->getPurchaseTotalProperty(), 2) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Business Selection --}}
                    <div class="mb-8">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                            <x-heroicon-s-building-storefront class="w-5 h-5 text-gray-500" />
                            Select Business <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="selectedBusinessIdForCart"
                            class="w-full p-4 border border-gray-300 rounded-lg dark:bg-zinc-800 dark:border-zinc-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-base">
                            <option value="">-- Choose your business --</option>
                            @foreach ($businesses as $business)
                                <option value="{{ $business->id }}">{{ $business->company_name }}</option>
                            @endforeach
                        </select>
                        @error('selectedBusinessIdForCart')
                            <span class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <x-heroicon-s-exclamation-triangle class="w-4 h-4" />
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3">
                        <button wire:click="closePurchaseModal"
                            class="px-6 py-3 rounded-xl bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-zinc-600 transition font-medium flex items-center gap-2">
                            <x-heroicon-s-x-mark class="w-4 h-4" />
                            Cancel
                        </button>
                        <button wire:click="proceedToPayment" wire:loading.attr="disabled"
                            class="px-6 py-3 rounded-xl bg-linear-to-r from-green-600 to-blue-600 text-white font-semibold shadow-md hover:shadow-lg transition disabled:opacity-60 disabled:cursor-not-allowed flex items-center gap-2">
                            <span wire:loading.remove>
                                <x-heroicon-s-credit-card class="w-5 h-5" />
                                Proceed to Payment
                            </span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
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
