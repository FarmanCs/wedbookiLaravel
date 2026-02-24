<?php

namespace App\Models\Host;

use App\Models\Booking\Booking;
use App\Models\Booking\Review;
use App\Models\Guest\Favourite;
use App\Models\Timing\Checklist;
use App\Models\Timing\PersonalizedChecklist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Host extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name', 'partner_full_name', 'partner_email', 'country', 'email',
        'linked_email', 'country_code', 'phone_no', 'profile_image', 'about',
        'wedding_date', 'password', 'google_id', 'google_access_token',
        'google_refresh_token', 'google_token_expiry', 'google_calendar_connected',
        'google_email', 'google_name', 'apple_id', 'signup_method', 'status',
        'role', 'is_verified', 'invite_image_url', 'pending_email', 'category',
        'event_type', 'estimated_guests', 'event_budget', 'otp', 'otp_attempts',
        'otp_expires_at', 'two_factor_code', 'two_factor_code_expires',
        'remember_token', 'join_date', 'account_deactivated', 'account_soft_deleted',
        'account_soft_deleted_at', 'auto_hard_delete_after_days',
    ];

    protected $hidden = [
        'password', 'remember_token', 'otp', 'two_factor_code',
    ];

    protected $casts = [
        'google_token_expiry' => 'datetime',
        'otp_expires_at' => 'datetime',
        'two_factor_code_expires' => 'datetime',
        'join_date' => 'datetime',
        'account_soft_deleted_at' => 'datetime',
        'wedding_date' => 'date',
        'event_budget' => 'decimal:2',
        'account_deactivated' => 'boolean',
        'account_soft_deleted' => 'boolean',
        'google_calendar_connected' => 'boolean',
    ];

    public function initials(): string
    {
    $name = $this->full_name ?? $this->name ?? 'Host';
    $words = explode(' ', trim($name));
    if (count($words) >= 2) {
        return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
    }
    return strtoupper(substr($name, 0, 2));
    }
    // Relationships
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function sessions()
    {
        return $this->hasMany(HostSession::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    public function personalizedChecklists()
    {
        return $this->hasMany(PersonalizedChecklist::class);
    }
}