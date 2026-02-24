<?php

namespace App\Models\Business;

use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'name',
        'timings',
        'extra_services',
        'images',
        'price',
        'street',
        'city',
        'state',
        'country',
        'postal_code',
        'capacity',
        'available_dates',
        'status',
    ];

    protected $casts = [
        'timings' => 'json',
        'extra_services' => 'json',
        'images' => 'json',
        'available_dates' => 'json',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}