<?php

namespace App\Models\Vendor;

use App\Models\Business\Business;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPurchase extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'cart_items' => 'array',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
