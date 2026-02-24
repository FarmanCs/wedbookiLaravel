<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'email',
        'password',
        'role',
        'otp',
        'otp_attempts',
        'otp_expires_at',
        'two_factor_code',
        'two_factor_code_expires',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'two_factor_code',
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'two_factor_code_expires' => 'datetime',
    ];

    /**
     * Get the name to display in Filament.
     *
     * @return string
     */
    public function getFilamentUserName(): string
    {
        return $this->first_name ?? 'Admin';
    }

    // Optional: also provide a name accessor for general use
    public function getNameAttribute(): string
    {
        return $this->first_name ?? 'Admin';
    }
}