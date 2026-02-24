<?php

namespace App\Models\Business;

use App\Models\Feature\ExtraService;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'img',
        'vendor_id',
        'category',
    ];

    protected $casts = [
        'img' => 'json',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function extraServices()
    {
        return $this->hasMany(ExtraService::class);
    }
}