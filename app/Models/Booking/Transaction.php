<?php

namespace App\Models\Booking;

use App\Models\Host\Host;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id',
        'host_id',
        'vendor_id',
        'amount',
        'status',
        'payment_method',
        'payment_reference',
        'sender_id',
        'receiver_id',
        'sender_type',
        'receiver_type',
        'sender_name',
        'receiver_name',
        'redirect_url',
        'acquirer_ref',
        'profile_id',
        'tran_type',
        'tran_class',
        'cart_id',
        'cart_currency',
        'comments',
        'request_body',
        'click_pay_response',
        'click_pay_callback',
        'paid_at',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'request_body' => 'json',
        'click_pay_response' => 'json',
        'click_pay_callback' => 'json',
        'paid_at' => 'datetime',
        'metadata' => 'array',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
