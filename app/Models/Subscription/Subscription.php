<?php

namespace App\Models\Subscription;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'business_id', 'plan_id', 'start_date', 'end_date',
        'subscription_type', 'credits', 'last_credit_date', 'last_reminder_sent',
        'last_renewal_attempt', 'amount', 'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'last_credit_date' => 'datetime',
        'last_reminder_sent' => 'datetime',
        'last_renewal_attempt' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function features()
    {
        return $this->hasMany(SubscriptionFeature::class);
    }
}