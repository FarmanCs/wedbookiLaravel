<?php

namespace App\Models\Booking;

use App\Models\Business\Business;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewReply extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'review_id',
        'business_id',
        'vendor_id',
        'text',
    ];

    // Relationships
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}