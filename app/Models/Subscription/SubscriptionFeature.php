<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'features', 'subscription_id', 'is_active', 'is_deleted'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}