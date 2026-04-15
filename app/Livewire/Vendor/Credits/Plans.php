<?php

namespace App\Livewire\Vendor\Credits;

use App\Models\Subscription\Plan;
use App\Models\Subscription\Credits;
use App\Models\Subscription\PlanTransaction;
use App\Models\Subscription\Subscription;
use App\Models\Business\Business;
use App\Models\Vendor\VendorPurchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Layout('components.layouts.vendor.vendor')]
class Plans extends Component
{
    // ── Subscription plan state ───────────────────────────────────────────────
    public $plans           = [];
    public $selectedPlan    = null;
    public $selectedCycle   = null;
    public $selectedPrice   = null;
    public bool $showPlanConfirmModal = false;
    public $selectedBusinessId        = null;

    // ── Ad credits state ──────────────────────────────────────────────────────
    public $credits                  = [];
    public $selectedCreditPlan           = null;
    public bool $showCreditConfirmModal  = false;
    public $selectedBusinessIdForCredits = null;
    public bool $processingPayment       = false;

    // ── Cart state ───────────────────────────────────────────────────────────
    public $cart = [];
    public $selectedBusinessIdForCart = null;
    public bool $showCartModal = false;
    public bool $processingCartPayment = false;

    // ── Purchase Modal state ─────────────────────────────────────────────────
    public bool $showPurchaseModal = false;
    public $selectedItem = null;
    public int $selectedQuantity = 1;
    public $selectedPlanForPurchase = null;
    public $selectedCreditsForPurchase = [];
    public $tempPlanId = null;
    public $tempCreditId = null;
    public $tempCycle = 'quarterly';

    // ── Shared ────────────────────────────────────────────────────────────────
    public $businesses = [];

    public function mount(): void
    {
        $this->loadBusinesses();
        $this->loadSubscriptionPlans();
        $this->loadcredits();
        $this->selectedBusinessIdForCart = $this->businesses->isNotEmpty() ? $this->businesses->first()->id : null;
    }

    public function loadBusinesses(): void
    {
        $vendor = Auth::guard('vendor')->user();
        $this->businesses = $vendor->businesses()->select('id', 'company_name')->get();
    }

    public function loadSubscriptionPlans(): void
    {
        $this->plans = Plan::with('features')->orderBy('monthly_price')->get();
    }

    public function loadcredits(): void
    {
        $this->credits = Credits::orderBy('price')->get();
    }

    // ── Subscription plan flow ────────────────────────────────────────────────

    public function buyPlan(int $planId, string $cycle): void
    {
        $plan = Plan::find($planId);

        if (! $plan) {
            session()->flash('error', 'Plan not found.');
            return;
        }

        $basePrice = match ($cycle) {
            'monthly'   => $plan->monthly_price,
            'quarterly' => $plan->quarterly_price,
            'annually'  => $plan->yearly_price,
            default     => $plan->quarterly_price,
        };

        $discountPercent = match ($cycle) {
            'quarterly' => 5,
            'annually'  => 10,
            default     => 0,
        };

        $this->selectedPlan  = $plan;
        $this->selectedCycle = $cycle;
        $this->selectedPrice = $discountPercent > 0
            ? $basePrice * (100 - $discountPercent) / 100
            : $basePrice;

        $this->selectedBusinessId = $this->businesses->isNotEmpty()
            ? $this->businesses->first()->id
            : null;

        $this->showPlanConfirmModal = true;
    }

    public function cancelPlanConfirm(): void
    {
        $this->showPlanConfirmModal = false;
        $this->selectedPlan         = null;
        $this->selectedCycle        = null;
        $this->selectedPrice        = null;
        $this->selectedBusinessId   = null;
    }

    public function confirmPlanPurchase(): void
    {
        $vendor = Auth::guard('vendor')->user();

        $this->validate(['selectedBusinessId' => 'required|exists:businesses,id']);

        $business = Business::where('id', $this->selectedBusinessId)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        // Do NOT create Subscription or PlanTransaction here
        // Wait for Stripe webhook confirmation for ACID safety

        $this->cart = [
            [
                'type' => 'plan',
                'id' => $this->selectedPlan->id,
                'name' => $this->selectedPlan->name,
                'cycle' => $this->selectedCycle,
                'price' => $this->selectedPrice,
            ]
        ];

        $this->selectedBusinessIdForCart = $this->selectedBusinessId;

        $this->checkout();
    }

    private function resolveEndDate(string $cycle): \Carbon\Carbon
    {
        return match ($cycle) {
            'monthly'   => now()->addMonth(),
            'quarterly' => now()->addQuarter(),
            'annually'  => now()->addYear(),
            default     => now()->addMonth(),
        };
    }

    // ── Ad credits flow ───────────────────────────────────────────────────────

    public function buyCreditPlan(int $planId): void
    {
        $plan = Credits::find($planId);

        if (! $plan) {
            session()->flash('error', 'Ad credits plan not found.');
            return;
        }

        $this->selectedCreditPlan = $plan;

        $this->selectedBusinessIdForCredits = $this->businesses->isNotEmpty()
            ? $this->businesses->first()->id
            : null;

        $this->showCreditConfirmModal = true;
        $this->processingPayment      = false;
    }

    public function cancelCreditConfirm(): void
    {
        $this->showCreditConfirmModal       = false;
        $this->selectedCreditPlan           = null;
        $this->selectedBusinessIdForCredits = null;
        $this->processingPayment            = false;
    }

    public function confirmCreditPurchase(): void
    {
        $this->validate([
            'selectedBusinessIdForCredits' => 'required|integer',
        ], [
            'selectedBusinessIdForCredits.required' => 'Please select a business.',
        ]);

        $vendor = Auth::guard('vendor')->user();

        $business = Business::where('id', $this->selectedBusinessIdForCredits)
            ->where('vendor_id', $vendor->id)
            ->first();

        if (! $business) {
            $this->addError('selectedBusinessIdForCredits', 'Business not found or does not belong to you.');
            return;
        }

        $plan = $this->selectedCreditPlan;

        if (! $plan) {
            session()->flash('error', 'No credit plan selected. Please try again.');
            $this->cancelCreditConfirm();
            return;
        }

        $finalPrice = round((float) $plan->price, 2);
        if ($plan->discounted_percentage > 0) {
            $finalPrice = round($finalPrice * (100 - $plan->discounted_percentage) / 100, 2);
        }

        if ($finalPrice <= 0) {
            session()->flash('error', 'Invalid price for this plan.');
            $this->cancelCreditConfirm();
            return;
        }

        $this->cart = [
            [
                'type' => 'credit',
                'id' => $plan->id,
                'name' => $plan->name,
                'quantity' => 1,
                'price' => $finalPrice,
                'credits' => $plan->no_of_credits,
            ]
        ];

        $this->selectedBusinessIdForCart = $this->selectedBusinessIdForCredits;

        $this->checkout();
    }

    // ── Cart methods ─────────────────────────────────────────────────────────

    public function addToCart($type, $id, $cycle = null)
    {
        if ($type === 'credit') {
            $plan = collect($this->credits)->firstWhere('id', $id);
            if (!$plan) return;

            $price = $plan->price;
            if ($plan->discounted_percentage > 0) {
                $price = $price * (100 - $plan->discounted_percentage) / 100;
            }

            $existingIndex = collect($this->cart)->search(fn($item) => $item['type'] === 'credit' && $item['id'] == $id);
            if ($existingIndex !== false) {
                $this->cart[$existingIndex]['quantity']++;
            } else {
                $this->cart[] = [
                    'type' => 'credit',
                    'id' => $id,
                    'name' => $plan->name,
                    'quantity' => 1,
                    'price' => $price,
                    'credits' => $plan->no_of_credits,
                ];
            }
        } elseif ($type === 'plan') {
            $plan = collect($this->plans)->firstWhere('id', $id);
            if (!$plan) return;

            $basePrice = match ($cycle) {
                'monthly' => $plan->monthly_price,
                'quarterly' => $plan->quarterly_price,
                'annually' => $plan->yearly_price,
                default => $plan->quarterly_price,
            };

            $discount = match ($cycle) {
                'quarterly' => 5,
                'annually' => 10,
                default => 0,
            };

            $price = $discount > 0 ? $basePrice * (100 - $discount) / 100 : $basePrice;

            // Remove any existing plan
            $this->cart = collect($this->cart)->reject(fn($item) => $item['type'] === 'plan')->toArray();

            $this->cart[] = [
                'type' => 'plan',
                'id' => $id,
                'name' => $plan->name,
                'cycle' => $cycle,
                'price' => $price,
            ];
        }
    }

    public function updateQuantity($index, $quantity)
    {
        if ($quantity < 1) {
            $this->removeFromCart($index);
        } else {
            $this->cart[$index]['quantity'] = $quantity;
        }
    }

    public function clearCart()
    {
        $this->cart = [];
        $this->showCartModal = false;
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(function ($item) {
            if ($item['type'] === 'credit') {
                return $item['price'] * $item['quantity'];
            } else {
                return $item['price'];
            }
        });
    }

    public function openCartModal()
    {
        $this->showCartModal = true;
    }

    public function closeCartModal()
    {
        $this->showCartModal = false;
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Cart is empty.');
            return;
        }

        $this->validate(['selectedBusinessIdForCart' => 'required|exists:businesses,id']);

        $vendor = Auth::guard('vendor')->user();

        $business = Business::find($this->selectedBusinessIdForCart);
        if (!$business || $business->vendor_id != $vendor->id) {
            session()->flash('error', 'Invalid business selected.');
            return;
        }

        $this->processingCartPayment = true;

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $lineItems = [];
            $metadata = [
                'vendor_id' => $vendor->id,
                'business_id' => $business->id,
                'cart' => json_encode($this->cart),
            ];

            foreach ($this->cart as $item) {
                if ($item['type'] === 'credit') {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $item['name'] . ' - ' . $item['credits'] . ' Credits',
                            ],
                            'unit_amount' => (int) round($item['price'] * 100),
                        ],
                        'quantity' => $item['quantity'],
                    ];
                } elseif ($item['type'] === 'plan') {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $item['name'] . ' - ' . ucfirst($item['cycle']) . ' Plan',
                            ],
                            'unit_amount' => (int) round($item['price'] * 100),
                        ],
                        'quantity' => 1,
                    ];
                }
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('vendor.credits.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('vendor.credits'),
                'metadata' => $metadata,
            ]);

            $this->dispatch('stripe-redirect', url: $session->url);
        } catch (\Exception $e) {
            Log::error('Cart checkout error: ' . $e->getMessage());
            session()->flash('error', 'Payment error: ' . $e->getMessage());
            $this->processingCartPayment = false;
        }
    }

    // ── Purchase Modal methods ───────────────────────────────────────────────

    public function openPurchaseModal($type, $id, $cycle = null)
    {
        if ($type === 'credit') {
            $plan = collect($this->credits)->firstWhere('id', $id);
            if (!$plan) return;

            $price = $plan->price;
            if ($plan->discounted_percentage > 0) {
                $price = $price * (100 - $plan->discounted_percentage) / 100;
            }

            $this->selectedItem = [
                'type' => 'credit',
                'id' => $id,
                'name' => $plan->name,
                'price' => $price,
                'credits' => $plan->no_of_credits,
            ];
            $this->selectedQuantity = 1;
            $this->selectedPlanForPurchase = null;
        } elseif ($type === 'plan') {
            $plan = collect($this->plans)->firstWhere('id', $id);
            if (!$plan) return;

            $basePrice = match ($cycle) {
                'monthly' => $plan->monthly_price,
                'quarterly' => $plan->quarterly_price,
                'annually' => $plan->yearly_price,
                default => $plan->quarterly_price,
            };

            $discount = match ($cycle) {
                'quarterly' => 5,
                'annually' => 10,
                default => 0,
            };

            $price = $discount > 0 ? $basePrice * (100 - $discount) / 100 : $basePrice;

            $this->selectedItem = [
                'type' => 'plan',
                'id' => $id,
                'name' => $plan->name,
                'cycle' => $cycle,
                'price' => $price,
            ];
            $this->selectedCreditsForPurchase = [];
        }

        $this->showPurchaseModal = true;
    }

    public function closePurchaseModal()
    {
        $this->showPurchaseModal = false;
        $this->selectedItem = null;
        $this->selectedQuantity = 1;
        $this->selectedPlanForPurchase = null;
        $this->selectedCreditsForPurchase = [];
        $this->tempPlanId = null;
        $this->tempCreditId = null;
        $this->tempCycle = 'quarterly';
    }

    public function updateSelectedQuantity($quantity)
    {
        if ($quantity >= 1) {
            $this->selectedQuantity = $quantity;
        }
    }

    public function addCreditToPurchase($id)
    {
        $plan = collect($this->credits)->firstWhere('id', $id);
        if (!$plan) return;

        $price = $plan->price;
        if ($plan->discounted_percentage > 0) {
            $price = $price * (100 - $plan->discounted_percentage) / 100;
        }

        $existingIndex = collect($this->selectedCreditsForPurchase)->search(fn($item) => $item['id'] == $id);
        if ($existingIndex !== false) {
            $this->selectedCreditsForPurchase[$existingIndex]['quantity']++;
        } else {
            $this->selectedCreditsForPurchase[] = [
                'id' => $id,
                'name' => $plan->name,
                'quantity' => 1,
                'price' => $price,
                'credits' => $plan->no_of_credits,
            ];
        }
    }

    public function updateCreditQuantity($index, $quantity)
    {
        if ($quantity < 1) {
            unset($this->selectedCreditsForPurchase[$index]);
            $this->selectedCreditsForPurchase = array_values($this->selectedCreditsForPurchase);
        } else {
            $this->selectedCreditsForPurchase[$index]['quantity'] = $quantity;
        }
    }

    public function selectPlanForPurchase($id, $cycle)
    {
        $plan = collect($this->plans)->firstWhere('id', $id);
        if (!$plan) return;

        $basePrice = match ($cycle) {
            'monthly' => $plan->monthly_price,
            'quarterly' => $plan->quarterly_price,
            'annually' => $plan->yearly_price,
            default => $plan->quarterly_price,
        };

        $discount = match ($cycle) {
            'quarterly' => 5,
            'annually' => 10,
            default => 0,
        };

        $price = $discount > 0 ? $basePrice * (100 - $discount) / 100 : $basePrice;

        $this->selectedPlanForPurchase = [
            'id' => $id,
            'name' => $plan->name,
            'cycle' => $cycle,
            'price' => $price,
        ];
    }

    public function removePlanForPurchase()
    {
        $this->selectedPlanForPurchase = null;
    }

    public function getPurchaseTotalProperty()
    {
        $total = 0;

        if ($this->selectedItem && $this->selectedItem['type'] === 'credit') {
            $total += $this->selectedItem['price'] * $this->selectedQuantity;
            if ($this->selectedPlanForPurchase) {
                $total += $this->selectedPlanForPurchase['price'];
            }
        } elseif ($this->selectedItem && $this->selectedItem['type'] === 'plan') {
            $total += $this->selectedItem['price'];
            foreach ($this->selectedCreditsForPurchase as $credit) {
                $total += $credit['price'] * $credit['quantity'];
            }
        }

        return $total;
    }

    public function proceedToPayment()
    {
        if (!$this->selectedItem) return;

        $cart = [];

        if ($this->selectedItem['type'] === 'credit') {
            $cart[] = [
                'type' => 'credit',
                'id' => $this->selectedItem['id'],
                'name' => $this->selectedItem['name'],
                'quantity' => $this->selectedQuantity,
                'price' => $this->selectedItem['price'],
                'credits' => $this->selectedItem['credits'],
            ];
            if ($this->selectedPlanForPurchase) {
                $cart[] = [
                    'type' => 'plan',
                    'id' => $this->selectedPlanForPurchase['id'],
                    'name' => $this->selectedPlanForPurchase['name'],
                    'cycle' => $this->selectedPlanForPurchase['cycle'],
                    'price' => $this->selectedPlanForPurchase['price'],
                ];
            }
        } elseif ($this->selectedItem['type'] === 'plan') {
            $cart[] = [
                'type' => 'plan',
                'id' => $this->selectedItem['id'],
                'name' => $this->selectedItem['name'],
                'cycle' => $this->selectedItem['cycle'],
                'price' => $this->selectedItem['price'],
            ];
            foreach ($this->selectedCreditsForPurchase as $credit) {
                $cart[] = [
                    'type' => 'credit',
                    'id' => $credit['id'],
                    'name' => $credit['name'],
                    'quantity' => $credit['quantity'],
                    'price' => $credit['price'],
                    'credits' => $credit['credits'],
                ];
            }
        }

        $this->validate(['selectedBusinessIdForCart' => 'required|exists:businesses,id']);

        $vendor = Auth::guard('vendor')->user();

        $business = Business::find($this->selectedBusinessIdForCart);
        if (!$business || $business->vendor_id != $vendor->id) {
            session()->flash('error', 'Invalid business selected.');
            return;
        }

        $this->processingCartPayment = true;

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $lineItems = [];
            $metadata = [
                'vendor_id' => $vendor->id,
                'business_id' => $business->id,
                'cart' => json_encode($cart),
            ];

            foreach ($cart as $item) {
                if ($item['type'] === 'credit') {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $item['name'] . ' - ' . $item['credits'] . ' Credits',
                            ],
                            'unit_amount' => (int) round($item['price'] * 100),
                        ],
                        'quantity' => $item['quantity'],
                    ];
                } elseif ($item['type'] === 'plan') {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $item['name'] . ' - ' . ucfirst($item['cycle']) . ' Plan',
                            ],
                            'unit_amount' => (int) round($item['price'] * 100),
                        ],
                        'quantity' => 1,
                    ];
                }
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('vendor.credits.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('vendor.credits'),
                'metadata' => $metadata,
            ]);

            $this->dispatch('stripe-redirect', url: $session->url);
        } catch (\Exception $e) {
            Log::error('Purchase payment error: ' . $e->getMessage());
            session()->flash('error', 'Payment error: ' . $e->getMessage());
            $this->processingCartPayment = false;
        }
    }

    public function render()
    {
        return view('livewire.vendor.credits.plans', [
            'plans'       => $this->plans,
            'credits' => $this->credits,
        ]);
    }
}
