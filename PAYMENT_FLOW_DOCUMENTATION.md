# Secure Payment Flow with ACID Transactions

## Overview
This implementation ensures **ACID-safe payment processing** using MySQL transactions via Eloquent ORM. Database records are only created AFTER Stripe payment confirmation through webhooks.

---

## Architecture

### Payment Flow

```
User Initiates Purchase
        ↓
[Plans.php Component]
    - Validates business & plan/credits selection
    - Creates Stripe checkout session
    - Stores ONLY metadata (no DB writes yet)
    - Redirects to Stripe
        ↓
[Stripe Checkout]
    - User completes payment
    - Returns to success URL with session_id
        ↓
[Webhook] StripeWebhookController
    - Verifies Stripe signature
    - Retrieves session from Stripe
    - Wraps all DB writes in MySQL transaction
    - Updates business credits OR creates subscriptions
    - All-or-nothing ACID guarantee
```

---

## Key Features

### 1. **No Premature Database Writes**
- **Before**: Plans.php created Subscription & PlanTransaction records BEFORE payment
- **After**: Only Stripe session metadata is stored; DB records created only after webhook confirms payment

### 2. **MySQL Transactions for ACID Safety**
```php
DB::transaction(function () {
    // All writes succeed together or all rollback on failure
    // No partial/inconsistent state possible
}, attempts: 3); // Automatic retry on deadlock
```

### 3. **Idempotency Protection**
- Webhook checks if transaction already processed
- Prevents duplicate credits if webhook is called multiple times
- Safe to retry failed webhooks

### 4. **Stripe Metadata Tracking**
All Stripe sessions store metadata for webhook processing:
```php
'metadata' => [
    'vendor_id'      => $vendor->id,
    'business_id'    => $business->id,
    'plan_id'        => $plan->id,
    'cycle'          => 'quarterly',  // or 'monthly', 'annually'
    'amount'         => $price,
    'type'           => 'plan',        // or 'credit', 'cart'
]
```

---

## Database Schema Updates

### PlanTransaction Migration
Added three new fields for Stripe tracking:

```sql
ALTER TABLE plans_transactions ADD COLUMN stripe_session_id VARCHAR(255) UNIQUE;
ALTER TABLE plans_transactions ADD COLUMN payment_intent_id VARCHAR(255);
ALTER TABLE plans_transactions ADD COLUMN status ENUM('pending', 'completed', 'failed', 'refunded');
```

### CreditsTransaction Table
Already has:
- `stripe_session_id` (unique)
- `payment_intent_id`
- `status` (enum)

---

## Webhook Processing

### Single Credit Purchase
```
Session metadata: { type: 'credit', credit_plan_id, credits, ... }
    ↓
[DB::transaction]
    1. Create VendorPurchase record
    2. Increment business.ad_credits
    3. Create CreditsTransaction record
    ↓
All succeed or rollback on error
```

### Single Plan Purchase (NEW)
```
Session metadata: { type: 'plan', plan_id, cycle, amount, ... }
    ↓
[DB::transaction]
    1. Create Subscription record
    2. Create PlanTransaction record
    3. Record Stripe session_id & payment_intent_id
    ↓
All succeed or rollback on error
```

### Cart Purchase (Credits + Plans)
```
Session metadata: { cart: [...], ... }
    ↓
[DB::transaction]
    1. Create VendorPurchase record
    2. For each credit item:
       - Increment ad_credits
       - Create CreditsTransaction
    3. For each plan item:
       - Create Subscription
       - Create PlanTransaction
    ↓
All items processed atomically or none
```

---

## Webhook Signature

### Request
```
POST /stripe/webhook
Content-Type: application/json

{
  "type": "checkout.session.completed",
  "data": {
    "object": {
      "id": "cs_test_xxx",
      "payment_intent": "pi_test_xxx",
      "amount_total": 5000,
      "metadata": {
        "vendor_id": "1",
        "business_id": "5",
        "type": "plan",
        "plan_id": "2",
        "cycle": "quarterly",
        "amount": "50.00"
      }
    }
  }
}
```

### Processing
1. **Signature Verification**: Ensures request from Stripe
2. **Metadata Validation**: Checks vendor_id, business_id, type
3. **Idempotency Check**: Skip if already processed
4. **Transaction**: Wrap all DB ops in `DB::transaction()`
5. **Logging**: Log all operations for audit trail

---

## Error Handling

### Transaction Rollback
Any error causes complete rollback:
- Invalid business ID
- Missing plan/credit plan
- Database constraint violations
- Deadlock (auto-retry 3 times)

### Webhook Expiration
If Stripe session expires before payment:
```php
handleCheckoutExpired($session)
    - Mark pending CreditsTransaction as 'failed'
    - Mark pending PlanTransaction as 'failed'
    - Mark VendorPurchase as 'failed'
```

### Logging
All operations logged for debugging:
```
[Webhook] Processing checkout.session.completed
[Webhook] Credit plan purchased
[Webhook] Checkout processed successfully
[Webhook] Credit transaction already processed (idempotency)
[Webhook] Transaction failed: {error}
```

---

## Code Changes Summary

### 1. Plans.php (Livewire Component)
- ✅ `confirmPlanPurchase()`: Removed Subscription/PlanTransaction creation
  - Now only creates Stripe session
  - Includes plan metadata (type='plan', cycle, amount, etc.)
  
- ✅ `confirmCreditPurchase()`: Already correct
  - Only creates Stripe session
  - Includes credit metadata (type='credit', credit_plan_id, credits)

### 2. PlanTransaction Model
- ✅ Added fields to `$fillable`:
  - `stripe_session_id`
  - `payment_intent_id`
  - `status`

- ✅ Added `status` to `$casts`

### 3. StripeWebhookController
- ✅ Added `use Illuminate\Support\Facades\DB;`
- ✅ Refactored `handleCheckoutCompleted()` to:
  - Support 3 purchase types: credit, plan, cart
  - Wrap all in `DB::transaction()`
  - Improve error handling & logging
- ✅ Separated logic into methods:
  - `handleCreditCheckout()`
  - `handlePlanCheckout()`
  - `handleCartCheckout()`
  - `processCartCredit()`
  - `processCartPlan()`

### 4. Migration
- ✅ Created `2026_04_14_000001_add_stripe_fields_to_plans_transactions.php`
  - Adds stripe_session_id (unique)
  - Adds payment_intent_id
  - Adds status enum

---

## Testing Checklist

### Single Credit Purchase
- [ ] User selects credit plan
- [ ] Opens confirmation modal
- [ ] Selects business
- [ ] Clicks "Proceed to Payment"
- [ ] Stripe redirects
- [ ] Payment succeeds
- [ ] Webhook creates CreditsTransaction
- [ ] Business credits incremented
- [ ] VendorPurchase record created

### Single Plan Purchase
- [ ] User selects plan & cycle
- [ ] Opens confirmation modal
- [ ] Selects business
- [ ] Clicks "Buy Now"
- [ ] Stripe redirects
- [ ] Payment succeeds
- [ ] Webhook creates Subscription
- [ ] Webhook creates PlanTransaction
- [ ] Includes stripe_session_id & status='completed'

### Cart Purchase
- [ ] User adds multiple credits & plans
- [ ] Opens cart modal
- [ ] Selects business
- [ ] Clicks "Checkout"
- [ ] Stripe redirects
- [ ] Payment succeeds
- [ ] Webhook processes all items atomically
- [ ] VendorPurchase with cart JSON
- [ ] All CreditsTransaction & Subscription records created

### Idempotency
- [ ] Manually retry webhook (admin UI or manually)
- [ ] No duplicate records created
- [ ] Logs show "already processed"

### Error Scenarios
- [ ] Invalid business ID → Transaction rollbacks
- [ ] Missing plan → Transaction rollbacks
- [ ] Database deadlock → Auto-retry, succeeds
- [ ] Expired session → PlanTransaction status='failed'

---

## Audit Trail

Every transaction creates records with:
- **stripe_session_id**: Links to Stripe session
- **payment_intent_id**: Links to Stripe payment intent
- **status**: 'completed', 'failed', 'pending'
- **created_at**: Timestamp
- **updated_at**: Timestamp

Can query payment history:
```php
// Get all transactions for a business
$business->creditTransactions()->get();
$business->planTransactions()->get();

// Find by Stripe session
PlanTransaction::where('stripe_session_id', $sessionId)->first();

// Get all failed transactions
CreditsTransaction::where('status', 'failed')->get();
```

---

## Security Features

1. **Signature Verification**: Stripe webhook must be signed
2. **ACID Transactions**: No inconsistent state
3. **Idempotency**: Safe to retry webhooks
4. **Business Ownership**: Verify vendor owns business before creating records
5. **Metadata Validation**: Verify all required fields present
6. **Logging**: Full audit trail
7. **Deadlock Handling**: Auto-retry on database contention
8. **Atomic Credits Update**: `increment()` is atomic at DB level

---

## What to Monitor

1. **Webhook Processing Time**: Should be < 5 seconds
2. **Failed Transactions**: Check `status='failed'` records
3. **Idempotency Hits**: Count of already-processed webhooks
4. **Deadlock Retries**: Should be rare
5. **Stripe API Errors**: Check logs for rate limits, auth errors

