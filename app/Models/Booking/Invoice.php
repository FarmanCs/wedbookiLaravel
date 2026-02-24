<?php

namespace App\Models\Booking;

use App\Models\Business\Business;
use App\Models\Host\Host;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id', 'host_id', 'business_id', 'vendor_id', 'sender_name',
        'receiver_name', 'invoice_number', 'payment_type', 'total_amount',
        'advance_amount', 'remaining_amount', 'base_amount_paid', 'platform_fee_from_user',
        'total_user_paid', 'vendor_share', 'platform_share', 'commission_rate',
        'vendor_plan_name', 'advance_paid_date', 'final_paid_date', 'is_advance_paid',
        'is_final_paid', 'advance_due_date', 'final_due_date', 'advance_percentage',
        'full_payment_only',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'advance_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'base_amount_paid' => 'decimal:2',
        'platform_fee_from_user' => 'decimal:2',
        'total_user_paid' => 'decimal:2',
        'vendor_share' => 'decimal:2',
        'platform_share' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'advance_paid_date' => 'datetime',
        'final_paid_date' => 'datetime',
        'advance_due_date' => 'datetime',
        'final_due_date' => 'datetime',
        'is_advance_paid' => 'boolean',
        'is_final_paid' => 'boolean',
        'full_payment_only' => 'boolean',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Scope a query to only include paid invoices (advance or final paid).
     */
    public function scopePaid($query)
    {
        return $query->where(function ($q) {
            $q->where('is_advance_paid', true)
              ->orWhere('is_final_paid', true);
        });
    }
}