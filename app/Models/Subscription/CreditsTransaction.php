<?php

namespace App\Models\Subscription;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditsTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'credits_transactions';

    protected $fillable = [
        'business_id',
        'credit_plan_id',
        'no_of_credits',
        'amount',
        'stripe_session_id',
        'payment_intent_id',
        'status',
        'tran_type',
        'from',
        'to',
    ];

    protected $casts = [
        'no_of_credits' => 'integer',
        'amount'        => 'decimal:2',
        'from'          => 'datetime',
        'to'            => 'datetime',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function creditPlan()
    {
        return $this->belongsTo(CreditPlan::class);
    }
}
