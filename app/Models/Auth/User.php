<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'email',
        'phone_no',
        'password',
        'otp',
        'otp_attempts',
        'otp_expires_at',
        'is_verified',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'otp_expires_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    // Relationships
    public function personalAccessTokens()
    {
        return $this->hasMany(PersonalAccessToken::class);
    }
}