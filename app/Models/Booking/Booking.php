<?php

namespace App\Models\Booking;

use App\Models\Business\Business;
use App\Models\Business\Package;
use App\Models\Host\Host;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['custom_booking_id'];
    protected $fillable = [
        'host_id',
        'business_id',
        'vendor_id',
        'package_id',
        'amount',
        'advance_percentage',
        'advance_amount',
        'final_amount',
        'advance_due_date',
        'final_due_date',
        'event_date',
        'timezone',
        'time_slot',
        'guests',
        'advance_paid',
        'final_paid',
        'status',
        'approved_at',
        'payment_completed_at',
        'start_time',
        'end_time',
        'payment_status',
        'is_synced_with_calendar',
        'extra_services',
    ];

    protected $casts = [
        'advance_due_date' => 'date',
        'final_due_date' => 'date',
        'event_date' => 'date',
        'advance_paid' => 'boolean',
        'final_paid' => 'boolean',
        'approved_at' => 'datetime',
        'payment_completed_at' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_synced_with_calendar' => 'boolean',
        'amount' => 'decimal:2',
        'advance_percentage' => 'decimal:2',
        'advance_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'extra_services' => 'json',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {

            // Generate next booking number
            $nextId = self::withTrashed()->max('id') + 1;

            $booking->custom_booking_id =
                'WBK-' . date('Y') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
        });
    }


    // Relationships
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

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
