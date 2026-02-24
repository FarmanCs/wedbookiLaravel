<?php

namespace App\Models\Booking;

use App\Models\Business\Business;
use App\Models\Host\Host;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'host_id',
        'business_id',
        'points',
        'text',
    ];

    protected $casts = [
        'points' => 'integer',
    ];

    // Relationships
    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function replies()
    {
        return $this->hasMany(ReviewReply::class);
    }
}