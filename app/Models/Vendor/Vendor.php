<?php

namespace App\Models\Vendor;

use App\Models\Business\Business;
use App\Models\Booking\Booking;
use App\Models\Booking\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone_no',
        'pending_email',
        'country_code',
        'profile_image',
        'years_of_experience',
        'languages',
        'team_members',
        'specialties',
        'about',
        'country',
        'city',
        'role',
        'password',
        'category_id',
        'postal_code',
        'otp',
        'otp_attempts',
        'otp_expires_at',
        'otp_attempt_count',
        'two_factor_code',
        'two_factor_code_expires',
        'remember_token',
        'profile_verification',
        'email_verified',
        'stripe_account_id',
        'bank_last4',
        'bank_name',
        'account_holder_name',
        'payout_currency',
        'custom_vendor_id',
        'google_id',
        'signup_method',
        'cover_image',
        'last_login',
        'account_deactivated',
        'is_active',
        'account_soft_deleted',
        'account_soft_deleted_at',
        'auto_hard_delete_after_days',
        'credits',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'two_factor_code',
    ];

    protected $casts = [
        'languages' => 'array',
        'specialties' => 'array',
        'otp_expires_at' => 'datetime',
        'two_factor_code_expires' => 'datetime',
        'last_login' => 'datetime',
        'account_soft_deleted_at' => 'datetime',
        'email_verified' => 'boolean',
        'account_deactivated' => 'boolean',
        'is_active' => 'boolean',
        'account_soft_deleted' => 'boolean',
    ];

    // ===== RELATIONSHIPS =====

    public function category()
    {
        return $this->belongsTo(\App\Models\Category\Category::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function services()
    {
        return $this->hasMany(\App\Models\Business\Service::class);
    }

    public function venues()
    {
        return $this->hasMany(\App\Models\Business\Venue::class);
    }

    public function timings()
    {
        return $this->hasMany(\App\Models\Vendor\VendorTiming::class);
    }

    /**
     * Get all bookings for this vendor
     * Relationship through the bookings table vendor_id foreign key
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vendor_id');
    }

    /**
     * Get all reviews for this vendor (if you have a reviews table)
     * For now, returning empty collection - add when you have reviews table
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'vendor_id');
    }

    // ===== SCOPES =====

    /**
     * Scope to get confirmed bookings
     */
    public function scopeConfirmedBookings($query)
    {
        return $query->with('bookings')->get()->map(function ($vendor) {
            $vendor->confirmed_bookings = $vendor->bookings->whereIn('status', ['confirmed', 'completed'])->count();
            return $vendor;
        });
    }

    // ===== CALCULATED PROPERTIES =====

    /**
     * Get total revenue from confirmed/completed bookings
     */
    public function getTotalRevenue()
    {
        return $this->bookings()
            ->whereIn('status', ['confirmed', 'completed'])
            ->where('final_paid', true)
            ->sum('final_amount') ?? 0;
    }

    /**
     * Get total confirmed bookings count
     */
    public function getConfirmedBookingsCount()
    {
        return $this->bookings()
            ->whereIn('status', ['confirmed', 'completed'])
            ->count();
    }

    /**
     * Get total page visitors (unique hosts who booked)
     */
    public function getPageVisitorsCount()
    {
        return $this->bookings()
            ->distinct('host_id')
            ->count('host_id');
    }

    /**
     * Get recent bookings
     */
    public function getRecentBookings($limit = 3)
    {
        return $this->bookings()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get average rating (when reviews table exists)
     */
    public function getAverageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get total reviews count
     */
    public function getTotalReviewsCount()
    {
        return $this->reviews()->count() ?? 0;
    }

    // ===== UTILITY METHODS =====

    /**
     * Get vendor initials for avatar
     */
    public function initials(): string
    {
        $name = $this->full_name ?? 'Vendor';
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }

    /**
     * Get profile percentage (for profile completion)
     */
    public function getProfileCompletionPercentage(): int
    {
        $fields = ['full_name', 'email', 'phone_no', 'profile_image', 'about', 'city', 'country'];
        $filledFields = 0;

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }

        return (int) (($filledFields / count($fields)) * 100);
    }

    /**
     * Check if profile is complete
     */
    public function isProfileComplete(): bool
    {
        return $this->getProfileCompletionPercentage() === 100;
    }

    /**
     * Get booking by custom ID
     */
    public function getBookingByCustomId($customId)
    {
        return $this->bookings()->where('custom_booking_id', $customId)->first();
    }
}
