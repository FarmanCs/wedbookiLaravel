<?php

namespace App\Models\Subscription;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plans_transactions';

    protected $fillable = [
        'business_id',
        'plan_id',
        'transaction_time',
        'start_at',
        'end_at',
        'amount',
        'transaction_type',
        'stripe_session_id',
        'payment_intent_id',
        'status',
    ];

    protected $casts = [
        'transaction_time' => 'datetime',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'amount' => 'decimal:2',
        'status' => 'string',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
