<?php

namespace App\Models\Subscription;

use App\Models\Category\Category;
use App\Models\Feature\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'badge', 'monthly_price', 'quarterly_price',
        'yearly_price', 'category_id', 'is_active', 'published_at',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'quarterly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function transactions()
    {
        return $this->hasMany(PlanTransaction::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_plan');
    }
}