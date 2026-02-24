<?php

namespace App\Models\Analytics;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessSocialClick extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['business_id', 'platform', 'device_id', 'clicked_at'];

    protected $casts = ['clicked_at' => 'datetime'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}