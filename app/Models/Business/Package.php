<?php

namespace App\Models\Business;

use App\Models\Booking\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_id',
        'name',
        'price',
        'discount',
        'discount_percentage',
        'description',
        'features',
        'is_popular',
    ];

    protected $casts = [
        'features' => 'json',
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'is_popular' => 'boolean',
    ];

    // Relationships
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}