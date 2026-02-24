<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorTiming extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_id',        // Changed from vendor_id
        'timings_venue',
        'slot_duration',
        'working_hours',
        'timings_service_weekly',
        'unavailable_dates',
    ];

    protected $casts = [
        'timings_venue' => 'json',
        'working_hours' => 'json',
        'timings_service_weekly' => 'json',
        'unavailable_dates' => 'json',
    ];

    // Relationships
    public function business()
    {
        return $this->belongsTo(\App\Models\Business\Business::class);
    }
}