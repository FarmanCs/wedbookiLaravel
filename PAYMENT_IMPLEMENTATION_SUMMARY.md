# Payment Flow Summary - Quick Reference

## What Changed

### Before (Insecure)
```
User → Plans.php → Create DB records → Stripe → Success
                   ❌ Records created before payment confirmed!
```

### After (Secure with ACID)
```
User → Plans.php (metadata only) → Stripe → Webhook → DB::transaction
       ✅ No DB writes until payment confirmed
       ✅ All writes atomic (all-or-nothing)
       ✅ Automatic retry on deadlock
```

---

## Database Records Created By Webhook

### Purchase Type: `credit`
**Metadata:**
```php
[
    'vendor_id'      => 1,
    'business_id'    => 5,
    'type'           => 'credit',
    'credit_plan_id' => 3,
    'credits'        => 100,
]
```

**Records Created in Transaction:**
1. `VendorPurchase` - Payment record
2. `CreditsTransaction` - Credits ledger
3. `Business.ad_credits += 100` - Increment credits

---

### Purchase Type: `plan`
**Metadata:**
```php
[
    'vendor_id'   => 1,
    'business_id' => 5,
    'type'        => 'plan',
    'plan_id'     => 2,
    'cycle'       => 'quarterly',  // or 'monthly', 'annually'
    'amount'      => '50.00',
]
```

**Records Created in Transaction:**
1. `Subscription` - Active subscription
2. `PlanTransaction` - Payment ledger with Stripe fields
   - `stripe_session_id`
   - `payment_intent_id`
   - `status` = 'completed'

---

### Purchase Type: `cart`
**Metadata:**
```php
[
    'vendor_id'   => 1,
    'business_id' => 5,
    'cart' => json_encode([
        [
            'type'      => 'credit',
            'id'        => 3,
            'name'      => '100 Credits',
            'credits'   => 100,
            'quantity'  => 1,
            'price'     => '25.00',
        ],
        [
            'type'   => 'plan',
            'id'     => 2,
            'name'   => 'Pro Plan',
            'cycle'  => 'quarterly',
            'price'  => '50.00',
        ],
    ])
]
```

**Records Created in Transaction:**
- `VendorPurchase` (1 record with cart JSON)
- For each credit: `CreditsTransaction` + `Business.ad_credits += X`
- For each plan: `Subscription` + `PlanTransaction`

**ALL ITEMS PROCESSED ATOMICALLY** - If one item fails, entire cart rolls back!

---

## Transaction Guarantee

```php
DB::transaction(function () {
    // Create VendorPurchase
    // Create CreditsTransaction(s)
    // Create Subscription(s)
    // Create PlanTransaction(s)
    // Increment ad_credits
}, attempts: 3);  // Auto-retry on deadlock
```

**If ANY operation fails:**
- ✅ All database changes rollback
- ✅ No partial/inconsistent state
- ✅ Retries up to 3 times automatically
- ✅ Error logged for debugging

---

## Idempotency (Webhook Safety)

If Stripe calls webhook twice for same session:

```php
// Check if already processed
if (CreditsTransaction::where('stripe_session_id', $session->id)->exists()) {
    Log::info('Already processed - skipping');
    return;
}
```

**Result:** No duplicate credits or charges! Safe to retry webhooks.

---

## Status Tracking

All transaction records have a `status` field:

| Status | Meaning |
|--------|---------|
| `completed` | Payment successful, records created |
| `failed` | Payment failed or expired |
| `pending` | (Currently unused - we skip to completed) |
| `refunded` | (For future refund handling) |

---

## Models Updated

### PlanTransaction
```php
$fillable = [
    'business_id',
    'plan_id',
    'transaction_time',
    'start_at',
    'end_at',
    'amount',
    'transaction_type',
    'stripe_session_id',     // ← NEW
    'payment_intent_id',     // ← NEW
    'status',                // ← NEW
];
```

### CreditsTransaction
Already had these fields (no changes needed).

---

## Webhook Endpoints

**All requests go to:** `POST /stripe/webhook`

**Handled events:**
- `checkout.session.completed` → Creates records
- `checkout.session.expired` → Marks as failed

---

## Error Scenarios & Handling

| Scenario | Handling |
|----------|----------|
| Invalid business_id | Transaction rollback, error logged |
| Missing plan/credit | Transaction rollback, error logged |
| DB deadlock | Automatic retry (3 attempts) |
| Missing Stripe secret | Caught early, no DB write attempted |
| Webhook signature invalid | Rejected with 400 response |
| Duplicate webhook call | Idempotency check skips processing |

---

## Testing Quick Checklist

```
✓ Single credit purchase creates CreditsTransaction
✓ Single plan purchase creates Subscription + PlanTransaction
✓ Plan has stripe_session_id + status='completed'
✓ Cart processes all items atomically (try with mixed items)
✓ Retry webhook doesn't create duplicates
✓ VendorPurchase records payment for audit trail
✓ Business credits incremented correctly
✓ Logs show all operations (search for '[Webhook]')
```

---

## Migration Applied

```
2026_04_14_000001_add_stripe_fields_to_plans_transactions
  ├─ ADD stripe_session_id VARCHAR(255) UNIQUE
  ├─ ADD payment_intent_id VARCHAR(255)
  └─ ADD status ENUM('pending', 'completed', 'failed', 'refunded')
```

Status: ✅ **APPLIED**

