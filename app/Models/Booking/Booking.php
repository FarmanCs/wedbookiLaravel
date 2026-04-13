<?php

namespace App\Models\Booking;

use App\Models\Business\Business;
use App\Models\Business\Package;
use App\Models\Business\Venue;
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
        'venue_id',
        'booking_type',
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
        'special_requests',
        'stripe_advance_session_id',
        'stripe_final_session_id',
        'stripe_advance_payment_intent',
        'stripe_final_payment_intent',
        'stripe_payment_intent_id',
        'stripe_session_id',
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
        'total_amount' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            // Generate next booking number
            $nextId = self::withTrashed()->max('id') + 1;
            $booking->custom_booking_id = 'WBK-' . date('Y') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
        });
    }

    // ===== RELATIONSHIPS =====

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

    // Helper to check if paid
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // ===== HELPER METHODS =====

    /**
     * Check if booking is for a package
     */
    public function isPackageBooking(): bool
    {
        return $this->booking_type === 'package' && $this->package_id !== null;
    }

    /**
     * Check if booking is for a venue
     */
    public function isVenueBooking(): bool
    {
        return $this->booking_type === 'venue' && $this->venue_id !== null;
    }

    /**
     * Get the bookable item (package or venue)
     */
    public function getBookableItem()
    {
        return $this->isPackageBooking() ? $this->package : $this->venue;
    }

    /**
     * Get the bookable item name
     */
    public function getBookableItemName(): string
    {
        if ($this->isPackageBooking() && $this->package) {
            return $this->package->name;
        }

        if ($this->isVenueBooking() && $this->venue) {
            return $this->venue->name;
        }

        return 'Custom Booking';
    }

    /**
     * Calculate remaining amount to pay
     */
    public function getRemainingAmount(): float
    {
        if ($this->final_paid) {
            return 0;
        }

        if ($this->advance_paid) {
            return $this->final_amount - $this->advance_amount;
        }

        return $this->final_amount;
    }

    /**
     * Get next payment amount
     */
    public function getNextPaymentAmount(): float
    {
        if ($this->final_paid) {
            return 0;
        }

        if (!$this->advance_paid) {
            return $this->advance_amount;
        }

        return $this->final_amount - $this->advance_amount;
    }

    /**
     * Get next payment type
     */
    public function getNextPaymentType(): ?string
    {
        if ($this->final_paid) {
            return null;
        }

        return !$this->advance_paid ? 'advance' : 'final';
    }

    /**
     * Check if booking can be paid
     */
    public function canBePaid(): bool
    {
        return $this->status === 'confirmed' && !$this->final_paid;
    }

    /**
     * Update payment status based on paid flags
     */
    public function updatePaymentStatus(): void
    {
        if ($this->advance_paid && $this->final_paid) {
            $this->payment_status = 'completed';
            $this->payment_completed_at = now();
        } elseif ($this->advance_paid) {
            $this->payment_status = 'partial';
        } else {
            $this->payment_status = 'pending';
        }

        $this->save();
    }

    /**
     * Approve booking
     */
    public function approve(): void
    {
        $this->status = 'confirmed';
        $this->approved_at = now();
        $this->save();
    }

    /**
     * Reject booking
     */
    public function reject(): void
    {
        $this->status = 'rejected';
        $this->save();
    }
}
