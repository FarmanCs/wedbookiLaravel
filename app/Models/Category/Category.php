<?php

namespace App\Models\Category;

use App\Models\Business\Business;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'description',
        'image',
    ];

    // Relationships
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}