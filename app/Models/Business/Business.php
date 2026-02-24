<?php

namespace App\Models\Business;

use App\Models\Booking\Booking;
use App\Models\Booking\Review;
use App\Models\Booking\ReviewReply;
use App\Models\Category\Category;
use App\Models\Category\SubCategory;
use App\Models\Guest\Favourite;
use App\Models\Vendor\Vendor;
use App\Models\Subscription\Subscription;
use App\Models\Timing\Timing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'business_desc',
        'category_id',
        'subcategory_id',
        'vendor_id',
        'venue_type',
        'member_type',
        'business_registration',
        'business_license_number',
        'rating',
        'is_featured',
        'business_type',
        'website',
        'social_links',
        'postal_code',
        'business_email',
        'business_phone',
        'features',
        'profile_verification',
        'services',
        'faqs',
        'portfolio_images',
        'videos',
        'street_address',
        'city',
        'country',
        'capacity',
        'view_count',
        'social_count',
        'last_login',
        'payment_days_advance',
        'payment_days_final',
        'services_radius',
        'advance_percentage',
        'profile_image',
        'cover_image',
        'chat_image',
        'chat_video',
        'chat_document',
    ];

    protected $casts = [
        'social_links' => 'json',
        'features' => 'json',
        'faqs' => 'json',
        'portfolio_images' => 'json',
        'videos' => 'json',
        'rating' => 'decimal:2',
        'is_featured' => 'boolean',
        'last_login' => 'datetime',
        'advance_percentage' => 'decimal:2',
    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewReplies()
    {
        return $this->hasMany(ReviewReply::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function timings()
    {
        return $this->hasMany(Timing::class);
    }

    // public function subscriptions()
    // {
    //     return $this->hasMany(Subscription::class);
    // }
}