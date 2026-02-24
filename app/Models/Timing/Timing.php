<?php

namespace App\Models\Timing;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'timings';

    protected $fillable = [
        'business_id', 'timings_venue', 'slot_duration', 'working_hours',
        'timings_service_weekly', 'unavailable_dates'
    ];

    protected $casts = [
        'timings_venue' => 'array',
        'working_hours' => 'array',
        'timings_service_weekly' => 'array',
        'unavailable_dates' => 'array',
        'slot_duration' => 'integer',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}