<?php

namespace App\Models\Vendor;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name', 'email', 'phone_no', 'pending_email', 'country_code',
        'profile_image', 'years_of_experience', 'languages', 'team_members',
        'specialties', 'about', 'country', 'city', 'role', 'password',
        'category_id', 'postal_code', 'otp', 'otp_attempts', 'otp_expires_at',
        'otp_attempt_count', 'two_factor_code', 'two_factor_code_expires',
        'remember_token', 'profile_verification', 'email_verified',
        'stripe_account_id', 'bank_last4', 'bank_name', 'account_holder_name',
        'payout_currency', 'custom_vendor_id', 'google_id', 'signup_method',
        'cover_image', 'last_login', 'account_deactivated', 'is_active',
        'account_soft_deleted', 'account_soft_deleted_at', 'auto_hard_delete_after_days',
    ];

    protected $hidden = [
        'password', 'remember_token', 'otp', 'two_factor_code',
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

    // Relationships
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

    public function packages()
    {
        return $this->hasMany(\App\Models\Vendor\VendorPackage::class);
    }

    public function timings()
    {
        return $this->hasMany(\App\Models\Vendor\VendorTiming::class);
    }

    // Optional: for Filament avatars
    public function initials(): string
    {
        $name = $this->full_name ?? 'Vendor';
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }
}